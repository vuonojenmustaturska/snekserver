<?php

namespace Snek;

use Illuminate\Database\Eloquent\Model;
use Iatstuti\Database\Support\NullableFields;

use Snek\Nation;
use Log;

class GameStat extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'gamestats';


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
    protected $fillable = ['game_id', 'turn', 'nation_id', 'provinces', 'forts', 'income', 'gemincome', 'dominion', 'armysize', 'victorypoints', 'turn_status'];


    public function nation()
    {
        return $this->belongsTo('Snek\Nation', 'nation_id');
    }

}