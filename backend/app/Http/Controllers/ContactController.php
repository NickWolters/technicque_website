<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Carbon\Carbon;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Contact::all()->map(function ($contact) {
            $contact->media_url = $contact->getMedia('contacts')->map(function ($media) {
                return $media->getTemporaryUrl(Carbon::now()->addMinutes(5));
            })->get(0);
             return $contact;
        });
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $contact = Contact::all()->where('id', $id)->toJson();
    }

    public function download($id)
    {
        $post = Contact::findOrFail($id);
        $media = $post->getFirstMedia('contacts');

        return $media->getTemporaryUrl(Carbon::now()->addMinutes(5));
    }
}
