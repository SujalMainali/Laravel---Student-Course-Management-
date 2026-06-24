<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    private const PAGE_SIZE = 5;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::query()
            ->select(['id', 'name', 'email', 'dob'])
            ->orderBy('name')
            ->paginate(self::PAGE_SIZE);

        if ($students->currentPage() > $students->lastPage()) {
            return redirect()->route('student.index');
        }

        return view('students.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('students.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Student::create($request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:students,email'],
            'dob' => ['required', 'date', 'before_or_equal:today'],
        ]));

        return redirect()
            ->route('student.index')
            ->with('success', 'Student created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        return view('students.edit', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        $student->update($request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:students,email,'.$student->id],
            'dob' => ['required', 'date', 'before_or_equal:today'],
        ]));

        return redirect()
            ->route('student.index')
            ->with('success', 'Student updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        //
    }
}
