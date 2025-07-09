<form method="POST" action="{{ route('paiement.store') }}">
    @csrf

    <label for="idagriculteur">Agriculteur</label>
    <select name="idagriculteur" required>
        @foreach($agriculteurs as $agriculteur)
            <option value="{{ $agriculteur->id }}">{{ $agriculteur->nom_complet }}</option>
        @endforeach
    </select>

    <label for="montantPaye">Montant payé (F CFA)</label>
    <input type="number" name="montantPaye" required>

    <label for="datePayement">Date de paiement</label>
    <input type="date" name="datePayement" required>

    <button type="submit">Valider le paiement</button>
</form>
