<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Program;

class ProgramController extends Controller
{
    /**
     * Display a listing of the programs.
     */
    public function index()
    {
        $programs = Program::active()
            ->orderBy('order')
            ->orderBy('name')
            ->get()
            ->groupBy('category');
        
        return view('programs.index', compact('programs'));
    }
    
    /**
     * Display the specified program.
     */
    public function show($id)
    {
        $program = Program::findOrFail($id);
        
        // 관련 프로그램
        $relatedPrograms = Program::active()
            ->where('category', $program->category)
            ->where('id', '!=', $id)
            ->take(3)
            ->get();
        
        return view('programs.show', compact('program', 'relatedPrograms'));
    }
}
