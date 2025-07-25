<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() : Collection
    {
        return Blog::all();
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id) : Blog
    {
        return Blog::all()->where('id', $id)->first();
    }

    public function download($id) : string
    {
        $post = Blog::findOrFail($id);
        $media = $post->getFirstMedia('experiences');

        return $media->getTemporaryUrl(Carbon::now()->addMinutes(5));
    }
}
