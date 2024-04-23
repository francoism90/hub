<x-wireuse::layout-page>
    {{ $this->tab }}

    <x-wireuse::navigation-tabs
        :navigation="$this->navigation"
        wire:model.live="tab"
    />
</x-wireuse::layout-page>
