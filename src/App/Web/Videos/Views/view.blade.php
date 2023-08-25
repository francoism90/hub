<x-layouts::container>
    <x-layouts::navbar />

    <main>
        <article>
            <header>
                <div class="text-center">
                    <dl class="space-y-10">
                        <dt class="sr-only">Published on</dt>
                        <dd class="text-base font-medium leading-6 text-gray-400">
                            <time datetime="{{ $video->created_at->format('Y-m-d\TH:i:s.uP') }}">
                                {{ $video->created_at->format('F d, Y') }}
                            </time>
                        </dd>
                    </dl>

                    <h1 class="text-3xl font-extrabold leading-9 tracking-tight text-gray-900 dark:text-gray-100 sm:text-4xl sm:leading-10 md:text-5xl md:leading-14">
                        {{ $video->name }}
                    </h1>
                </div>
            </header>

            <div class="grid grid-cols-1 divide-y divide-gray-700">

            </div>
        </article>
    </main>
</x-layouts::container>
