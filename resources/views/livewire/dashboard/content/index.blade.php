<div class="flex flex-col p-3">
    <x-wireuse::navigation-tabs wire:model.live="tab" :$tabs />

    @if ($current)
        <livewire:dynamic-component :is="$current->getComponent()" :key="$this->hash" />
    @endif
</div>
