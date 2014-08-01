<h3>Pytanie</h3>
<p>
    {{ $content }}
</p>

<h3>Dane kontaktowe</h3>
<p>
    {{ $contact }}
</p>

<h3>Użytkownik</h3>
@if($user) 
{{ $user->firstname }} {{ $user->lastname }} ({{ $user->id }})
@else
Gość
@endif