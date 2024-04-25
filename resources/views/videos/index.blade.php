<x-wireuse::layout-container x-data="scroll" fluid>
    <main
        wire:key="{{ $this->item->getRouteKey() }}"
        class="bg-black/25 h-screen w-screen max-h-[calc(100dvh-65px)]"
        @wheel.self.throttle="start"
        @touchmove.self.throttle="start"
    >

        {{ $this->item->name }}
    </main>
</x-wireuse::layout-container>

@script
    <script>
        Alpine.data('scroll', () => ({
            instance: null,

            start() {
                console.log('scroll')

                $wire.refresh()
            },
        }));
    </script>
@endscript
