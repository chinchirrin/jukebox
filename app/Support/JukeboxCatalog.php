<?php

namespace App\Support;

class JukeboxCatalog implements IJukeboxCatalog
{
    private static $artists = [
        'A' => 'The Beatles',
        'B' => 'Led Zeppelin',
        'C' => 'The Strokes',
    ];

    private static $songs = [
        'A1' => 'Yellow Submarine',
        'A2' => 'Pepperland',
        'B1' => 'Tangerine',
        'B2' => 'Whole Lotta Love',
        'B3' => 'Stairway to Heaven',
        'C1' => 'Last nite',
        'C2' => 'Someday',
        'C3' => 'Is This It',
    ];

    public function getSongById(string $trackId): string
    {
        if ($this->isValidTrackId($trackId)) {
            $song = static::$songs[$trackId];

            return $song;
        }

        return "$trackId - Unknown track";
    }

    /**
     * @return (array{name: string, songs: string[]})[]
     **/
    public function all(): array
    {
        $result = [];
        foreach (static::$artists as $artistId => $artistName) {
            $callback = fn(string $key, string $value): string => "$key - $value";
            $songs = array_map($callback, array_keys(static::$songs), array_values(static::$songs));

            $result[$artistId] = [
                'name' => $artistName,
                'songs' => $songs,
            ];
        }

        return $result;
    }


    public function getArtistById(string $id): string
    {
        $artistId = substr($id, 0, 1);
        if (isset(static::$artists[$artistId])) {
            return static::$artists[$artistId];
        }

        return 'Unknown artist';
    }

    public function isValidTrackId(string $id): bool
    {
        return isset(static::$songs[$id]);
    }
}
