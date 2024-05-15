<form wire:submit="save">
    <x-app.layout.container class="flex max-w-2xl flex-col gap-y-6 py-6" fluid>
        <x-dashboard.forms.messages />

        <x-dashboard.forms.input
            label="{{ __('Name') }}"
            placeholder="{{ __('Name') }}"
            id="form.name"
            wire:model.live="form.name"
        />

        <x-dashboard.forms.tags
            :items="$tags->results()"
            label="{{ __('Tags') }}"
            id="form.tags"
            wire:model.live="form.tags"
        />

        <x-dashboard.forms.input
            label="{{ __('Episode') }}"
            placeholder="{{ __('E01') }}"
            id="form.episode"
            wire:model.live="form.episode"
        />

        <x-dashboard.forms.input
            label="{{ __('Season') }}"
            placeholder="{{ __('S01') }}"
            id="form.season"
            wire:model.live="form.season"
        />

        <x-dashboard.forms.input
            label="{{ __('Snapshot') }}"
            placeholder="0.0"
            id="form.snapshot"
            wire:model.live="form.snapshot"
        >
            <x-slot:append>
                <x-wireuse::actions-button :action="$snapshot" />
            </x-slot:append>
        </x-dashboard.forms.input>
    </x-app.layout.container>

    <x-dashboard.forms.actions :$actions />
</form>
