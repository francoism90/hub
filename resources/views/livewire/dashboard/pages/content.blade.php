<x-wireuse::layout-page>
    {{ $this->tab }}

    <x-wireuse::navigation-tabs :$navigation wire:model.live="tab" />
</x-wireuse::layout-page>
