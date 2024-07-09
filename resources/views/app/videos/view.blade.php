{{ html()->element('main')->attribute('x-data', 'player')->open() }}
    {{ html()->element('section')->class('py-6')->open() }}
        {{-- <livewire:app::videos-recently lazy="on-load" /> --}}
    {{ html()->element('section')->close() }}
{{ html()->element('main')->close() }}

<x-app.player.shim />
<x-app.player.shim />
