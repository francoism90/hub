@aware([
    'controls',
])

<div class="absolute inset-0 z-0">
    <div class="h-viewport grid grid-cols-2 gap-x-4">
        <div x-on:dblclick.debounce="backward"></div>
        <div x-on:dblclick.debounce="forward"></div>
    </div>
</div>
