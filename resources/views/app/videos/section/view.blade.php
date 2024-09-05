{{ html()->div()->class('container h-80 min-h-80 max-h-80 flex flex-col gap-y-3')->open() }}
    {{ html()->element('h1')->text($title)->class('text-2xl') }}

    {{ html()->div()->attribute('wire.poll.900s', 'refresh')->class('carousel carousel-start w-full gap-x-4')->open() }}
        @foreach ($this->items as $video)
            {{ html()->div()->wireKey($video->getRouteKey())->class('carousel-item shrink-0 w-72 min-w-72 max-w-72')->open() }}
                <livewire:web.videos.item :$video :key="$video->getRouteKey()" />
            {{ html()->div()->close() }}
        @endforeach
    {{ html()->div()->close() }}
{{ html()->div()->close() }}
