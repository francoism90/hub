<div>
    <x-layouts::container class="py-10">
        <x-layouts::navbar />
    </x-layouts::container>

    <x-layouts::container>
        <h1 class="text-3xl font-extrabold leading-9 tracking-tight text-gray-100 sm:text-4xl sm:leading-10">
            {{ __('Tags') }}
        </h1>

        <div class="flex flex-wrap gap-x-2 gap-y-3 py-6">
            @foreach ($this->items as $item)
                <x-tags::card :$item />
            @endforeach
        </div>
    </x-layouts::container>

    <x-layouts::footer />
</div>
