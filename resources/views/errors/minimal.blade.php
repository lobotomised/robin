<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="sha" content="{{ getRelease() }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="api-base-url" content="{{ url('/api/v1') }}">

    <title>RoBin</title>

    <link rel="stylesheet" href="{{ mix('/css/app.css') }}" media="screen" type="text/css">

    <style>

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .code {
            font-size: 26px;
            padding: 0 15px 0 15px;
            text-align: center;
        }

        .message {
            font-size: 18px;
            text-align: center;
        }
    </style>
</head>
<body class="bg-dark-light text-dark-font">

<div class="w-full max-w-screen-xl mx-auto px-6">
    <header class="mt-8 mb-12 ml-16">
        <h1 class="text-4xl font-bold font-mono">
            <a href="{{ route('past.create') }}">RoBin</a>
        </h1>
    </header>

    <main>

        <div class="flex-center position-ref full-height">
            <div class="code">
                @yield('code')
            </div>

            <div class="message" style="padding: 10px;">
                @yield('message')
            </div>
        </div>

    </main>

</div>


<script src="{{ mix('/js/manifest.js') }}"></script>
<script src="{{ mix('/js/vendor.js') }}"></script>
<script src="{{ mix('/js/app.js') }}"></script>

</body>
</html>
