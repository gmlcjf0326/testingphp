<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProgramController extends Controller
{
    /**
     * Display a listing of the programs.
     */
    public function index()
    {
        $programs = Program::orderBy('order')
            ->orderBy('name')
            ->paginate(10);
        
        return view('admin.programs.index', compact('programs'));
    }

    /**
     * Show the form for creating a new program.
     */
    public function create()
    {
        return view('admin.programs.create');
    }

    /**
     * Store a newly created program in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|string|max:100',
            'age_group' => 'required|string|max:100',
            'duration' => 'required|string|max:100',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'icon' => 'nullable|string|max:100',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
            'order' => 'nullable|integer|min:0',
        ]);
        
        $validated['slug'] = Str::slug($validated['name']);
        
        // 이미지 업로드 처리
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('programs', 'public');
        }
        
        Program::create($validated);
        
        return redirect()->route('admin.programs.index')
            ->with('success', '프로그램이 성공적으로 생성되었습니다.');
    }

    /**
     * Display the specified program.
     */
    public function show(Program $program)
    {
        return view('admin.programs.show', compact('program'));
    }

    /**
     * Show the form for editing the specified program.
     */
    public function edit(Program $program)
    {
        return view('admin.programs.edit', compact('program'));
    }

    /**
     * Update the specified program in storage.
     */
    public function update(Request $request, Program $program)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|string|max:100',
            'age_group' => 'required|string|max:100',
            'duration' => 'required|string|max:100',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'icon' => 'nullable|string|max:100',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
            'order' => 'nullable|integer|min:0',
        ]);
        
        $validated['slug'] = Str::slug($validated['name']);
        
        // 이미지 업로드 처리
        if ($request->hasFile('image')) {
            // 기존 이미지 삭제
            if ($program->image) {
                \Storage::disk('public')->delete($program->image);
            }
            $validated['image'] = $request->file('image')->store('programs', 'public');
        }
        
        $program->update($validated);
        
        return redirect()->route('admin.programs.index')
            ->with('success', '프로그램이 성공적으로 수정되었습니다.');
    }

    /**
     * Remove the specified program from storage.
     */
    public function destroy(Program $program)
    {
        // 이미지 삭제
        if ($program->image) {
            \Storage::disk('public')->delete($program->image);
        }
        
        $program->delete();
        
        return redirect()->route('admin.programs.index')
            ->with('success', '프로그램이 성공적으로 삭제되었습니다.');
    }
}
