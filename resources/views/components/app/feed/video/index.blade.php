@props([
    'video',
    'actions',
])

<div class="absolute z-10 mx-auto inset-0 w-full sm:w-3/5 xl:max-w-2xl">
    <x-app.feed.video.preview />
    <x-app.feed.video.details />
    <x-app.feed.video.controls />
</div>
