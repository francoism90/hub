{{ html()->element('main')->attribute('x-data', 'preview')->open() }}
    {{ html()->element('section')->class('py-6')->open() }}
        <livewire:web.videos.viewed lazy="on-load" />
        <livewire:web.videos.saved lazy="on-load" />
        <livewire:web.videos.favorites lazy="on-load" />
    {{ html()->element('section')->close() }}
{{ html()->element('main')->close() }}

<x-app.player.shim />
