<form wire:submit="save" class="flex flex-col gap-y-3 py-6">
    <x-app.layout.container class="mx-0 max-w-2xl" fluid>
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
    </x-app.layout.container>

    <x-dashboard.forms.actions :$actions />
</form>
