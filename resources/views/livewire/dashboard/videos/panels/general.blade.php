<form wire:submit="save">
    <x-dashboard.forms.schema :$schema />

    {{ var_dump($schema->items()) }}
</form>
