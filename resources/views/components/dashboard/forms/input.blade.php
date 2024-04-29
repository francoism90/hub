@props([
    'id',
])

<input {{ $attributes
    ->cssClass([
        'layer' => 'p-3 h-10 w-full text-base bg-secondary-800/90 border-secondary-500/50 focus:border-secondary-500 focus:border-2 focus:ring-0',
        'error' => '!border-red-500',
        'message' => 'pt-1.5 text-red-500 text-sm',
    ])
    ->classMerge([
        'layer',
        'error' => $errors->has($id),
    ])
    ->merge([
        'id' => $id,
        'type' => 'text',
    ])
}}>

@error($id)
    <p class="{{ $attributes->classFor('message') }}">
        {{ $message }}
    </p>
@enderror
