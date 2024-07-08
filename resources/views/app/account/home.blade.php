{{ html()->element('main')->attribute('x-data', 'player')->open() }}
    {{ html()->element('section')->class('py-6')->open() }}
        <livewire:app::videos-watching lazy="on-load" />
        <livewire:app::videos-watching lazy="on-load" />
    {{ html()->element('section')->close() }}

    <x-app.player.shim />
{{ html()->element('main')->close() }}
