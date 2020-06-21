<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
        $games = Game::with('levels','levels.game','levels.stats','user')->get();
        return response()->json(['data'=>$games]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //  return $request->all();
         $request->validate([
            'level_id' => 'required',
            'user_id' => 'required',
            'miss' => 'required',
            'hit' => 'required',
        ]);        

        $level = Level::find($request->level_id);
        
        $stats = new Stats;
            $stats->user_id = $request->user_id;
            $stats->level_id = $request->level_id;
            $stats->miss = $request->miss;
            $stats->hit = $request->hit;
        $stats->save();


        return response()->json(['data'=>$level->load('stats')]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $games = Game::with('levels','levels.game','levels.stats','user')->where('id',$id)->get();
        return response()->json(['data'=>$games]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
