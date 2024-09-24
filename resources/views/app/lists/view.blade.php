@use('Domain\Playlists\Models\Playlist')

{{ html()->div()->attribute('x-data', 'preview')->class('container py-4')->open() }}
    {{ html()->element('h1')->text($playlist->title)->class('text-2xl') }}

    {{ html()->element('section')->attribute('wire.poll.900s', 'refresh')->class('pt-4 grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4')->open() }}
        @foreach ($this->items as $video)
            {{ html()->div()->wireKey($video->getRouteKey())->open() }}
                <livewire:web.videos.item :$video :key="$video->getRouteKey()" />
            {{ html()->div()->close() }}
        @endforeach
    {{ html()->element('section')->close() }}

    {{ $this->items->links() }}
{{ html()->div()->close() }}

<x-app.player.shim />
