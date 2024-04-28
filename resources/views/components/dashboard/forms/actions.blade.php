@props([
    'submit' => null,
])

<nav class="flex items-center p-3 gap-x-5 overflow-x-auto border-t border-secondary-700/50">
    @if ($submit)
        <x-wireuse::actions-button
            :action="$submit"
            class="bg-primary-600 rounded text-secondary-100 px-3 h-8 text-sm font-medium"
        />
    @endif

    {{ $slot }}
</nav>
