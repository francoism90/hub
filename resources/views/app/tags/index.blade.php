{{ html()->div()->class('container py-4 flex flex-col gap-y-3')->open() }}
    {{ html()->div()->class('flex flex-col gap-y-9')->open() }}
        @foreach ($this->types as $type)
            {{ html()->div()->wireKey($type->value)->open() }}
                <livewire:web.tags.section :$type :key="$type->value" lazy />
            {{ html()->div()->close() }}
        @endforeach
    {{ html()->div()->close() }}
{{ html()->div()->close() }}
