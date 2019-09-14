<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="api-base-url" content="{{ url('/api/v1') }}">

    <title>RoBin</title>

    <link rel="stylesheet" href="{{ mix('/css/app.css') }}" media="screen" type="text/css">

</head>
<body class="bg-dark-light text-dark-font">

<div class="w-full max-w-screen-xl mx-auto px-6">
    <header class="mt-8 mb-16 ml-16">
        <h1 class="text-5xl">
            <a href="{{ route('past.create') }}">RoBin</a></h1>
    </header>

    <main>
        <noscript>
            <div class="bg-danger text-white p-5">
                <strong>Le Javascript est désactivé. L'application ne pourra pas fonctionner correctement.</strong>
            </div>
        </noscript>

        @yield('content')

    </main>

</div>


<script src="{{ mix('/js/manifest.js') }}"></script>
<script src="{{ mix('/js/vendor.js') }}"></script>
<script src="{{ mix('/js/app.js') }}"></script>

</body>
</html>
