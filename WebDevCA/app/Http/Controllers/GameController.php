<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

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
        $games = Game::paginate(10);

        return view('games.index')->with('games', $games);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Returns the create view using the linked database parameters
        return view('games.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validates the information being stored by the system
        $request->validate([
            'title' => 'required|max:120',
            'category' => 'required|max:50',
            'publisher' => 'required|max:50',
            'description' => 'required|max:500',
            // 'book_image' => 'file|image'
        ]);

        // //Requests and stores the image file for each game entry
        // $game_image = $request->file('game_image');
        // $extension = $game_image->getClientOriginalExtension();

        //Ensures that every filename is unique
        // $filename = date('Y-m-d-His') . '_' . $request->input('title') . '.' . $extension;

        // $path = $game_image->storeAs('public/images', $filename);

        //Adds the validated data to the table as a new row 
        Game::create([
            'title' => $request->title,
            'category' => $request->category,
            'publisher' => $request->publisher,
            'description' => $request->description,
            // 'game_image' => $filename
        ]);

        //Returns the user to the index page
        return to_route('games.index')->with('success', 'Game created successfully');;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Game $game)
    {
        //Returns the show view using the linked database parameters
        return view('games.show')->with('game', $game);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Game $game)
    {
        //Returns the edit view using the linked database parameters
        return view('games.edit')->with('game', $game);
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

        //Validates the information being sent through the system
        $request->validate([
            'title' => 'required',
            'category' => 'required',
            'publisher' => 'required',
            'description' => 'required|max:500',
            // 'game_image' => 'file|image'
        ]);

        // $game_image = $request->file('game_image');
        // $extension = $game_image->getClientOriginalExtension();
        // $filename = date('Y-m-d-His') . '_' . $request->input('title') . '.' . $extension;

        // // Stores the game's image in /public/images, and names it $filename
        // $path = $game_image->storeAs('public/images', $filename);

        //Sends the validated inputs through to the database, replacing the old data
        $game->update([
            'title' => $request->title,
            'category' => $request->category,
            'publisher' => $request->publisher,
            'description' => $request->description,
            // 'game_image' => $filename,
        ]);

        //Once the request succeeds the user is sent back to the show page with the freshly updated information
        return to_route('games.show', $game)->with('success', 'Game updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Game $game)
    {
        $game->delete();

        return to_route('games.index')->with('success', 'Game deleted successfully');
    }
}
