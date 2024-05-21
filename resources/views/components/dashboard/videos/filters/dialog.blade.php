@aware([
    'action',
])

<div
    x-data="{ open: false }"
    class="flex items-center gap-3"
>
    <x-wireuse::actions-button
        :$action
        x-on:click="open = ! open"
        class="flex-row-reverse gap-1 rounded bg-secondary-700 h-8 px-3"
    >
        <x-wireuse::actions-icon class:icon="size-5" :$action />

        @if (! $action->getIcon())
            <span class="text-xs font-medium text-secondary-200">{{ $action->getLabel() }}</span>
        @endif
    </x-wireuse::actions-button>

    @teleport('body')
    <div
        x-show="open"
        x-trap="open"
        x-on:click.outside="open = false"
        x-on:keyup.escape.window="open = false"
        class="absolute inset-x-0 bottom-4 z-30 mx-auto w-full max-w-[28rem] px-3"
    >
        <div class="relative rounded-xl bg-secondary-800">
            <x-heroicon-s-minus class="mx-auto h-8 fill-secondary-500" />

            <div class="flex flex-col gap-y-3 p-5 pt-0">
                <h1 class="font-semibold">{{ $action->getLabel() }}</h1>
                {{ $slot }}
            </div>
        </div>
    </div>
    @endteleport
</div>
