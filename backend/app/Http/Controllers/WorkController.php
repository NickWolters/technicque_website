<?php

namespace App\Http\Controllers;

use App\Models\Work;
use Carbon\Carbon;

class WorkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Work::with('experiences')->get();
    }

    public function download($id)
    {
        $post = Work::findOrFail($id);
        $media = $post->getFirstMedia('work_images');

        return $media->getTemporaryUrl(Carbon::now()->addMinutes(5));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Work::all()->where('id', $id);
    }
}
