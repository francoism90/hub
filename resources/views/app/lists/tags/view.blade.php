{{ html()->div()->wireKey($type->value)->class('flex flex-col w-full gap-y-3')->open() }}
    {{ html()->element('h1')->text($title)->class('text-2xl') }}

    {{ html()->div()->class('flex flex-col gap-3 w-full')->open() }}
        @foreach ($this->items as $tag)
            <div>
                <livewire:app::tags-item :$tag :key="$tag->getRouteKey()" />
            </div>
        @endforeach
    {{ html()->div()->close() }}
{{ html()->div()->close() }}
