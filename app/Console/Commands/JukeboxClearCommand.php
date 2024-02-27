<?php

namespace App\Console\Commands;

use App\Models\Jukebox;
use Illuminate\Console\Command;

class JukeboxClearCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'jukebox:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear queue and current playing track';

    /**
     * Execute the console command.
     * @return void
     */
    public function handle(): void
    {
        $queued = Jukebox::where('playing', false)->delete();
        $playing = Jukebox::where('playing', true)->delete();

        $this->info("The playlist has been cleared sucessfully!");
    }
}
