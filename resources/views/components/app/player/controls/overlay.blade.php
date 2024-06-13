@aware([
    'controls'
])

<div class="absolute inset-0 z-0">
    <div class="grid grid-cols-2 gap-x-4 h-viewport">
        <div x-on:dblclick.debounce="backward"></div>
        <div x-on:dblclick.debounce="forward"></div>
    </div>
</div>
