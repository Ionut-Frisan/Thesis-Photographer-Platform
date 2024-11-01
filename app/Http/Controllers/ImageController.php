<?php

namespace App\Http\Controllers;

use App\Http\Requests\Image\StoreImageRequest;
use App\Http\Requests\Image\UpdateImageRequest;
use App\Http\Requests\Image\UploadImageRequest;
use App\Models\Image;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get the authenticated user
        $user = auth()->user();

        // Check if the user is an admin
        if ($user->role === 'admin') {
            // If admin, return all images
            return Image::with('photoshoot')->paginate(20);
        }

        // For photographers and customers, return images from their photoshoots
        return Image::whereHas('photoshoot', function ($query) use ($user) {
            $query->where('photographer_id', $user->id)
                ->orWhere('customer_id', $user->id);
        })->with('photoshoot')->paginate(20);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Demo/FileUpload');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreImageRequest $request)
    {
        // Validate the request
        $validated = $request->validated();

        // Handle file upload
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $path = $file->store('images', 'public');

            // Create new image record
            $image = new Image([
                'photographer_id' => auth()->id(),
                'customer_id' => $validated['photoshoot_id'],
                'photoshoot_id' => $validated['photoshoot_id'],
                'name' => $validated['title'],
                'size' => $file->getSize(),
                'mime' => $file->getMimeType(),
                'extension' => $file->getClientOriginalExtension(),
            ]);

            $image->path = $path;
            $image->save();

            // You might want to associate the image with a photoshoot here
            // $photoshoot = Photoshoot::findOrFail($validated['photoshoot_id']);
            // $photoshoot->images()->save($image);

            return response()->json([
                'message' => 'Image uploaded successfully',
                'image' => $image,
            ], 201);
        }

        return response()->json(['error' => 'No file uploaded'], 400);
    }

    /**
     * Display the specified resource.
     */
    public function show(Image $image)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Image $image)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateImageRequest $request, Image $image)
    {
        $validated = $request->validated();

        $image->update([
            'name' => $validated['name'],
        ]);

        return response()->json([
            'message' => 'Image updated successfully',
            'image' => $image,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Image $image)
    {
        $image->delete();

        return response()->json([
            'message' => 'Image deleted successfully',
        ], 200);
    }

    public function upload(UploadImageRequest $request)
    {
        $validated = $request->validated();

        $image = $validated['file'];
        $res = Storage::disk('s3')->putFileAs('images', $image, $image->getClientOriginalName());

        return Inertia::render('Demo/FileUpload', ['message' => 'Image uploaded successfully']);
    }
}
