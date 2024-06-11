

@extends('welcome')
@section('css')
    <style>
        #playCrash:disabled {
            cursor: not-allowed;
            background-color: #c9264a;
        }
    </style>
@endsection
@section('content')
<link rel="stylesheet" href="https://cdn.29bet.com/assets/css/games/game.css">
    <div class="row justify-content-center">
      <div class="col-12 col-md-7 col-lg-7 col-xl-7 col-dice">
        <div class="g_sidebar_footer p-0 mb-2 mt-2 mb-sm-4 mb-md-4 mb-lg-3 justify-content-lg-end">


            <div class="g_sidebar_footer_button" id="dice_music" data-music="on" onclick="setAudioGame(!isAudioGame)">
                <script>$(document).ready(function(){isAudioGame?($("#game_audio_on").fadeIn(0),$("#game_audio_off").fadeOut(0)):($("#game_audio_off").fadeIn(0),$("#game_audio_on").fadeOut(0))});</script>
                <div class="tooltip" id="game_audio_on" style="display:none" title="{{ __('Turn off sound')}}" >
                    <svg width="15" height="15" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12.0329 0.0666813C11.9226 0.0126507 11.7992 -0.00873414 11.6771 0.00504551C11.5551 0.0188252 11.4395 0.0671954 11.344 0.144459L5.0107 5.20001H1.99959C1.27737 5.20001 0.688477 5.7889 0.688477 6.51113V11.7111C0.688477 12.4333 1.27737 13.0111 1.99959 13.0111H5.02181L11.3551 18.0778C11.4506 18.1506 11.564 18.1963 11.6833 18.2099C11.8026 18.2236 11.9234 18.2048 12.0329 18.1556C12.2551 18.0445 12.3996 17.8222 12.3996 17.5667V0.65557C12.3997 0.532942 12.3653 0.41275 12.3005 0.308651C12.2357 0.204553 12.143 0.120721 12.0329 0.0666813Z" fill="currentColor"/>
                        <path d="M16.5227 5.87755C16.5227 5.35595 16.0998 4.93311 15.5782 4.93311C15.0566 4.93311 14.6338 5.35595 14.6338 5.87755V12.2664C14.6338 12.788 15.0566 13.2109 15.5782 13.2109C16.0998 13.2109 16.5227 12.788 16.5227 12.2664V5.87755Z" fill="currentColor"/>
                        <path d="M19.8889 3.94444C19.8889 3.42284 19.466 3 18.9444 3C18.4228 3 18 3.42284 18 3.94444V13.8778C18 14.3994 18.4228 14.8222 18.9444 14.8222C19.466 14.8222 19.8889 14.3994 19.8889 13.8778V3.94444Z" fill="currentColor"/>
                    </svg>
                </div>
                <div class="tooltip" id="game_audio_off" style="display:none" title="{{ __('Turn on the sound')}}">
                    <svg width="15" height="15" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M14.3259 1.67366C14.327 1.55859 14.2961 1.44549 14.2366 1.34698C14.1771 1.24847 14.0914 1.16842 13.9891 1.11576C13.8849 1.06328 13.7677 1.04229 13.6518 1.05538C13.5359 1.06847 13.4263 1.11506 13.3365 1.18945L7.87331 5.53682L14.3259 12V1.67366ZM17.8417 17.2526L1.8312 1.23155C1.77384 1.1735 1.7056 1.12731 1.63038 1.09562C1.55516 1.06393 1.47444 1.04737 1.39282 1.04689C1.22799 1.0459 1.06951 1.11043 0.952257 1.22629C0.835003 1.34215 0.768576 1.49984 0.767589 1.66467C0.766602 1.82951 0.831136 1.98798 0.946994 2.10524L4.82068 5.97892H4.46278C4.08384 5.97892 3.74699 6.15787 3.52594 6.43155C3.33647 6.64208 3.2312 6.91576 3.2312 7.22103V12.1473C3.2312 12.821 3.7891 13.3789 4.46278 13.3789H7.31541L13.3154 18.1684C13.4312 18.2526 13.568 18.3052 13.7049 18.3052C13.8696 18.3052 14.0276 18.2398 14.144 18.1233C14.2605 18.0069 14.3259 17.8489 14.3259 17.6842V15.4737L16.9575 18.1263C17.0734 18.2421 17.2305 18.3072 17.3944 18.3072C17.5582 18.3072 17.7153 18.2421 17.8312 18.1263C17.9471 18.0104 18.0122 17.8533 18.0122 17.6894C18.0122 17.5256 17.9471 17.3685 17.8312 17.2526H17.8417Z" fill="currentColor"/>
                    </svg>
                </div>
            </div>
        </div>
        <div id="d_container" class="g_c g_container gn_game gn_game--dice">

            {{-- <div class="outcome-window outcome-window_won outcome-window_centered shadow-blue game__win pyro ">
                <div class="game__win__images text-center">
                    <img class="game__win__images--tropheu" src="https://cdn.29bet.com/assets/img/tropheu.webp" alt="https://cdn.29bet.com/assets/img/tropheu.webp">
                    <img class="game__win__images--stars" src="https://cdn.29bet.com/assets/img/stars.webp" alt="https://cdn.29bet.com/assets/img/stars.webp">
                </div>
                <div class="before"></div>
                <div class="after"></div>
                <div class="game__win__text mt-4">
                    <p>{{ __('You won!')}}</p>
                </div>
                <div class="outcome-window__text outcome-window_won__text game__win--rs">R$
                    <span class="outcome-window_won-wrapper game__win--value">
                        <span class="outcome-window_won__sum" id="val" style="color: #ffd534">0</span>
                        <span class="myicon-coins" style="color: #ffd534"></span>
                    </span>
                </div>
            </div> --}}
            <div class="congrats">
                {{-- TODO CREATE A BREAK POINTS FOR ALL DEVICES ON OUTCOME WINDOW
                    -Mecky pogi --}}
                <div class="btn_outcome" id="confetti_proc"   href="javascript:void(0)"></div>
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

            {{-- <div class="outcome-window-lose outcome-window_centered shadow-blue game__lose">
                <div class="game__lose__images">
                    <img class="game__lose__images--stars" src="https://cdn.29bet.com/assets/img/stars.webp" alt="https://cdn.29bet.com/assets/img/stars.webp">
                    <img class="game__lose__images--tropheu" src="https://cdn.29bet.com/assets/img/tropheu-broken.webp" alt="https://cdn.29bet.com/assets/img/tropheu-broken.webp">
                </div>
                <div class="outcome-window_lose__coeff game__lose__description">{{ __('You lost!!')}}</div>
            </div> --}}
              {{-- lose OUtcome --}}
        <div class="YOU_LOSE">
            <DIV class="btn_outcome_lose " href="javascript:void(0)"></DIV>
            <div class="el ang-a_LOSE animated d-none" data-in="zoomOut"></div>
            <div class="el ang-b_LOSE animated d-none" data-in="zoomOut"></div>
            <div class="el glow_lose animated d-none"
                data-in="fadeIn"></div>
            <div class="el bg_lose bg-1_lose animated d-none"
                data-in="fadeIn" data-out="zoomOut"></div>
            <div class="el dots_LOSE animated d-none"> <i></i> <i></i> <i></i>
                <i></i> <i></i> <i></i> <i></i> <i></i> <i></i> <i></i>
                <i></i> <i></i> <i></i> <i></i> <i></i> <i></i> <i></i>
                <i></i> <i></i> <i></i> <i></i> <i></i> <i></i> <i></i>
                <i></i> <i></i> <i></i> <i></i> <i></i> <i></i> <i></i>
                <i></i> <i></i> <i></i> <i></i> <i></i> <i></i> <i></i>
                <i></i> <i></i> <i></i> <i></i> <i></i> <i></i> <i></i>
                <i></i> <i></i> <i></i> <i></i> <i></i></div>
            <div class="el bg_lose bg-2_lose animated d-none"
                data-in="zoomIn" data-out="bounceOut"></div>
            <div class="el ang-c_LOSE animated d-none" data-in="zoomOut"></div>
            <div class="el shine_LOSE animated d-none" data-in="shine_LOSE_In"
                data-out="fadeOut"></div>
            <div class="el text_LOSE animated d-none" data-in="zoomOutIn"
                data-out="zoomOutRight">{{ __('You lost!!')}}</div>
        </div>
        {{-- END OF LOSE OUTCOME SECTION --}}

            <div class="d_slider-border d_slider-top row mt15 dice__background dice__blue">
                <div class="col-6 col-md-5">
                    <input id="i_value" value="50" type="text" class="b_input_s mt5" data-number-input="true">
                    {{-- <div class="b_input_btns">
                        <div onclick="sw()" class="b_input_btn g_s"><i class="fa fa-exchange-alt"></i></div>
                    </div> --}}
                    <div class="b_label" id="sw_text">{{ __('Minus')}}</div>
                </div>
                <div class="col-md-2 d-lg-flex d-md-flex align-items-center justify-content-center d-none">
                    <div class="dice animation-dice" style="transform-style: preserve-3d;">
                        <ol class="die-list even-roll" data-roll="1" id="die-1">
                              <li class="die-item" data-side="1">
                                <span class="dot"></span>
                              </li>
                              <li class="die-item" data-side="2">
                                <span class="dot"></span>
                                <span class="dot"></span>
                              </li>
                              <li class="die-item" data-side="3">
                                <span class="dot"></span>
                                <span class="dot"></span>
                                <span class="dot"></span>
                              </li>
                              <li class="die-item" data-side="4">
                                <span class="dot"></span>
                                <span class="dot"></span>
                                <span class="dot"></span>
                                <span class="dot"></span>
                              </li>
                              <li class="die-item" data-side="5">
                                <span class="dot"></span>
                                <span class="dot"></span>
                                <span class="dot"></span>
                                <span class="dot"></span>
                                <span class="dot"></span>
                              </li>
                              <li class="die-item" data-side="6">
                                <span class="dot"></span>
                                <span class="dot"></span>
                                <span class="dot"></span>
                                <span class="dot"></span>
                                <span class="dot"></span>
                                <span class="dot"></span>
                              </li>
                        </ol>
                    </div>
                </div>
                <div class="col-6 col-md-5">
                    <input disabled id="i_chance" value="50%" type="text" class="b_input_s mt5" data-number-input="true">
                    <div class="b_label">{{ __('Chance')}}</div>
                </div>
            </div>
            {{-- <button type="button" id="roll-button">Roll Dice</button> --}}


            <div class="dice__options">
                <div class="dice__options__content d-lg-flex d-md-flex d-block">
                    <div class="dice__options__content__low d-none d-md-flex d-lg-flex">
                        <p>{{ __('SCROLL DOWN')}}</p>
                    </div>

                    <div class="w-100 d-flex justify-content-center dice__options__content__statistic">
                        <div class="dice__options__content__multiplier w-100">
                            <p class="dice__options__content__multiplier--title mb-1">{{ __('Multiplier')}}</p>
                            <p class="dice__options__content__multiplier--number">x1.96</p>
                        </div>
                        <div class="dice__options__content__chance w-100">
                            <p class="dice__options__content__chance--title mb-1">{{ __('Chance to win')}}</p>
                            <p class="dice__options__content__chance--porcent">50%</p>
                        </div>
                    </div>

                    <div class="d-flex gap-2 d-block d-lg-md-none d-md-none">
                        <div class="dice__options__content__high">
                            <p>{{ __('ROLL HIGH')}}</p>
                        </div>
                        <div class="dice__options__content__low">
                            <p>{{ __('SCROLL DOWN')}}</p>
                        </div>
                    </div>

                    <div class="dice__options__content__high d-none d-md-flex d-lg-flex">
                        <p>{{ __('ROLL HIGH')}}</p>
                    </div>
                </div>
            </div>


            <div class="d_slider d_slider-bottom p-0 mt-4">
                <style type="text/css">
                .ui-corner-all{background: #fa2f5c}
                .ui-button, .ui-state-default, .ui-widget-content .ui-state-default, .ui-widget-header .ui-state-default, html .ui-button.ui-state-disabled:active, html .ui-button.ui-state-disabled:hover
                {border: 1px solid #c5c5c5;background:#f6f6f6;font-weight:400;color:#ffffff}
                </style>
                    <div class="d_slider-border p-0">
                        <div id="slider-range"></div>
                    </div>
            </div>
        </div>
        <div class="sb_game">

            <div class="w-100 ">
                <div>
                    <div class="w-100">
                        <div class="general__control d-flex m-0">

                            <div class="general__control__box double__bet my-3" >
                                <div class="general__control__box__bets">
                                    <div class="general__control__box__values">
                                        <p class="general__control__box__values--min my-2" id="btMn">{{ __('Min')}}</p>
                                        <p class="general__control__box__values--max my-2" id="btMx">{{ __('Max')}}</p>
                                    </div>


                                    <label class="general__control__box__label" for="betAmountInput">
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

                            <button class="g_s general__control__box--play double__play my-3" id="play" onclick="dice()"><span id="bet_btn">{{ __('Play')}}</span></button>
                            <button class="g_s general__control__box--play double__play my-3" id="auto" style="display: none;"><span id="bet_btn_auto">{{ __('Play')}}</span></button>

                        </div>
                        @include('pages.game_task', ['game_id' => 1])
                    </div>
                </div>

            </div>

            <div class="my-3">
                <div class="col-12">
                    <div class="game-sidebar-tabs">
                        <div class="game-sidebar-tab active" onclick="setMode('default')" data-tab="default">{{ __('Manual')}}</div>
                        <div class="game-sidebar-tab" onclick="setMode('auto')" data-tab="auto">{{ __('Auto')}}</div>
                    </div>
                </div>
                <div>
                    <div class="position-relative w-100"  id="gamesvalue" style="display: none;">
                        <div class="b_label games__label">{{ __('Number of games')}}</div>
                        <div class="mb-3 position-relative">
                            <div class="bombs_container">
                                <div data-games="15" class="bc_active">15</div>
                                <div data-games="25">25</div>
                                <div data-games="50">50</div>
                                <div data-games="-1"><i class="far fa-infinity"></i></div>
                                <div id="change_games">
                                    <span>{{ __('To change')}}</span>
                                    <input data-number-input="true" class="bomb_input dn" value="15" placeholder="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="w-100" id="gamesvictory" style="display: none;">
                        <div class="b_label">
                            {{ __('Stop in victory')}}
                        </div>
                        <div class="col-xs-12 mb10 mt5" id="gamesvictoryvalue">
                            <div class="buttons-3">
                                <div data-victory="1" class="buttons-3-selected">{{ __('Yes')}}</div>
                                <div data-victory="-1" class="">{{ __('No')}}</div>
                                <div data-victory="5" class="">x5</div>
                                <input data-number-input="true" class="victory_input dn" value="1" placeholder="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
     </div>
     <div class="col-lg-4 col-12">
        <div class="players pc crash__players" style="max-height: 540px">
            <div class="d-flex justify-content-between align-items-center mb-2 r-head">
                <div class="crash__player__title--username">{{ __('Player')}}</div>
                <div class="crash__player__title--multiplier">{{ __('Multiplier')}}</div>
                <div class="crash__player__title--bet">{{ __('Bet')}}</div>
            </div>
            {{-- <div class="r-body jogadores">
            </div> --}}
            <div class="r-body fw-monserrat bet_jogadores">
            </div>
        </div>
    </div>
    </div>
@endsection
