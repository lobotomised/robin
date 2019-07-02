@extends('layout.main')
@section('content')

    <form class="need-validation" id="create-past" novalidate>

        <div class="form-group">
            <label class="form-check-label" for="bin">Coller votre texte ici</label>
            <textarea class="form-control" id="bin" rows="15" required></textarea>
        </div>

        <div class="form-inline">

            <div class="form-group mb-2">
                <label for="expire">Expiration dans&nbsp;</label>
                <select class="form-control" id="expire" required>
                    <option value="5m">5 minutes</option>
                    <option value="1h">1 heure</option>
                    <option value="1d">1 jour</option>
                    <option value="1w" selected>1 semaine</option>
                    <option value="1m">1 mois</option>
                    <option value="1y">1 an</option>
                </select>
            </div>

            <div class="form-group ml-sm-3 mb-2">
                <label for="passd">Mot de passe&nbsp;</label>

                <div class="mb-2">
                    <input type="text" class="form-control" id="passwd" pattern=".{3,}" required>
                </div>

            </div>

        </div>

        <button type="submit" class="btn btn-primary" id="create">Valider</button>
    </form>
@endsection
