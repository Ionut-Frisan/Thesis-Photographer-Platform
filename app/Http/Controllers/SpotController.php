<?php

namespace App\Http\Controllers;

use App\Http\Requests\Spot\StoreSpotRequest;
use App\Http\Requests\Spot\UpdateSpotRequest;
use App\Models\Spot;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


class SpotController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize('viewAny', Spot::class);

        return Spot::all();
    }

    public function store(StoreSpotRequest $request)
    {
        return Spot::create($request->validated());
    }

    public function show(Spot $spot)
    {
        $this->authorize('view', $spot);

        return $spot;
    }

    public function update(UpdateSpotRequest $request, Spot $spot)
    {
        $spot->update($request->validated());

        return $spot;
    }

    public function destroy(Spot $spot)
    {
        $this->authorize('delete', $spot);

        $spot->delete();

        return response()->json();
    }
}
