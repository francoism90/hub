<x-app.layout.container fluid>
    <form wire:submit="save">
        <x-dashboard.forms.input
            id="form.name"
            wire:model.live="form.name"
        />

        <button type="submit">Save</button>
    </form>
</x-app.layout.container>
