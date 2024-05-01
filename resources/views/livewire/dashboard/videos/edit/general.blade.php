<form wire:submit="save">
    <x-app.layout.container class="flex flex-col py-6 gap-y-6 mx-0 max-w-2xl" fluid>
        <x-dashboard.forms.input
            label="{{ __('Name') }}"
            id="form.name"
            wire:model.live="form.name"
        />

        <x-dashboard.forms.input
            label="{{ __('Episode') }}"
            id="form.episode"
            wire:model.live="form.episode"
        />

        <x-dashboard.forms.input
            label="{{ __('Season') }}"
            id="form.season"
            wire:model.live="form.season"
        />

        <x-dashboard.forms.tags
            :items="$tags->results()"
            label="{{ __('Tags') }}"
            id="form.tags"
            wire:model.live="form.tags"
        />
    </x-app.layout.container>

    <x-dashboard.forms.actions :$actions />
</form>
