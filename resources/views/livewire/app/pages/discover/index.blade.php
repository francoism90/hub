<header class="sticky top-0 z-30 h-16 max-h-16 w-full border-b border-secondary-800/80 bg-secondary-950">
    <x-app.navigation.navbar>
        <x-dashboard.forms.input
            placeholder="{{ __('Type something..') }}"
            id="form.episode"
            class:input="px-3 h-16 w-full min-w-96 max-w-full text-base bg-transparent border-0 focus:border-0 focus:ring-0"                wire:model.live="form.episode"
        />
    </x-app.navigation.navbar>
</header>
