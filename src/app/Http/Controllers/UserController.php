<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        $roles = User::roles();
        return view('users.index', compact('users', 'roles'));
    }

    public function create()
    {
        $roles = User::roles();
        return view('users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate(User::rules());

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('users.index')->with('success', 'Usuario creado correctamente.');
    }

    public function show(User $user)
    {
        $roles = User::roles();
        return view('users.show', compact('user', 'roles'));
    }

    public function edit(User $user)
    {
        $roles = User::roles();
        return view('users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $rules = User::rules($user->id);
        unset($rules['password']);
        $rules['email'] = 
        $request->validate($rules);

        $user->update($request->all());

        return redirect()->route('users.index')->with('success', 'Usuario actualizado correctamente.');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')->with('success', 'Usuario borrado correctamente.');
    }
}
