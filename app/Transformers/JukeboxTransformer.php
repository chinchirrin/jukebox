<?php

namespace App\Transformers;

use App\Models\Jukebox;

class JukeboxTransformer
{
    public function transformToString(Jukebox $data): string {
        return "{$data->code} - {$data->song} - {$data->artist}";
    }
}

