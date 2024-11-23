<?php

namespace App\Http\Controllers;

use App\Http\Requests\Location\StoreLocationRequest;
use App\Http\Requests\Location\UpdateLocationRequest;
use App\Models\File;
use App\Models\Location;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Inertia\Inertia;

class LocationController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize('viewAny', Location::class);

        return Location::all();
    }

    public function create() {
        $this->authorize('create', Location::class);

        return Inertia::render('Location/CreateLocation');
    }

    public function store(StoreLocationRequest $request)
    {
        $data = $request->validated();

        if (!isset($data['cover_image_id']) && $request->hasFile('cover_image')) {
            $f = $request->file('cover_image');
            $path = $f->store('locations', 's3');

            $file = new File([
                'name' => $f->getClientOriginalName(),
                'path' => $path,
                'size' => $f->getSize(),
                'mime' => $f->getMimeType(),
                'extension' => $f->getClientOriginalExtension(),
                'storage_provider' => 's3',
            ]);
            $file->save();
            $data['cover_image_id'] = $file->id;
        }

        return Location::create($data);
    }

    public function show(Location $location)
    {
        $this->authorize('view', $location);

        return $location;
    }

    public function edit(Location $location) {
        $this->authorize('update', $location);

        return Inertia::render('Location/UpdateLocation', [
            'location' => $location,
        ]);
    }

    public function update(UpdateLocationRequest $request, Location $location)
    {
        $location->update($request->validated());

        return $location;
    }

    public function destroy(Location $location)
    {
        $this->authorize('delete', $location);

        $location->delete();

        return response()->json();
    }
}
