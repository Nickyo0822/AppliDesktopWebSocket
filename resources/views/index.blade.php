@php
    use App\Models\Messages;
    $messages = Messages::get(); 
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Chat Laravel Pusher | Edlin App</title>
    <link rel="icon" href="https://assets.edlin.app/favicon/favicon.ico"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- JavaScript -->
    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <!-- End JavaScript -->
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="/style.css">
    <!-- End CSS -->
</head>
<body>
    <a href="{{ route('dashboard') }}">Dashboard</a>
    
    <div class="chat">
    <!-- Header -->
     <div class="top">
        <img src="https://assets.edlin.app/images/rossedlin/03/rossedlin-03-100.jpg" alt="Avatar">
        <div>
        <p>Ross Edlin</p>
        <small>Online</small>
        </div>
    </div>
    <!-- End Header -->
    <div class="container-fluid">
        <div class="row">
            <!-- Menu Vertical -->
            <div class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
              <div class="sidebar-sticky">
                  <ul class="nav flex-column">
                    @foreach($salons as $salon)
                        <li class="nav-item">
                            <a class="nav-link" href="#" data-toggle="modal" data-target="#editSalonModal{{ $salon->id }}">
                                <img src="{{ asset('images/salons/' . $salon->image) }}" alt="{{ $salon->name }}" style="width: 60px; height: 60px; border-radius: 50%;">
                                {{ $salon->name }}
                            </a>
                        </li>
                    @endforeach
                      <!-- Bouton pour ouvrir la modale -->
                      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ajouterSalonModal">
                          Ajouter un Salon
                      </button>
                  </ul>
              </div>
          </div>

    <!-- Chat -->
    <div class="messages">
        @include('receive', ['message' => "heheboi"])
    </div>
    <!-- End Chat -->

    <!-- Footer -->
    <div class="bottom">
        <form>
        <input type="text" id="message" name="message" placeholder="Enter message..." autocomplete="off">
        <button type="submit"></button>
        </form>
    </div>
    <!-- End Footer -->

    </div>
@endforeach

  
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>

<script>
    const pusher  = new Pusher('{{config('broadcasting.connections.pusher.key')}}', {cluster: 'eu'});
    const channel = pusher.subscribe('public');

    //Receive messages
    channel.bind('chat', function (data) {
        $.post("/receive", {
            _token:  '{{csrf_token()}}',
            message: data.message,
        })
        .done(function (res) {
            $(".messages > .message").last().after(res);
            $(document).scrollTop($(document).height());
        });
    });

    //Broadcast messages
    $("form").submit(function (event) {
        event.preventDefault();

        $.ajax({
            url:     "/broadcast",
            method:  'POST',
            headers: {
                'X-Socket-Id': pusher.connection.socket_id
            },
            data:    {
                _token:  '{{csrf_token()}}',
                message: $("form #message").val(),
            }
        }).done(function (res) {
            $(".messages > .message").last().after(res);
            $("form #message").val('');
            $(document).scrollTop($(document).height());
        });
    });
</script>
</html>
