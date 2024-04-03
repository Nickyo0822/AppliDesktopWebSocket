@php
    use App\Models\Messages;
@endphp

<div class="left message">
    <img src="https://assets.edlin.app/images/rossedlin/03/rossedlin-03-100.jpg" alt="Avatar">
    <p>{{$message}}</p>
</div>

@php
    Messages::create([
        'content' => $message,
        'user_id' => Auth::id(),
        'rooms_id' => 1
    ]);
@endphp