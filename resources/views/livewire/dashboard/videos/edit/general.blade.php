<form wire:submit="save">
    <x-app.layout.container class="flex max-w-2xl flex-col gap-y-6 py-6" fluid>
        <x-dashboard.forms.messages />

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

        <x-dashboard.forms.input
            label="{{ __('Snapshot') }}"
            id="form.snapshot"
            type="number"
            wire:model.live="form.snapshot"
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
