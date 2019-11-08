@if(Auth::check())
Has recibido un mensaje por parte del usuario <strong>{{ Auth::user()->username }}</strong>
@else
Has recibido un mensaje por parte del usuario <strong>{{ $name }}</strong>
@endif

<p>
	<strong>{{ $name }}</strong> con el correo {{ $email }}
</p>

<p>
	Opinión: <br>{{ $user_message }}
</p>