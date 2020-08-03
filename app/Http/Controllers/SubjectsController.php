<?php

namespace App\Http\Controllers;

use App\Subjects;
use Illuminate\Http\Request;

class SubjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subjects = Subjects::query()
            ->when(request('name'), function ($q, $name){
                return $q->where('name', 'like', "%{$name}%");
            })
            ->get();

        return view('subjects.index')->with('subjects', $subjects);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('subjects.create');
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
            'name' => 'required|max:45|unique:App\Subjects,name',
        ]);

        Subjects::create($validatedData);

        return redirect()
            ->route('subjects.index')
            ->with('status', 'Предмет создан');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Subjects  $subject
     * @return \Illuminate\Http\Response
     */
    public function show(Subjects $subject)
    {
        $subject->load('marks', 'marks.student');

        $paginatedSubject = $subject->marks()->paginate(10);

        return view('subjects.show')->with(['subject' => $subject, 'paginator' => $paginatedSubject]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Subjects  $subject
     * @return \Illuminate\Http\Response
     */
    public function edit(Subjects $subject)
    {
        return view('subjects.edit')->with('subject', $subject);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Subjects  $subject
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subjects $subject)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:45',
        ]);

        $subject->update($validatedData);

        return redirect()
            ->route('subjects.show', $subject->id)
            ->with('status', 'Предмет отредактирован');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Subjects  $subject
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subjects $subject)
    {
        $subject->delete();

        return redirect()
            ->route('subjects.index')
            ->with('status', 'Предмет удален');
    }
}
