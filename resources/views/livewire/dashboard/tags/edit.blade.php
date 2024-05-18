<div class="flex flex-col">
    <div class="border-b border-secondary-400/40 p-3">
        <h1 class="line-clamp-1 text-base font-medium leading-none tracking-tight">
            {{ $tag->name }}
        </h1>

        <dl class="dl pt-1 text-xs font-medium text-secondary-300">
            <dt class="sr-only">{{ __('Created on') }}</dt>
            <dd>
                <time datetime="{{ $tag->created_at->jsonSerialize() }}">
                    {{ $tag->created_at->format('M d, Y') }}
                </time>
            </dd>

            @foreach ($actions as $action)
                <dt class="sr-only">{{ $action->getLabel() }}</dt>
                <dd>
                    <x-wireuse::actions-link :$action />
                </dd>
            @endforeach
        </dl>
    </div>

    <x-wireuse::navigation-tabs wire:model.live="tab" :$tabs />

    @if ($current)
        <livewire:dynamic-component :is="$current->getComponent()" :key="$this->hash" :$tag />
    @endif
</div>
