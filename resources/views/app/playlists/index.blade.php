{{ html()->div()->class('container py-4 flex flex-col gap-y-3')->open() }}
    {{ html()->element('h1')->class('text-2xl')->text('Lists') }}

    {{ html()->div()->class('flex flex-col gap-y-9')->open() }}
        <livewire:web.playlists.groups lazy />

        @foreach ($this->types as $type)
            {{ html()->div()->wireKey($type->value)->open() }}
                {{-- <livewire:web.playlists.section :$type :key="$type->value" lazy /> --}}
            {{ html()->div()->close() }}
        @endforeach
    {{ html()->div()->close() }}
{{ html()->div()->close() }}
