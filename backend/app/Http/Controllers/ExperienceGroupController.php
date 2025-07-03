<?php

namespace App\Http\Controllers;

use App\Models\ExperienceGroup;
use Illuminate\Support\Facades\DB;

class ExperienceGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ExperienceGroup::with('experiences')->get();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return ExperienceGroup::all()->where('id', $id);
    }
}
