<form wire:submit="save">
    <x-wireuse::layout.container class="flex flex-col gap-y-6 py-6" fluid>
        <x-dashboard.forms.messages />

        <x-dashboard.forms.input
            wire:model.blur="form.name"
            label="{{ __('Name') }}"
            placeholder="{{ __('Name') }}"
        >
            <x-slot:append>
                <x-wireuse::actions-button :action="$titleize" />
            </x-slot:append>
        </x-dashboard.forms.input>

        <x-wireuse::layout.join class="gap-3">
            <x-dashboard.forms.input
                wire:model.blur="form.episode"
                label="{{ __('Episode') }}"
                placeholder="{{ __('E01') }}"
            />

            <x-dashboard.forms.input
                wire:model.blur="form.season"
                label="{{ __('Season') }}"
                placeholder="{{ __('S01') }}"
            />

            <x-dashboard.forms.input
                wire:model.blur="form.part"
                label="{{ __('Part') }}"
                placeholder="{{ __('1') }}"
            />
        </x-wireuse::layout.join>

         <x-wireuse::layout.join class="gap-3">
            <x-dashboard.forms.input
                wire:model.blur="form.released_at"
                label="{{ __('Released At') }}"
                placeholder="{{ __('2024-12-01') }}"
            />

            <x-dashboard.forms.input
                wire:model.blur="form.snapshot"
                label="{{ __('Snapshot') }}"
                placeholder="1.0"
            >
                <x-slot:append>
                    <x-wireuse::actions-button :action="$snapshot" />
                </x-slot:append>
            </x-dashboard.forms.input>
        </x-wireuse::layout.join>

        <x-dashboard.forms.tags
            wire:model.blur="form.tags"
            :items="$tags->results()"
        />
    </x-wireuse::layout.container>

    <x-dashboard.forms.actions :$actions />
</form>
