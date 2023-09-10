<div>
    @if (filled($this->search) || filled($this->tagName))
        <div class="flex w-full flex-nowrap items-center justify-between py-4 text-sm text-gray-400">
            <div class="line-clamp-1 pr-4">
                <span>{{ __('filter by') }}</span>
                <span class="lowercase">{{ $filters($this->search, $this->tagName) }}</span>
            </div>

            <div>
                <a class="btn" wire:click="resetQuery('search', 'sort', 'tag')" wire:navigate>
                    <x-heroicon-o-x-circle class="h-6 w-6" />
                </a>
            </div>
        </div>
    @endif
</div>
