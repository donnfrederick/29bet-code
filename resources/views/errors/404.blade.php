<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ __('404 | Not found') }}</title>
    <meta name="description"
        content="29BET - {{ __('Site oficial ⚡ Jogue 2x. Aceitamos todas as comissões, um bônus no momento do registro. ⭐ Faremos pagamentos dentro de 24 horas para qualquer sistema de pagamento.') }}" />
    <meta name="keywords" content="">
    <link rel="canonical" href="https://29bet.com" />

    <link rel="apple-touch-icon" sizes="180x180" href="https://cdn.29bet.com/assets/img/all/pages/layout/favicon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="https://cdn.29bet.com/assets/img/all/pages/layout/favicon.png">
    <link rel="icon" type="image/png" sizes="16x16" href="https://cdn.29bet.com/assets/img/all/pages/layout/favicon.png">

    <meta name="theme-color" content="#000000">
    <meta property="og:type" content="website">
    <meta property="og:title" content="Site Oficial - Casino e Apostas Esportivas">
    <meta property="og:description"
        content="29BET - Site oficial ⚡ Jogue 2x. Aceitamos todas as comissões, um bônus no momento do registro. ⭐ Faremos pagamentos dentro de 24 horas para qualquer sistema de pagamento.">
    <meta property="og:image" content="https://cdn.29bet.com/assets/img/all/pages/layout/favicon.png">
    <meta property="og:url" content="https:/29bet.com">
    <meta property="business:contact_data:country_name" content="Brazil">
    <link  rel="stylesheet"  href="{{ asset('css/main.min.css') }}">
</head>

<style>
    .error__stars {
        background: url('{{ asset('img/all/pages/errors/overlay_stars.svg') }}');
    }
</style>
<body class="m-0">
    <div class="error__wrapper h-100">
        <div class="error__wrapper__container h-100 w-100">
            <div class="error__rocks">
                <div class="error__purple" style="background-image: url('https://cdn.29bet.com/assets/img/all/pages/games/rocks.png')">
                    <div class="error__stars">
                        <div class="central-body">
                            <div class="error__content">
                                <h2 class="error__content--404">404</h2>
                                <p class="error__content--description">
                                    {{_('It feels like you are lost in space. Don´t worry, we are here to guide you back on the right path. Click the button below to return to your journey and find out how to win amazing prizes along the way.') }}
                                </p>
                            </div>
                            <a class="btn-29 custom__btn--error" href="{{ route('index') }}">{{_('Return to home')}}</a>
                        </div>
                        <div class="objects">
                            <div class="object_rocket">
                                <img class="object_rocket__img" src="https://cdn.29bet.com/assets/img/crash/rocket.png" width="90px">
                                <div class="object_rocket__smoke"></div>
                            </div>
                            <div class="earth-moon">
                                <img class="object_earth" src="https://cdn.29bet.com/assets/img/all/pages/errors/earth.svg" width="100px">
                                <img class="object_moon" src="https://cdn.29bet.com/assets/img/crash/moon.png" width="80px">
                                <img class="object_satelit" src="{{ asset('img/crash/sat.png') }}" width="80px">
                            </div>
                        </div>
                        <div class="error__glowing__stars">
                            <div class="error__star"></div>
                            <div class="error__star"></div>
                            <div class="error__star"></div>
                            <div class="error__star"></div>
                            <div class="error__star"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
