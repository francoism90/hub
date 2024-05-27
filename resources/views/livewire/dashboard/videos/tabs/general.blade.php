<form wire:submit="save">
    <x-app.layout.container class="flex max-w-2xl flex-col gap-y-6 py-6" fluid>
        <x-dashboard.forms.messages />

        <x-dashboard.forms.input
            wire:model.blur="form.name"
            label="{{ __('Name') }}"
            placeholder="Name"
            id="form.name"
        >
            <x-slot:append>
                <x-wireuse::actions-button :action="$titleize" />
            </x-slot:append>
        </x-dashboard.forms.input>

        <x-app.layout.join>
            <x-dashboard.forms.input
                wire:model.blur="form.episode"
                label="{{ __('Episode') }}"
                placeholder="{{ __('E01') }}"
                id="form.episode"
            />

            <x-dashboard.forms.input
                wire:model.blur="form.season"
                label="{{ __('Season') }}"
                placeholder="{{ __('S01') }}"
                id="form.season"
            />

            <x-dashboard.forms.input
                wire:model.blur="form.part"
                label="{{ __('Part') }}"
                placeholder="{{ __('1') }}"
                id="form.part"
            />

            <x-dashboard.forms.input
                wire:model.blur="form.released_at"
                label="{{ __('Released At') }}"
                placeholder="{{ __('2024-12-01') }}"
                id="form.released_at"
            />
        </x-app.layout.join>

        <x-dashboard.forms.tags
            wire:model.blur="form.tags"
            :items="$tags->results()"
            id="form.tags"
        />

        <x-dashboard.forms.input
            wire:model.blur="form.snapshot"
            label="{{ __('Snapshot') }}"
            placeholder="0.0"
            id="form.snapshot"
        >
            <x-slot:append>
                <x-wireuse::actions-button :action="$snapshot" />
            </x-slot:append>
        </x-dashboard.forms.input>
    </x-app.layout.container>

    <x-dashboard.forms.actions :$actions />
</form>
