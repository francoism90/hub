{{ html()->div()->attribute('x-data', 'preview')->class('container py-4 flex flex-col gap-y-3')->open() }}
    <livewire:web.videos.viewed lazy="on-load" />
    <livewire:web.videos.saved lazy="on-load" />
    <livewire:web.videos.favorites lazy="on-load" />
{{ html()->div()->close() }}

<x-app.player.shim />
