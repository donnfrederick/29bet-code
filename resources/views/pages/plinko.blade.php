@extends('welcome')
@section('css')
<style>
    .dropdown__select__default.bb_disabled {
        cursor: not-allowed !important;
    }
    #playCrash:disabled {
        cursor: not-allowed;
        background-color: #c9264a;
    }
    @media (max-width: 650px) {
        .game {
            margin: 10px 0;
        }
    }
</style>
@endsection
@section('content')

<div class="game__wrapper row justify-content-center">

    <div class="col-lg-7">
        <div class="g_sidebar_footer p-0 mb-2 mt-2 justify-content-lg-end">
            <div class="g_sidebar_footer_button tooltip" onclick="$('.md-result-instrution-plinko').toggleClass('md-show', true);" title="{{ __('Game information')}}">
                <svg width="15" height="15" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M10 1.25C5.16745 1.25 1.25 5.16745 1.25 10C1.25 14.8325 5.16745 18.75 10 18.75C14.8325 18.75 18.75 14.8325 18.75 10C18.75 5.16745 14.8325 1.25 10 1.25ZM10.2574 14.5791C10.093 14.7564 9.85964 14.845 9.55594 14.845C9.2526 14.845 9.01964 14.7585 8.8574 14.5854C8.69515 14.4121 8.61385 14.1698 8.61385 13.858C8.61385 13.2128 8.92776 12.8904 9.55594 12.8904C9.86365 12.8904 10.0984 12.9746 10.261 13.1435C10.4236 13.3123 10.5046 13.5504 10.5046 13.858C10.5046 14.1614 10.4218 14.4016 10.2574 14.5791ZM12.5426 8.32401C12.4485 8.57411 12.3064 8.81219 12.116 9.0386C11.9257 9.265 11.5983 9.55995 11.1328 9.92307C10.7354 10.2348 10.4692 10.4933 10.3347 10.6985C10.2209 10.8717 10.1586 11.0981 10.1411 11.3719C10.14 11.3778 10.1382 11.3796 10.1371 11.3854C10.0605 11.8167 9.55959 11.8138 9.55959 11.8138H9.29635C9.29635 11.8138 8.86067 11.7453 8.87709 11.4037C8.87709 10.9337 8.9624 10.5429 9.13339 10.2308C9.30437 9.9187 9.6037 9.5964 10.0306 9.26318C10.5392 8.8614 10.8666 8.54969 11.0139 8.32765C11.1612 8.10562 11.2352 7.84057 11.2352 7.53286C11.2352 7.17411 11.1156 6.89849 10.8765 6.70599C10.6373 6.51349 10.2931 6.4176 9.84469 6.4176C9.43854 6.4176 9.06265 6.47521 8.71666 6.59078C8.52781 6.65385 8.34224 6.72531 8.15813 6.80224C8.15411 6.8037 8.15265 6.80296 8.14828 6.80479C7.72318 6.96923 7.52594 6.6349 7.52594 6.6349L7.35896 6.28526C7.35896 6.28526 7.17084 5.85615 7.58865 5.66839C8.33349 5.32786 9.12135 5.15577 9.95334 5.15577C10.7904 5.15577 11.4551 5.36104 11.9462 5.7712C12.4372 6.18135 12.683 6.74755 12.683 7.46943C12.6834 7.78916 12.6362 8.07428 12.5426 8.32401Z" fill="currentColor"/>
                </svg>
            </div>
            <div class="g_sidebar_footer_button text-white" id="plinko_music" data-music="on" onclick="setAudioGame(!isAudioGame)">
                <script>$(document).ready(function(){isAudioGame?($("#game_audio_on").fadeIn(0),$("#game_audio_off").fadeOut(0)):($("#game_audio_off").fadeIn(0),$("#game_audio_on").fadeOut(0))});</script>
                <div class="tooltip" id="game_audio_on" style="display:none" title="{{ __('Turn off the sound')}}">
                    <svg width="15" height="15" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12.0329 0.0666813C11.9226 0.0126507 11.7992 -0.00873414 11.6771 0.00504551C11.5551 0.0188252 11.4395 0.0671954 11.344 0.144459L5.0107 5.20001H1.99959C1.27737 5.20001 0.688477 5.7889 0.688477 6.51113V11.7111C0.688477 12.4333 1.27737 13.0111 1.99959 13.0111H5.02181L11.3551 18.0778C11.4506 18.1506 11.564 18.1963 11.6833 18.2099C11.8026 18.2236 11.9234 18.2048 12.0329 18.1556C12.2551 18.0445 12.3996 17.8222 12.3996 17.5667V0.65557C12.3997 0.532942 12.3653 0.41275 12.3005 0.308651C12.2357 0.204553 12.143 0.120721 12.0329 0.0666813Z" fill="currentColor"/>
                        <path d="M16.5227 5.87755C16.5227 5.35595 16.0998 4.93311 15.5782 4.93311C15.0566 4.93311 14.6338 5.35595 14.6338 5.87755V12.2664C14.6338 12.788 15.0566 13.2109 15.5782 13.2109C16.0998 13.2109 16.5227 12.788 16.5227 12.2664V5.87755Z" fill="currentColor"/>
                        <path d="M19.8889 3.94444C19.8889 3.42284 19.466 3 18.9444 3C18.4228 3 18 3.42284 18 3.94444V13.8778C18 14.3994 18.4228 14.8222 18.9444 14.8222C19.466 14.8222 19.8889 14.3994 19.8889 13.8778V3.94444Z" fill="currentColor"/>
                    </svg>
                </div>
                <div class="tooltip" id="game_audio_off" style="display:none" title="{{ __('Turn on sound')}}">
                    <svg width="15" height="15" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M14.3259 1.67366C14.327 1.55859 14.2961 1.44549 14.2366 1.34698C14.1771 1.24847 14.0914 1.16842 13.9891 1.11576C13.8849 1.06328 13.7677 1.04229 13.6518 1.05538C13.5359 1.06847 13.4263 1.11506 13.3365 1.18945L7.87331 5.53682L14.3259 12V1.67366ZM17.8417 17.2526L1.8312 1.23155C1.77384 1.1735 1.7056 1.12731 1.63038 1.09562C1.55516 1.06393 1.47444 1.04737 1.39282 1.04689C1.22799 1.0459 1.06951 1.11043 0.952257 1.22629C0.835003 1.34215 0.768576 1.49984 0.767589 1.66467C0.766602 1.82951 0.831136 1.98798 0.946994 2.10524L4.82068 5.97892H4.46278C4.08384 5.97892 3.74699 6.15787 3.52594 6.43155C3.33647 6.64208 3.2312 6.91576 3.2312 7.22103V12.1473C3.2312 12.821 3.7891 13.3789 4.46278 13.3789H7.31541L13.3154 18.1684C13.4312 18.2526 13.568 18.3052 13.7049 18.3052C13.8696 18.3052 14.0276 18.2398 14.144 18.1233C14.2605 18.0069 14.3259 17.8489 14.3259 17.6842V15.4737L16.9575 18.1263C17.0734 18.2421 17.2305 18.3072 17.3944 18.3072C17.5582 18.3072 17.7153 18.2421 17.8312 18.1263C17.9471 18.0104 18.0122 17.8533 18.0122 17.6894C18.0122 17.5256 17.9471 17.3685 17.8312 17.2526H17.8417Z" fill="currentColor"/>
                    </svg>
                </div>
            </div>
        </div>
        <div id="w_container" class="position-relative">

            {{-- <div class="outcome-window outcome-window_won outcome-window_centered">
                <div class="outcome-window__coeff outcome-window_won__coeff">x1.05</div>
                <div class="outcome-window__text outcome-window_won__text">Вы выиграли
                    <span class="outcome-window_won-wrapper">
                        <span class="outcome-window_won__sum">1050</span>
                        <span class="myicon-coins"></span>
                    </span>
                </div>
            </div> --}}

                 {{-- OUTCOME SECTION --}}
        {{-- WIN OUTCOME --}}
        <div class="congrats">
            {{-- TODO CREATE A BREAK POINTS FOR ALL DEVICES ON OUTCOME WINDOW
                id="confetti_proc"
                -Mecky pogi --}}

            <div class="btn_outcome"   href="javascript:void(0)"></div>
            <div class="el ang-a animated d-none" data-in="zoomOut"></div>
            <div class="el ang-b animated d-none" data-in="zoomOut"></div>
            <div class="el glow animated d-none" data-in="fadeIn"></div>
            <div class="el bg bg-1 animated d-none" data-in="fadeIn" data-out="zoomOut"></div>
            <div class="el dots animated d-none"> <i></i> <i></i> <i></i> <i></i> <i></i> <i></i> <i></i> <i></i> <i></i>
                <i></i> <i></i> <i></i> <i></i> <i></i> <i></i> <i></i> <i></i> <i></i> <i></i> <i></i> <i></i> <i></i>
                <i></i> <i></i> <i></i> <i></i> <i></i> <i></i> <i></i> <i></i> <i></i> <i></i> <i></i> <i></i> <i></i>
                <i></i> <i></i> <i></i> <i></i> <i></i> <i></i> <i></i> <i></i> <i></i> <i></i> <i></i> <i></i> <i></i>
                <i></i> <i></i> <i></i> <i></i> <i></i> <i></i></div>
            <div class="el bg bg-2 animated d-none" data-in="zoomIn" data-out="bounceOut"></div>
            <div class="el ang-c animated d-none" data-in="zoomOut"></div>
            <div class="el shine animated d-none" data-in="shineIn" data-out="fadeOut"></div>
            <div class="el text animated d-none " data-in="zoomOutIn" data-out="zoomOutLeft">{{ __('You won!!') }}</div>
            <div class="el text animated d-none" data-in="zoomOutIn" data-out="zoomOutLeft">
                <div class="game__win__text">
                    <div class="outcome-window__coeff outcome-window_won__coeff" id="mul" style="display: none;">x0</div>
                        <div class="outcome-window__text outcome-window_won__text game__win--rs">R$
                            <span class="outcome-window_won-wrapper game__win--value">
                                <span class="outcome-window_won__sum" id="val" style="color: #ffd534">0</span>
                                <span class="myicon-coins" style="color: #ffd534"></span>
                            </span>
                        </div>
                </div>

            </div>
        </div>
        {{-- END OF WON SECTION OUTCOME --}}


            {{-- <div class="outcome-window outcome-window_won outcome-window_centered shadow-blue game__win">
                <div class="game__win__images text-center">
                    <img class="game__win__images--tropheu" src="https://cdn.29bet.com/assets/img/tropheu.webp" alt="https://cdn.29bet.com/assets/img/tropheu.webp">
                    <img class="game__win__images--stars" src="https://cdn.29bet.com/assets/img/stars.webp" alt="https://cdn.29bet.com/assets/img/stars.webp">
                </div>
                <div class="game__win__text mt-4">
                    <p>{{ __('You won') }}!!</p>
                </div>
                <div class="outcome-window__text outcome-window_won__text game__win--rs">R$
                    <span class="outcome-window_won-wrapper game__win--value">
                        <span class="outcome-window_won__sum" id="val" style="color: #ffd534">0</span>
                        <span class="myicon-coins" style="color: #ffd534"></span>
                    </span>
                </div>
            </div> --}}

            {{-- <div class="outcome-window-demo outcome-window_won-demo outcome-window_centered">
                <div class="outcome-window__coeff-demo outcome-window_won__coeff-demo">x1.07</div>
                <div class="outcome-window__text outcome-window_won__text">Вы выиграли
                    <span class="outcome-window_won-wrapper-demo">
                        <span class="outcome-window_won__sum">0</span>
                        <span class="myicon-coins"></span>
                    </span>
                </div>
            </div> --}}
            <div class="plinko" ></div>
            {{-- <div class="plinko"  style="background: url({{ asset('img/plinko/bg.png')}});"> --}}
                <!-- Additional asset 1 -->
                  <div class="blip-container ">
                    <img src="https://cdn.29bet.com/assets/img/plinko/planets/msclns/abuhing_planeta.webp" alt="Brown_planet" class="maabong_planeta">
                  </div>
                <img src="https://cdn.29bet.com/assets/img/plinko/planets/msclns/floating_rocks.webp" alt="Asset_1" class="plinko-asset_1">
                <img src="  https://cdn.29bet.com/assets/img/plinko/planets/msclns/purple_sat.webp" alt="Asset_satelite" class="plinko-asset_purple_satelite">
                <img src=" https://cdn.29bet.com/assets/img/plinko/planets/msclns/terrain_clean.webp" alt="terrain" class="cosmic_terrain" >
                <img src="https://cdn.29bet.com/assets/img/plinko/planets/msclns/astroboy.webp" alt="astronaut" class="astroboy">
                <img src="https://cdn.29bet.com/assets/img/plinko/planets/p5.webp" alt="Asset_3" class="plinko-asset_3">
                <img src="https://cdn.29bet.com/assets/img/plinko/planets/msclns/milkita.webp" alt="Asset_satelite" class="milkita">
                <img src="https://cdn.29bet.com/assets/img/plinko/planets/msclns/cosmic_bg.webp" alt="cosmic background" class="cosmic_background">
                <img src="https://cdn.29bet.com/assets/img/plinko/planets/msclns/mas_maabong_planeta.webp" alt="meteor" class="abuhing_bato">

            {{-- <div id="litratongbola" data-images="{{ json_encode($litratongbola) }}"></div> --}}

            <!-- <div class="plinko" style="background: url('https://cdn.29bet.com/assets/img/plinko_bg.webp');"></div> -->
        </div>
        <div class="mt-1 mt-sm-4 mt-lg-4">
            <div class="">
                <div class="general__control d-flex m-0">

                    <div class="general__control__box double__bet my-1 my-sm-3 my-lg-3" >
                        <div class="general__control__box__bets">
                            <div class="general__control__box__values">
                                <p class="general__control__box__values--min my-2" id="btMn">{{ __('Min')}}</p>
                                <p class="general__control__box__values--max my-2" id="btMx">{{ __('Max')}}</p>
                            </div>

                            <label class="general__control__box__label" for="bet">
                                <div class="general__control__box__label__bet">
                                    <div class="general__control__box__label__bet__values d-flex align-items-center gap-1">
                                        <span class="general__control__box__label__bet__values--rs mt-1"><img width="24" src="https://cdn.29bet.com/assets/img/rs.svg" alt="https://cdn.29bet.com/assets/img/rs.svg"> </span>
                                        <input class="general__control__box__label__bet__values--input" id="bet" type="number" inputmode="decimal" value="1.00" style="width: 55px;">
                                    </div>
                                </div>
                            </label>

                            <div class="general__control__box__values">
                                <p class="general__control__box__values--part my-2" id="btHf">1/2</p>
                                <p class="general__control__box__values--2xl my-2" id="btDl">2x</p>
                            </div>
                        </div>
                    </div>

                     {{-- play button --}}
                        <button class="g_s  double__play my-1 my-sm-3 my-lg-3 button" id="play"
                            onclick="plinko()">
                            <div class="button-top"><span id="bet_btn">{{ __('Play') }}</span></div>
                            <div class="button-bottom"></div>
                            <div class="button-base"></div>
                        </button>

                </div>

                {{-- <div class="col-xs-12">
                    <div class="b_label">
                        Número de pinos
                    </div>
                </div> --}}
                <div class="w-100 tower__value__numbers">
                    {{-- <div class="bombs_container plinko_container plinko__items slider-plinko d-lg-block d-none">
                        <div data-pin="8" class="plinko__items--number bc_active my-2">8</div>
                        <div data-pin="9" class="plinko__items--number my-2">9</div>
                        <div data-pin="10" class="plinko__items--number my-2">10</div>
                        <div data-pin="11" class="plinko__items--number my-2">11</div>
                        <div data-pin="12" class="plinko__items--number my-2">12</div>
                        <div data-pin="13" class="plinko__items--number my-2">13</div>
                        <div data-pin="14" class="plinko__items--number my-2">14</div>
                        <div data-pin="15" class="plinko__items--number my-2">15</div>
                        <div data-pin="16" class="plinko__items--number my-2">16</div>
                    </div> --}}

                    <div class="d-flex align-items-center justify-content-center gap-2">
                        <div class="dropdown w-100 my-3">
                            <div class="dropdown__select w-100">
                                <ul class="dropdown__select__default game__select__default w-100">
                                    <li>
                                        <div class="dropdown__select__default__option">
                                            <p>{{ __('Pick a number')}}</p>
                                        </div>
                                    </li>
                                </ul>
                                <ul class="dropdown__select__list">
                                    <li data-pin="8">
                                        <div class="dropdown__select__list__option select__list__option__game pins-dropdown-list">
                                            <p class="bc_active">8</p>
                                        </div>
                                    </li>
                                    <li data-pin="9">
                                        <div class="dropdown__select__list__option select__list__option__game pins-dropdown-list">
                                            <p>9</p>
                                        </div>
                                    </li>
                                    <li data-pin="10">
                                        <div class="dropdown__select__list__option select__list__option__game pins-dropdown-list">
                                            <p>10</p>
                                        </div>
                                    </li>
                                    <li data-pin="11">
                                        <div class="dropdown__select__list__option select__list__option__game pins-dropdown-list">
                                            <p>11</p>
                                        </div>
                                    </li>
                                    <li data-pin="12">
                                        <div class="dropdown__select__list__option select__list__option__game pins-dropdown-list">
                                            <p>12</p>
                                        </div>
                                    </li>
                                    <li data-pin="13">
                                        <div class="dropdown__select__list__option select__list__option__game pins-dropdown-list">
                                            <p>13</p>
                                        </div>
                                    </li>
                                    <li data-pin="14">
                                        <div class="dropdown__select__list__option select__list__option__game pins-dropdown-list">
                                            <p>14</p>
                                        </div>
                                    </li>
                                    <li data-pin="15">
                                        <div class="dropdown__select__list__option select__list__option__game pins-dropdown-list">
                                            <p>15</p>
                                        </div>
                                    </li>
                                    <li data-pin="16">
                                        <div class="dropdown__select__list__option select__list__option__game pins-dropdown-list">
                                            <p>16</p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="dropdown w-100 my-3">
                            <div class="dropdown__select w-100">
                                <ul class="dropdown__select__default game__select__default w-100">
                                    <li>
                                        <div class="dropdown__select__default__option">
                                            <p>{{ __('Difficulty')}}</p>
                                        </div>
                                    </li>
                                </ul>
                                <ul class="dropdown__select__list">
                                    <li data-plinko-difficulty="low">
                                        <div class="dropdown__select__list__option select__list__option__game difficulty-dropdown-list">
                                            <p class="buttons-3-selected">{{ __('LOW')}}</p>
                                        </div>
                                    </li>
                                    <li data-plinko-difficulty="medium">
                                        <div class="dropdown__select__list__option select__list__option__game difficulty-dropdown-list">
                                            <p>{{ __('MEDIUM')}}</p>
                                        </div>
                                    </li>
                                    <li data-plinko-difficulty="high">
                                        <div class="dropdown__select__list__option select__list__option__game difficulty-dropdown-list">
                                            <p>{{ __('HIGH')}}</p>
                                        </div>
                                    </li>
                                </ul>
                            </div>

                        </div>
                    </div>
                </div>

                {{-- <div class="col-xs-12">
                    <div class="b_label">
                        Nível de risco
                    </div>
                </div>
                 --}}
                {{-- <div class="w-100">
                    <div class="buttons-3 plinko-difficulty d-flex">
                        <div data-plinko-difficulty="low" class="plinko-difficulty--item">Pequeno</div>
                        <div data-plinko-difficulty="medium" class="plinko-difficulty--item buttons-3-selected">Média</div>
                        <div data-plinko-difficulty="high" class="plinko-difficulty--item">Alto</div>
                    </div>
                </div> --}}

                <div class="col-xs-12" id="gamestext" style="display: none;">
                    <div class="b_label">
                        Número de jogos
                    </div>
                </div>
                <div class="col-xs-12 mb5 mt5"  id="gamesvalue" style="display: none;">
                    <div class="bombs_container">
                        <div data-games="15" class="bc_active">15</div>
                        <div data-games="25">25</div>
                        <div data-games="50">50</div>
                        <div data-games="240"><i class="far fa-infinity"></i></div>
                        <div id="change_games">
                            <span>{{ __('To change')}}</span>
                            <input data-number-input="true" class="bomb_input dn" value="5" placeholder="5-240">
                        </div>
                    </div>
                </div>
                 <div class="col-xs-12" id="gamesvictory" style="display: none;">
                    <div class="b_label">
                        {{ __('Stop in victory')}}
                    </div>
                </div>
                <div class="col-xs-12 mb5 mt5" id="gamesvictoryvalue" style="display: none;">
                <style>
                    .buttons-4 {
                            font-size: 0;
                        }
                        .buttons-4 div:first-child {
                            border-top-left-radius: 3px;
                            border-bottom-left-radius: 3px;
                        }
                        .buttons-4 div {
                            font-size: 15px;
                            display: inline-block;
                            width: 33.33%;
                             text-align: center;
                            padding: 6px;
                            transition: background .3s ease;
                            background: hsla(0,0%,100%,.1);
                            -webkit-user-select: none;
                            -moz-user-select: none;
                            -ms-user-select: none;
                            user-select: none;
                            cursor: pointer;
                        }
                        .buttons-4-selected {
                            background: #266fbd!important;
                        }
                </style>

                </div>
                {{-- <div class="col-xs-12 col-sm-12 mt5">
                    <div class="g_s g_btn plinko__play"  onclick="plinko()" id="play"><span id="bet_btn">Jogar</span></div>
                </div> --}}
                @include('pages.game_task', ['game_id' => 13])
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="players pc crash__players" style="max-height: 700px;">
            <div class="d-flex justify-content-between align-items-center mb-2 r-head">
                <div class="crash__player__title--username">{{ __('Player')}}</div>
                <div class="crash__player__title--multiplier">{{ __('Multiplier')}}</div>
                <div class="crash__player__title--bet">{{ __('Bet')}}</div>
            </div>
            <div class="r-body fw-monserrat bet_jogadores">
            </div>
        </div>
    </div>
</div>

@endsection
