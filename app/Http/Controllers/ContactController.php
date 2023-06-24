<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;
use App\Models\Page;

class ContactController extends Controller
{
    public function index(Request $request)
    {
      
            $contacts = Contact::when($request->term, function ($query, $term) {
                $query->where('name', 'LIKE', '%' . $term . '%')->orwhere('email', 'LIKE', '%' . $term . '%')->orwhere('phone', 'LIKE', '%' . $term . '%');
            })->paginate(10)->appends(['term' => $request->term]);
            return Inertia::render('Contact', compact('contacts'));
      
    }

    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'email' => 'required|email|unique:contacts,email',
                'phone' => 'required|unique:contacts,phone|max:15',

            ]
        );
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        Contact::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'message' => $request->message
        ]);
        $header = Page::with('sections.contents.images',  'sections.theme')->where('title', 'header')->first();
        $pages = Page::get();

        return redirect('/contact/success')->with('success', 'Thank for send contact with us');
    }

    public function success()
    {
        $header = Page::with('sections.contents.images',  'sections.theme')->where('title', 'header')->first();
        $pages = Page::get();
    
        return view('landingpage.contact-success', compact('header', 'pages'));
    }
}
