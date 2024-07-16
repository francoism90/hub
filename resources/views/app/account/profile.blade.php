{{ html()->div()->class('container py-4 flex flex-col gap-y-3')->children([
    html()->element('h1')->text('My Profile')->class('text-2xl'),
    html()->a()->link('logout')->text('Log Out')->class('btn btn-secondary')
]) }}
