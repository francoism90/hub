{{ html()->div()->class('container py-4 flex flex-col gap-y-3')->open() }}
    {{ html()->element('h1')->text('Lists')->class('text-2xl') }}

    {{ html()->div()->class('flex flex-col gap-y-3')->open() }}
    @foreach ($types as $type)
        <livewire:app::lists-section :$type :key="$type->value" lazy="on-load" />
    @endforeach
    {{ html()->div()->close() }}
{{ html()->div()->close() }}
