<?php

namespace App\Http\Controllers;

use App\Http\Requests\Photoshoot\StorePhotoshootRequest;
use App\Http\Requests\Photoshoot\UpdatePhotoshootRequest;
use App\Models\Photoshoot;
use Inertia\Inertia;

class PhotoshootController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        $photoshoots = [];
        if ($user->role == 'customer') {
            $photoshoots = Photoshoot::where('customer_id', $user->id)->get();
        } elseif ($user->role == 'photographer') {
            $photoshoots = Photoshoot::where('photographer_id', $user->id)->get();
        } elseif ($user->role == 'admin') {
            $photoshoots = Photoshoot::all();
        }

        return view('photoshoots.index', compact('photoshoots'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
//        return Inertia::render("Photoshoots/Create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePhotoshootRequest $request)
    {
        $user = auth()->user();

        if ($user->cannot('create', Photoshoot::class)) {
            return abort(403);
        }

        $photoshoot = Photoshoot::create([
            'customer_id' => $user->id,
            'photographer_id' => $request->photographer_id,
            'status' => 'pending',
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'location' => $request->location,
            'description' => $request->description,
        ]);

        return redirect()->route('photoshoots.index')->with('success', 'Photoshoot created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Photoshoot $photoshoot)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Photoshoot $photoshoot)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePhotoshootRequest $request, Photoshoot $photoshoot)
    {
        $user = auth()->user();

        if ($user->cannot('update', $photoshoot)) {
            return abort(403);
        }

        $validatedData = $request->validated();
        $photoshoot->update($validatedData);

        return redirect()->route('photoshoots.index')->with('success', 'Photoshoot updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Photoshoot $photoshoot)
    {
        //
    }
}
