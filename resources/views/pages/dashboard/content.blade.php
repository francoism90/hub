<x-wireuse::layout-page>
    <x-wireuse::navigation-group
        :navigation="$this->navigation()"
        wire:model.live="tab"
    />
</x-wireuse::layout-page>
