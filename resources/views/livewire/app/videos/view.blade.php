<div
    x-data="{ show: false }"
    x-intersect:enter="show = true"
    x-intersect:leave="show = false"
    class="relative h-screen w-screen"
>
    <template x-if="show">
        <livewire:livewire.player.video :$video :key="$this->hash" />
    </template>
</div>
