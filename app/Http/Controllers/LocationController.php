<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Location;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
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
        $request->validate([
            'name' => ['required', 'string', 'min:3', 'max:30'],
            'user' => ['required'],
            'size' => ['required', 'in:small,medium,large'],
            'availability' => ['required', 'in:1,0'],
            'description' => ['required'],
        ]);

        $simpan = [
            'uuid' => Str::orderedUuid(),
            'user_id' => $request->input('user'),
            'location_name' => $request->input('name'),
            'size' => $request->input('size'),
            'is_available' => $request->input('availability'),
            'description' => $request->input('description'),
        ];

        Location::create($simpan);
        return redirect()->route('location.index')->with('success', 'Location Has been created');
    }


    public function show($param)
    {
        $location = Location::where('uuid', $param)->firstOrFail()->load('user');
        $users = User::where('is_admin', false)->get();
        $items = Item::where('location_id', $location->id)->get();
        return Inertia::render('Location/Show', [
            'location' => $location,
            'users' => $users,
            'items' => $items,
        ]);
    }

    public function update(Request $request, $param)
    {
        $data = Location::where('uuid', $param)->firstOrFail();
        $request->validate([
            'name' => ['required', 'string', 'min:3', 'max:30'],
            'user' => ['required'],
            'size' => ['required', 'in:small,medium,large'],
            'availability' => ['required', 'in:1,0'],
            'description' => ['required'],
        ]);

        $simpan = [
            'uuid' => Str::orderedUuid(),
            'user_id' => $request->input('user'),
            'location_name' => $request->input('name'),
            'size' => $request->input('size'),
            'is_available' => $request->input('availability'),
            'description' => $request->input('description'),
        ];

        $data->update($simpan);
        return redirect()->route('location.show', $data->uuid)->with('success', 'Location Has been updated');
    }

    public function destroy($param)
    {
        $data = Location::where('uuid', $param);
        $data->delete();
        return redirect()->route('location.index')->with('success', 'Location has been deleted');
    }

}
