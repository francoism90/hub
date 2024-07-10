{{ html()->div()->attribute('x-data', 'player')->class('container py-4 flex flex-col gap-y-3')->open() }}
    {{ html()->element('h1')->text('Lists')->class('text-2xl') }}

    {{-- <livewire:app::lists-user lazy="on-load" /> --}}
    <livewire:app::lists-section lazy="on-load" />
{{ html()->div()->close() }}

<x-app.player.shim />
