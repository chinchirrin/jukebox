<?php

namespace App\Console\Commands;

use App\Models\Jukebox;
use App\Support\JukeboxCatalog;
use Illuminate\Console\Command;

class JukeboxPlayCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'jukebox:play
                            {trackids* : the code, or list of codes, identifying a song/track, i.e.: `A1` or `A1 B3`}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Play the track identified by the corresponding number.
If there is a track already playing, add this to the queue. It should also take a list of
numbers and add the extra tracks to the queue';

    /**
     * Execute the console command.
     * @return void
     */
    public function handle(JukeboxCatalog $catalog): void
    {
        $trackIdList = $this->argument('trackids');

        $isEmpty = Jukebox::all()->count() == 0;

        foreach($trackIdList as $trackId) {
            $trackId = strtoupper($trackId);

            if (!$catalog->isValidTrackId($trackId)) {
                $this->info("Invalid track: $trackId");
                continue;
            }

            if ($this->isInPlaylist($trackId)) {
                $this->info("$trackId is already in the playlist");
                continue;
            }

            $this->addTrack($trackId, $catalog, $isEmpty);

            $this->info(sprintf("Track %s was added successfully!", $trackId));

            $isEmpty = false;
        }
    }

    private function addTrack(string $trackId, JukeboxCatalog $catalog, bool $playing): void
    {
        $track = new Jukebox();
        $track->code = $trackId;
        $track->artist = $catalog->getArtistById($trackId);
        $track->song = $catalog->getSongById($trackId);
        $track->playing = $playing;

        $track->save();

    }

    private function isInPlaylist(string $trackId): bool
    {
        return !is_null(Jukebox::where('code', $trackId)->first());
    }
}
