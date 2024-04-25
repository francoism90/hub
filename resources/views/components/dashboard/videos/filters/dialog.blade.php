@props([
    'action',
])

<div x-data="{ open: true }" class="flex gap-3 items-center">
    <x-wireuse::actions-button
        :$action
        x-on:click="open = ! open"
        class="py-1.5 px-3 flex-row-reverse gap-1 rounded font-medium text-xs bg-secondary-700 text-secondary-200"
        class:icon="size-3"
    />

    @teleport('body')
        <div
            x-cloak
            x-show="open"
            x-on:click.outside="open = false"
            x-on:keyup.escape.window="open = false"
            x-trap.inert.noscroll="open"
            class="absolute z-30 bottom-0 inset-x-0 mx-auto px-3 w-full max-w-[28rem] sm:bottom-4"
        >
            <div class="relative rounded-xl bg-secondary-800">
                <x-heroicon-m-minus class="h-8 fill-secondary-500 mx-auto" />

                <div class="p-4 pt-0 flex flex-col gap-3">
                    <h1 class="font-semibold">
                        {{ $action->getLabel() }}
                    </h1>

                    {{ $slot }}
                </div>
            </div>
        </div>
    @endteleport
</div>
