@component('mail::message')
# Hi, {{ $user->full_name }}

Last week, there were {{ $posts }} unapproved posts

@component('mail::button', ['url' => route('admin.post.approval')])
Post management
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
