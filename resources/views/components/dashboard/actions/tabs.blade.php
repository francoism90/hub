<nav {{ $attributes
    ->cssClass([
        'layer' => 'flex items-center border-b border-secondary-800/80 overflow-x-auto',
        'tab' => 'inline-flex text-secondary-600',
        'active' => 'text-white',
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
