{{ html()->div()->class('container h-80 min-h-80 max-h-80 flex flex-col gap-y-3')->open() }}
    {{ html()->element('nav')->class('flex flex-nowrap items-center justify-between gap-x-3 w-full')
        ->child(html()->element('h1')->text($title)->class('text-2xl'))
        ->childIf($url && $this->items->count(), html()->a()->href($url)->attribute('wire:navigate')->text('View all')->class('btn btn-sm'))
    }}

    {{ html()->div()->attribute('wire:poll.600s')->class('carousel carousel-start w-full gap-x-4')->open() }}
        @forelse ($this->items as $video)
            {{ html()->div()->wireKey($video->getRouteKey())->class('carousel-item shrink-0 w-72 min-w-72 max-w-72')->open() }}
                <livewire:web.videos.item :$video :key="$video->getRouteKey()" />
            {{ html()->div()->close() }}
        @empty
            {{ html()->p()->class('text-sm text-gray-300')->text('No videos found.') }}
        @endforelse
    {{ html()->div()->close() }}
{{ html()->div()->close() }}
