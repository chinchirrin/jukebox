<?php

namespace App\Support;

interface IJukeboxCatalog {
    /**
     * @return (array{name: string, songs: string[]})[]
     */
    public function all(): array;
    public function isValidTrackId(string $id): bool;
    public function getArtistById(string $id): string;
    public function getSongById(string $trackId): string;
}
