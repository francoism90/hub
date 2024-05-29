<form wire:submit="save">
    <x-app.layout.container class="flex max-w-2xl flex-col gap-y-6 py-6" fluid>
        <x-dashboard.forms.messages />

        <x-dashboard.forms.input
            wire:model.blur="form.name"
            label="{{ __('Name') }}"
            placeholder="{{ __('Name') }}"
        />

        <x-dashboard.forms.select
            wire:model.lazy="form.type"
            :options="$types"
            label="{{ __('Type') }}"
            placeholder="{{ __('Type') }}"
        />

        <x-dashboard.forms.input
            wire:model.blur="form.description"
            label="{{ __('Description') }}"
            placeholder="{{ __('Description') }}"
        />

        <x-dashboard.forms.tags
            wire:model.blur="form.related"
            :items="$tags->results()"
        />
    </x-app.layout.container>

    <x-dashboard.forms.actions :$actions />
</form>
