{{-- @extends('welcome')

@section('content')

<style>
    .game::before {
        background: linear-gradient(180deg,#fa2f5c,rgba(0,9,87,0));
        content: "";
        display: block;
        height: 45%;
        left: 0;
        position: absolute;
        top: 0;
        width: 100%;
        z-index: -1;
    }
    .game {
        margin: 0;
    }
</style>

<div>
    <div class="sport__page row align-items-center justify-content-center text-center  top-5">
        <div class="col-lg-10">
            <div class="sport__box">
                <h2 class="sport__box__title"><span class="color-orange ">29</span>{{ __('Bet Sports Betting')}}</h2>
                <p class="sport__box__description">
                    {{ __("You won't want to miss our news! We are preparing an amazing new sports structure that will help you earn even more money. Keep an eye out so you don't miss this opportunity!")}}
                </p>
                <div class="sport__present">
                    <div class="sport__present__button">
                        <a class="sport__present__button--link">{{ __('Shortly..')}}</a>
                    </div>
                    <div class="sport__present__chicket">
                        <p>
                            <span class="font-bold">{{ __('Discount coupons on all sports')}}</span>
                        </p>
                        <img src="https://cdn.29bet.com/assets/img/all/pages/sports/presente.png" alt="https://cdn.29bet.com/assets/img/all/pages/sports/presente.png">
                    </div>
                </div>

                <div class="row row-cols-lg-4 row-cols-md-3 row-cols-sm-2 row-col-1 sport__benefits ">
                    <div class="col">
                        <div class="sport__benefits__card">
                            <img class="sport__benefits__card--img" src="https://betfury-affiliate.com/_nuxt/icon-3.e001db18.png" alt="https://betfury-affiliate.com/_nuxt/icon-3.e001db18.png">
                            <h4 class="sport__benefits__card--title">International brand</h4>
                            <p class="sport__benefits__card--description">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis architecto dolor expedita nesciunt, voluptates at autem error est. Dolorem, eum.</p>
                        </div>
                    </div>
                    <div class="col">
                        <div class="sport__benefits__card">
                            <img class="sport__benefits__card--img" src="https://betfury-affiliate.com/_nuxt/icon-3.e001db18.png" alt="https://betfury-affiliate.com/_nuxt/icon-3.e001db18.png">
                            <h4 class="sport__benefits__card--title">International brand</h4>
                            <p class="sport__benefits__card--description">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis architecto dolor expedita nesciunt, voluptates at autem error est. Dolorem, eum.</p>
                        </div>
                    </div>
                    <div class="col">
                        <div class="sport__benefits__card">
                            <img class="sport__benefits__card--img" src="https://betfury-affiliate.com/_nuxt/icon-3.e001db18.png" alt="https://betfury-affiliate.com/_nuxt/icon-3.e001db18.png">
                            <h4 class="sport__benefits__card--title">International brand</h4>
                            <p class="sport__benefits__card--description">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis architecto dolor expedita nesciunt, voluptates at autem error est. Dolorem, eum.</p>
                        </div>
                    </div>
                    <div class="col">
                        <div class="sport__benefits__card">
                            <img class="sport__benefits__card--img" src="https://betfury-affiliate.com/_nuxt/icon-3.e001db18.png" alt="https://betfury-affiliate.com/_nuxt/icon-3.e001db18.png">
                            <h4 class="sport__benefits__card--title">International brand</h4>
                            <p class="sport__benefits__card--description">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis architecto dolor expedita nesciunt, voluptates at autem error est. Dolorem, eum.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
 --}}



@extends('welcome')
@section('content')

 <style>
    .game::before {
        background: linear-gradient(180deg,#fa2f5c,rgba(0,9,87,0));
        content: "";
        display: block;
        height: 45%;
        left: 0;
        position: absolute;
        top: 0;
        width: 100%;
        z-index: -1;
    }
    .game {
        margin: 0;
    }
</style>

<div>
    <div class="sport__page row align-items-center justify-content-center text-center">
        <div class="col-lg-10">

            <div class="sport__box">
                {{-- <img class="w-100" src="https://betfury-affiliate.com/_nuxt/intro-image.f05f9514.png" alt=""> --}}
                <img class="w-100 d-none d-lg-block" src="{{ asset('sports.png') }}" alt="{{ asset('sports.png') }}">
                <div class="sport__box__content">
                    <h2 class="sport__box__title"><span class="color-red">29</span>{{_('bet Sports') }}</h2>
                    <h2 class="sport__box__title mb-2"><span class="color-red">{{ __('REAL TIME BETTING') }}</h2>
                    <p class="sport__box__description">
                        {{ __("You won't want to miss our news! We are preparing an amazing new sports structure that will help you earn even more money. Keep an eye out so you don't miss this opportunity!")}}
                    </p>
                </div>
                <div class="sport__present mt-5">
                    <div class="sport__present__button">
                        <a class="sport__present__button--link">{{ __('Shortly..')}}</a>
                    </div>
                    <div class="sport__present__chicket">
                        <p>
                            <span class="font-bold">{{__('Discount coupons')}}</span>
                            <br>
                            {{__("in all sports")}}
                        </p>
                        <img src="{{ asset('img/all/pages/sports/presente.png') }}" alt="{{ asset('img/all/pages/sports/presente.png') }}">
                    </div>
                </div>

                <div class="row row-cols-lg-4 row-cols-md-3 row-cols-sm-2 row-col-1 sport__benefits ">
                    <div class="col my-5">
                        <div class="sport__benefits__card">
                            <img class="sport__benefits__card--img" src="https://betfury-affiliate.com/_nuxt/icon-3.e001db18.png" alt="https://betfury-affiliate.com/_nuxt/icon-3.e001db18.png">
                            <h4 class="sport__benefits__card--title">Aumente seus Ganhos com 29BET!</h4>
                            <p class="sport__benefits__card--description">
                                Junte-se à emoção das apostas esportivas na 29Bet e experimente a adrenalina de ganhar dinheiro
                                enquanto torce pelo seu time favorito! Nossa plataforma oferece uma ampla variedade de opções de
                                apostas em esportes, desde futebol até corridas de cavalos.
                            </p>
                        </div>
                    </div>
                    <div class="col my-5">
                        <div class="sport__benefits__card">
                            <img class="sport__benefits__card--img" src="{{ asset('img/all/pages/sports/ico-1.png') }}" alt="{{ asset('img/all/pages/sports/ico-1.png') }">
                            <h4 class="sport__benefits__card--title">Suporte Excepcional na 29BET!</h4>
                            <p class="sport__benefits__card--description">
                                Na 29Bet, acreditamos que o atendimento ao cliente é fundamental para uma experiência de apostas excepcional.
                                Nossa equipe de suporte está disponível 24 horas por dia, 7 dias por semana, para ajudar com qualquer dúvida
                                ou problema que você possa ter.
                            </p>
                        </div>
                    </div>
                    <div class="col my-5">
                        <div class="sport__benefits__card">
                            <img class="sport__benefits__card--img" src="{{ asset('img/all/pages/sports/ico-2.png') }}" alt="{{ asset('img/all/pages/sports/ico-2.png') }}">
                            <h4 class="sport__benefits__card--title">Vantagens Inigualáveis na 29BET!</h4>
                            <p class="sport__benefits__card--description">
                                A 29Bet oferece uma série de benefícios exclusivos para os entusiastas de apostas esportivas.
                                Além das odds competitivas e da ampla gama de esportes para apostar, proporcionamos cashbacks
                                regulares que retornam parte do valor das suas apostas, mesmo que você não ganhe.
                            </p>
                        </div>
                    </div>
                    <div class="col my-5">
                        <div class="sport__benefits__card">
                            <img class="sport__benefits__card--img" src="{{ asset('img/all/pages/sports/ico-3.png') }}" alt="{{ asset('img/all/pages/sports/ico-3.png') }}">
                            <h4 class="sport__benefits__card--title">Jogos Empolgantes e Novidades na 29BET!</h4>
                            <p class="sport__benefits__card--description">
                                Na 29Bet, a diversão vai além das apostas esportivas tradicionais. Nossa plataforma oferece uma emocionante variedade
                                de jogos de cassino para complementar sua experiência de apostas. De caça-níqueis a jogos de mesa, você encontrará uma
                                seleção cativante.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>




@endsection
