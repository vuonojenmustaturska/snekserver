<?php

namespace Snek\Http\Controllers;

use Snek\Http\Requests;
use Snek\Http\Controllers\Controller;

use Snek\Lobby;
use Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;
use Snek\ServerState;
use Snek\Nation;
use DB;
use Log;

class LobbyUser 
{
    public $name = '';

    public function __construct($name)
    {
        $this->name = '* '.$name;
    }
}

class LobbiesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
        if (Auth::check() && Auth::user()->is_admin)
        {
            $lobbies = Lobby::paginate(15);

            return view('lobbies.index', compact('lobbies'));
        }
        else
        {
            return view('lobbies.mes');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        return view('lobbies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return void
     */
    public function store(Request $request)
    {
        
        Lobby::create($request->all());

        Session::flash('flash_message', 'Lobby added!');

        return redirect('lobbies');
    }

    public function json_nationmods()
    {
        $mods = DB::table('mods')
            ->select('mods.id', 'mods.name')
            ->join('nations', 'mods.id', '=', 'nations.implemented_by')
            ->distinct()
            ->get();

        //$mods = array_merge(['id' => null, 'name' => 'Dominions 4 core nations'], $mods);


        return response()->json($mods);
    }

    public function json_nations($id)
    {
        if ($id == 0)
            return response()->json( DB::table('nations')->select('nation_id','name','epithet','flag')->where('implemented_by','=',null)->get() );
        elseif (is_numeric($id))
            return response()->json( DB::table('nations')->select('nation_id','name','description','epithet','flag')->where('implemented_by','=',$id)->where('era', '!=', 0)->get() );
        else
            return (new Response('', 404));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return void
     */
    public function show($id)
    {
        $lobby = Lobby::findOrFail($id);

        $signupsById = [];

        foreach ($lobby->signups as $signup)
        {
            if (isset($signup->user_id) && $signup->user_id > 0)
            {
                $signupsById[$signup->nation_id] = $signup->user;
            }
            else
            {
                $signupsById[$signup->nation_id] = new LobbyUser($signup->write_in);
            }
            
        }


        $state = new ServerState($lobby->server_address, $lobby->server_port);
        $state->fetch();
        $state->getMods();


        $mods = [];

        foreach ($state->mods as $mod)
            $mods[] = $mod['Name'];

        $nations = Nation::getNationsByModsNames($mods);



        return view('lobbies.show', compact('lobby','state', 'nations', 'signupsById'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return void
     */
    public function edit($id)
    {
        $lobby = Lobby::findOrFail($id);

        return view('lobbies.edit', compact('lobby'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     *
     * @return void
     */
    public function update($id, Request $request)
    {
        
        $lobby = Lobby::findOrFail($id);
        $lobby->update($request->all());

        Session::flash('flash_message', 'Lobby updated!');

        return redirect('lobbies');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return void
     */
    public function destroy($id)
    {
        Lobby::destroy($id);

        Session::flash('flash_message', 'Lobby deleted!');

        return redirect('lobbies');
    }
}
