{{ html()->div()->class('flex h-screen justify-center items-center')->child(
    html()->div()->class('container w-[28rem] max-w-[28rem] bg-secondary-500/50 rounded px-8 py-5')->children([
        html()->element('h1')->text('Log In')->class('text-3xl hyphens-auto line-clamp-2'),

        html()->wireForm($form, 'submit')->class('flex flex-col py-3 gap-y-6')->children([
            html()->div()
                ->classIf(flash()->message, ['alert mt-6', flash()->class])
                ->textIf(flash()->message, flash()->message),

            html()->div()->class('form-control')->children([
                html()->label('Email', 'form.email')->class('label'),
                html()->text()->wireModel('form.email')->placeholder('Your Email')->class('input input-bordered'),
                html()->validate('form.email'),
            ]),

            html()->div()->class('form-control')->children([
                html()->label('Password', 'form.password')->class('label'),
                html()->password()->wireModel('form.password')->placeholder('Your Password')->class('input input-bordered'),
                html()->validate('form.password'),
            ]),

            html()->div()->class('form-control-inline')->children([
                html()->checkbox()->wireModel('form.remember')->class('checkbox checkbox-primary'),
                html()->label('Remember me', 'form.remember')->class('label'),
                html()->validate('form.remember'),
            ]),

            html()->button()->type('submit')->text('Log In')->class('btn btn-secondary')
        ])
    ])
) }}
