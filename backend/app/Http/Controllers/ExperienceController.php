<?php

namespace App\Http\Controllers;

use App\Models\Experience;
use Carbon\Carbon;
use Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection;

class ExperienceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Experience::all();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Experience::all()->where('id', $id)->get();
    }

    public function download($id)
    {
        $post = Experience::findOrFail($id);
        $media = $post->getFirstMedia('experiences');

        return $media->getTemporaryUrl(Carbon::now()->addMinutes(5));
    }
}
