<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Location;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;

class ItemController extends Controller
{
    public function index()
    {
        $locations = Location::all();
        $items = Item::all();
        return Inertia::render('Item/Index', [
            'locations' => $locations,
            'items' => $items,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'min:3', 'max:30'],
            'location' => ['required', 'exists:locations,id'],
            'category' => ['required', 'in:electronic,tools,etc,transportation'],
            'condition' => ['required', 'in:good,broke,maintenance'],
            'stock' => ['required', 'min:0', 'max:999'],
            'image' => ['required', 'mimes:png,jpg,jpeg,svg,webp'],
            'description' => ['required'],
        ]);

        $simpan = [
            'uuid' => Str::orderedUuid(),
            'location_id' => $request->input('location'),
            'item_name' => $request->input('name'),
            'condition' => $request->input('condition'),
            'category' => $request->input('category'),
            'stock' => $request->input('stock'),
            'description' => $request->input('description'),
        ];

        if ($request->hasFile('image')) {
            $gambar = $request->file('image');
            $path = 'public/images/items';
            $ext = $gambar->getClientOriginalExtension();
            $name = 'item_image_'.Carbon::now('Asia/Jakarta')->format('Ymdhis').'.'.$ext;

            $gambar->storeAs($path, $name);

            $simpan['image'] = $name;

         }


        Item::create($simpan);
        return redirect()->route('item.index')->with('success', 'Item Has been created');
    }


    public function show($param)
    {
        $item = Item::where('uuid', $param)->firstOrFail()->load('location');
        $locations = Location::all(); 
        return Inertia::render('Item/Show', [
            'locations' => $locations,
            'item' => $item,
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
            'condition' => $request->input('condition'),
            'stock' => $request->input('stock'),
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
