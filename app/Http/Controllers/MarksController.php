<?php

namespace App\Http\Controllers;

use App\Marks;
use App\User;
use App\Subjects;
use Illuminate\Http\Request;

class MarksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $marks = Marks::all();

        $students = User::paginate(15);

        $students->load('marks', 'group');

        $subjects = Subjects::all();

        $subjects->load('marks');

        return view('marks.index')->with(['students' => $students, 'subjects' => $subjects, 'marks' => $marks]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subjects = Subjects::all();

        $students = User::all();
        $students->load('group');

        return view('marks.create')->with(['subjects' => $subjects, 'students' => $students]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'subject_id' => 'required|numeric',
            'student_id' => 'required|numeric',
            'group_id' => 'required|numeric',
            'mark' => 'required|numeric',
        ]);

        Marks::create($validatedData);

        return redirect()
            ->route('marks.index')
            ->with('status', 'Оценка по предмету внесена');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Marks  $mark
     * @return \Illuminate\Http\Response
     */
    public function show(Marks $mark)
    {
        $mark->load('subject', 'student');

        return view('marks.show')->with('mark', $mark);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Marks  $mark
     * @return \Illuminate\Http\Response
     */
    public function edit(Marks $mark)
    {
        $mark->load('subject', 'student');

        return view('marks.edit')->with('mark', $mark);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Marks  $mark
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Marks $mark)
    {
        $validatedData = $request->validate([
            'subject_id' => 'required|numeric',
            'student_id' => 'required|numeric',
            'group_id' => 'required|numeric',
            'mark' => 'required|numeric',
        ]);

        $mark->update($validatedData);

        return redirect()
            ->route('marks.show', $mark->id)
            ->with('status', 'Оценка изменена');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Marks  $mark
     * @return \Illuminate\Http\Response
     */
    public function destroy(Marks $mark)
    {
        $mark->delete();

        return redirect()
            ->route('marks.index')
            ->with('status', 'Оценка была убрана');
    }
}
