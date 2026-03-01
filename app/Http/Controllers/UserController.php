<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class UserController extends Controller
{
    public function index()
    {
        $users = User::withCount('location')->where('is_admin', false)->get();
        return Inertia::render('User/Index', compact('users'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'min:3', 'max:40'],
            'email' => ['required', 'string','lowercase','email','max:255','unique:'.User::class,]
        ]);

        $save = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make('password'), //nilai password default
        ];
        User::create($save);

        return redirect()->route('user.index')->with('success', 'User has been created');
    }

    public function show($param)
    {
        $user = User::findOrFail($param);
        $location = Location::where('user_id', $param)->get();
        return Inertia::render('User/Show', [
            'user' => $user,
            'location' => $location,
        ]);
    }
    public function destroy($param)
    {
        $user = User::findOrFail($param);
        $user->delete();
        return redirect()->route('user.index')->with('success', 'User has been deleted');
    }
}
