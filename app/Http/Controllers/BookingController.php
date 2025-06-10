<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Program;
use App\Models\Teacher;
use App\Models\TeacherSchedule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BookingController extends Controller
{
    /**
     * 예약 페이지 표시
     */
    public function create(Request $request, $programId)
    {
        $program = Program::findOrFail($programId);
        
        // 선택된 선생님이 있으면 가져오기
        $teacherId = $request->get('teacher_id');
        $teacher = $teacherId ? Teacher::find($teacherId) : null;
        
        // 활성화된 선생님 목록
        $teachers = Teacher::where('is_active', true)->get();
        
        return view('bookings.create', compact('program', 'teacher', 'teachers'));
    }

    /**
     * 예약 가능한 시간대 조회 (AJAX)
     */
    public function getAvailableSlots(Request $request)
    {
        $request->validate([
            'teacher_id' => 'nullable|exists:teachers,id',
            'date' => 'required|date|after_or_equal:today',
        ]);

        // 선생님이 지정되지 않은 경우 기본 시간대 제공
        if (!$request->teacher_id) {
            $dayOfWeek = date('w', strtotime($request->date));
            $slots = [];
            
            // 평일 (1-5)
            if ($dayOfWeek >= 1 && $dayOfWeek <= 5) {
                // 오전 시간대
                for ($hour = 9; $hour < 12; $hour++) {
                    $slots[] = [
                        'time' => sprintf('%02d:00', $hour),
                        'display' => sprintf('%02d:00 - %02d:40', $hour, $hour)
                    ];
                }
                // 오후 시간대
                for ($hour = 14; $hour < 18; $hour++) {
                    $slots[] = [
                        'time' => sprintf('%02d:00', $hour),
                        'display' => sprintf('%02d:00 - %02d:40', $hour, $hour)
                    ];
                }
            }
            // 토요일 (6)
            elseif ($dayOfWeek == 6) {
                for ($hour = 10; $hour < 14; $hour++) {
                    $slots[] = [
                        'time' => sprintf('%02d:00', $hour),
                        'display' => sprintf('%02d:00 - %02d:40', $hour, $hour)
                    ];
                }
            }
            // 일요일은 휴무
            
            return response()->json([
                'success' => true,
                'slots' => $slots
            ]);
        }

        $slots = TeacherSchedule::getAvailableSlots(
            $request->teacher_id,
            $request->date
        );

        return response()->json([
            'success' => true,
            'slots' => $slots
        ]);
    }

    /**
     * 예약 처리
     */
    public function store(Request $request)
    {
        $request->validate([
            'program_id' => 'required|exists:programs,id',
            'teacher_id' => 'nullable|exists:teachers,id',
            'booking_date' => 'required|date|after_or_equal:today',
            'booking_time' => 'required',
            'parent_name' => 'required|string|max:255',
            'parent_phone' => 'required|string|max:20',
            'parent_email' => 'required|email',
            'child_age' => 'required|integer|min:1|max:20',
            'special_notes' => 'nullable|string|max:500',
        ]);

        try {
            DB::beginTransaction();

            $program = Program::findOrFail($request->program_id);
            
            // 예약 생성
            $booking = Booking::create([
                'booking_number' => Booking::generateBookingNumber(),
                'user_id' => auth()->id(),
                'program_id' => $request->program_id,
                'teacher_id' => $request->teacher_id,
                'booking_date' => $request->booking_date,
                'booking_time' => $request->booking_time,
                'duration' => 40, // 기본 40분
                'parent_name' => $request->parent_name,
                'parent_phone' => $request->parent_phone,
                'parent_email' => $request->parent_email,
                'child_age' => $request->child_age,
                'special_notes' => $request->special_notes,
                'amount' => $program->price,
                'payment_status' => 'pending',
                'status' => 'pending',
            ]);

            DB::commit();

            // 결제 페이지로 이동
            return redirect()->route('bookings.payment', $booking->id);

        } catch (\Exception $e) {
            DB::rollback();
            Log::error('예약 생성 실패: ' . $e->getMessage());
            
            return back()->with('error', '예약 처리 중 오류가 발생했습니다.')
                         ->withInput();
        }
    }

    /**
     * 결제 페이지
     */
    public function payment($bookingId)
    {
        $booking = Booking::with(['program', 'teacher'])
                          ->where('id', $bookingId)
                          ->where(function($query) {
                              $query->where('user_id', auth()->id())
                                    ->orWhere('parent_email', request()->user()->email ?? '');
                          })
                          ->firstOrFail();

        if ($booking->payment_status === 'paid') {
            return redirect()->route('bookings.complete', $booking->id);
        }

        return view('bookings.payment', compact('booking'));
    }

    /**
     * 결제 처리 (토스페이먼츠)
     */
    public function processPayment(Request $request, $bookingId)
    {
        $booking = Booking::findOrFail($bookingId);

        // 토스페이먼츠 결제 준비
        session([
            'booking_id' => $booking->id,
            'booking_amount' => $booking->amount,
        ]);

        return response()->json([
            'success' => true,
            'booking_number' => $booking->booking_number,
            'amount' => $booking->amount,
        ]);
    }

    /**
     * 결제 성공 처리
     */
    public function paymentSuccess(Request $request)
    {
        $bookingId = session('booking_id');
        
        if (!$bookingId) {
            return redirect()->route('home')->with('error', '잘못된 접근입니다.');
        }

        try {
            DB::beginTransaction();

            $booking = Booking::findOrFail($bookingId);
            
            // 결제 정보 업데이트
            $booking->update([
                'payment_status' => 'paid',
                'payment_method' => $request->get('paymentMethod', 'card'),
                'payment_key' => $request->get('paymentKey'),
                'paid_at' => now(),
                'status' => 'confirmed',
                'confirmed_at' => now(),
            ]);

            DB::commit();

            // 세션 정리
            session()->forget(['booking_id', 'booking_amount']);

            return redirect()->route('bookings.complete', $booking->id)
                           ->with('success', '예약이 완료되었습니다.');

        } catch (\Exception $e) {
            DB::rollback();
            Log::error('결제 처리 실패: ' . $e->getMessage());
            
            return redirect()->route('bookings.payment', $bookingId)
                           ->with('error', '결제 처리 중 오류가 발생했습니다.');
        }
    }

    /**
     * 결제 실패 처리
     */
    public function paymentFail(Request $request)
    {
        $bookingId = session('booking_id');
        
        if ($bookingId) {
            return redirect()->route('bookings.payment', $bookingId)
                           ->with('error', '결제가 실패했습니다. 다시 시도해주세요.');
        }

        return redirect()->route('home')->with('error', '결제가 실패했습니다.');
    }

    /**
     * 예약 완료 페이지
     */
    public function complete($bookingId)
    {
        $booking = Booking::with(['program', 'teacher'])
                          ->where('id', $bookingId)
                          ->where('payment_status', 'paid')
                          ->firstOrFail();

        return view('bookings.complete', compact('booking'));
    }

    /**
     * 내 예약 목록
     */
    public function myBookings()
    {
        $bookings = Booking::with(['program', 'teacher'])
                           ->where('user_id', auth()->id())
                           ->orWhere('parent_email', auth()->user()->email)
                           ->orderBy('booking_date', 'desc')
                           ->orderBy('booking_time', 'desc')
                           ->paginate(10);

        return view('bookings.index', compact('bookings'));
    }

    /**
     * 예약 상세
     */
    public function show($bookingId)
    {
        $booking = Booking::with(['program', 'teacher'])
                          ->where('id', $bookingId)
                          ->where(function($query) {
                              $query->where('user_id', auth()->id())
                                    ->orWhere('parent_email', auth()->user()->email ?? '');
                          })
                          ->firstOrFail();

        return view('bookings.show', compact('booking'));
    }

    /**
     * 예약 취소
     */
    public function cancel(Request $request, $bookingId)
    {
        $request->validate([
            'cancel_reason' => 'required|string|max:255',
        ]);

        $booking = Booking::where('id', $bookingId)
                          ->where('user_id', auth()->id())
                          ->where('status', '!=', 'cancelled')
                          ->firstOrFail();

        // 수업 24시간 전까지만 취소 가능
        $bookingDateTime = $booking->start_date_time;
        if ($bookingDateTime->subHours(24)->isPast()) {
            return back()->with('error', '수업 24시간 전까지만 취소가 가능합니다.');
        }

        try {
            DB::beginTransaction();

            $booking->update([
                'status' => 'cancelled',
                'cancelled_at' => now(),
                'cancel_reason' => $request->cancel_reason,
            ]);

            // 결제 취소 처리 (토스페이먼츠 API 호출 필요)
            if ($booking->payment_status === 'paid') {
                // TODO: 토스페이먼츠 결제 취소 API 호출
                $booking->update([
                    'payment_status' => 'refunded',
                ]);
            }

            DB::commit();

            return redirect()->route('bookings.index')
                           ->with('success', '예약이 취소되었습니다.');

        } catch (\Exception $e) {
            DB::rollback();
            Log::error('예약 취소 실패: ' . $e->getMessage());
            
            return back()->with('error', '예약 취소 중 오류가 발생했습니다.');
        }
    }
}
