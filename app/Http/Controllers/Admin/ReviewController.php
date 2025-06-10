<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use App\Models\Program;
use App\Models\Teacher;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Display a listing of the reviews.
     */
    public function index()
    {
        $reviews = Review::with(['teacher', 'program'])
            ->latest()
            ->paginate(10);
        
        return view('admin.reviews.index', compact('reviews'));
    }

    /**
     * Show the form for creating a new review.
     */
    public function create()
    {
        $teachers = Teacher::where('is_active', true)->orderBy('name')->get();
        $programs = Program::where('is_active', true)->orderBy('name')->get();
        
        return view('admin.reviews.create', compact('teachers', 'programs'));
    }

    /**
     * Store a newly created review in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'teacher_id' => 'required|exists:teachers,id',
            'program_id' => 'required|exists:programs,id',
            'student_name' => 'required|string|max:255',
            'parent_name' => 'required|string|max:255',
            'content' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
            'is_approved' => 'boolean',
        ]);
        
        Review::create($validated);
        
        return redirect()->route('admin.reviews.index')
            ->with('success', '리뷰가 성공적으로 생성되었습니다.');
    }

    /**
     * Display the specified review.
     */
    public function show(Review $review)
    {
        $review->load(['teacher', 'program']);
        return view('admin.reviews.show', compact('review'));
    }

    /**
     * Show the form for editing the specified review.
     */
    public function edit(Review $review)
    {
        $teachers = Teacher::where('is_active', true)->orderBy('name')->get();
        $programs = Program::where('is_active', true)->orderBy('name')->get();
        
        return view('admin.reviews.edit', compact('review', 'teachers', 'programs'));
    }

    /**
     * Update the specified review in storage.
     */
    public function update(Request $request, Review $review)
    {
        $validated = $request->validate([
            'teacher_id' => 'required|exists:teachers,id',
            'program_id' => 'required|exists:programs,id',
            'student_name' => 'required|string|max:255',
            'parent_name' => 'required|string|max:255',
            'content' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
            'is_approved' => 'boolean',
        ]);
        
        $review->update($validated);
        
        return redirect()->route('admin.reviews.index')
            ->with('success', '리뷰가 성공적으로 수정되었습니다.');
    }

    /**
     * Remove the specified review from storage.
     */
    public function destroy(Review $review)
    {
        $review->delete();
        
        return redirect()->route('admin.reviews.index')
            ->with('success', '리뷰가 성공적으로 삭제되었습니다.');
    }
    
    /**
     * Toggle review approval status.
     */
    public function toggleApproval(Review $review)
    {
        $review->update([
            'is_approved' => !$review->is_approved
        ]);
        
        $status = $review->is_approved ? '승인' : '미승인';
        
        return redirect()->back()
            ->with('success', "리뷰가 {$status} 상태로 변경되었습니다.");
    }
}
