<?php

namespace App\Console\Commands;

use App\Models\Jukebox;
use Illuminate\Console\Command;
use App\Transformers\JukeboxTransformer;

class JukeboxPlayingCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'jukebox:playing';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'give details of the currently playing track';

    /**
     * Execute the console command.
     * @return void
     */
    public function handle(JukeboxTransformer $transformer): void
    {
        $playing = Jukebox::where('playing', true)->first();

        if (!is_null($playing)) {
            $this->info('Playing: ' . $transformer->transformToString($playing));

            return;
        }

        $this->info('No song is currently playing');
    }
}
