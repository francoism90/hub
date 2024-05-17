<header class="sticky top-0 z-30 h-16 w-full border-b border-secondary-800/80 bg-secondary-950">
    <x-app.navigation.navbar>
        <x-dashboard.forms.input
            placeholder="{{ __('Type something..') }}"
            id="form.query"
            class:input="px-3 h-16 w-screen max-w-screen text-base bg-transparent border-0 focus:border-0 focus:ring-0"
            wire:model.live.debounce.300ms="form.query"
        />
    </x-app.navigation.navbar>
</header>