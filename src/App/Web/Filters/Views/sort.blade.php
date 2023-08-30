<div class="w-full rounded bg-gray-900/70 p-6 shadow-md">
    <div class="flex items-center justify-between pb-4">
        <h3 class="headline">{{ __('Sort By') }}</h3>
    </div>

    <div class="flex flex-col space-y-3">
        <div class="radio">
            <input type="radio" id="newest" wire:model.live="sort" value="">
            <label for="newest">{{ __('Date added (newest)') }}</label>
        </div>

        <div class="radio">
            <input type="radio" id="oldest" wire:model.live="sort" value="oldest">
            <label for="oldest">{{ __('Date added (oldest)') }}</label>
        </div>

        <div class="radio">
            <input type="radio" id="published" wire:model.live="sort" value="published">
            <label for="published">{{ __('Date published') }}</label>
        </div>
    </div>
</div>
