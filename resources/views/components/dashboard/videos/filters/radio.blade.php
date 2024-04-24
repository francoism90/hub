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
            class="absolute z-30 bottom-0 inset-x-0 m-3"
        >
            <div class="relative mx-auto rounded-xl w-full max-w-96 bg-secondary-800">
                <x-heroicon-m-minus class="h-8 fill-secondary-500 mx-auto" />

                <div class="flex flex-col pb-4 px-4 gap-3">
                    <h1 class="font-semibold">{{ $action->getLabel() }}</h1>

                    @foreach ($action->all() as $option)
                        <div class="flex items-center gap-3 text-sm">
                            <input
                                type="radio"
                                id="{{ $option->getName() }}"
                                value="{{ $option->getName() }}"
                                wire:model.live="form.sort"
                            />

                            <label for="{{ $option->getName() }}">
                                {{ $option->getLabel() }}
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endteleport
</div>
