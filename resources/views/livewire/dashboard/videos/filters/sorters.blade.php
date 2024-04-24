<div x-data="{ open: true }" class="flex items-center">
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
            class="absolute z-30 bottom-0 inset-x-1/4 m-3"
        >
            <div class="relative px-3 py-4 rounded-xl flex w-full max-w-[26rem] mx-auto bg-secondary-500">
                <div class="prose prose-headings:font-semibold prose-h1:text-sm prose-h1:text-base">
                    <h1>{{ __('Sort by' )}}</h1>

                    {{-- {{ $action->foo }} --}}

                    <button wire:click="$parent.set('foo', 'bla')">Remove</button>
                </div>
            </div>
        </div>
    @endteleport
</div>
