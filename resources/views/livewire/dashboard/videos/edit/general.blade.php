<x-app.layout.container fluid>
    <form wire:submit="save">
        <section class="flex flex-col py-3 w-2/4">
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
        </section>

        <button type="submit">Save</button>
    </form>
</x-app.layout.container>
