{{ html()->div()->attribute('x-data', 'preview')->class('container py-4 flex flex-col gap-y-3')->open() }}
    {{-- <livewire:web.videos.viewed lazy /> --}}
    {{-- <livewire:web.videos.saved lazy /> --}}
    {{-- <livewire:web.videos.favorites lazy /> --}}
{{ html()->div()->close() }}

<x-app.player.shim />
