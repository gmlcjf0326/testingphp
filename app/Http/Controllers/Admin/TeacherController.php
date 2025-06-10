<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TeacherController extends Controller
{
    /**
     * Display a listing of the teachers.
     */
    public function index()
    {
        $teachers = Teacher::orderBy('name')
            ->paginate(10);
        
        return view('admin.teachers.index', compact('teachers'));
    }

    /**
     * Show the form for creating a new teacher.
     */
    public function create()
    {
        return view('admin.teachers.create');
    }

    /**
     * Store a newly created teacher in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'specialty' => 'required|string|max:255',
            'experience' => 'required|integer|min:0',
            'education' => 'required|string',
            'introduction' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'rating' => 'nullable|numeric|min:0|max:5',
            'is_active' => 'boolean',
        ]);
        
        $validated['slug'] = Str::slug($validated['name']);
        
        // 사진 업로드 처리
        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('teachers', 'public');
        }
        
        Teacher::create($validated);
        
        return redirect()->route('admin.teachers.index')
            ->with('success', '선생님이 성공적으로 등록되었습니다.');
    }

    /**
     * Display the specified teacher.
     */
    public function show(Teacher $teacher)
    {
        $teacher->load('reviews');
        return view('admin.teachers.show', compact('teacher'));
    }

    /**
     * Show the form for editing the specified teacher.
     */
    public function edit(Teacher $teacher)
    {
        return view('admin.teachers.edit', compact('teacher'));
    }

    /**
     * Update the specified teacher in storage.
     */
    public function update(Request $request, Teacher $teacher)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'specialty' => 'required|string|max:255',
            'experience' => 'required|integer|min:0',
            'education' => 'required|string',
            'introduction' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'rating' => 'nullable|numeric|min:0|max:5',
            'is_active' => 'boolean',
        ]);
        
        $validated['slug'] = Str::slug($validated['name']);
        
        // 사진 업로드 처리
        if ($request->hasFile('photo')) {
            // 기존 사진 삭제
            if ($teacher->photo) {
                \Storage::disk('public')->delete($teacher->photo);
            }
            $validated['photo'] = $request->file('photo')->store('teachers', 'public');
        }
        
        $teacher->update($validated);
        
        return redirect()->route('admin.teachers.index')
            ->with('success', '선생님 정보가 성공적으로 수정되었습니다.');
    }

    /**
     * Remove the specified teacher from storage.
     */
    public function destroy(Teacher $teacher)
    {
        // 사진 삭제
        if ($teacher->photo) {
            \Storage::disk('public')->delete($teacher->photo);
        }
        
        $teacher->delete();
        
        return redirect()->route('admin.teachers.index')
            ->with('success', '선생님이 성공적으로 삭제되었습니다.');
    }
}
