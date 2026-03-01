<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class LocationController extends Controller
{
    public function index()
    {
        $locations = Location::all();
        $users = User::where('is_admin', false)->get();
        return Inertia::render('Location/Index', [
            'locations' => $locations,
            'users' => $users,
        ]);
    }

    public function store(Request $request)
    {
        return $request;
    }
}
