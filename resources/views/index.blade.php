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

            <!-- Contenu Principal -->
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
                <div class="chat">
                    <!-- Header supprimé pour l'exemple -->
                    <!-- Chat -->
                    <div class="messages">
                        @include('receive', ['message' => "heheboi"])
                    </div>
                    <!-- Footer -->
                    <div class="bottom">
                        <form>
                            <input type="text" id="message" name="message" placeholder="Enter message..." autocomplete="off">
                            <button type="submit"></button>
                        </form>
                    </div>
                </div>
            </main>
        </div>
    </div>


    <!-- Modale Ajouter un Salon -->
<div class="modal fade" id="ajouterSalonModal" tabindex="-1" aria-labelledby="ajouterSalonModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="ajouterSalonModalLabel">Ajouter un Salon</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('salons.update', $salon->id) }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="modal-body">
            <div class="form-group">
              <label for="salon-name">Nom du Salon</label>
              <input type="text" class="form-control" id="salon-name" name="salonname" required>
            </div>
            <div class="form-group">
              <label for="salon-image">Image du Salon</label>
              <input type="file" class="form-control-file" id="salon-image" name="salonimage">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
            <button type="submit" class="btn btn-primary">Ajouter</button>
          </div>
        </form>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
      </div>
    </div>
  </div>

  @foreach($salons as $salon)
    <!-- Image et nom du salon ici -->

    <!-- Modale de Modification pour le Salon -->
    <div class="modal fade" id="editSalonModal{{ $salon->id }}" tabindex="-1" role="dialog" aria-labelledby="editSalonModalLabel{{ $salon->id }}" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editSalonModalLabel{{ $salon->id }}">Modifier Salon</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('salons.update', $salon->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Nom du Salon</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $salon->name }}" required>
                        </div>
                        <div class="form-group">
                            <label for="image">Image du Salon</label>
                            <input type="file" class="form-control-file" id="image" name="image">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-primary">Sauvegarder les changements</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach

  
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
