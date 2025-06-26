
    <div class="row p-4 pt-2">
    <div class="col-md-6">
        <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title"><i class="fas fa-user-plus fa-2x"></i> Formulaire de création d'un utilisateur </h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
            @if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('users.store') }}" enctype="multipart/form-data">

    @csrf
    <div class="card-body">

        <div class="form-group">
            <label for="nom_complet">Nom complet</label>
            <input type="text" class="form-control" id="nom_complet" name="nom_complet"
                   value="{{ old('nom_complet') }}" placeholder="Entrez le nom complet">
            @error('nom_complet') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label for="email">Adresse Email</label>
            <input type="email" class="form-control" id="email" name="email"
                   value="{{ old('email') }}" placeholder="Entrez l'email">
            @error('email') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label for="sexe">Sexe</label>
            <select class="form-control" id="sexe" name="sexe">
                <option value="">-- Sélectionnez --</option>
                <option value="homme" {{ old('sexe') == 'homme' ? 'selected' : '' }}>Homme</option>
                <option value="femme" {{ old('sexe') == 'femme' ? 'selected' : '' }}>Femme</option>
            </select>
            @error('sexe') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label for="password">Mot de passe</label>
            <input type="password" class="form-control" id="password" name="password"
                   placeholder="Entrez un mot de passe">
            @error('password') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label for="numero_CNI">Numéro CNI</label>
            <input type="text" class="form-control" id="numero_CNI" name="numero_CNI"
                   value="{{ old('numero_CNI') }}" placeholder="Entrez le numéro CNI">
            @error('numero_CNI') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label for="telephone">Téléphone</label>
            <input type="text" class="form-control" id="telephone" name="telephone"
                   value="{{ old('telephone') }}" placeholder="Entrez le numéro de téléphone">
            @error('telephone') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label for="photo_CNI">Photo CNI</label>
            <input type="file" class="form-control-file" id="photo_CNI" name="photo_CNI">
            @error('photo_CNI') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label for="photo_personne">Photo de la personne</label>
            <input type="file" class="form-control-file" id="photo_personne" name="photo_personne">
            @error('photo_personne') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

    </div>

    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Enregistrer</button>
        <a href="{{ route('users.index') }}" class="btn btn-danger">
            Retour à la liste des utilisateurs
        </a>
    </div>
</form>


            </div>
        </div>
    </div>