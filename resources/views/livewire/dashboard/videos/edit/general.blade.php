<form wire:submit="save">
    <x-app.layout.container class="flex flex-col py-6 gap-y-6 mx-0 max-w-2xl" fluid>
        <x-dashboard.forms.field>
            <x-dashboard.forms.label
                id="form.name"
                label="{{ __('Name') }}"
            />

            <x-dashboard.forms.input
                id="form.name"
                wire:model.live="form.name"
            />
        </x-dashboard.forms.field>

        <x-dashboard.forms.field>
            <x-dashboard.forms.label
                id="form.episode"
                label="{{ __('Episode') }}"
            />

            <x-dashboard.forms.input
                id="form.episode"
                wire:model.live="form.episode"
                placeholder="{{ __('Episode') }}"
            />
        </x-dashboard.forms.field>

        <x-dashboard.forms.field>
            <x-dashboard.forms.label
                id="form.season"
                label="{{ __('Season') }}"
            />

            <x-dashboard.forms.input
                id="form.season"
                wire:model.live="form.season"
                placeholder="{{ __('Season') }}"
            />
        </x-dashboard.forms.field>

        <x-dashboard.forms.field>
            <x-dashboard.forms.label
                id="form.tags"
                label="{{ __('Tags') }}"
            />

            <x-dashboard.forms.tags
                :form="$tags"
                id="form.tags"
                wire:model.live="form.tags"
            />
        </x-dashboard.forms.field>
    </x-app.layout.container>

    <x-dashboard.forms.actions :$actions />
</form>
