@if (filled($brand = filament()->getBrandName()))
    <div class="flex items-center space-x-4 text-2xl font-medium lowercase">
        <x-heroicon-s-play-circle class="h-12 w-12 bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 p-0.5" />
        <span>{{ config('app.name') }}</span>
    </div>
@endif
