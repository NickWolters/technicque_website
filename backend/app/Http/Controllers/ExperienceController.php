<?php

namespace App\Http\Controllers;

use App\Models\Experience;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

class ExperienceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() : Collection
    {
        return Experience::with('experience_group')->get(0);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) : Experience
    {
        return Experience::with('experience_group')->where('id', $id)->first();
    }

    public function download($id) : string
    {
        $post = Experience::findOrFail($id);
        $media = $post->getFirstMedia('experiences');

        return $media->getTemporaryUrl(Carbon::now()->addMinutes(5));
    }
}
