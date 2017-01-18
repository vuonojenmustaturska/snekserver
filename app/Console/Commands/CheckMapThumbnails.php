<?php

namespace Snek\Console\Commands;

use Illuminate\Console\Command;

use Snek\Map;

use Snek\Jobs\CreateThumbnail;

use Illuminate\Foundation\Bus\DispatchesJobs;

class CheckMapThumbnails extends Command
{
    use DispatchesJobs;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'maps:checkthumbnails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Checks that map thumbnails exist and recreates them if missing.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        foreach(Map::all() as $map)
        {
            if (!empty($map->imagefile) && file_exists('/home/snek/dominions4/maps/'.$map->imagefile))
            {
                if (!file_exists('/home/snek/snek/public/img/maps/'.$map->id.'.png') or !file_exists('/home/snek/snek/public/img/maps/'.$map->id.'-lg.png'))
                {
                    $this->info($map->name . ' is missing a thumbnail, generating...');
                    $this->dispatch(new CreateThumbnail($map->id, 'map'));
                }
            }
        }
    }
}
