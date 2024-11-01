<?php

namespace App\Http\Controllers;

use App\Http\Requests\PhotoshootOffer\StorePhotoshootOfferRequest;
use App\Http\Requests\PhotoshootOffer\UpdatePhotoshootOfferRequest;
use App\Models\PhotoshootOffer;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Inertia\Inertia;

class PhotoshootOfferController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of the photoshoot offers.
     *
     * This method authorizes the user to view any photoshoot offers and
     * retrieves all photoshoot offers from the database.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function index()
    {
        $this->authorize('viewAny', PhotoshootOffer::class);
        // TODO: return a view not a collection
        return PhotoshootOffer::all();
    }

    /**
     * Show the form for creating a new photoshoot offer.
     *
     * This method authorizes the user to create a photoshoot offer and
     * renders the appropriate view.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        $this->authorize('create', PhotoshootOffer::class);
        return Inertia::render('PhotoshootOffer/Create');
    }

    /**
     * Store a newly created photoshoot offer in storage.
     *
     * This method stores a new photoshoot offer in the database. It validates
     * the request's data using the `StorePhotoshootOfferRequest` rules and
     * creates a new `PhotoshootOffer` instance with the validated data.
     *
     * @param  \App\Http\Requests\PhotoshootOffer\StorePhotoshootOfferRequest  $request
     * @return \App\Models\PhotoshootOffer
     */
    public function store(StorePhotoshootOfferRequest $request)
    {
        $data = $request->validated();

        return PhotoshootOffer::create($data);
    }

    /**
     * Display the specified photoshoot offer.
     *
     * This method authorizes the user to view the specified photoshoot offer
     * and retrieves it from the database.
     *
     * @param  \App\Models\PhotoshootOffer  $photoshootOffer
     * @return \App\Models\PhotoshootOffer
     */
    public function show(PhotoshootOffer $photoshootOffer)
    {
        $this->authorize('view', $photoshootOffer);

        return $photoshootOffer;
    }

    /**
     * Show the form for editing an existing photoshoot offer.
     *
     * This method authorizes the user to edit a photoshoot offer and
     * renders the appropriate view.
     *
     * @return \Inertia\Response
     */
    public function edit(PhotoshootOffer $photoshootOffer)
    {
        $this->authorize('update', [PhotoshootOffer::class, $photoshootOffer]);
        return Inertia::render('PhotoshootOffer/Update', ['photoshootOffer' => $photoshootOffer]);
    }

    /**
     * Update the specified photoshoot offer in storage.
     *
     * This method authorizes the user to update the specified photoshoot offer,
     * validates the request's data using the `UpdatePhotoshootOfferRequest` rules,
     * and updates the photoshoot offer with the validated data.
     *
     * @param  \App\Http\Requests\PhotoshootOffer\UpdatePhotoshootOfferRequest  $request
     * @param  \App\Models\PhotoshootOffer  $photoshootOffer
     * @return \App\Models\PhotoshootOffer
     */
    public function update(UpdatePhotoshootOfferRequest $request, PhotoshootOffer $photoshootOffer)
    {
        $data = $request->validated();

        $photoshootOffer->update($data);

        return $photoshootOffer;
    }

    /**
     * Remove the specified photoshoot offer from storage.
     *
     * This method authorizes the user to delete the specified photoshoot offer,
     * and removes it from the database.
     *
     * @param  \App\Models\PhotoshootOffer  $photoshootOffer
     * @return \Illuminate\Http\Response
     */
    public function destroy(PhotoshootOffer $photoshootOffer)
    {
        $this->authorize('delete', $photoshootOffer);

        $photoshootOffer->delete();

        return response()->json();
    }
}
