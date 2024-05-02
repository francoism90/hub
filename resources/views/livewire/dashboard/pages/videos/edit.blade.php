<div class="flex flex-col">
    <div class="border-b border-secondary-400/40 p-3">
        <h1 class="line-clamp-1 text-base font-medium leading-none tracking-tight">
            {{ $video->title }}
        </h1>

        <dl class="dl text-xs font-medium text-secondary-300">
            <dt class="sr-only">{{ __('Time') }}</dt>
            <dd class="text-ellipsis">
                <time> {{ duration($video->duration) }} </time>
            </dd>

            <dt class="sr-only">{{ __('Published on') }}</dt>
            <dd class="text-ellipsis">
                <time datetime="{{ $video->published->jsonSerialize() }}">
                    {{ $video->published->format('M d, Y') }}
                </time>
            </dd>

            @if ($video->episode || $video->season)
            <dt class="sr-only">{{ __('ID') }}</dt>
            <dd class="text-ellipsis">{{ $video->identifier }}</dd>
            @endif
        </dl>
    </div>

    <x-wireuse::navigation-tabs wire:model.live="tab" :$tabs />

    @if ($current)
    <livewire:is :component="$current->getComponent()" :$state />
    @endif
</div>
