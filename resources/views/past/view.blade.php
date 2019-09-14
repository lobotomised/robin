@extends('layout.main')
@section('content')

    <?php /** @var \App\Models\Past $request */ ?>
    <div id="app">
        <show-past
            :encrypted="'{{ $past->encrypted }}'"
            :create_at="'{{ $past->created_at->format('Y-m-d H:m:s') }}'"
            :expire_at="'{{ $past->expire_at->format('Y-m-d H:m:s') }}'"
        ></show-past>
    </div>
@endsection
