@component('mail::message')
<h1>A new story was added with title "{{$title}}"</h1>
<p>Please check the home page</p>

@component('mail::button', ['url' => route('dashboard.index')])
    View Story
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
