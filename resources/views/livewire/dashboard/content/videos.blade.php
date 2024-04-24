<x-wireuse::layout-container class="p-3" fluid>
    {{ $form->sort }}

    <x-dashboard.videos.filters>
        @foreach($filters->all() as $action)
            <x-dynamic-component :component="$action->getComponent()" :$action />
        @endforeach
    </x-dashboard.videos.filters>

</x-wireuse::layout-container>
