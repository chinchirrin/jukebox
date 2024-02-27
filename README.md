# Jukebox Challenge

The idea of this task is to create a simple JukeBox CLI application.
This jukebox will simply hold a set of songs from a set of artists. We play
tracks on the jukebox. If a track is already playing and you choose a new track
to play, the track should be appended to a play queue\*. We want to be able to
list the contents of the queue. If I choose to play a track already in the
queue, don’t re-add it, simply let the user know.

- There is one final requirement for our Jukebox CLI: we want all tracks from a
    given artist in the queue to be played sequentially. So, I have tracks from
    artist A, B and C in the queue in that order, and I added a new track from
    artist B, the tracks should play in A, B(1), B(2), C sequence.

The application should be able to take the following commands and they should
work as detailed:

• `list`: List all artists and tracks, with a number associated
• `play <num>[,<num>...]`: Play the track identified by the corresponding number.
If there is a track already playing, add this to the queue. It should also
take a list of numbers and add the extra tracks to the queue
• `queue`: list contents of the queue including currently playing track
• `playing`: give details of the currently playing track
• `clear`: clear queue and current playing track

As part of this task, there is no need to simulate the track playing. So, when
you “play” your first track, that will always be the one playing, and any
subsequent “plays” should simply add the track to the queue.

## Setup

### Install dependencies

```sh
composer install
```

### Setup sqlite DB (optional)

If using `sqlite`, update .env file to have the following DB connection details:

```bash
DB_CONNECTION=sqlite
DB_DATABASE=database.sqlite
```

### Generate Database


```sh
php artisan migrate:fresh
```

## Usage

For listing all `jukebox` commands along with artisan's:

```sh
php artisan list
```

List the songs catalog:

```sh
php artisan jukebox:list
```

Play a song or list of songs by providing the track ID:

```sh
php artisan jukebox:play A1
# or
php artisan jukebox:play C1 A2 B3
```

Note: the ID is composed of a letter followed by a 1-based digit.

List the queue along with the song being played:

```sh
php artisan jukebox:queue
```

Clear the queue, including the track being played:

```sh
php artisan jukebox:clear
```
