<div>
    <x-wireuse::navigation-tabs
        :nodes="$this->getNodes()"
        wire:model.live="tab"
    />

    {{ $tab }}
</div>
