@component('mail::message')
# Please activate your account.

The body of your message.

@component('mail::button', ['url' => route('activation.activate', $token)])
Activate
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
