@extends('layout.main')
@section('content')

    <?php /** /** @var \App\Entities\Past $request */ ?>
    <div id="cipher" class="d-none">{{ $past->getEncrypted() }}</div>

    <form class="need-validation" id="show-past" novalidate>

        <nav class="navbar navbar-expand-lg navbar-light pasts-info">

            <div class="past-info"><span class="badge badge-primary">Created at</span>{{ $past->getCreatedAt() }}</div>
            <div class="past-info"><span class="badge badge-primary">Expire at</span>{{ $past->getExpireAt() }}</div>

        </nav>

        <div class="form-group">
            <label class="form-check-label" for="past"></label>
            <textarea class="form-control" id="past" rows="15" required readonly>{{ $past->getEncrypted() }}</textarea>
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
