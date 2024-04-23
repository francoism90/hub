<nav {{ $attributes
    ->cssClass([
        'layer' => 'flex items-center px-3 gap-3 border-b border-secondary-800/80 overflow-x-auto',
        'tab' => 'inline-flex text-sm font-medium py-3 text-secondary-600',
        'active' => 'text-white border-b border-white-600/80',
    ])
    ->classMerge([
        'layer',
    ])
    ->whereDoesntStartWith('wire:model')
}}>
    @foreach ($items as $action)
        <input
            type="radio"
            value="{{ $action->getName() }}"
            id="{{ $action->getName() }}"
            class="hidden"
            {{ $attributes->whereStartsWith('wire:model') }}
        >

        <label {{ $attributes
            ->classOnly([
                'tab',
                'active' => $action->getName() === $this->state->tab()->getName(),
            ])
            ->merge([
                'for' => $action->getName()
            ])
        }}>
            {{ $action->getLabel() }}
        </label>
    @endforeach
</nav>
