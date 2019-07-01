<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="api-base-url" content="{{ url('/') }}">

    <title>RoBin</title>

    <link rel="stylesheet" href="{{ mix('/css/app.css') }}" media="screen" type="text/css">

</head>
<body>

<div class="container">
    <header>
        <h1 class="mx-auto">
            <a href="{{ route('past.create') }}">RoBin</a></h1>
    </header>
    <main>
        @yield('content')
    </main>

    <div id="app">
        <button id="show-modal" @click="showModal = true">Show Modal</button>
        <!-- use the modal component, pass in the prop -->
        <modal-component v-if="showModal" @close="showModal = false">
            <!--
              you can use custom content here to overwrite
              default content
            -->
            <h3 slot="header">custom header</h3>
        </modal-component>
    </div>
</div>


<script src="{{ mix('/js/manifest.js') }}"></script>
<script src="{{ mix('/js/vendor.js') }}"></script>
<script src="{{ mix('/js/app.js') }}"></script>

</body>
</html>
