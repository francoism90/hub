{{ html()->element('main')->attribute('x-data', 'player')->open() }}
    <livewire:app::videos-watching lazy="on-load" />

    <x-app.player.shim />
{{ html()->element('main')->close() }}
