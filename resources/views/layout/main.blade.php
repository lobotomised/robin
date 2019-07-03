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
<body>

<div class="container">
    <header>
        <h1 class="mx-auto">
            <a href="{{ route('past.create') }}">RoBin</a></h1>
    </header>
    <main>
        @yield('content')
    </main>

    <transition name="modal" id="modal" class="modal-close">
        <div class="modal-mask">
            <div class="modal-wrapper" id="modal-wrapper">
                <div class="modal-container">
                    <div class="modal-header">
                        <slot name="header" id="modal-message"></slot>
                    </div>

                    <div class="modal-body">
                        <slot name="body" id="modal-error"></slot>
                    </div>

                    <div class="modal-footer">
                        <slot name="footer">
                            <button class="btn btn-primary modal-default-button" id="modal-close">
                                OK
                            </button>
                        </slot>
                    </div>
                </div>
            </div>
        </div>
    </transition>

</div>


<script src="{{ mix('/js/manifest.js') }}"></script>
<script src="{{ mix('/js/vendor.js') }}"></script>
<script src="{{ mix('/js/app.js') }}"></script>

</body>
</html>
