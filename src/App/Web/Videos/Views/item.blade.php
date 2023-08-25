<article class="flex flex-col space-y-2">
    <dl>
        <dt class="sr-only">Published on</dt>
        <dd class="text-base font-medium leading-6 text-gray-400">
            <time datetime="{{ $item->created_at->format('Y-m-d\TH:i:s.uP') }}">
                {{ $item->created_at->format('F d, Y') }}
            </time>
        </dd>
    </dl>

    <h2 class="text-2xl font-bold leading-8 tracking-tight">
        {{ $item->name }}
    </h2>

    @if ($item->tags)
        <x-videos::tags :items="$item->tags" />
    @endif

    <a class="py-2" href="#">
        <x-videos::preview :item="$item" class="bg-black w-full h-40" />
    </a>
</article>
