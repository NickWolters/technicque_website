<?php

namespace App\Http\Controllers;

use App\Mail\ContactForm;
use App\Models\ContactRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactRequestController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) : ContactRequest
    {
        $contact_request = ContactRequest::create($request->all());

        //Send email to both user for conformation and one to owner with the content.
        //TODO: When deploying add domain to Resend.
        Mail::to( 'nhj.wolters@gmail.com')->send(new ContactForm($contact_request));

        return $contact_request;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): ContactRequest
    {
        return ContactRequest::find($id);
    }
}
