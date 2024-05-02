@if (flash()->message)
    <div {{ $attributes
        ->cssClass([
            'layer' => 'flex gap-3 w-full',
            'success' => 'p-3 text-base text-sm font-medium bg-primary-500 rounded',
        ])
        ->classMerge([
            'layer',
            'success' => flash()->level === 'success',
        ])
    }}>
        <span>{{ flash()->message }}</span>
    </div>
@endif
