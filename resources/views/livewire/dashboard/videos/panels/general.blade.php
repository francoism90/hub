<form wire:submit="save">
    <x-app.layout.container class="py-6" fluid>
        {{-- <x-dashboard.forms.messages class="mb-6 sm:w-2/4" timeout="3000" />

        <section class="flex flex-col gap-6 w-full sm:w-2/4">
            <x-dashboard.forms.field>
                <x-dashboard.forms.label id="form.name">
                    {{ __('Name') }}
                </x-dashboard.forms.label>

                <x-dashboard.forms.input
                    id="form.name"
                    wire:model.live="form.name"
                />
            </x-dashboard.forms.field>

            <x-dashboard.forms.field>
                <x-dashboard.forms.label id="form.tags">
                    {{ __('Tags') }}
                </x-dashboard.forms.label>

                <x-dashboard.forms.tags
                    :items="$form->getTags()"
                    id="form.tags"
                />
            </x-dashboard.forms.field>
        </section> --}}

        {{ $form->schema()->items() }}
    </x-app.layout.container>

    <x-dashboard.forms.actions :$submit />
</form>
