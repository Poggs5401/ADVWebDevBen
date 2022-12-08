<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Publisher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PublisherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $user->authorizeRoles('admin');

       $publishers = Publisher::all();
       // $publishers = Publisher::paginate(10);
       // need to test if with 'books' works
       // $publishers = Publisher::with('books')->get();

        return view('admin.publishers.index')->with('publishers', $publishers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        $user->authorizeRoles('admin');
        //Returns the create view with the publishers passed through it
        $publishers = Publisher::all();
        return view('admin.publishers.create')->with('publishers',$publishers);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $user->authorizeRoles('admin');

        //Validates the information being stored by the system
        $request->validate([
            'name' => 'required|max:50',
            'address' => 'required|max:120',
        ]);

//Adds the validated data to the table as a new row 
$publisher = new Publisher;
$publisher->name = $request->name;
$publisher->address = $request->address;
$publisher->save();

//Returns the user to the index page
return to_route('admin.publishers.index')->with('success', 'Publisher created successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Publisher $publisher)
    {
        $user = Auth::user();
        $user->authorizeRoles('admin');

        if(!Auth::id()) {
           return abort(403);
         }

        return view('admin.publishers.show')->with('publisher', $publisher);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Publisher $publisher)
    {
        $user = Auth::user();
        $user->authorizeRoles('admin');

        //Returns the edit view using the linked database parameters
        return view('admin.publishers.edit')->with('publisher', $publisher);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Publisher $publisher)
    {
        $user = Auth::user();
        $user->authorizeRoles('admin');

        //Validates the information being sent through the system
        $request->validate([
            'name' => 'required',
            'address' => 'required',
        ]);

        $publisher->name = $request->name;
        $publisher->address = $request->address;
        $publisher->save();

        //Once the request succeeds the user is sent back to the show page with the freshly updated information
        return to_route('admin.publishers.show', $publisher)->with('success', 'Publisher updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Publisher $publisher)
    {
        $user = Auth::user();
        $user->authorizeRoles('admin');

        $publisher->delete();

        return to_route('admin.publishers.index')->with('success', 'Publisher deleted successfully');
    }
}
