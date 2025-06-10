<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Program;
use App\Models\Teacher;
use App\Models\Review;
use App\Models\Inquiry;

class MainController extends Controller
{
    /**
     * 메인 홈페이지
     */
    public function index()
    {
        // 추천 프로그램 (문의 폼에서 사용)
        $programs = Program::where('is_active', true)
            ->orderBy('order')
            ->orderBy('name')
            ->get();
        
        // 우수 선생님
        $teachers = Teacher::where('is_active', true)
            ->orderBy('rating', 'desc')
            ->take(6)
            ->get();
        
        // 최근 리뷰
        $reviews = Review::with(['teacher', 'program'])
            ->where('is_approved', true)
            ->latest()
            ->take(10)
            ->get();
        
        return view('main.index', compact('programs', 'teachers', 'reviews'));
    }
    
    /**
     * 뮤지토리 소개 페이지
     */
    public function about()
    {
        return view('main.about');
    }
    
    /**
     * 수업 문의 처리
     */
    public function inquiry(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'child_age' => 'required|integer|min:0|max:20',
            'program_id' => 'nullable|exists:programs,id',
            'message' => 'nullable|string|max:1000',
        ]);
        
        // 문의 저장
        Inquiry::create($validated);
        
        return redirect()->back()->with('success', '문의가 성공적으로 접수되었습니다. 빠른 시일 내에 연락드리겠습니다.');
    }
}
