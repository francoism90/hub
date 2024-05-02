<div class="flex flex-col">
    <x-wireuse::navigation-tabs wire:model.live="tab" :$tabs />

    @if ($current)
    <livewire:is :component="$current->getComponent()" />
    @endif
</div>
