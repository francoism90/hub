{{ html()->div()->class('container h-80 min-h-80 flex flex-col gap-y-2')->open() }}
    {{ html()->element('h1')->text($title)->class('text-2xl') }}

    {{ html()->div()->class('relative w-full flex gap-6 snap-x snap-mandatory overflow-x-auto')->open() }}
        @foreach ($this->items as $item)
            {{ html()->div()->class('snap-start scroll-mx-6 shrink-0')->open() }}
                <x-app.videos.item :$item />
            {{ html()->div()->close() }}
        @endforeach
    {{ html()->div()->close() }}
{{ html()->div()->close() }}
