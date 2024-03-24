<aside {{ $attributes
    ->cssClass([
        'layer' => 'hidden w-72 min-w-72 max-w-72 flex-col gap-y-6 self-start sm:flex',
        'block' => 'w-full rounded border border-gray-700/10 bg-gray-900/75 p-4',
    ])
    ->classMerge(['layer'])
}}>
    @if ($this->relatables->count())
        <div {{ $attributes->classFor('block')}}>
            <h3 class="pb-3.5 text-sm font-medium uppercase text-primary-500">
                {{ __('Related') }}
            </h3>

            <div class="flex max-h-96 flex-col gap-y-2 overflow-y-scroll">
                @foreach ($this->relatables as $relatable)
                    <div
                        wire:key="relatable-{{ $relatable->getRouteKey() }}"
                        class="uppercase text-sm hover:text-primary-400"
                    >
                        <a
                            wire:navigate
                            href="{{ route('tags.view', $relatable) }}"
                        >
                            {{ $relatable->name }}
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</aside>
