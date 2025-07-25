<?php

namespace App\Http\Controllers;

use App\Models\Study;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

class StudyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() : Collection
    {
        return Study::all();
    }

    public function download($id) : string
    {
        $post = Study::findOrFail($id);
        $media = $post->getFirstMedia('study_institute');

        return $media->getTemporaryUrl(Carbon::now()->addMinutes(5));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) : Study
    {
        return Study::all()->where('id', $id);
    }
}
