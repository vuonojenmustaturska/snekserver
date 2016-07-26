<?php

namespace Snek\Http\Controllers;

use Snek\Http\Requests;
use Snek\Http\Controllers\Controller;

use Snek\Game;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;
use Log;
use Auth;
use Snek\ServerState;
use Storage;
use Snek\Nation;

use Snek\Jobs\CreateNewGame;
use Snek\Jobs\StartGame;
use Snek\Jobs\RestartGame;

class GamesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
        $games = Game::paginate(15);

        return view('games.index', compact('games'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        return view('games.create');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function server_status($id)
    {
        $game = Game::findOrFail($id);
        $state = new ServerState('snek.earth', 50000+$game->id);
        $state->fetch();
        $state->getMods();

        $mods = [];

        foreach ($state->mods as $mod)
            $mods[] = $mod['Name'];

        $nations = Nation::getNationsByModsNames($mods);


        /*if (($handle = fopen("/home/snek/snek/storage/app/nations.csv", "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, "\t")) !== FALSE) {
                    $nations[$data[0]] = ['name' => $data[1],
                    'epithet' => $data[2],
                    'abbreviation' => $data[3],
                    'file_name_base' => $data[4],
                    'era' => $data[5]];
            }
            fclose($handle);
        } */


        return view('games.status', compact('game','state', 'nations'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @return void
     */
    public function store(Request $request)
    {
        if (Auth::check() && Auth::user()->is_vouched)
        {
            $request['user_id'] = Auth::id();
            $request['shortname'] = preg_replace("/[^A-Za-z0-9]/", '', $request['name']);

            $this->validate($request,
            [
                'name' => 'required|min:1',
                'shortname' => 'required|min:1',
                'era' => 'required|min:1|max:3',
                'port' => 'numeric|min:50000|max:60000',
                'magicsites' => 'numeric|min:0|max:75',
                'eventrarity' => 'numeric|min:1|max:2',
                'research' => 'numeric|min:-1|max:3',
                'richness' => 'numeric|min:50|max:300',
                'supplies' => 'numeric|min:50|max:300',
                'resources' => 'numeric|min:50|max:300',
                'masterpw' => 'min:4|max:255',
                'victorycond' => 'required|numeric|min:0|max:2',
                'teamgame' => 'required|numeric|min:0|max:1',
                'lvl1thrones' => 'required_unless:victorycond,0|numeric|min:0|max:10',
                'lvl2thrones' => 'required_unless:victorycond,0|numeric|min:0|max:10',
                'lvl3thrones' => 'required_unless:victorycond,0|numeric|min:0|max:10',
                'totalvp' => 'numeric|min:0|max:25',
                'mods' => ['array','exists:mods,id'],
                'map_id' => 'required|numeric|exists:maps,id',
            ]);


            $game = Game::create($request->all());

            Log::info(print_r($request->input('mods'),true));

            $game->mods()->attach($request->input('mods'));

            Session::flash('flash_message', 'Game added!');

            return redirect('games');
        }
        else
        {
            return redirect('games');
        }
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
        $game = Game::findOrFail($id);

        return view('games.show', compact('game'));
    }

    /**
     * Sets up a server instance
     *
     * @param  int  $id
     *
     * @return void
     */
    public function server_createnew($id)
    {
        if (Auth::check())
        {
            $game = Game::findOrFail($id);
            if (Auth::id() == $game->user_id || Auth::user()->is_admin)
            {
                $game->state = 1;
                $game->save();


                $this->dispatch(new CreateNewGame($game));


                return redirect()->action('GamesController@show', [$game->id]);
            }


        }
        else
        {
            return redirect('games');
        }

    }

    /**
     * Starts a game server
     *
     * @param  int  $id
     *
     * @return void
     */
    public function server_start($id)
    {
        if (Auth::check())
        {
            $game = Game::findOrFail($id);

            if (Auth::id() == $game->user_id || Auth::user()->is_admin)
            {
                $game->state = 3;
                $game->save();

                $this->dispatch(new StartGame($game));

                return redirect()->action('GamesController@show', [$game->id]);
            }
            
        }
        else
        {
            return redirect('games');
        }
    }

    /**
     * Restarts a game server
     *
     * @param  int  $id
     *
     * @return void
     */
    public function server_restart($id)
    {
        if (Auth::check())
        {
            $game = Game::findOrFail($id);
            
            if (Auth::id() == $game->user_id || Auth::user()->is_admin)
            {
                

                $this->dispatch(new RestartGame($game));

                return redirect()->action('GamesController@show', [$game->id]);
            }
            
        }
        else
        {
            return redirect('games');
        }
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
        $game = Game::findOrFail($id);

        if (Auth::id() == $game->user_id)
        {
            return view('games.edit', compact('game'));
        }
        else
        {
            return redirect('games');
        }

        
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
        $this->validate($request,
        [
            'hours' => 'numeric',
            'masterpw' => 'min:4|max:255',
        ]);

        $game = Game::findOrFail($id);

        if (Auth::id() == $game->user_id)
        {

            $game->update($request->only('masterpw', 'hours'));

            Session::flash('flash_message', 'Game updated!');

        }

        return redirect('games');
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
        $game = Game::findOrFail($id);
        
        if (Auth::id() == $game->user_id)
        {
            $this->dispatch(new StopGame($game, true));

            Session::flash('flash_message', 'Game queued for deletion!');
        }
        else
        {
            Session::flash('flash_message', 'Please don\'t try to delete someone else\'s game');
        }

        return redirect('games');
    }
}
