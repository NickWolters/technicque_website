<?php

namespace App\Http\Controllers;

use App\Models\Study;
use Carbon\Carbon;

class StudyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Study::all();
    }

    public function download($id)
    {
        $post = Study::findOrFail($id);
        $media = $post->getFirstMedia('study_institute');

        return $media->getTemporaryUrl(Carbon::now()->addMinutes(5));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Study::all()->where('id', $id);
    }
}
