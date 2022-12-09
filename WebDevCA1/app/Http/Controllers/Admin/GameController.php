<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Models\Publisher;
use App\Models\Developer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Fetch Games in order of last updated by user
        // $games = Game::where('user_id', Auth::id())->latest('updated_at')->paginate(1);

        //Fetch all Games regardless of User
        // 

        // return view('games.index')->with('games', $games);

        $user = Auth::user();
        $user->authorizeRoles('admin');

        $games = Game::with('publisher')->with('developers')->get();


        return view('admin.games.index')->with('games', $games);
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
        $developers = Developer::all();
        return view('admin.games.create')->with('publishers', $publishers)->with('developers', $developers);
        //Returns the create view using the linked database parameters
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
            'title' => 'required|max:120',
            'category' => 'required|max:50',
            'description' => 'required|max:500',
            'game_image' => 'file|image',
            'publisher_id' => 'required',
            'developers' => ['required', 'exists:developers,id']
        ]);

        //Requests and stores the image file for each game entry
        $game_image = $request->file('game_image');
        $extension = $game_image->getClientOriginalExtension();

        // Ensures that every filename is unique
        $filename = date('Y-m-d-His') . '_' . $request->input('title') . '.' . $extension;

        $path = $game_image->storeAs('public/images', $filename);

        //Adds the validated data to the table as a new row 
        $game = new Game;
        $game->title = $request->title;
        $game->category = $request->category;
        $game->description = $request->description;
        $game->game_image = $filename;
        $game->publisher_id = $request->publisher_id;
        $game->save();

        $game->developers()->attach($request->developers);

        //Returns the user to the index page
        return to_route('admin.games.index')->with('success', 'Game created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Game $game)
    {

        $user = Auth::user();
        $user->authorizeRoles('admin');

        //Returns the show view using the linked database parameters
        return view('admin.games.show')->with('game', $game);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Game $game)
    {

        $user = Auth::user();
        $user->authorizeRoles('admin');

        //Returns the edit view using the linked database parameters
        $publishers = Publisher::all();
        $developers = Developer::all();

        return view('admin.games.edit')->with('game', $game)->with('publishers',$publishers)->with('developers', $developers);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Game $game)
    {

        $user = Auth::user();
        $user->authorizeRoles('admin');

        //Validates the information being sent through the system
        $request->validate([
            'title' => 'required',
            'category' => 'required',
            'publisher_id' => 'required',
            'description' => 'required|max:500',
            'game_image' => 'file|image',
        ]);


        $game_image = $request->file('game_image');
        $extension = $game_image->getClientOriginalExtension();
        $filename = date('Y-m-d-His') . '_' . $request->input('title') . '.' . $extension;

        // Stores the game's image in /public/images, and names it $filename
        $path = $game_image->storeAs('public/images', $filename);

        //Sends the validated inputs through to the database, replacing the old data
        $game->title = $request->title;
        $game->category = $request->category;
        $game->publisher_id = $request->publisher_id;
        $game->description = $request->description;
        $game->game_image = $filename;
        $game->save();

        //Once the request succeeds the user is sent back to the show page with the freshly updated information
        return to_route('admin.games.show', $game)->with('success', 'Game updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Game $game)
    {
        $user = Auth::user();
        $user->authorizeRoles('admin');

        $game->delete();



        return to_route('admin.games.index')->with('success', 'Game deleted successfully');
    }
}
