<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ListingController extends Controller
{
    // show all listings
    public function index()
    {
        $listings = Listing::latest()->filter(request(['tag', 'search']))->paginate(6);
        return view('listings.index')->with('listings', $listings);
    }

    // show single listing
    public function show($id)
    {
        $listing = Listing::find($id);
        return view('listings.show')->with('listing', $listing);
    }

    // show create form
    public function create()
    {
        return view('listings.create');
    }

    // store Listing data
    public function store(Request $request)
    {
        # dd($request->all());
        # dd($request->file('logo'));
        $formFields = $request->validate([
           'title' => 'required',
           'company' => ['required', Rule::unique('listings', 'company')],
           'location' => 'required',
           'website' => 'required',
           'email' => ['required', 'email'],
           'tags' => 'required',
           'description' => 'required'
        ]);
        if ($request->hasFile('logo')){
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }
        Listing::create($formFields);
        return redirect('/')->with('message', 'Listing Created Successfully!');
    }

    // edit Listing data
    public function edit($id)
    {
        $listing = Listing::find($id);
        return view('listings.edit')->with('listing', $listing);
    }

    // update Listing data
    public function update(Request $request, Listing $id)
    {
        # dd($request->all());
        $formFields = $request->validate([
            'title' => 'required',
            'company' => ['required'],
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required'
        ]);
        if ($request->hasFile('logo')){
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }
        $id->update($formFields);
        return back()->with('message', 'Listing Updated Successfully!');
    }

    // delete Listing data
    public function destroy(Listing $id)
    {
//        dd($id->logo);
        if ($id->logo != 'no-image.png'){
//            dd($id->logo);
            Storage::delete('public/' . $id->logo);
        }
        $id->delete();
        return redirect('/')->with('message', 'Listing deleted successfully!');
    }
}
