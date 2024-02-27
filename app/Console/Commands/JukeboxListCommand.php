<?php

namespace App\Console\Commands;

use App\Support\JukeboxCatalog;
use Illuminate\Console\Command;

class JukeboxListCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'jukebox:list';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'List all artists and tracks, with a number/code associated';

    /**
     * Execute the console command.
     * @return void
     */
    public function handle(JukeboxCatalog $catalog): void
    {
        $list = $catalog->all();

        foreach ($list as $artist) {
            $output = [];
            array_push($output, $artist['name']);
            array_push($output, str_pad('-', strlen($artist['name']), '-'));
            $output = array_merge($output, $artist['songs']);

            $this->info(implode("\n", $output) . "\n");
        }
    }
}
