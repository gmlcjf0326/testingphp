<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher;

class TeacherController extends Controller
{
    /**
     * Display a listing of the teachers.
     */
    public function index()
    {
        $teachers = Teacher::active()
            ->orderBy('rating', 'desc')
            ->orderBy('lesson_count', 'desc')
            ->paginate(12);
        
        return view('teachers.index', compact('teachers'));
    }
    
    /**
     * Display the specified teacher.
     */
    public function show($id)
    {
        $teacher = Teacher::with(['approvedReviews' => function($query) {
            $query->latest()->take(10);
        }])->findOrFail($id);
        
        return view('teachers.show', compact('teacher'));
    }
}
