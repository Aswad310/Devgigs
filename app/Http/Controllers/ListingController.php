<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Input;

class ListingController extends Controller
{
    // show all listings
    public function index()
    {
        $listings = Listing::latest()->filter(request(['tag', 'search']))->paginate(6);
        # dd(request('search'));
        $search = request('search');
        return view('listings.index')->with(['listings' => $listings, 'search' => $search]);
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
        # dd(auth()->user()->id);
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
        $formFields['user_id'] = auth()->id();
        Listing::create($formFields);
        return redirect('/')->with('message', 'Listing Created Successfully!');
    }

    // edit Listing data
    public function edit($id)
    {
        $listing = Listing::find($id);
        // Make sure logged-in user is owner
        if ($listing->user_id != auth()->id()){
            abort(403, 'Unauthorized Action');
        }
        return view('listings.edit')->with('listing', $listing);
    }

    // update Listing data
    public function update(Request $request, Listing $id)
    {
        // Make sure logged-in user is owner
        if ($id->user_id != auth()->id()){
            abort(403, 'Unauthorized Action');
        }
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
        // Make sure logged-in user is owner
        if ($id->user_id != auth()->id()){
            abort(403, 'Unauthorized Action');
        }
        # dd($id->logo);
        if ($id->logo != 'no-image.png'){
            # dd($id->logo);
            Storage::delete('public/' . $id->logo);
        }
        $id->delete();
        return redirect('/')->with('message', 'Listing deleted successfully!');
    }

    // Manage Listings
    public function manage()
    {
        return view('listings.manage')->with(['listings' => auth()->user()->listings()->get()]);
    }
}
