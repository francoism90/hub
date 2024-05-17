<div>
    <x-app.discover.videos.search />

    <livewire:livewire.discover.videos.items
        :$form
        wire:key="{{ $this->hash }}"
    />
</div>
