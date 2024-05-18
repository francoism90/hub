<form wire:submit="save">
    <x-app.layout.container class="flex max-w-2xl flex-col gap-y-6 py-6" fluid>
        <x-dashboard.forms.messages />

        <x-dashboard.forms.input
            label="{{ __('Name') }}"
            placeholder="{{ __('Name') }}"
            id="form.name"
            wire:model.live="form.name"
        />

        <x-dashboard.forms.select
            :options="$types"
            label="{{ __('Type') }}"
            placeholder="{{ __('Type') }}"
            id="form.type"
            wire:model.live="form.type"
        />
    </x-app.layout.container>

    <x-dashboard.forms.actions :$actions />
</form>