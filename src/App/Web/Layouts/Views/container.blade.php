<div {{ $attributes->merge(['class' => implode(' ', ['container', $class])]) }}>
    {{ $slot }}
</div>
