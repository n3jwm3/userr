@component('mail::message' )
salut{{$user->name}},

<p>nous comprenons que cela arrive.</p>

@component('mail::button', ['url' =>url('reset/' .$user->remember_token)])
réinitialiser votre mot de passe
@endcomponent

<p>Si vous rencontrez des problèmes pour récupérer votre mot de passe, veuillez nous contacter.</p>

Merci,<br>
{{ config('app.name')}}
@endcomponent
