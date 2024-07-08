{{ html()->element('article')->class('flex flex-col gap-y-1')->wireKey($video->getRouteKey())->children([
    html()->a()->child(
        html()->img($video->thumbnail, $video->title)->class('shrink-0 w-80 h-40 rounded bg-black')
    ),

    html()->p()->class('text-center')->children([
        html()->a()->text($video->title)->class('text-sm'),
        html()->element('dl')->class('dl dl-list justify-center text-xs text-secondary-100')
            ->childrenIf($video->duration, [
                html()->element('dt')->text('Duration')->class('sr-only'),
                html()->element('dd')->text(duration($video->duration))
            ])
            ->childrenIf($video->identifier, [
                html()->element('dt')->text('ID')->class('sr-only'),
                html()->element('dd')->text($video->identifier)
            ]),
    ]),
]) }}
