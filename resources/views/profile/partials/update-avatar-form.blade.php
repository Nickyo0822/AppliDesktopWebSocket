<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            Image de profil
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            Uploadez votre image de profil
        </p>
    </header>

    <form method="post" action="" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf

        <div>
            <input type="file" name="image" class="form-control" value="{{ old('image') }}">
        </div>

        <button>Enregistrer</button>
    </form>
</section>
