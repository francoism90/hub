<div class="flex flex-col">
    <x-wireuse::navigation-tabs wire:model.live="tab" :$tabs />

    @if ($current)
        <livewire:dynamic-component :is="$current->getComponent()" :key="$current->getName()" />
    @endif
</div>
