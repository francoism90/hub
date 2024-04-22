<x-wireuse::layout-page>
    {{-- <h1>
        active tab: {{ $state->tab()->getName() }}
    </h1> --}}

    <x-dashboard.actions.tabs :items="$state->tabs()" wire:model.live="state.tab" />
</x-wireuse::layout-page>
