<?php

namespace App\Http\Controllers;

use App\Http\Requests\FileRequest;
use App\Models\File;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class FileController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize('viewAny', File::class);

        return File::all();
    }

    public function store(FileRequest $request)
    {
        $this->authorize('create', File::class);

        return File::create($request->validated());
    }

    public function show(File $file)
    {
        $this->authorize('view', $file);

        return $file;
    }

    public function update(FileRequest $request, File $file)
    {
        $this->authorize('update', $file);

        $file->update($request->validated());

        return $file;
    }

    public function destroy(File $file)
    {
        $this->authorize('delete', $file);

        $file->delete();

        return response()->json();
    }
}
