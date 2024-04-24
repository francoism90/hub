<x-wireuse::layout-container class="p-3" fluid>
    <x-dashboard.videos.filters>
        <x-dashboard.videos.filters.sorters :action="$filters->first('sort')" />
    </x-dashboard.videos.filters>

</x-wireuse::layout-container>
