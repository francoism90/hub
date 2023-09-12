<div class="grid grid-cols-1 gap-4 py-8 sm:grid-cols-2">
    @forelse ($items as $item)
        <x-videos::item :$item />
    @empty
        <div class="flex items-center justify-center p-8 text-gray-400">
            {{ __('No videos found') }}
        </div>
    @endforelse
</div>
