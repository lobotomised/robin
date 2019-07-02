@extends('layout.main')
@section('content')

    <div id="cipher" class="d-none">{{ $past->encrypted }}</div>

    <form class="need-validation" id="show-past" novalidate>

        <div class="form-group">
            <label class="form-check-label" for="past"></label>
            <textarea class="form-control" id="past" rows="15" required readonly>{{ $past->encrypted }}</textarea>
        </div>

        <div class="form-inline">

            <div class="form-group ml-sm-3 mb-2">
                <label for="passd">Mot de passe&nbsp;</label>

                <div class="mb-2">
                    <input type="text" class="form-control" id="passwd" required>
                </div>

            </div>

        </div>

        <button type="submit" class="btn btn-primary" id="decrypt">Dechiffrer</button>

    </form>
@endsection
