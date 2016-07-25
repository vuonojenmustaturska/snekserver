<?php

namespace Snek\Jobs;

use Snek\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use Snek\Game;

class RestartGame extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    protected $game;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Game $game)
    {
        $this->game = $game;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        file_put_contents('/home/snek/.config/systemd/user/snek-'.$this->game->id.'.service', $this->game->getUnitFile());
        exec('systemctl --user daemon-reload');
        exec('systemctl --user restart snek-'.$this->game->id.'.service');
    }
}
