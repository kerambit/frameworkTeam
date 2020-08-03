<?php

namespace App\Http\Controllers;

use App\User;
use App\Group;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('password.confirm')->only('edit');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $students = User::paginate(15);

        $students->load('group', 'marks');

        return view('student.index')->with('students', $students);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $user->load('group', 'marks');

        return view('student.show')->with('student', $user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $user->load('group', 'marks');

        $groups = Group::all();

        return view('student.edit')->with(['student' => $user, 'groups' => $groups]);
    }

    /**
     * Update the user info in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'last_name' => 'required|min:3|max:45',
            'first_name' => 'required|min:3|max:45',
            'middle_name' => 'required|min:3|max:45',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'group_id' => 'required|numeric',
        ]);

        $user->update($validatedData);

        return redirect()
            ->route('users.show', $user)
            ->with('status', 'Профиль был успешно изменен');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()
            ->route('users.index')
            ->with('status', 'Студент удален');
    }
}
