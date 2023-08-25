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
        <a href="{{ route('videos.view', $item) }}">
            {{ $item->name }}
        </a>
    </h2>

    @if ($item->tags)
        <x-videos::tags :items="$item->tags" />
    @endif

    <a class="py-2" href="{{ route('videos.view', $item) }}">
        <x-videos::player
            :model="$item"
            :manifest="$item->preview"
            :controls="false"
            playsinline
            muted
            loop
            class="bg-black w-full h-52 object-cover"
        />
    </a>
</article>
