<x-wireuse::layout-container x-data="scroll" fluid>
    <main class="bg-primary-500 h-screen max-h-[calc(100dvh-65px)]" @scroll.window.throttle="refresh">
            dwdw
    </main>

</x-wireuse::layout-container>

@script
    <script>
        Alpine.data('scroll', () => ({
            instance: null,

            async init() {
                console.log('scroll')
            },

            async destroy() {
                console.log('scroll')
            },

            async refresh() {
                console.log('scroll')
            },
        }));
    </script>
@endscript
