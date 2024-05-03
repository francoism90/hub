<div class="flex flex-col">
    <x-wireuse::navigation-tabs wire:model.live="tab" :$tabs />

    @if ($current)
        @livewire($current->getComponent(), compact('state'), key($current->getName()))
    @endif
</div>
