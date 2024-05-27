<header class="sticky top-0 z-30 h-16 w-full border-b border-secondary-800/80 bg-secondary-950">
    <x-dashboard.forms.input
        type="search"
        wire:model.live.debounce="form.query"
        placeholder="{{ __('Type something..') }}"
        id="form.query"
        class:input="px-3 h-16 w-screen max-w-screen text-base bg-transparent border-0 focus:border-0 focus:ring-0"
    >
    @if ($this->form->query())
        <x-slot:append>
            <a
                class="p-3"
                wire:click="$set('form.query', '')"
            >
                <x-heroicon-s-backspace class="size-5 fill-secondary-500" />
            </a>
        </x-slot:append>
    @endif
    </x-dashboard.forms.input>
</header>
