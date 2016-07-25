<?php

namespace Snek;

use Illuminate\Database\Eloquent\Model;

class Map extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'maps';

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
    protected $fillable = ['name', 'description', 'filename', 'provinces', 'imagefile', 'user_id'];

    public function user()
    {
        return $this->belongsTo('Snek\User');
    }

    public function games()
    {
        return $this->hasMany('Snek\Game');
    }
}
