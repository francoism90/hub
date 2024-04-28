<form wire:submit="save">
    <x-app.layout.container class="py-6" fluid>
        <section class="flex flex-col gap-3 w-full sm:w-2/4">
            <x-dashboard.forms.field>
                <x-dashboard.forms.label id="form.name">
                    {{ __('Name') }}
                </x-dashboard.forms.label>

                <x-dashboard.forms.input
                    id="form.name"
                    wire:model.live="form.name"
                />
            </x-dashboard.forms.field>
        </section>
    </x-app.layout.container>

    <x-dashboard.forms.actions :$submit />
</form>
