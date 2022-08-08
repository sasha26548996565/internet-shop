@component('mail::message')
Your password: {{ $password }}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
