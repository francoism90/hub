<div class="bg-gray-900/70 shadow-md rounded min-w-[280px] max-w-[280px] p-6">
    <h3 class="headline">{{ __('By Tag') }}</h3>

    <div class="overflow-auto max-h-[32rem]">
    <div class="flex flex-col flex-wrap space-y-4 p-4">
        @foreach ($this->tags as $tag)
            <a class="uppercase text-sm font-medium text-gray-400 hover:text-primary-500" href="#">{{ $tag->name }}</a>
        @endforeach
    </div>
    </div>
</div>
