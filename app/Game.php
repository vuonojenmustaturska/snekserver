<?php

namespace Snek;

use Iatstuti\Database\Support\NullableFields;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Game extends Model
{
	use NullableFields;
    use SoftDeletes;
    
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'games';

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
    protected $fillable = ['name', 'port', 'masterpw', 'map_id', 'era', 'hours', 'hofsize', 'indepstr', 'magicsites', 'eventrarity', 'richness', 'resources', 'startprov', 'scoregraphs', 'nonationinfo', 'noartrest', 'teamgame', 'clustered', 'victorycond', 'requiredap', 'lvl1thrones', 'lvl2thrones', 'lvl3thrones', 'totalvp', 'capitalvp', 'requiredvp', 'summervp', 'user_id', 'renaming', 'shortname', 'research'];


    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $nullable = [
        'hours',
        'hofsize',
        'port',
        'indepstr',
        'magicsites',
        'eventrarity',
        'richness',
        'resources',
        'startprov',
        'requiredap',
        'requiredvp',
        'lvl1thrones',
        'lvl2thrones',
        'lvl3thrones',
        'totalvp',
        'requirevp',
        'supplies',
    ];

    /**
     * User who created this game
     */
    public function user()
    {
        return $this->belongsTo('Snek\User');
    }

    /**
     * The mods used in this game
     */
    public function mods()
    {
        return $this->belongsToMany('Snek\Mod');
    }

    /**
     * Map
     */
    public function map()
    {
        return $this->belongsTo('Snek\Map');
    }

    public function getQuotedName()
    {
    	return "'".$this->name."'";
    }


    public function getNonDefaultSettings()
    {
        $defaultvalues = [
            'research' => 1,
            'hofsize' => 10,
            'indepstr' => 5,
            'magicsites' => 40,
            'eventrarity' => 1,
            'richness' => 100,
            'resources' => 100,
            'supplies' => 100,
            'startprov' => 1,
            'renaming' => false,
            'scoregraphs' => false,
            'nonationinfo' => false,
            'noartrest' => false,
            'teamgame' => false,
            'storyevents' => false,
            'clustered' => false,
            'requiredap' => ($this->lvl1thrones+($this->lvl2thrones*2)+($this->lvl3thrones*3))-1,
        ];

        $ret = [];
        foreach ($this->toArray() as $key => $value)
        {
            if (array_key_exists($key, $defaultvalues) && $defaultvalues[$key] != $value)
                $ret[$key] = $value;   
        }
        return $ret;
    }

    /**
     * Get the command line string for this game, first host after pretender picking
     *
     * @return string
     */
    public function getCommandLine()
    {
        switch ($this->state)
        {
            case 0:
            case 1:
                return $this->getCommandLinePretenderUpload();
            case 2:
            case 3:
                return $this->getCommandLineInitial();
            case 4:
            case 5:
            default:
                return $this->getCommandLineShort();
        }

    }

    public function getOptions()
    {
        $cmdline = [];

        foreach ($this->getNonDefaultSettings() as $key => $value)
        {
            switch ($key)
            {
                case 'magicsites':
                case 'hofsize':
                case 'eventrarity':
                case 'richness':
                case 'research':
                case 'supplies':
                case 'resources':
                case 'indepstr':
                case 'startprov':
                	if (!empty($value))
                    	$cmdline[] = "--$key ".escapeshellarg($value);
                    break;
                case 'nonationinfo':
                case 'noartrest':
                case 'clustered':
                case 'teamgame':
                case 'capitalvp':
                case 'renaming':
                case 'summervp':
                    $cmdline[] = "--$key";
                    break;
                case 'scoregraphs':
                    $cmdline[] = '--noscoregraphs';
                    break;
            }
        }


        if (count($this->mods) > 0)
        {
            foreach ($this->mods as $mod)
            {
                $cmdline[] = '-M '.escapeshellarg($mod->filename);
            }
        }

        switch ($this->victorycond)
        {
            case 0:
                $cmdline[] = '--conqonly';
                break;
            case 1:
                $cmdline[] = '--thrones '.implode(' ', [(int)$this->lvl1thrones,(int)$this->lvl2thrones,(int)$this->lvl3thrones]);
                if (!empty($this->requiredap))
                    $cmdline[] = '--requiredap '.escapeshellarg($this->requiredap);
                break;
            default:
                break;
        }

        return $cmdline;

    }
    /**
     * Get the command line string for this game, first host after pretender picking
     *
     * @return string
     */
    public function getCommandLineInitial()
    {
        $cmdline = [
            '-T',
            '-S', 
            '--port '.(50000+$this->id),
            '--era '.$this->era,
            '--uploadtime 1',
            '--noclientstart',
            '--mapfile '.escapeshellarg($this->map->filename),
             ];

        if ($this->hours > 0)
            $cmdline[] = '--hours '.$this->hours;

        $cmdline = array_merge($cmdline, $this->getOptions());

        $cmdline[] = escapeshellarg($this->shortname);

        return implode(' ', $cmdline);

    }

    public function getCommandLineShort()
    {
        $cmdline = [
            '-T',
            '-S', 
            '--port '.(50000+$this->id),
            '--era '.$this->era,
            '--mapfile '.escapeshellarg($this->map->filename),
            ];

        if ($this->hours > 0)
            $cmdline[] = '--hours '.$this->hours;

        $cmdline = array_merge($cmdline, $this->getOptions());

        $cmdline[] = escapeshellarg($this->shortname);

        return implode(' ', $cmdline);
    }

    public function getCommandLinePretenderUpload()
    {
        $cmdline = [
            '-T',
            '-S', 
            '--era '.$this->era,
            '--port '.(50000+$this->id),
            '--noclientstart',
            '--mapfile '.escapeshellarg($this->map->filename),
            ];

        $cmdline = array_merge($cmdline, $this->getOptions());

        $cmdline[] = escapeshellarg($this->shortname);

        return implode(' ', $cmdline);
    }

    public function getUnitFile()
    {
        return '[Unit]
Description=SnekServer - '.$this->name.'

[Service]
ExecStart=/opt/dominions4/dom4.sh '.$this->getCommandLine();
    }
}
