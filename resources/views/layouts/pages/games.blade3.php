@extends('welcome')

@section('css')
    <link rel="stylesheet" href="https://cdn.29bet.com/assets/css/slick.css">

    <style>
        .slider-games-home {
            padding: 0;
        }

        .slider-items {
            padding: 0 5px;
        }

        .slider__games__items {
            padding: 0;
        }

        .slider-items img {
            width: 100vw;
            height: auto;
            border-radius: 12px;
        }


        .stick__sliders {
            display: flex;
            justify-content: end;
            margin-bottom: 15px;
        }
        .slick-track {
            width: 100%!important
        }
        .pageLoaderRecharge {
            z-index: 999999;
            position: fixed;
            left: 0;
            top: 0;
            width: 100vw;
            height: 100vh;
            background: #090e14de;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
        }
        .initGames__item--prov {
          width: 100%!important;
          max-width: 130px!important;
        }
    </style>
@endsection
@section('content')
    @if ($showLoader)
        <div class="pageLoader">
            <div class="loader-main">
                <img class="loader-main-image" src="https://cdn.29bet.com/assets/img/all/pages/layout/logotype.png"
                    alt="https://cdn.29bet.com/assets/img/all/pages/layout/logotype.png">
                <div class="loading-progress"></div>
            </div>
        </div>
    @endif

    <div class="pageLoaderRecharge" style="display: none">
        <div class="loader-maind">
            <img class="loader-main-image" src="https://cdn.29bet.com/assets/img/all/pages/layout/logotype.png"
                alt="https://cdn.29bet.com/assets/img/all/pages/layout/logotype.png">
            <div class="loading-progress"></div>
        </div>
    </div>

    <section>
        {{-- <div class="home__banners">
            <div class="home__banners__items slider-home-banners p-0">
                @php
                    dd($image_list);
                @endphp
                @empty($image_list)
                    <div class="home__banners__items__large">
                        <a class="home__banners__items__large__link" href="#">
                            <img class="home__banners__items__large--img"

                                src="https://cdn.29bet.com/assets/img/all/pages/games/banner-large-01.png" alt="https://cdn.29bet.com/assets/img/all/pages/games/banner-large-01.png">
                        </a>
                    </div>
                    <div class="home__banners__items__large">
                        <a class="home__banners__items__large__link" href="#">
                            <img class="home__banners__items__large--img"
                                src="https://cdn.29bet.com/assets/img/all/pages/games/banner-large-02.png" alt="https://cdn.29bet.com/assets/img/all/pages/games/banner-large-02.png">
                        </a>
                    </div>
                    <div class="home__banners__items__small">
                        <a class="home__banners__items__small__link" href="#">
                            <img class="home__banners__items__small--img"
                                src="https://cdn.29bet.com/assets/img/all/pages/games/banner-small-01.png" alt="https://cdn.29bet.com/assets/img/all/pages/games/banner-small-01.png">
                        </a>
                    </div>
                    <div class="home__banners__items__small">
                        <a class="home__banners__items__small__link" href="#">
                            <img class="home__banners__items__small--img"
                                src="https://cdn.29bet.com/assets/img/all/pages/games/banner-small-02.png" alt="https://cdn.29bet.com/assets/img/all/pages/games/banner-small-02.png">
                        </a>
                    </div>
                    <div class="home__banners__items__small">
                        <a class="home__banners__items__small__link" href="#">
                            <img class="home__banners__items__small--img"
                                src="https://cdn.29bet.com/assets/img/all/pages/games/banner-small-03.png" alt="https://cdn.29bet.com/assets/img/all/pages/games/banner-small-03.png">
                        </a>
                    </div>
                    <div class="home__banners__items__small">
                        <a class="home__banners__items__small__link" href="#">
                            <img class="home__banners__items__small--img"
                                src="https://cdn.29bet.com/assets/img/all/pages/games/banner-small-04.png" alt="https://cdn.29bet.com/assets/img/all/pages/games/banner-small-04.png">
                        </a>
                    </div>
                @else
                    @php
                        $cnt = 0;
                    @endphp

                    @foreach ($image_list as $image_list)
                        @if ($cnt <= 1)
                            <div class="home__banners__items__large">
                                <img class="home__banners__items__large--img"
                                    src="{{ asset($image_list['computers_icon']) }}" alt="{{ asset($image_list['computers_icon']) }}">
                            </div>
                            @php
                                $cnt++;
                            @endphp
                            @continue
                        @endif
                        @if ($cnt > 1)
                            <div class="home__banners__items__small">
                                <img class="home__banners__items__small--img"
                                    src="{{ asset($image_list['computers_icon']) }}" alt="{{ asset($image_list['computers_icon']) }}">
                            </div>
                            @php
                                $cnt++;
                            @endphp
                        @endif
                    @endforeach
                @endempty

            </div>
        </div> --}}
        <div class="new__banners">
            <div class="new__banners__background" style="padding-top: 0px;">
                <div class="new__banners__background__title d-none d-lg-flex d-md-flex mb-1"
                    style="background-image: url('https://cdn.29bet.com/assets/img/all/pages/games/banner-principal.webp');">

                    <h1>
                        <span class="new__banners__background__title--logo">29Bet</span>
                        <br>
                        <span class="new__banners__background__title--about">
                            {{ __('BET AND WIN NOW!') }}
                        </span>
                        <br>
                        {{ __('The Online Casino That Offers The Best Gambling Experience Today!') }}
                    </h1>
                </div>
                <div class="new__banners__background__boxes slder-banners-new p-0">
                    @empty($image_list)
                        <div class="px-1">
                            <a href="javascript:void(0)" class="new__banners__background__boxes__item">
                                <img class="new__banners__background__boxes__item--img w-100 lazy-load"
                                    src="https://cdn.29bet.com/assets/img/all/pages/games/banner-promotion-1.png"
                                    alt="https://cdn.29bet.com/assets/img/all/pages/games/banner-promotion-1.png">
                            </a>
                        </div>

                        <div class="px-1">
                            <a href="javascript:void(0)" class="new__banners__background__boxes__item">
                                <img class="new__banners__background__boxes__item--img w-100 lazy-load"
                                    src="https://cdn.29bet.com/assets/img/all/pages/games/banner-promotion-2.png"
                                    alt="https://cdn.29bet.com/assets/img/all/pages/games/banner-promotion-2.png">
                            </a>
                        </div>

                        <div class="px-1">
                            <a href="javascript:void(0)" class="new__banners__background__boxes__item">
                                <img class="new__banners__background__boxes__item--img w-100 lazy-load"
                                    src="https://cdn.29bet.com/assets/img/all/pages/games/banner-promotion-3.png"
                                    alt="https://cdn.29bet.com/assets/img/all/pages/games/banner-promotion-3.png">
                            </a>
                        </div>

                        <div class="px-1">
                            <a href="javascript:void(0)" class="new__banners__background__boxes__item">
                                <img class="new__banners__background__boxes__item--img w-100 lazy-load"
                                    src="https://cdn.29bet.com/assets/img/all/pages/games/banner-promotion-4.png"
                                    alt="https://cdn.29bet.com/assets/img/all/pages/games/banner-promotion-4.png">
                            </a>
                        </div>

                        <div class="px-1">
                            <a href="javascript:void(0)" class="new__banners__background__boxes__item">
                                <img class="new__banners__background__boxes__item--img w-100 lazy-load"
                                    src="https://cdn.29bet.com/assets/img/all/pages/games/banner-promotion-2.png"
                                    alt="https://cdn.29bet.com/assets/img/all/pages/games/banner-promotion-2.png">
                            </a>
                        </div>

                        <div class="px-1">
                            <a href="javascript:void(0)" class="new__banners__background__boxes__item">
                                <img class="new__banners__background__boxes__item--img w-100 lazy-load"
                                    src="https://cdn.29bet.com/assets/img/all/pages/games/banner-promotion-3.png"
                                    alt="https://cdn.29bet.com/assets/img/all/pages/games/banner-promotion-3.png">
                            </a>
                        </div>

                        <div href="javascript:void(0)" class="px-1">
                            <a href="javascript:void(0)" class="new__banners__background__boxes__item">
                                <img class="new__banners__background__boxes__item--img w-100 lazy-load"
                                    src="https://cdn.29bet.com/assets/img/all/pages/games/banner-promotion-4.png"
                                    alt="https://cdn.29bet.com/assets/img/all/pages/games/banner-promotion-4.png">
                            </a>
                        </div>
                    @else
                        @foreach ($image_list as $images)
                            @php
                                $id = $images['id'];
                            @endphp
                            <div class="px-1">
                                <a href="{{ route('event_details_page', ['id' => $id]) }}"
                                    class="new__banners__background__boxes__item">
                                    <img class="new__banners__background__boxes__item--img w-100 lazy-load"
                                        src="{{ $images['computers_icon'] }}" alt="{{ $images['computers_icon'] }}">
                                </a>
                            </div>
                            {{-- <!-- <div class="new__banners__background__boxes__item px-1">
                                <a href="javascript:void(0)">
                                    <img class="new__banners__background__boxes__item--img w-100" src="{{ url($images['computers_icon'])}}"   alt="{{ url($images['computers_icon'])}}">
                                </a>
                            </div> --> --}}
                        @endforeach
                    @endempty

                </div>
            </div>
        </div>


        <div class="home__filter mt-3">
            <div class="filter__container" id="filter__container">
                <div class="row">
                    <div class="col-12">
                        <div class="filter__links h-100 p-0 slider-filters-home">
                            <div>
                                <div class="filter__item filter__home active" onclick="filterSelection('all')">
                                    <img src="https://cdn.29bet.com/assets/img/all/pages/games/all.webp"
                                        alt="https://cdn.29bet.com/assets/img/all/pages/games/all.webp">
                                    <span class="filter__txt">{{ __('All') }}</span>
                                    <b>{{ $games_count }}</b>
                                </div>
                            </div>

                            {{-- provider separeted section nav --}}
                            {{-- <div>
                                <div class="filter__item filter__home"
                                    onclick="filterSelection('cat--{{ $navs[1][2] }}')">
                                    <img src="{{ $navs[1][3] }}" alt="{{ $navs[1][3] }}">
                                    <span class="filter__txt">{{ __($navs[1][1]) }}</span>
                                </div>
                            </div> --}}
                            @foreach ($navs as $nav)
                                {{-- @if ($nav[1] !== 'Providers') --}}
                                <div>
                                    <div id="{{ $nav[2] }}" class="filter__item filter__home"
                                        onclick="filterSelection('cat--{{ $nav[2] }}')">
                                        <img src="{{ $nav[3] }}" alt="{{ $nav[3] }}">
                                        <span class="filter__txt">{{ __($nav[1]) }}</span>
                                    </div>
                                </div>
                                {{-- @endif --}}
                            @endforeach
                        </div>
                    </div>

                    {{-- <div class="col filter__pesquisa">
                        <div class="pesquisa" onclick="$('.md-modalwin').toggleClass('md-show', true);">
                            <i class=" pesquisa__icon fa fa-search"></i>
                            <input class="pesquisa__campo" id="pesquisa-card" type="text" name="search"
                                placeholder="Pesquise um jogo" autocomplete="off">
                        </div>
                    </div> --}}
                </div>
            </div>

            <div class="home__sliders">

                {{-- providers --}}
                {{-- baba --}}
                {{-- <script>
                    $(document).ready(function() {
                        slickify('pang_load2');
                    });
                </script> --}}
                <div class="initGames filterDiv cat--providers pang_load2" >

                    <div class="stick__sliders d-flex justify-content-between align-items-center">
                        <div class="initGames__titulo m-0">
                            <div class="initGames__titulo--ico">
                                <img src="https://cdn.29bet.com/assets/img/all/pages/games/provider.webp">
                            </div>
                            <div class="initGames__titulo--txt">{{ __('Providers') }}</div>
                        </div>
                        <div>
                            <button class="slick__prev prev-providers"><i
                                    class=" pesquisa__icon fa fa-angle-left"></i></button>
                            <button class="slick__prev next-providers"><i
                                    class=" pesquisa__icon fa fa-angle-right"></i></button>
                        </div>
                    </div>
                    {{-- game list of providers --}}
                    <div class="js-slider-providers p-0">
                        @foreach ($contents['providers'] as $provider)
                            <div class="initGames__item--prov {{ $provider[2] }}"
                                onclick="filterSelection('{{ $provider[2] }}')">
                                <div class="initGames__content">
                                    <div class="initGames__img" style="background-image:url('{{ $provider[4] }}')">
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>


                {{-- internal --}}
                @php
                    $code_name = str_replace(' ', '_', strtolower($contents['internal'][2]));
                @endphp
                <div class="initGames filterDiv cat--{{ $code_name }}">
                    <div class="stick__sliders d-flex justify-content-between align-items-center">
                        <div class="initGames__titulo m-0">
                            <div class="initGames__titulo--ico"><img
                                    src="https://cdn.29bet.com/assets/img/all/pages/games/all.webp"
                                    alt="https://cdn.29bet.com/assets/img/all/pages/games/all.webp"></div>
                            <div class="initGames__titulo--txt">{{ __($contents['internal'][1]) }}</div>
                        </div>
                        <div>
                            <a class="btn__viewall"
                                href="{{ route('site.allgames', ['game_type' => $contents['internal'][0]]) }}">{{ __('View All') }}</a>
                            <button class="slick__prev" onclick="gameSlickPrev('{{ $code_name }}')"><i
                                    class=" pesquisa__icon fa fa-angle-left"></i></button>
                            <button class="slick__prev" onclick="gameSlickNext('{{ $code_name }}')"><i
                                    class=" pesquisa__icon fa fa-angle-right"></i></button>
                        </div>
                    </div>

                    <div class="initGames__container js-slider-{{ $code_name }} p-0">

                        @foreach ($contents['internal'][4]->skip(0)->take(15) as $key => $game)
                            <div class="initGames__item item--slots">
                                <div class="initGames__content">
                                    <div class="iniGames__new"><img
                                            src="https://cdn.29bet.com/assets/img/all/components/games/tag-new.png"
                                            alt="https://cdn.29bet.com/assets/img/all/components/games/tag-new.png">
                                    </div>
                                    <div class="initGames__img"
                                        style="background-image:url('https://cdn.29bet.com/uat-images/games/{{ $game['computers_icon'] }}')">
                                    </div>
                                    @if (Auth::guest())
                                        <a href="javascript:void()" onclick="$('#b_si').click();">
                                        @else
                                            <a href="{{ $game['api_url'] }}">
                                    @endif
                                    <div class="initGames__hover">
                                        <div class="initGames_hover--name">{{ strtoupper($game['game_name']) }}</div>
                                        <div class="initGames_hover--play"><i class=" pesquisa__icon fa fa-play"></i>
                                        </div>
                                        <div class="initGames_hover--sssg">{{ $code_name }}</div>
                                    </div>
                                    </a>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>


                {{-- proiders --}}
                <script>
                    document.addEventListener("DOMContentLoaded", function() {
                        slickify('{{ $code_name }}');
                    });
                    const isSafari = /^((?!chrome|android).)*safari/i.test(navigator.userAgent);
                </script>

                @foreach ($contents['providers'] as $provider)
                    @php
                        $code_name = str_replace(' ', '_', strtolower($provider[2]));
                    @endphp
                    <div class="initGames filterDiv cat--{{ $code_name }}">
                        <div class="stick__sliders d-flex justify-content-between align-items-center">
                            <div class="initGames__titulo m-0">
                                <div class="initGames__titulo--ico"><img src="{{ $provider[4] }}"
                                        alt="{{ $provider[4] }}"></div>
                                <div class="initGames__titulo--txt">{{ __($provider[1]) }}</div>
                            </div>
                            <div>
                                <a class="btn__viewall"
                                    href="{{ route('site.allgames', ['game_type' => $provider[0]]) }}">{{ __('View All') }}</a>
                                <button class="slick__prev" onclick="gameSlickPrev('{{ $code_name }}')"><i
                                        class=" pesquisa__icon fa fa-angle-left"></i></button>
                                <button class="slick__prev" onclick="gameSlickNext('{{ $code_name }}')"><i
                                        class=" pesquisa__icon fa fa-angle-right"></i></button>
                            </div>
                        </div>

                        <div class="initGames__container js-slider-{{ $code_name }} p-0">

                            @foreach ($provider[3]->skip(0)->take(15)->get() as $key => $game)
                                <div class="initGames__item item--slots">
                                    <div class="initGames__content">
                                        <div class="iniGames__new"><img
                                                src="https://cdn.29bet.com/assets/img/all/components/games/tag-new.png"
                                                alt="https://cdn.29bet.com/assets/img/all/components/games/tag-new.png">
                                        </div>
                                        <div class="initGames__img"
                                            style="background-image:url('https://cdn.29bet.com/uat-images/games/{{ $game['computers_icon'] }}')">
                                        </div>
                                        @if (Auth::guest())
                                            <a href="javascript:void()" onclick="$('#b_si').click();">
                                            @else
                                                <a id="red_url_{{ $game->id }}" href="{{ $game->api_url }}">
                                                    @if ($game->game_origin == 'PGSoft Games')
                                                        <script>
                                                            if (isSafari && window.innerWidth <= 590) {
                                                                const url = '{!! $game->getPGUrl() !!}';
                                                                const new_url = url.replace('amp;', '').replace('amp;', '');
                                                                $('#red_url_{{ $game->id }}').attr('href', new_url);
                                                                $('#red_url_{{ $game->id }}').attr('target', '_blank');
                                                            }
                                                        </script>
                                                    @endif
                                                    @if (isset($game->game_provider))
                                                        @if ($game->game_provider != 4 && $game->game_provider != 5)
                                                            <script>
                                                                if (isSafari && window.innerWidth <= 590) {
                                                                    const url = '{!! $game->api_url !!}';
                                                                    $('#red_url_{{ $game->id }}').attr('href', url + '/true');
                                                                    $('#red_url_{{ $game->id }}').attr('target', '_blank');
                                                                }
                                                            </script>
                                                        @endif
                                                    @endif
                                        @endif
                                        <div class="initGames__hover">
                                            <div class="initGames_hover--name">{{ strtoupper($game->game_name) }}</div>
                                            <div class="initGames_hover--play"><i class=" pesquisa__icon fa fa-play"></i>
                                            </div>
                                            <div class="initGames_hover--sssg">{{ $code_name }}</div>
                                        </div>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    </div>


                    <script>
                        $(document).ready(function() {
                            slickify('{{ $code_name }}');
                        });
                    </script>
                @endforeach

                {{-- end of provider's game --}}

                @php
                    $code_name = str_replace(' ', '_', strtolower($contents['slots'][2]));
                @endphp
                <div class="initGames filterDiv cat--{{ $code_name }}">
                    <div class="stick__sliders d-flex justify-content-between align-items-center">
                        <div class="initGames__titulo m-0">
                            <div class="initGames__titulo--ico"><img
                                    src="https://cdn.29bet.com/assets/img/all/pages/games/slots.webp"
                                    alt="https://cdn.29bet.com/assets/img/all/pages/games/slots.webp"></div>
                            <div class="initGames__titulo--txt">{{ __($contents['slots'][1]) }}</div>
                        </div>
                        <div>
                            <a class="btn__viewall"
                                href="{{ route('site.allgames', ['game_type' => 'slots']) }}">{{ __('View All') }}</a>
                            <button class="slick__prev" onclick="gameSlickPrev('{{ $code_name }}')"><i
                                    class=" pesquisa__icon fa fa-angle-left"></i></button>
                            <button class="slick__prev" onclick="gameSlickNext('{{ $code_name }}')"><i
                                    class=" pesquisa__icon fa fa-angle-right"></i></button>
                        </div>
                    </div>
                    {{-- pgsoft --}}
                    <div class="initGames__container js-slider-{{ $code_name }} p-0">

                        @foreach ($contents['slots'][3]->skip(0)->take(15)->get() as $key => $game)
                            <div class="initGames__item item--slots">
                                <div class="initGames__content">
                                    <div class="iniGames__new"><img
                                            src="https://cdn.29bet.com/assets/img/all/components/games/tag-new.png"
                                            alt="https://cdn.29bet.com/assets/img/all/components/games/tag-new.png">
                                    </div>
                                    <div class="initGames__img"
                                        style="background-image:url('https://cdn.29bet.com/uat-images/games/{{ $game['computers_icon'] }}')">
                                    </div>
                                    @if (Auth::guest())
                                        <a href="javascript:void()" onclick="$('#b_si').click();">
                                        @else
                                            <a id="slot_url_{{ $game->id }}" href="{{ $game->api_url }}">
                                                @if ($game->game_origin == 'PGSoft Games')
                                                    <script>
                                                        if (isSafari && window.innerWidth <= 590) {
                                                            const url = '{!! $game->getPGUrl() !!}';
                                                            const new_url = url.replace('amp;', '').replace('amp;', '');
                                                            $('#slot_url_{{ $game->id }}').attr('href', new_url);
                                                            $('#slot_url_{{ $game->id }}').attr('target', '_blank');
                                                        }
                                                    </script>
                                                @endif
                                                @if (isset($game->game_provider))
                                                    @if ($game->game_provider != 4 && $game->game_provider != 8)
                                                        <script>
                                                            if (isSafari && window.innerWidth <= 590) {
                                                                const url = '{!! $game->api_url !!}';
                                                                $('#red_url_{{ $game->id }}').attr('href', url + '/true');
                                                                $('#red_url_{{ $game->id }}').attr('target', '_blank');
                                                            }
                                                        </script>
                                                    @endif
                                                @endif
                                    @endif
                                    <div class="initGames__hover">
                                        <div class="initGames_hover--name">{{ strtoupper($game->game_name) }}</div>
                                        <div class="initGames_hover--play"><i class=" pesquisa__icon fa fa-play"></i>
                                        </div>
                                        <div class="initGames_hover--sssg">{{ $code_name }}</div>
                                    </div>
                                    </a>
                                </div>
                            </div>
                        @endforeach

                    </div>

                </div>

                <script>
                    $(document).ready(function() {
                        slickify('{{ $code_name }}');
                    });
                </script>

                @php
                    $code_name = str_replace(' ', '_', strtolower($contents['fishing'][2]));
                @endphp
                <div class="initGames filterDiv cat--{{ $code_name }}">
                    <div class="stick__sliders d-flex justify-content-between align-items-center">
                        <div class="initGames__titulo m-0">
                            <div class="initGames__titulo--ico"><img
                                    src="https://cdn.29bet.com/assets/img/all/pages/games/slots.webp"
                                    alt="https://cdn.29bet.com/assets/img/all/components/games/tag-new.png"></div>
                            <div class="initGames__titulo--txt">{{ __($contents['fishing'][1]) }}</div>
                        </div>
                        <div>
                            <a class="btn__viewall"
                                href="{{ route('site.allgames', ['game_type' => 'fishing']) }}">{{ __('View All') }}</a>
                            <button class="slick__prev" onclick="gameSlickPrev('{{ $code_name }}')"><i
                                    class=" pesquisa__icon fa fa-angle-left"></i></button>
                            <button class="slick__prev" onclick="gameSlickNext('{{ $code_name }}')"><i
                                    class=" pesquisa__icon fa fa-angle-right"></i></button>
                        </div>
                    </div>

                    <div class="initGames__container js-slider-{{ $code_name }} p-0">

                        @foreach ($contents['fishing'][3]->skip(0)->take(15)->get() as $key => $game)
                            <div class="initGames__item item--fishing">
                                <div class="initGames__content">
                                    <div class="iniGames__new"><img
                                            src="https://cdn.29bet.com/assets/img/all/components/games/tag-new.png"
                                            alt="https://cdn.29bet.com/assets/img/all/components/games/tag-new.png">
                                    </div>
                                    <div class="initGames__img"
                                        style="background-image:url('https://cdn.29bet.com/uat-images/games/{{ $game['computers_icon'] }}')">
                                    </div>
                                    @if (Auth::guest())
                                        <a href="javascript:void()" onclick="$('#b_si').click();">
                                        @else
                                            <a id="slot_url_{{ $game->id }}" href="{{ $game->api_url }}">
                                                @if ($game->game_origin == 'PGSoft Games')
                                                    <script>
                                                        if (isSafari && window.innerWidth <= 590) {
                                                            const url = '{!! $game->getPGUrl() !!}';
                                                            const new_url = url.replace('amp;', '').replace('amp;', '');
                                                            $('#slot_url_{{ $game->id }}').attr('href', new_url);
                                                            $('#slot_url_{{ $game->id }}').attr('target', '_blank');
                                                        }
                                                    </script>
                                                @endif
                                                @if (isset($game->game_provider))
                                                    @if ($game->game_provider != 4 && $game->game_provider != 8)
                                                        <script>
                                                            if (isSafari && window.innerWidth <= 590) {
                                                                const url = '{!! $game->api_url !!}';
                                                                $('#red_url_{{ $game->id }}').attr('href', url + '/true');
                                                                $('#red_url_{{ $game->id }}').attr('target', '_blank');
                                                            }
                                                        </script>
                                                    @endif
                                                @endif
                                    @endif
                                    <div class="initGames__hover">
                                        <div class="initGames_hover--name">{{ strtoupper($game->game_name) }}</div>
                                        <div class="initGames_hover--play"><i class=" pesquisa__icon fa fa-play"></i>
                                        </div>
                                        <div class="initGames_hover--sssg">{{ $code_name }}</div>
                                    </div>
                                    </a>
                                </div>
                            </div>
                        @endforeach

                    </div>
                    <script>
                        $(document).ready(function() {
                            slickify('{{ $code_name }}');
                        });
                    </script>

                </div>


            </div>

    </section>
@endsection

@section('js')
    {{-- <script src="https://cdn.29bet.com/assets/js/home.js"></script> --}}
    <script src="{{ asset('js/home.js')}}"></script>
    @if (session()->has('referral_code'))
        <script>
            $('.md-popup-hover').removeClass('md-show');
            $('.md-auth').addClass('md-show');
        </script>
    @endif

    @if ($errors->first('error_header'))
        <script>
            $('.md-popup-hover').removeClass('md-show');

            $('#error_header').html("{{ $errors->first('error_header') }}");
            $('#error_message').html("{{ $errors->first('error_message') }}");

            $('.md-popup-error').addClass('md-show');
        </script>
    @endif

    @if ($isLogin)
        <script>
            $('.md-auth').toggleClass('md-show', true);
        </script>
    @endif
@endsection
