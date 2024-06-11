@extends('welcome')

@section('css')
    <style>
        .roulette__ball::after {
            background: linear-gradient(3deg, #0d131c 0, rgba(5,5,6,0) 0%),linear-gradient(170deg, #0d131c 0%, rgb(5 5 6 / 0%) 50%),linear-gradient(0deg, rgb(13 19 28 / 0%) 0, #0d131c 75%);
            position: absolute;
            height: 120px;
            width: 100%;
            top: -3px;
            content: "";
            z-index: 1;
        }
        #play {
            padding: 27px;
            color: #fff;
            border-radius: 4px;
        }
        #play:hover {
            background-color: #c9264a;
        }
        #play.disabled {
            cursor: not-allowed;
            background-color: #c9264a;
        }
    </style>

@endsection
@section('content')

<div class="game__wrapper row justify-content-center">

    <div class="col-lg-7 col-12">

        <div class="g_sidebar_footer p-0 mb-1 mt-1 justify-content-lg-end" title="{{ __('Game information')}}">
            <div class="g_sidebar_footer_button tooltip" onclick="$('.md-result-instrution-roulette').toggleClass('md-show', true);">
                <svg width="15" height="15" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M10 1.25C5.16745 1.25 1.25 5.16745 1.25 10C1.25 14.8325 5.16745 18.75 10 18.75C14.8325 18.75 18.75 14.8325 18.75 10C18.75 5.16745 14.8325 1.25 10 1.25ZM10.2574 14.5791C10.093 14.7564 9.85964 14.845 9.55594 14.845C9.2526 14.845 9.01964 14.7585 8.8574 14.5854C8.69515 14.4121 8.61385 14.1698 8.61385 13.858C8.61385 13.2128 8.92776 12.8904 9.55594 12.8904C9.86365 12.8904 10.0984 12.9746 10.261 13.1435C10.4236 13.3123 10.5046 13.5504 10.5046 13.858C10.5046 14.1614 10.4218 14.4016 10.2574 14.5791ZM12.5426 8.32401C12.4485 8.57411 12.3064 8.81219 12.116 9.0386C11.9257 9.265 11.5983 9.55995 11.1328 9.92307C10.7354 10.2348 10.4692 10.4933 10.3347 10.6985C10.2209 10.8717 10.1586 11.0981 10.1411 11.3719C10.14 11.3778 10.1382 11.3796 10.1371 11.3854C10.0605 11.8167 9.55959 11.8138 9.55959 11.8138H9.29635C9.29635 11.8138 8.86067 11.7453 8.87709 11.4037C8.87709 10.9337 8.9624 10.5429 9.13339 10.2308C9.30437 9.9187 9.6037 9.5964 10.0306 9.26318C10.5392 8.8614 10.8666 8.54969 11.0139 8.32765C11.1612 8.10562 11.2352 7.84057 11.2352 7.53286C11.2352 7.17411 11.1156 6.89849 10.8765 6.70599C10.6373 6.51349 10.2931 6.4176 9.84469 6.4176C9.43854 6.4176 9.06265 6.47521 8.71666 6.59078C8.52781 6.65385 8.34224 6.72531 8.15813 6.80224C8.15411 6.8037 8.15265 6.80296 8.14828 6.80479C7.72318 6.96923 7.52594 6.6349 7.52594 6.6349L7.35896 6.28526C7.35896 6.28526 7.17084 5.85615 7.58865 5.66839C8.33349 5.32786 9.12135 5.15577 9.95334 5.15577C10.7904 5.15577 11.4551 5.36104 11.9462 5.7712C12.4372 6.18135 12.683 6.74755 12.683 7.46943C12.6834 7.78916 12.6362 8.07428 12.5426 8.32401Z" fill="currentColor"/>
                </svg>
            </div>

            <div class="g_sidebar_footer_button" id="roulette_music" data-music="on" onclick="setAudioGame(!isAudioGame)">
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

        <div id="w_container" class="w-100 position-relative">

{{--
            <div class="outcome-window outcome-window_won outcome-window_centered" style="margin-top: 20%;">
                <div class="outcome-window__coeff outcome-window_won__coeff">0</div>
                <div class="outcome-window__text outcome-window_won__text">Você ganhou
                    <span class="outcome-window_won-wrapper">
                        <span class="outcome-window_won__sum">0</span>
                        <span class="myicon-coins"></span>
                    </span>
                </div>
            </div> --}}
{{-- <div class="outcome-window-lose outcome-window_centered" style="margin-top: 20%;">
                <div class="outcome-window_lose__coeff">Você perdeu</div>
            </div> --}}



            <div class="roulette-result d-none" style="display: none">
                -1
            </div>


            <div class="roulette-graph-container roulette__ball">
                <div class="roulete__content">




        {{-- OUTCOME SECTION --}}
        {{-- WIN OUTCOME --}}
        <div class="congrats">
            {{-- TODO CREATE A BREAK POINTS FOR ALL DEVICES ON OUTCOME WINDOW
                -Mecky pogi --}}
            <div class="btn_outcome" id="confetti_proc"  href="javascript:void(0)"></div>
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
                    {{-- <div class="outcome-window__coeff outcome-window_won__coeff" id="mul" style="display: none;">x0</div> --}}
                    <div class="outcome-window__text outcome-window_won game__win--rs">R$
                        <span class="outcome-window_won-wrapper game__win--value">
                            <span class="outcome-window_won__sum" id="val" style="color: #ffd534">0</span>
                            <span class="myicon-coins" style="color: #ffd534"></span>
                        </span>
                    </div>
                </div>

            </div>
        </div>
        {{-- END OF WON SECTION OUTCOME --}}
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




                    {{-- <div class="outcome-window outcome-window_won outcome-window_centered shadow-blue game__win pyro " >
                        <div class="game__win__images text-center">
                            <img class="game__win__images--tropheu" src="https://cdn.29bet.com/assets/img/tropheu.webp" alt="https://cdn.29bet.com/assets/img/tropheu.webp">
                            <img class="game__win__images--stars" src="https://cdn.29bet.com/assets/img/stars.webp" alt="https://cdn.29bet.com/assets/img/stars.webp">
                        </div>
                        <div class="before"></div>
                        <div class="after"></div>
                        <div class="game__win__text mt-4">
                            <p>{{ __('You won!!')}}</p>
                        </div>

                        <div class="outcome-window__text outcome-window_won__text game__win--rs">R$
                            <span class="outcome-window_won-wrapper game__win--value">
                                <span class="outcome-window_won__sum" id="val" style="color: #ffd534">0</span>
                                <span class="myicon-coins" style="color: #ffd534"></span>
                            </span>
                        </div>
                    </div>


                    <div class="outcome-window-lose outcome-window_centered shadow-blue game__lose" >
                        <div class="game__lose__images">
                            <img class="game__lose__images--stars" src="https://cdn.29bet.com/assets/img/stars.webp" alt="https://cdn.29bet.com/assets/img/stars.webp">
                            <img class="game__lose__images--tropheu" src="https://cdn.29bet.com/assets/img/tropheu-broken.webp" alt="https://cdn.29bet.com/assets/img/tropheu-broken.webp">
                        </div>
                        <div class="outcome-window_lose__coeff game__lose__description">{{ __('You lost!!')}}</div>
                    </div> --}}


                    <div class="r-spinner" id="rouletteSpinner">
                        <div class="r-ball">
                            <span>
                                <svg class="roulette__spin" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" fill="currentColor">
                                    <path d="M73 39c-14.8-9.1-33.4-9.4-48.5-.9S0 62.6 0 80V432c0 17.4 9.4 33.4 24.5 41.9s33.7 8.1 48.5-.9L361 297c14.3-8.7 23-24.2 23-41s-8.7-32.2-23-41L73 39z"/>
                                </svg>
                            </span>
                        </div>
                        <div class="r-platebg"></div>
                        <div id="toppart" class="r-topnodebox">
                            <div class="r-silvernode"></div>
                            <div class="r-topnode r-silverbg"></div>
                            <span class="r-top r-silverbg"></span>
                            <span class="r-right r-silverbg"></span>
                            <span class="r-down r-silverbg"></span>
                            <span class="r-left r-silverbg"></span>
                        </div>

                        <div id="rcircle" class="r-pieContainer">
                            <div class="r-pieBackground"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="w-100 position-relative">
                {{-- <div class="b_label">
                    Selecione uma ficha
                </div> --}}
                <div class="token-container">
                    <div class="tokens w-100" style="max-width: 100%">
                        <div class="tc"><div class="token token-active" data-value="0.1">0.1</div></div>
                        <div class="tc"><div class="token" data-value="1">1</div></div>
                        <div class="tc"><div class="token" data-value="5">5</div></div>
                        <div class="tc"><div class="token" data-value="10">10</div></div>
                        <div class="tc"><div class="token" data-value="50">50</div></div>
                        <div class="tc"><div class="token" data-value="100">100</div></div>
                        <div class="tc"><div class="token" data-value="250">250</div></div>
                        <div class="tc"><div class="token" data-value="500">500</div></div>
                        <div class="tc"><div class="token" data-value="1000">1K</div></div>
                    </div>
                </div>
            </div>

            <div class="position-relative">
                <div class="roulette-container roulette__table">
                    <div class="roulette-header">
                        <div class="roulette-bet"><strong style="font-style: italic; font-weight: 700;">R$</strong>: <span id="token_bet">0.00 &nbsp;<i class="fad fa-coins"></i></span></div>
                        <div class="roulette-controls">
                            <div class="roulette-button roulette__actions" onclick="r_history_back();">
                                <span><i class="la la-angle-left"></i> {{ __('CANCEL')}}</span>
                            </div>
                            <div class="roulette-button roulette__actions" onclick="r_history_clear();">
                                <span><i class="la la-remove"></i>{{ __('TO CLEAN')}}</span>
                            </div>
                        </div>
                    </div>
                    <div class="roulette-game-container">
                        <div class="r-row-top">
                            <div class="r-row r-row-small roulette__greeen">
                                <div class="chip chip-green chip-huge" data-chip="0"><span>0</span></div>
                            </div>
                            <div class="r-row r-row-big">
                                <div class="chip chip-red" data-chip="3"><span>3</span></div>
                                <div class="chip chip-black" data-chip="6"><span>6</span></div>
                                <div class="chip chip-red" data-chip="9"><span>9</span></div>
                                <div class="chip chip-red" data-chip="12"><span>12</span></div>
                                <div class="chip chip-black" data-chip="15"><span>15</span></div>
                                <div class="chip chip-red" data-chip="18"><span>18</span></div>
                                <div class="chip chip-red" data-chip="21"><span>21</span></div>
                                <div class="chip chip-black" data-chip="24"><span>24</span></div>
                                <div class="chip chip-red" data-chip="27"><span>27</span></div>
                                <div class="chip chip-red" data-chip="30"><span>30</span></div>
                                <div class="chip chip-black" data-chip="33"><span>33</span></div>
                                <div class="chip chip-red" data-chip="36"><span>36</span></div>

                                <div class="chip chip-black" data-chip="2"><span>2</span></div>
                                <div class="chip chip-red" data-chip="5"><span>5</span></div>
                                <div class="chip chip-black" data-chip="8"><span>8</span></div>
                                <div class="chip chip-black" data-chip="11"><span>11</span></div>
                                <div class="chip chip-red" data-chip="14"><span>14</span></div>
                                <div class="chip chip-black" data-chip="17"><span>17</span></div>
                                <div class="chip chip-black" data-chip="20"><span>20</span></div>
                                <div class="chip chip-red" data-chip="23"><span>23</span></div>
                                <div class="chip chip-black" data-chip="26"><span>26</span></div>
                                <div class="chip chip-black" data-chip="29"><span>29</span></div>
                                <div class="chip chip-red" data-chip="32"><span>32</span></div>
                                <div class="chip chip-black" data-chip="35"><span>35</span></div>

                                <div class="chip chip-red" data-chip="1"><span>1</span></div>
                                <div class="chip chip-black" data-chip="4"><span>4</span></div>
                                <div class="chip chip-red" data-chip="7"><span>7</span></div>
                                <div class="chip chip-black" data-chip="10"><span>10</span></div>
                                <div class="chip chip-black" data-chip="13"><span>13</span></div>
                                <div class="chip chip-red" data-chip="16"><span>16</span></div>
                                <div class="chip chip-red" data-chip="19"><span>19</span></div>
                                <div class="chip chip-black" data-chip="22"><span>22</span></div>
                                <div class="chip chip-red" data-chip="25"><span>25</span></div>
                                <div class="chip chip-black" data-chip="28"><span>28</span></div>
                                <div class="chip chip-black" data-chip="31"><span>31</span></div>
                                <div class="chip chip-red" data-chip="34"><span>34</span></div>
                            </div>
                            <div class="r-row r-row-small">
                                <div class="chip chip-row roulette__selected--line" id="row1" data-chip="row1"><span>2:1</span></div>
                                <div class="chip chip-row roulette__selected--line" id="row2" data-chip="row2"><span>2:1</span></div>
                                <div class="chip chip-row roulette__selected--line" id="row3" data-chip="row3"><span>2:1</span></div>
                            </div>
                        </div>
                        <div class="mobile__roulette">
                            <div class="r-row r-row-small roulette__greeen__mobile">
                                <div class="chip chip-green chip-huge button__green__mobile" data-chip="0"><span class="roulette__green__mobile">0</span></div>
                            </div>
                        </div>
                        <div class="r-row-bottom roulette__others">
                            <div class="r-row r-row-small"></div>
                            <div class="r-row r-row-big roulette__size">
                                <div class="r-row-bottom-top">
                                    <div class="chip chip-row roulette__selected--block" id="1-12" data-chip="1-12"><span>1-12</span></div>
                                    <div class="chip chip-row roulette__selected--block" id="13-24" data-chip="13-24"><span>13-24</span></div>
                                    <div class="chip chip-row roulette__selected--block" id="25-36" data-chip="25-36"><span>25-36</span></div>
                                </div>
                                <div class="r-row-bottom-bottom">
                                    <div class="chip chip-row chip-fix roulette__controls--others" id="1-18" data-chip="1-18"><span>1-18</span></div>
                                    <div class="chip chip-row chip-fix roulette__controls--others" id="e" data-chip="even"><span>{{ __('even')}}</span></div>

                                    <div class="chip chip-red" id="red" data-chip="red"><span></span></div>
                                    <div class="chip chip-black" id="black" data-chip="black"><span></span></div>

                                    <div class="chip chip-row chip-fix roulette__controls--others" id="eo" data-chip="odd"><span>{{ __('odd')}}</span></div>
                                    <div class="chip chip-row chip-fix roulette__controls--others" id="19-36" data-chip="19-36"><span>19-36</span></div>
                                </div>
                            </div>
                            <div class="r-row r-row-small"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="w-100 my-2">
                <div class="g_s roulette__play" onclick="roulette()" id="play"><span id="bet_btn">{{ __('Play')}}</span></div>
            </div>

        </div>




    </div>
    <div class="col-lg-3">
        <div class="players pc crash__players" style="max-height: 830px">
            <div class="d-flex justify-content-around align-items-center mb-2 r-head">
                <div class="crash__player__title--username">{{ __('Player')}}</div>
                <div class="crash__player__title--bet">{{ __('Bet')}}</div>
            </div>
            <div class="r-body fw-monserrat bet_jogadores">
            </div>
        </div>
    </div>
</div>


<script>
    function applyResponsive() {
        var windowWidth = window.innerWidth;
        if (windowWidth > 990) {
            var newScale = 2.8;
        } else {
            var baseScale = 3.8;
            var baseWidth = 1024;

            var scaleFactor = windowWidth / baseWidth;

            var newScale = baseScale * scaleFactor;
        }
        var elemento = document.getElementById("rouletteSpinner");
        elemento.style.transform = "scale(" + newScale + ")";
    }

    applyResponsive();
    window.onresize = function() {
        applyResponsive();
    };

</script>
@endsection


