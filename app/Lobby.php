<?php

namespace Snek;

use Illuminate\Database\Eloquent\Model;

class Lobby extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'lobbies';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'description', 'server_address', 'server_port', 'maxplayers', 'status'];


    /**
     * The signups for this lobby
     */
    public function signups()
    {
        return $this->hasMany('Snek\Signup', 'lobby_id');
    }


    public function game()
    {
        return $this->belongsTo('Snek\Game');
    }
}
