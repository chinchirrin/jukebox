<?php

namespace App\Console\Commands;

use App\Models\Jukebox;
use Illuminate\Console\Command;
use App\Transformers\JukeboxTransformer;

class JukeboxQueueCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'jukebox:queue';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'list contents of the queue including currently playing track';

    /**
     * Execute the console command.
     * @return void
     */
    public function handle(JukeboxTransformer $transformer): void
    {
        $playing = Jukebox::where('playing', true)
            ->first();
        $queue = Jukebox::where('playing', false)
            ->orderBy('code')
            ->get();

        if ($queue->isEmpty() && is_null($playing)) {
            $this-> info('No songs have been added to the playlist');
            return;
        }

        if (!is_null($playing)) {
            $this->info("Playing: " . $transformer->transformToString($playing));
        }
        foreach ($queue as $track) {
            $this->info($transformer->transformToString($track));
        }
    }
}
