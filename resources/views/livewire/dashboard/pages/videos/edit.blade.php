<div class="flex flex-col">
    <div class="border-b border-secondary-400/40 p-3">
        <h1 class="line-clamp-1 text-base font-medium leading-none tracking-tight">
            {{ $video->title }}
        </h1>

        <dl class="dl text-xs font-medium text-secondary-300">
            <dt class="sr-only">{{ __('Time') }}</dt>
            <dd>
                <time>{{ duration($video->duration) }}</time>
            </dd>

            <dt class="sr-only">{{ __('Published on') }}</dt>
            <dd>
                <time datetime="{{ $video->published->jsonSerialize() }}">
                    {{ $video->published->format('M d, Y') }}
                </time>
            </dd>

            @if ($video->episode || $video->season)
            <dt class="sr-only">{{ __('ID') }}</dt>
            <dd>{{ $video->identifier }}</dd>
            @endif

            <dt class="sr-only">{{ __('Play') }}</dt>
            <dd>
                <a
                    wire:navigate
                    href="{{ route('videos.view', $video) }}"
                >
                    {{ __('View') }}
                </a>
            </dd>
        </dl>
    </div>

    <x-wireuse::navigation-tabs wire:model.live="tab" :$tabs />

    @if ($current)
        <livewire:dynamic-component :is="$current->getComponent()" :key="$current->getName()" :$state />
    @endif
</div>
