@props([
    'item',
])

{{ html()->element('article')->class('flex flex-col gap-y-1')->wireKey($item->getRouteKey())->children([
    html()->a()->child(
        html()->img($item->thumbnail, $item->title)->class('shrink-0 w-80 h-40 rounded bg-black')
    ),

    html()->p()->class('text-center')->children([
        html()->a()->text($item->title)->class('text-sm'),
        html()->element('dl')->class('dl dl-list justify-center text-xs text-secondary-100')
            ->childrenIf($item->duration, [
                html()->element('dt')->text('Duration')->class('sr-only'),
                html()->element('dd')->text(duration($item->duration))
            ])
            ->childrenIf($item->identifier, [
                html()->element('dt')->text('ID')->class('sr-only'),
                html()->element('dd')->text($item->identifier)
            ]),
    ]),
]) }}
