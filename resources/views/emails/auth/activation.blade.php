@component('mail::message')
# Please activate your account.

You received this email because it was used to register an account for {{ config('app.name') }}.
If you did not register an account ignore this email otherwise please use the button to activate the account.

@component('mail::button', ['url' => route('activation.activate', $token)])
Activate
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
