{{ html()->element('main')->attribute('x-data', 'preview')->open() }}
    {{ html()->element('section')->class('py-6')->open() }}
        <livewire:web.videos.recommended lazy="on-load" />
        <livewire:web.videos.watching lazy="on-load" />
        <livewire:web.videos.watchlist lazy="on-load" />
        <livewire:web.videos.recently lazy="on-load" />
    {{ html()->element('section')->close() }}
{{ html()->element('main')->close() }}

<x-app.player.shim />
