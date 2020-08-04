<?php

namespace App\Http\Controllers;

use App\User;
use App\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

    private const defaultAvatar = 'default_avatar.png';

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $students = User::query()
            ->with('group', 'marks')
            ->when(request('last_name'), function ($q, $lastName){
                return $q->where('last_name', 'like', "%{$lastName}%");
            })
            ->when(request('first_name'), function ($q, $firstName){
                return $q->where('first_name', 'like', "%{$firstName}%");
            })
            ->when(request('middle_name'), function ($q, $middleName){
                return $q->where('middle_name', 'like', "%{$middleName}%");
            })
            ->when(request('birth_date'), function ($q, $birthDate) {
                return $q->orderBy('birth_date', $birthDate);
            })
            ->paginate(20);

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
            'avatar' => 'mimes:jpeg,jpg,png|',
            'birth_date' => 'required|min:10',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'group_id' => 'required|numeric',
        ]);

        if ($request->hasFile('avatar')){
            if ($user->avatar != self::defaultAvatar) {
                Storage::disk('avatars')->delete($user->avatar);
            }

            $now = now();
            $extension = $request->file('avatar')->getClientOriginalExtension();
            $newAvatar = "{$user->id}_{$user->group_id}_{$now}.{$extension}";

            Storage::putFileAs(
                'avatars',
                $request->file('avatar'),
                $newAvatar
            );

            $validatedData['avatar'] = $newAvatar;
        }

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
        if ($user->avatar != self::defaultAvatar) {
            Storage::disk('avatars')->delete($user->avatar);
        }

        $user->delete();

        return redirect()
            ->route('users.index')
            ->with('status', 'Студент удален');
    }
}
