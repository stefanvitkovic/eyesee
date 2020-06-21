<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Game;
use App\Level;
use App\Stats;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $games = Game::where('status',1)->get();
        return view('home',compact('games'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
        // return $request->all();
        $request->validate([
            'game_title' => 'required',
        ]);

        $game = new Game;
            $game->user_id = Auth::id();
            $game->title = $request->game_title;
            $game->status = isset($request->status) ? 1 : 0;
        $game->save();

        if(isset($request->speeds) || isset($request->titles))
        {
            $request->validate([
                'titles' => 'required|min:1',
                'speeds' => 'required|min:1',
            ]);

            foreach($request->titles as $key => $title){
                $level = new Level;
                    $level->game_id = $game->id;
                    $level->title = $title;
                    $level->speed = $request->speeds[$key];
                $level->save();
            }
        }


        return redirect()->back()->with('status','Game created !');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Game $game)
    {
        return view('games.show',compact('game'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Game $game)
    {
        return view('games.edit',compact('game'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Game $game)
    {
         // return $request->all();
         $request->validate([
            'game_title' => 'required',
        ]);

        $game->title = $request->game_title;
        $game->status = isset($request->status) ? 1 : 0;
        $game->save();

        if(isset($request->speeds) || isset($request->titles))
        {
            $request->validate([
                'titles' => 'required|min:1',
                'speeds' => 'required|min:1',
            ]);

            $game->levels()->delete();

            foreach($request->titles as $key => $title){
                $level = new Level;
                    $level->game_id = $game->id;
                    $level->title = $title;
                    $level->speed = $request->speeds[$key];
                $level->save();
            }
        }


        return redirect()->back()->with('status','Game created !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Game $game)
    {
        if($game->levels)
        {
            $game->levels()->delete();
        }

        $game->delete();

        return redirect()->back()->with('status','Game deleted!');
    }

    public function play(Game $game)
    {
        return $game;
    }

    public function stats(Game $game)
    {
        return view('games.stats',compact('game'));
    }
}
