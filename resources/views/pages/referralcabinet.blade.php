@extends('welcome')

@section('css')
    <style>
        .dropdown__select select {
            background-image: url('https://cdn.29bet.com/assets/img/arrow.svg')
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="my-3">
                    <h3 class="referral__title">{{ __('Reference Program') }}</h3>
                </div>
                <div class="referral my-3 row">

                    <div class="referral__header col-lg-2 d-none d-lg-block d-md-block">
                        <div class="referral__tabs tab-list" id="fixedReferral">
                            <div class="my-tab referral__tabs__item active" data-tab-target="referralOverview">
                                <p>{{ __('Overview') }}</p>
                            </div>
                            <div class="my-tab referral__tabs__item" data-tab-target="referralDiscount">
                                <p>{{ __('Discount') }}</p>
                            </div>
                            <div class="my-tab referral__tabs__item" data-tab-target="referralStatistic">
                                <p>{{ __('Statistics') }}</p>
                            </div>
                            <div class="my-tab referral__tabs__item" data-tab-target="referralDetails">
                                <p>{{ __('Details') }}</p>
                            </div>
                            <div class="my-tab referral__tabs__item" data-tab-target="referralComission">
                                <p>{{ __('My commission') }}</p>
                            </div>
                            <div class="my-tab referral__tabs__item" data-tab-target="referralRecharge">
                                <p>{{ __('Recharge record') }}</p>
                            </div>
                            <div class="my-tab referral__tabs__item" data-tab-target="referralMembers">
                                <p>{{ __('Team members') }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="d-block d-md-none d-md-block p-0 w-100 my-3">
                        {{-- <div class="dropdown">
                            <div class="dropdown__select">
                                <select class="select--pix--input dropdown__referral" id="transactiondate_filter" name="transactiondate_filter" >
                                    <option value="1">Visão Geral</option>
                                    <option value="2">Desconto</option>
                                    <option value="3">Estastísticas</option>
                                    <option value="4">Detalhes</option>
                                    <option value="5">Dentro do ano</option>
                                </select>
                            </div>
                        </div> --}}

                        <div class="dropdown">
                            <div class="dropdown__select">
                                <ul class="dropdown__select__default w-100">
                                    <li>
                                        <div class="dropdown__select__default__option">
                                            <p>{{ __('Overview') }}</p>
                                        </div>
                                    </li>
                                </ul>
                                <ul class="dropdown__select__list">
                                    <li data-tab="#referralOverview">
                                        <div class="dropdown__select__list__option">
                                            <p>{{ __('Overview') }}</p>
                                        </div>
                                    </li>
                                    <li data-tab="#referralDiscount">
                                        <div class="dropdown__select__list__option">
                                            <p>{{ __('Discount') }}</p>
                                        </div>
                                    </li>
                                    <li data-tab="#referralStatistic">
                                        <div class="dropdown__select__list__option">
                                            <p>{{ __('Statistics') }}</p>
                                        </div>
                                    </li>
                                    <li data-tab="#referralDetails">
                                        <div class="dropdown__select__list__option">
                                            <p>{{ __('Details') }}</p>
                                        </div>
                                    </li>
                                    <li data-tab="#referralComission">
                                        <div class="dropdown__select__list__option">
                                            <p>{{ __('My commission') }}</p>
                                        </div>
                                    </li>
                                    <li data-tab="#referralRecharge">
                                        <div class="dropdown__select__list__option">
                                            <p>{{ __('Recharge record') }}</p>
                                        </div>
                                    </li>
                                    <li data-tab="#referralMembers">
                                        <div class="dropdown__select__list__option">
                                            <p>{{ __('Team members') }}</p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>

                    </div>




                    <div class="position-relative col-lg-10 p-0 px-lg-1">

                        <div class="my-tab-content tab__styled__referral position-relative" id="referralOverview">
                            <div class="referral__body">
                                <div>
                                    <div class="row h-100 referral__body__invite w-100 m-0">
                                        <div class="col-lg-2">
                                            <div class="referall__body__invite__type">
                                                {{-- <p>Afilliado -</p> --}}
                                            </div>
                                            <div class="referral__body__invite__image">
                                                <img src="https://cdn.29bet.com/assets/img/all/pages/referralcabinet/speaker.webp"
                                                    alt="https://cdn.29bet.com/assets/img/all/pages/referralcabinet/speaker.webp">
                                            </div>
                                        </div>
                                        <div class="col-lg-10 p-0">
                                            <!-- @if (!Auth::guest()) -->
                                                <div
                                                    class="referral__body__invite__info d-flex gap-3 align-items-center justify-content-around mb-4">
                                                    <div class="referral__body__invite__info__number">
                                                        <small>{{ __('Guest Users') }}</small>
                                                        <!-- <p>{{ empty($display_summary['guests']) ? 0 : $display_summary['guests'] }}
                                                        </p> -->
                                                        
                                                        <p id="TotalGuestUser"></p>
                                                    </div>
                                                    <div class="referral__body__invite__info__number">
                                                        <small>{{ __('Deposited Users') }}</small>
                                                        <!-- <p>{{ empty($display_summary['deposited_users']) ? 0 : $display_summary['deposited_users'] }}
                                                        </p> -->

                                                        <p id="TotalDepositUser"></p>
                                                    </div>
                                                    <div class="referral__body__invite__info__number">
                                                        <small>{{ __('Bonus Today') }}</small>
                                                        <!-- <p>{{ empty($display_summary['bonus_today']) ? 0 : $display_summary['bonus_today'] }}
                                                        </p> -->
                                                        
                                                        <p id="TotalBonusToday"></p>

                                                    </div>
                                                    <div class="referral__body__invite__info__number">
                                                        <small>{{ __('Bonus Yesterday') }}</small>
                                                        <!-- <p>{{ empty($display_summary['bonus_yesterday']) ? 0 : $display_summary['bonus_yesterday'] }}
                                                        </p> -->
                                                        
                                                        <p id="TotalBonusYesterday"></p>

                                                    </div>
                                                </div>
                                            <!-- @else
                                                <div
                                                    class="referral__body__invite__info d-flex gap-3 align-items-center justify-content-around mb-4">
                                                    <div class="referral__body__invite__info__number">
                                                        <small>{{ __('Guest Users') }}</small>
                                                        <p>0</p>
                                                    </div>
                                                    <div class="referral__body__invite__info__number">
                                                        <small>{{ __('Deposited Users') }}</small>
                                                        <p>0</p>
                                                    </div>
                                                    <div class="referral__body__invite__info__number">
                                                        <small>{{ __('Bonus Today') }}</small>
                                                        <p>0</p>
                                                    </div>
                                                    <div class="referral__body__invite__info__number">
                                                        <small>{{ __('Bonus Yesterday') }}</small>
                                                        <p>0</p>
                                                    </div>
                                                </div>
                                            @endif -->

                                            <div class="referral__body__invite__social d-md-flex align-items-center gap-3">
                                                <div class="referral__body__invite__social__number  w-100 max-auto gap-1">
                                                    <div class="my-2">
                                                        <div
                                                            class="referral__body__invite__social__number__text d-flex gap-2 align-items-center">
                                                            <h5>Link de convite</h5>
                                                            {{-- <span
                                                            class="referral__body__invite__social__number--badge">Padrão</span> --}}
                                                        </div>
                                                        <div class="referral__body__invite__social__number__copy">
                                                            <input type="text"
                                                                class="referral__body__invite__social__number__copy--input"
                                                                id="copyReferalLink"
                                                                value="{{ isset($referral_link) ? $referral_link : '' }}">
                                                            <button
                                                                class="referral__body__invite__social__number__copy--btn"
                                                                type="button" onclick="copyReferalLink()"><i
                                                                    class="fas fa-copy"></i></button>
                                                        </div>
                                                    </div>

                                                    <div class="my-2">
                                                        <div
                                                            class="referral__body__invite__social__number__text d-flex gap-2 align-items-center">
                                                            <h5>Codigo de convite</h5>
                                                            {{-- <span
                                                            class="referral__body__invite__social__number--badge">Padrão</span> --}}
                                                        </div>
                                                        <div class="referral__body__invite__social__number__copy">
                                                            <input type="text"
                                                                class="referral__body__invite__social__number__copy--input"
                                                                id="copyReferalcode"
                                                                value="{{ isset($referral_no) ? $referral_no : '' }}">
                                                            <button
                                                                class="referral__body__invite__social__number__copy--btn"
                                                                type="button" onclick="copyReferalcode()"><i
                                                                    class="fas fa-copy"></i></button>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="referral__body__invite__social__number w-100">
                                                    <div class="banner__flu">
                                                        <div class="banner__flu--ico"><img
                                                                src="https://cdn.29bet.com/assets/img/all/pages/referralcabinet/cash.webp"
                                                                alt="https://cdn.29bet.com/assets/img/all/pages/referralcabinet/cash.webp"></div>
                                                        <div class="row banner__flu00">
                                                            <div class="banner__flu--confete animation-top"><img
                                                                    src="https://cdn.29bet.com/assets/img/all/pages/referralcabinet/confete.webp"
                                                                    alt="https://cdn.29bet.com/assets/img/all/pages/referralcabinet/confete.webp"></div>
                                                            <div class="col-md-8 banner__flu--txt">
                                                                {{ __('Total gain') }}<br> {{ __('This month:') }}
                                                                R$<span> 44,43</span></div>
                                                            <div class="col-md-4 banner__flu--btn"><a
                                                                    class="bannerbtn bannerbtn-white bannerbtn-animate"
                                                                    href="">{{ __('My account') }}</a></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="referral__awards mt-4">
                                        <div class="referral__body__invite__about">
                                            <h3 class="my-5 text-center referral__body__invite__about--title">
                                                {{ __('AWARDS ISSUED SO FAR') }}</h3>
                                            <div class="row row-cols-lg-3 row-cols-md-1 row-cols-1">

                                                <div class="col">
                                                    <div class="referral__awards__card cdd d-flex gap-2 align-items-center"
                                                        style="background-image: url('https://cdn.29bet.com/assets/img/all/pages/referralcabinet/awards2.webp')">
                                                        <img src="#" alt="">
                                                        <div class="referral__awards__card__text">
                                                            <h5 class="referral__awards__card__text--bonus">
                                                                {{ __('Invitation Bonus') }}
                                                            </h5>
                                                            <h3 class="referral__awards__card__text--money">R$
                                                                13.363.678,00
                                                            </h3>
                                                            <h6 class="referral__awards__card__text-others">
                                                                {{ __('Number of people who received') }} 222948</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="referral__awards__card d-flex gap-2 align-items-center"
                                                        style="background-image: url('https://cdn.29bet.com/assets/img/all/pages/referralcabinet/awards3.webp')">
                                                        <img src="#" alt="">
                                                        <div class="referral__awards__card__text">
                                                            <h5 class="referral__awards__card__text--bonus">
                                                                {{ __('Achievement Reward') }}</h5>
                                                            <h3 class="referral__awards__card__text--money">R$ 3.213.552,00
                                                            </h3>
                                                            <h6 class="referral__awards__card__text-others">
                                                                {{ __('Number of people who received') }} 324265</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="referral__awards__card d-flex gap-2 align-items-center"
                                                        style="background-image: url('https://cdn.29bet.com/assets/img/all/pages/referralcabinet/awards-1.webp')">
                                                        <img src="#" alt="">
                                                        <div class="referral__awards__card__text">
                                                            <h5 class="referral__awards__card__text--bonus">
                                                                {{ __('Bet Refund') }}</h5>
                                                            <h3 class="referral__awards__card__text--money">R$ 47.605,69
                                                            </h3>
                                                            <h6 class="referral__awards__card__text-others">
                                                                {{ __('Number of people who received') }} 222948</h6>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="referral__bonus">
                                        <h3 class="referral__bonus--title my-5">
                                            {{ __('HOW DOES THE INVITATION BONUS WORK?') }}</h3>
                                        <div class="referral__bonus__background">
                                            <div class="referral__bonus__background__proposal">
                                                <h3 class="referral__bonus__background__proposal--title">
                                                    {{ __('Affiliate deposit refund') }}</h3>
                                                <p class="referral__bonus__background__proposal--description">
                                                    {{ __('Each user who makes a deposit can receive at least') }} <strong
                                                        class="color-primary">R$ 18,00</strong> <br>

                                                </p>
                                                <img src="https://cdn.29bet.com/assets/img/all/pages/sports/moedas2.webp"
                                                    alt="https://cdn.29bet.com/assets/img/all/pages/sports/moedas2.webp">
                                            </div>
                                            <div class="referral__bonus__background__special">
                                                <div class="referral__bonus__background__special__ofert">
                                                    <div class="referral__bonus__background__special__ofert__label">
                                                        <h4>{{ __('SPECIAL OFFER') }}</h4>
                                                    </div>
                                                    <div class="referral__bonus__background__special__ofert__porcentage">
                                                        <img src="https://cdn.29bet.com/assets/img/all/pages/sports/presente.webp"
                                                            alt="https://cdn.29bet.com/assets/img/all/pages/sports/presente.webp">
                                                    </div>
                                                </div>
                                                <div class="referral__bonus__background__special__text">
                                                    <p>{{ __('First 2 months from registration date') }}</p>
                                                    <h5>{{ __('RevShare') }} 50%</h5>
                                                </div>
                                                {{-- <div class="referral__bonus__background__special__invite">
                                                    <button>Lorem ipsum dolor sit amet</button>
                                                </div> --}}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="referral__indication mt-5">
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="referral__indication__text">
                                                    <h3 class="mb-4">{{ __('HOW TO GET COMMISSION ON YOUR BETS') }}</h3>
                                                    <p class="mt-2 mb-3">
                                                        {{ __('Take advantage of the amazing 29bet affiliate program bonuses!') }}
                                                        <br>
                                                        <br>
                                                        {{ __('Have you ever imagined earning incredible bonuses simply by inviting your friends to join the 29bet betting platform? Well now this is possible! We are pleased to introduce our unique guest user bonus chart, where the more depositor guests you bring, the bigger your bonus!') }}
                                                        <br>
                                                        <br>
                                                        {{ __("Let's take off together towards big bonuses and unlimited fun at 29bet!") }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-lg-8">
                                                <div class="referral__indication__payment d-flex gap-lg-3 gap-2 ">
                                                    @foreach($agent_referral_lists as $index => $list)
                                                        
                                                        <div class="referral__indication__payment__bar">
                                                        <div
                                                            class="referral__indication__payment__bar__found bg-porcent-{{ $index + 1}}">
                                                            <div
                                                                class="referral__indication__payment__bar__found--number-invitation">
                                                                <h3>{{ $list->referral_count}}</h3>
                                                            </div>
                                                            <div
                                                                class="referral__indication__payment__bar__found--recive-invitation">
                                                                <p>R$ {{ $list->reward_value}}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                         
                                                    @endforeach
                                                    
                                                    <!-- <div class="referral__indication__payment__bar">
                                                        <div
                                                            class="referral__indication__payment__bar__found bg-porcent-2">
                                                            <div
                                                                class="referral__indication__payment__bar__found--number-invitation">
                                                                <h3>10</h3>
                                                            </div>
                                                            <div
                                                                class="referral__indication__payment__bar__found--recive-invitation">
                                                                <p>R$ 40,00</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="referral__indication__payment__bar">
                                                        <div
                                                            class="referral__indication__payment__bar__found bg-porcent-3">
                                                            <div
                                                                class="referral__indication__payment__bar__found--number-invitation">
                                                                <h3>20</h3>
                                                            </div>
                                                            <div
                                                                class="referral__indication__payment__bar__found--recive-invitation">
                                                                <p>R$ 60,00</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="referral__indication__payment__bar">
                                                        <div
                                                            class="referral__indication__payment__bar__found bg-porcent-4">
                                                            <div
                                                                class="referral__indication__payment__bar__found--number-invitation">
                                                                <h3>40</h3>
                                                            </div>
                                                            <div
                                                                class="referral__indication__payment__bar__found--recive-invitation">
                                                                <p>R$ 100,00</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="referral__indication__payment__bar">
                                                        <div
                                                            class="referral__indication__payment__bar__found bg-porcent-5">
                                                            <div
                                                                class="referral__indication__payment__bar__found--number-invitation">
                                                                <h3>80</h3>
                                                            </div>
                                                            <div
                                                                class="referral__indication__payment__bar__found--recive-invitation">
                                                                <p>R$ 10,00</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="referral__indication__payment__bar">
                                                        <div
                                                            class="referral__indication__payment__bar__found bg-porcent-6">
                                                            <div
                                                                class="referral__indication__payment__bar__found--number-invitation">
                                                                <h3>100</h3>
                                                            </div>
                                                            <div
                                                                class="referral__indication__payment__bar__found--recive-invitation">
                                                                <p>R$ 260,00</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="referral__indication__payment__bar">
                                                        <div
                                                            class="referral__indication__payment__bar__found bg-porcent-7">
                                                            <div
                                                                class="referral__indication__payment__bar__found--number-invitation">
                                                                <h3>200</h3>
                                                            </div>
                                                            <div
                                                                class="referral__indication__payment__bar__found--recive-invitation">
                                                                <p>R$ 500,00</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="referral__indication__payment__bar">
                                                        <div
                                                            class="referral__indication__payment__bar__found bg-porcent-8">
                                                            <div
                                                                class="referral__indication__payment__bar__found--number-invitation">
                                                                <h3>500</h3>
                                                            </div>
                                                            <div
                                                                class="referral__indication__payment__bar__found--recive-invitation">
                                                                <p>R$ 1.300,00</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="referral__indication__payment__bar">
                                                        <div
                                                            class="referral__indication__payment__bar__found bg-porcent-9">
                                                            <div
                                                                class="referral__indication__payment__bar__found--number-invitation">
                                                                <h3>1000</h3>
                                                            </div>
                                                            <div
                                                                class="referral__indication__payment__bar__found--recive-invitation">
                                                                <p>R$ 3.000,00</p>
                                                            </div>
                                                        </div>
                                                    </div> -->
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-12">
                                                <div class="referral__indication__card">

                                                    <div class="referral__indication__card__ofert">
                                                        <div class="referral__indication__card__ofert__label">
                                                            <h4 class="mb-3">{{ __('What are you waiting for?') }}</h4>
                                                            <p class="mb-3">
                                                                {{ __("Don't waste time, start inviting your friends to join the 29bet family right now.") }}
                                                            </p> <br>
                                                            <button>Lorem ipsum dolor sit amet</button>
                                                        </div>
                                                        <img class="referral__indication__card__ofert--money1"
                                                            src="https://cdn.29bet.com/assets/img/all/pages/sports/moedas2.webp"
                                                            alt="https://cdn.29bet.com/assets/img/all/pages/sports/moedas2.webp">
                                                        <img class="referral__indication__card__ofert--money2"
                                                            src="https://cdn.29bet.com/assets/img/all/pages/sports/moedas1.webp"
                                                            alt="https://cdn.29bet.com/assets/img/all/pages/sports/moedas1.webp">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="referral__explication my-5">
                                        <div class="referral__explication__title">
                                            <h3 class="referral__explication__title--h3 mb-2">
                                                {{ __('HOW TO GET COMMISSION ON YOUR BETS') }}</h3>
                                            <p class="referral__explication__title--p text-center">
                                                {{ __('This will be your long-term income and you will receive a different percentage of commission <br> each time a player you invite places a bet.') }}
                                            </p>
                                        </div>

                                        <div class="referral__explication__earnings">
                                            <div class="referral__explication__earnings__amount mb-3">
                                                <p class="mb-2">{{ __('Amount to be earned at the end of the month:') }}
                                                </p>
                                                <h4>R$: <span id="valor-ganho">0</span></h4>
                                            </div>
                                            <div class="referral__explication__earnings__invitate-number">
                                                <input type="range" id="num-depositantes"
                                                    class="referral__explication__earnings__invitate-number--range"
                                                    min="0" max="100" value="0">
                                                <div class="result mt-2">
                                                    <h5>{{ __('Number of guests:') }} <span
                                                            id="contador-convidados">0</span></span></h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="referral__demonstration d-sm-flex align-items-center">
                                        <div class="referral__demonstration__text">
                                            <h5 class="mb-3">
                                                {{ __("Bonus rules: All players invited by the 'recommender' will receive a platform advantage bonus proportional to each bet.") }}
                                            </h5>

                                            <div>
                                                <p class="mb-2">{{ __('') }}</p>
                                                <ul>
                                                    @foreach($agent_level_commission as $level)
                                                   

                                                    <li>{{ __('Level ' . $level->agent_level . ': Get a ' . $level->proportion . '% platform advantage') }}</li>

                                              
                                                    @endforeach
                                                </ul>
                                            </div>

                                        </div>
                                        <div class="referral__demonstration__image my-3">
                                            <img src="https://cdn.29bet.com/assets/img/all/pages/referralcabinet/ranking.webp"
                                                alt="https://cdn.29bet.com/assets/img/all/pages/referralcabinet/ranking.webp">
                                        </div>
                                    </div>

                                    <div class="referral__socials d-sm-flex align-items-center gap-3 mt-5">
                                        <div class="referral__socials__image my-3">
                                            <img class="w-100"
                                                src="https://cdn.29bet.com/assets/img/all/pages/referralcabinet/emojis.webp"
                                                alt="https://cdn.29bet.com/assets/img/all/pages/referralcabinet/emojis.web">
                                        </div>
                                        <div class="referral__socials__text">
                                            <p>
                                                {{ __('Are you a blogger with a large audience and large following? We offer you a partnership program with a special referral bonus. <br><br> Contact our manager to discuss terms') }}
                                                <br>
                                                <br>
                                                <a class="mb-1"
                                                    href="#">https://wa.me/message/3E5IOHH5J2BsdsCL1</a>
                                                <br>
                                                <br>
                                                {{ __('Important: Only users who have passed the requirements and been approved by their manager can participate in the program.') }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="my-tab-content tab__styled__referral position-relative" id="referralDiscount">

                            <div class="referral__discount">
                                <div class="referral__discount__banner">
                                    <div>
                                        <h3 class="referral__discount__banner--title mb-3">
                                            {{ __('Daily invites to challenge bonuses') }}</h3>
                                        <p class="referral__discount__banner--description">
                                            {{ __('Achievement rewards reset at 00:00 every day and are <br>claimable every day. The more depositors you invite, the bigger your bonus up to 3000') }}
                                        </p>
                                    </div>
                                    <img src="https://cdn.29bet.com/assets/img/all/pages/referralcabinet/money-discount.webp"
                                        alt="https://cdn.29bet.com/assets/img/all/pages/referralcabinet/money-discount.webp" class="referral__discount__banner--img">
                                </div>
                                @if (!Auth::guest())
                                    {{-- return the code --}}
                                    @foreach ($rewards as $reward => $r)
                                        @php
                                            $url = 'https://cdn.29bet.com/assets/img/all/pages/referralcabinet/reward'.$reward.'.webp';   
                                        @endphp
                                        <div
                                            class="referral__discount__ranking d-flex justify-content-between align-items-center my-4 gap-3">
                                            <div class="referral__discount__ranking__image">
                                                <img src="{{ $url }}" alt="{{ $url }}">
                                            </div>
                                            <div class="referral__discount__ranking__progress">
                                                <div
                                                    class="referral__discount__ranking__progress__quantity align-items-center mb-2">
                                                    <div class="slider__bonus--titulo">{{ $r->description }}</div>
                                                    <h4 class="referral__discount__ranking__progress__quantity--complet">
                                                        {{ $r->person_count }}/ <span>{{ $r->referral_count }}</span></h4>
                                                </div>
                                                <div class="referral__discount__ranking__progress__task">
                                                    {{-- <input type="range" id="taskRange"
                                                        class="referral__discount__ranking__progress__task--range"
                                                        min="{{ $r['progress'] }}" max="100" value=""> --}}

                                                    <div class="referral__discount__ranking__progress__task__line">
                                                        <div class="referral__discount__ranking__progress__task__line--progress"
                                                            style="width:  {{ $r->progress }}%;"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            @if ($r->status == 1)
                                                <div class="referral__discount__ranking__receive">
                                                    <h5 class="referral__discount__ranking__receive--amount mb-2">R$
                                                        {{ $r->reward_value }}</h5>
                                                    <button id="btn-claim-reward-{{ $r->id }}"
                                                        name="btn-claim-reward-{{ $r->id }}"
                                                        class="btn-claim referral__discount__ranking__receive--button"
                                                        style="background: linear-gradient(1turn, #202a39 .8%, #202a39);
                                                    box-shadow: 0 3px 16px rgb(50 59 73 / 74%), inset 0 4px 3px hsla(0,0%,100%,.3);"
                                                        disabled>{{ __('Claimed Reward') }}</button>
                                                </div>
                                            @elseif ($r->status == 0 && $r->person_count == $r->referral_count)
                                                <div class="referral__discount__ranking__receive">
                                                    <h5 class="referral__discount__ranking__receive--amount mb-2">R$
                                                        {{ $r->reward_value }}</h5>
                                                    <button id="btn-claim-reward-{{ $r->id }}"
                                                        name="btn-claim-reward-{{ $r->id }}"
                                                        class="btn-claim referral__discount__ranking__receive--button">{{ __('Claim Reward') }}</button>
                                                </div>
                                            @elseif ($r->status == 0 && $r->person_count != $r->referral_count)
                                                <div class="referral__discount__ranking__receive">
                                                    <h5 class="referral__discount__ranking__receive--amount mb-2">R$
                                                        {{ $r->reward_value }}</h5>
                                                    <button id="btn-claim-reward-{{ $r->id }}"
                                                        name="btn-claim-reward-{{ $r->id }}"
                                                        class="btn-claim referral__discount__ranking__receive--button"
                                                        style="background: linear-gradient(1turn, #202a39 .8%, #202a39);
                                                    box-shadow: 0 3px 16px rgb(50 59 73 / 74%), inset 0 4px 3px hsla(0,0%,100%,.3);"
                                                        disabled>{{ __('Not Available') }}</button>
                                                </div>
                                            @else
                                                <div class="referral__discount__ranking__receive">
                                                    <h5 class="referral__discount__ranking__receive--amount mb-2">R$
                                                        {{ $r->reward_value }}</h5>
                                                    <button id="btn-claim-reward-{{ $r->id }}"
                                                        name="btn-claim-reward-{{ $r->id }}"
                                                        class="btn-claim referral__discount__ranking__receive--button">{{ __('Claim Reward') }}</button>
                                                </div>
                                            @endif
                                            <img class="referral__discount__ranking__money"
                                                src="https://cdn.29bet.com/assets/img/all/pages/sports/moedas2.webp" alt="https://cdn.29bet.com/assets/img/all/pages/sports/moedas2.webp">
                                        </div>
                                    @endforeach
                                @else
                                    <div
                                        class="referral__discount__ranking d-flex justify-content-between align-items-center my-4 gap-3">
                                        <div class="referral__discount__ranking__image">
                                            <img src="https://cdn.29bet.com/assets/img/all/pages/referralcabinet/estrela-prata1.webp"
                                                alt="https://cdn.29bet.com/assets/img/all/pages/referralcabinet/estrela-prata1.webp">
                                        </div>
                                        <div class="referral__discount__ranking__progress">
                                            <div
                                                class="referral__discount__ranking__progress__quantity align-items-center mb-2">
                                                <div class="slider__bonus--titulo">Realização do agente 1000</div>
                                                <h4 class="referral__discount__ranking__progress__quantity--complet">0 /
                                                    <span>200</span>
                                                </h4>
                                            </div>
                                            <div class="referral__discount__ranking__progress__task">
                                                <input type="range" id="taskRange"
                                                    class="referral__discount__ranking__progress__task--range"
                                                    min="0" max="100" value="0">
                                            </div>
                                        </div>
                                        <div class="referral__discount__ranking__receive">
                                            <h5 class="referral__discount__ranking__receive--amount mb-2">R$ 3.000</h5>
                                            <button class="referral__discount__ranking__receive--button">Receber</button>
                                        </div>

                                        <img class="referral__discount__ranking__money"
                                            src="https://cdn.29bet.com/assets/img/all/pages/sports/moedas2.webp" alt="https://cdn.29bet.com/assets/img/all/pages/sports/moedas2.webp">
                                    </div>
                                @endif

                            </div>

                        </div>
                        <div class="my-tab-content  tab__styled__referral  position-relative" id="referralStatistic">
                            <div class="referral__statistic">
                                <div class="referral__statistic__profit">
                                    <div class="referral__statistic__profit__today">
                                        {{-- <h3 class="referral__statistic__profit__today--title mb-4">Lucro de hoje</h3> --}}
                                        <div class="referral__statistic__profit__today__card">
                                            <div
                                                class="referral__statistic__profit__today__card__numbers d-flex flex-wrap align-items-center gap-3 justify-content-around">
                                                <div class="my-3">
                                                    <h5>R$: 0,00</h5>
                                                    <p>{{ __('Bet Refund') }}</p>
                                                </div>
                                                <div class="my-3">
                                                    <h5>R$: 0,00</h5>
                                                    <p>{{ __('Deposit Refund') }}</p>
                                                </div>
                                                <div class="my-3">
                                                    <h5>R$: 0,00</h5>
                                                    <p>{{ __('Achievement Reward') }}</p>
                                                </div>
                                            </div>
                                            <div
                                                class="referral__statistic__profit__today__card__info d-sm-flex align-items-center gap-3">
                                                <div class="referral__statistic__profit__today__card__info__amount w-100 text-center">
                                                    <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI3NSUiIHZpZXdCb3g9Ii0yNSAtMjUgNDAwIDQwMCI+CiAgICA8Y2lyY2xlIGN4PSIxNzUiIGN5PSIxNzUiIHI9IjEzMCIgc3R5bGU9ImZpbGw6IHJnYigyOCwgMzcsIDUwKSI+PC9jaXJjbGU+CiAgICA8cmVjdCB4PSI4MCIgeT0iMTQ1IiB3aWR0aD0iMzAiIGhlaWdodD0iMjUiIGZpbGw9IiMwMDc4RkYiPjwvcmVjdD4KICAgIDxyZWN0IHg9IjgwIiB5PSIxODUiIHdpZHRoPSIzMCIgaGVpZ2h0PSIyNSIgZmlsbD0iIzAwNTVlMiI+PC9yZWN0PgogICAgPHJlY3QgeD0iODAiIHk9IjIyNSIgd2lkdGg9IjMwIiBoZWlnaHQ9IjI1IiBmaWxsPSIjRkZCMTIxIj48L3JlY3Q+CiAgICA8dGV4dCBmaWxsPSIjZmZmIiB4PSIxMTgiIHk9IjE2MiIgZHg9IjAiIHRleHQtYW5jaG9yPSJzdGFydCIgc3R5bGU9ImZvbnQ6IDEuMnJlbSBIZWx2ZXRpY2EsIEFyaWFsLCBzYW5zLXNlcmlmIj5SZWNoYXJnZSBSZWJhdGU8L3RleHQ+CiAgICA8dGV4dCBmaWxsPSIjZmZmIiB4PSIxMTgiIHk9IjIwNSIgZHg9IjAiIHRleHQtYW5jaG9yPSJzdGFydCIgc3R5bGU9ImZvbnQ6IDEuMnJlbSBIZWx2ZXRpY2EsIEFyaWFsLCBzYW5zLXNlcmlmIj5CZXR0aW5nIFJlYmF0ZXM8L3RleHQ+CiAgICA8dGV4dCBmaWxsPSIjZmZmIiB4PSIxMTgiIHk9IjI0NSIgZHg9IjAiIHRleHQtYW5jaG9yPSJzdGFydCIgc3R5bGU9ImZvbnQ6IDEuMnJlbSBIZWx2ZXRpY2EsIEFyaWFsLCBzYW5zLXNlcmlmIj5BY2hpZXZlbWVudCBCb251czwvdGV4dD4KICAgIDxjaXJjbGUgc3Ryb2tlPSIjRkZGIiBjeD0iMTc1IiBjeT0iMTc1IiByPSIxNzUiIHN0cm9rZS13aWR0aD0iNTAiIGZpbGw9Im5vbmUiIHN0cm9rZS1kYXNoYXJyYXk9IjExMDBweCI+PC9jaXJjbGU+CiAgICA8Y2lyY2xlIGN4PSIxNzUiIGN5PSIxNzUiIHI9IjE3NSIgc3Ryb2tlPSIjMDA3OEZGIiB0cmFuc2Zvcm09InJvdGF0ZSgtOTAgMTc1IDE3NSkiIHN0cm9rZS13aWR0aD0iNTAiIGZpbGw9Im5vbmUiIHN0cm9rZS1kYXNoYXJyYXk9IjM2NywgMTEwMCI+PC9jaXJjbGU+CiAgICA8Y2lyY2xlIGN4PSIxNzUiIGN5PSIxNzUiIHI9IjE3NSIgc3Ryb2tlPSIjMDA1NWUyIiB0cmFuc2Zvcm09InJvdGF0ZSgtOTAgMTc1IDE3NSkiIHN0cm9rZS13aWR0aD0iNTAiIGZpbGw9Im5vbmUiIHN0cm9rZS1kYXNoYXJyYXk9IjM2NywgMTEwMCIgc3Ryb2tlLWRhc2hvZmZzZXQ9Ii0zNjciPjwvY2lyY2xlPgogICAgPGNpcmNsZSBjeD0iMTc1IiBjeT0iMTc1IiByPSIxNzUiIHN0cm9rZT0iI0ZGQjEyMSIgdHJhbnNmb3JtPSJyb3RhdGUoLTkwIDE3NSAxNzUpIiBzdHJva2Utd2lkdGg9IjUwIiBmaWxsPSJub25lIiBzdHJva2UtZGFzaGFycmF5PSIzNjcsIDExMDAiIHN0cm9rZS1kYXNob2Zmc2V0PSItNzM0Ij48L2NpcmNsZT4KPC9zdmc+Cg==" alt="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI3NSUiIHZpZXdCb3g9Ii0yNSAtMjUgNDAwIDQwMCI+CiAgICA8Y2lyY2xlIGN4PSIxNzUiIGN5PSIxNzUiIHI9IjEzMCIgc3R5bGU9ImZpbGw6IHJnYigyOCwgMzcsIDUwKSI+PC9jaXJjbGU+CiAgICA8cmVjdCB4PSI4MCIgeT0iMTQ1IiB3aWR0aD0iMzAiIGhlaWdodD0iMjUiIGZpbGw9IiMwMDc4RkYiPjwvcmVjdD4KICAgIDxyZWN0IHg9IjgwIiB5PSIxODUiIHdpZHRoPSIzMCIgaGVpZ2h0PSIyNSIgZmlsbD0iIzAwNTVlMiI+PC9yZWN0PgogICAgPHJlY3QgeD0iODAiIHk9IjIyNSIgd2lkdGg9IjMwIiBoZWlnaHQ9IjI1IiBmaWxsPSIjRkZCMTIxIj48L3JlY3Q+CiAgICA8dGV4dCBmaWxsPSIjZmZmIiB4PSIxMTgiIHk9IjE2MiIgZHg9IjAiIHRleHQtYW5jaG9yPSJzdGFydCIgc3R5bGU9ImZvbnQ6IDEuMnJlbSBIZWx2ZXRpY2EsIEFyaWFsLCBzYW5zLXNlcmlmIj5SZWNoYXJnZSBSZWJhdGU8L3RleHQ+CiAgICA8dGV4dCBmaWxsPSIjZmZmIiB4PSIxMTgiIHk9IjIwNSIgZHg9IjAiIHRleHQtYW5jaG9yPSJzdGFydCIgc3R5bGU9ImZvbnQ6IDEuMnJlbSBIZWx2ZXRpY2EsIEFyaWFsLCBzYW5zLXNlcmlmIj5CZXR0aW5nIFJlYmF0ZXM8L3RleHQ+CiAgICA8dGV4dCBmaWxsPSIjZmZmIiB4PSIxMTgiIHk9IjI0NSIgZHg9IjAiIHRleHQtYW5jaG9yPSJzdGFydCIgc3R5bGU9ImZvbnQ6IDEuMnJlbSBIZWx2ZXRpY2EsIEFyaWFsLCBzYW5zLXNlcmlmIj5BY2hpZXZlbWVudCBCb251czwvdGV4dD4KICAgIDxjaXJjbGUgc3Ryb2tlPSIjRkZGIiBjeD0iMTc1IiBjeT0iMTc1IiByPSIxNzUiIHN0cm9rZS13aWR0aD0iNTAiIGZpbGw9Im5vbmUiIHN0cm9rZS1kYXNoYXJyYXk9IjExMDBweCI+PC9jaXJjbGU+CiAgICA8Y2lyY2xlIGN4PSIxNzUiIGN5PSIxNzUiIHI9IjE3NSIgc3Ryb2tlPSIjMDA3OEZGIiB0cmFuc2Zvcm09InJvdGF0ZSgtOTAgMTc1IDE3NSkiIHN0cm9rZS13aWR0aD0iNTAiIGZpbGw9Im5vbmUiIHN0cm9rZS1kYXNoYXJyYXk9IjM2NywgMTEwMCI+PC9jaXJjbGU+CiAgICA8Y2lyY2xlIGN4PSIxNzUiIGN5PSIxNzUiIHI9IjE3NSIgc3Ryb2tlPSIjMDA1NWUyIiB0cmFuc2Zvcm09InJvdGF0ZSgtOTAgMTc1IDE3NSkiIHN0cm9rZS13aWR0aD0iNTAiIGZpbGw9Im5vbmUiIHN0cm9rZS1kYXNoYXJyYXk9IjM2NywgMTEwMCIgc3Ryb2tlLWRhc2hvZmZzZXQ9Ii0zNjciPjwvY2lyY2xlPgogICAgPGNpcmNsZSBjeD0iMTc1IiBjeT0iMTc1IiByPSIxNzUiIHN0cm9rZT0iI0ZGQjEyMSIgdHJhbnNmb3JtPSJyb3RhdGUoLTkwIDE3NSAxNzUpIiBzdHJva2Utd2lkdGg9IjUwIiBmaWxsPSJub25lIiBzdHJva2UtZGFzaGFycmF5PSIzNjcsIDExMDAiIHN0cm9rZS1kYXNob2Zmc2V0PSItNzM0Ij48L2NpcmNsZT4KPC9zdmc+Cg==">
                                                    {{-- <img src="https://cdn.29bet.com/assets/img/all/pages/referralcabinet/chart-statistic.svg" alt=""> --}}
                                                    <h3 class="mt-3">R$: 0,00</h3>
                                                    <h5>{{ __("today's profit") }}</h5>
                                                </div>
                                                <div class="referral__statistic__profit__today__card__info__text">
                                                    <p>
                                                        {{ __('Your profits will consist of two parts, namely 【bonus of invitation】 【betting commission】<br><br> betting commission <br>This will be your main source of income, you will receive a commissionin different proportions whenever you invite a player to bet <br><br> invitation bonus <br> You will receive at least one cash bonus of <span> R$18.00</span> for the first deposit made by your users guests. <br><br> achievement reward <br> When you invite enough users who have made deposits, you can unlock the【conquest rewards correspondents') }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="referral__statistic__profit__all my-4">
                                        {{-- <h3 class="referral__statistic__profit__all--title mb-4">Lucro total</h3> --}}
                                        <div class="referral__statistic__profit__all__card">
                                            <div
                                                class="referral__statistic__profit__all__card__numbers d-flex flex-wrap align-items-center gap-3 justify-content-around">
                                                <div class="my-3">
                                                    <h5>R$: 0,00</h5>
                                                    <p>{{ __('deposit refund') }}</p>
                                                </div>
                                                <div class="my-3">
                                                    <h5>R$: 0,00</h5>
                                                    <p>{{ __('achievement reward') }}</p>
                                                </div>
                                                <div class="my-3">
                                                    <h5>R$: 0,00</h5>
                                                    <p>{{ __("today's profit") }}</p>
                                                </div>
                                                <div class="my-3">
                                                    <h5>R$: 0,00</h5>
                                                    <p>{{ __('deposit user') }}</p>
                                                </div>
                                            </div>
                                            <div
                                                class="referral__statistic__profit__all__card__info d-sm-flex align-items-center gap-3">
                                                <div class="referral__statistic__profit__all__card__info__amount text-center">
                                                    <img src="https://cdn.29bet.com/assets/img/all/pages/referralcabinet/bau.webp" alt="https://cdn.29bet.com/assets/img/all/pages/referralcabinet/bau.webp">
                                                    <h3 class="mt-3">R$: 0,00</h3>
                                                    <h5>Lucro de hoje</h5>
                                                </div>
                                                <div class="referral__statistic__profit__all__card__info__text">
                                                    <p>
                                                        Você receberá uma comissão sempre que o usuário convidado fizer uma
                                                        aposta, independentemente de ganhar ou perder.
                                                        <br>
                                                        Portanto, o que você precisa fazer é melhorar suas habilidades de
                                                        apostas, pensar em como ganhar jogos e compartilhar com todos,
                                                        ajudando mais pessoas a ganhar jogos da sua maneira.
                                                        <br>
                                                        Esperamos que todos os jogadores possam se divertir em 29bet, seja
                                                        com a diversão das apostas ou com o jogo em si!
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="my-tab-content  tab__styled__referral position-relative" id="referralDetails">
                            <div class="referral__details">


                                <div class="referral__details__selects d-flex flex-wrap gap-2 align-items-center mb-2">

                                    <div class="d-flex gap-2 w-mb-100">
                                        <div class="dropdown w-mb-100">
                                            <div class="dropdown__select">
                                                <select class="select--pix--input" id="transactiondate_filter" name="transactiondate_filter" >
                                                    <option value="1" selected>{{ __('last 7 days')}}</option>
                                                    <option value="2">{{ __('Today')}}</option>
                                                    <option value="3">{{ __('Yesterday')}}</option>
                                                    <option value="4">{{ __('Within a month')}}</option>
                                                    <option value="5">{{ __('Within the year')}}</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="dropdown w-mb-100">
                                            <div class="dropdown__select">
                                                <select class="select--pix--input" id="transactiontype_filter" name="transactiontype_filter" >
                                                    <option value="7, 8, 12, 14, 15, 16, 17, 18, 19, 26, 27, 28, 29, 30, 31, 32, 35, 36, 37" selected>{{ __('All')}}</option>
                                                    <option value="8, 12, 28, 29">{{ __('Withdrawal')}}</option>
                                                    <option value="7, 19, 26, 27">{{ __('Recharge')}}</option>
                                                    <option value="14, 30, 31, 32, 35, 36">{{ __('Transfer Balance')}}</option>
                                                    <option value="15, 16, 17, 37">{{ __('Claim promotion')}}</option>
                                                </select>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="dropdown w-mb-100">
                                        <div class="dropdown__select">
                                            <select class="select--pix--input" id="transaction_limit"
                                                name="transaction_limit">
                                                <option value="10" selected>10</option>
                                                <option value="20">20</option>
                                                <option value="50">50</option>
                                                <option value="100">100</option>
                                            </select>
                                        </div>
                                    </div>

                                </div>

                                <div class="dt00  table__scroll">
                                    <table class="default__table" id="transaction">
                                        <thead class="default__table__header">
                                            <tr class="default__table__header__content">
                                                <th scope="col" class="default__table__header__content--item">
                                                    {{ __('Transaction ID') }}</th>
                                                <th scope="col" class="default__table__header__content--item">
                                                    {{ __('Description') }}</th>
                                                <th scope="col" class="default__table__header__content--item">
                                                    {{ __('Before balance') }}</th>
                                                <th scope="col" class="default__table__header__content--item">
                                                    {{ __('Value') }}</th>
                                                <th scope="col" class="default__table__header__content--item">
                                                    {{ __('New balance sheet') }}</th>
                                                <th scope="col" class="default__table__header__content--item">
                                                    {{ __('Transaction Date') }}</th>
                                            </tr>
                                        </thead>

                                        <tbody class="default__table__body">
                                        </tbody>

                                    </table>
                                </div>

                            </div>
                        </div>

                        <div class="my-tab-content  tab__styled__referral position-relative" id="referralComission">
                            <div class="referral__details">
                                <div class="referral__details__selects d-flex gap-3 align-items-center mb-2">

                                    <div class="dropdown w-mb-100">
                                        <div class="dropdown__select">
                                            <select class="select--pix--input" id="commissiondate_filter"
                                                name="commissiondate_filter">
                                                <option value="1" selected>{{ __('last 7 days') }}</option>
                                                <option value="2">{{ __('Today') }}</option>
                                                <option value="3">{{ __('Yesterday') }}</option>
                                                <option value="4">{{ __('Within a month') }}</option>
                                                <option value="5">{{ __('Within the year') }}</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="dropdown w-mb-100">
                                        <div class="dropdown__select">
                                            <select class="select--pix--input" id="commissiontype_filter" name="commissiontype_filter" >
                                                <option value="44, 47" selected>{{ __('All')}}</option>
                                                <option value="44">{{ __('Games Agent Commission')}}</option>
                                                <option value="47">{{ __('Recharge Agent Commission')}}</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="dropdown w-mb-100">
                                        <div class="dropdown__select">
                                            <select class="select--pix--input" id="commission_limit"
                                                name="commission_limit">
                                                <option value="10" selected>10</option>
                                                <option value="20">20</option>
                                                <option value="50">50</option>
                                                <option value="100">100</option>
                                            </select>
                                        </div>
                                    </div>

                                </div>
                                <div class="dt00 table__scroll">
                                    <table class="default__table" id="Commission">
                                        <thead class="default__table__header">
                                            <tr class="default__table__header__content">
                                                <th scope="col" class="default__table__header__content--item">
                                                    {{ __('Transaction ID') }}</th>
                                                <th scope="col" class="default__table__header__content--item">
                                                    {{ __('Description') }}</th>
                                                <th scope="col" class="default__table__header__content--item"> 
                                                    {{ __('Before balance') }}</th>
                                                <th scope="col" class="default__table__header__content--item">
                                                    {{ __('Value') }}</th>
                                                <th scope="col" class="default__table__header__content--item">
                                                    {{ __('New balance sheet') }}</th>
                                                <th scope="col" class="default__table__header__content--item">
                                                    {{ __('Transaction Date') }}</th>
                                            </tr>
                                        </thead>

                                        <tbody class="default__table__body">
                                        </tbody>

                                    </table>
                                </div>

                            </div>
                        </div>

                        <div class="my-tab-content  tab__styled__referral position-relative" id="referralRecharge">
                            <div class="referral__details">
                                <div class="referral__details__selects flex-wrap d-flex gap-3 align-items-center mb-2">

                                    <div class="d-flex gap-2 w-mb-100">
                                        <div class="dropdown w-mb-100">
                                            <div class="dropdown__select">
                                                <select class="select--pix--input" id="rechargedate_filter" name="rechargedate_filter">
                                                    <option value="1" selected>{{ __('last 7 days')}}</option>
                                                    <option value="2">{{ __('Today')}}</option>
                                                    <option value="3">{{ __('Yesterday')}}</option>
                                                    <option value="4">{{ __('Within a month')}}</option>
                                                    <option value="5">{{ __('Within the year')}}</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="dropdown w-mb-100">
                                            <div class="dropdown__select">
                                                <select class="select--pix--input" id="rechargetype_filter" name="rechargetype_filter">
                                                    <option value="7, 8, 12, 14, 15, 16, 17, 18, 19, 26, 27, 28, 29, 30, 31, 32, 35, 36, 37, 46, 48" selected>{{ __('All')}}</option>
                                                    <option value="8, 12, 28, 29">{{ __('Withdrawal')}}</option>
                                                    <option value="7, 19, 26, 27">{{ __('Recharge')}}</option>
                                                    <option value="14, 30, 31, 32">{{ __('Transfer Balance')}}</option>
                                                    <option value="15, 16, 17, 46, 48">{{ __('Claim promotion')}}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="dropdown w-mb-100">
                                        <div class="dropdown__select">
                                            <select class="select--pix--input" id="recharge_limit" name="recharge_limit">
                                                <option value="10" selected>10</option>
                                                <option value="20">20</option>
                                                <option value="50">50</option>
                                                <option value="100">100</option>
                                            </select>
                                        </div>
                                    </div>

                                </div>
                                <div class="dt00 table__scroll">
                                    <table class="default__table" id="RechargeRecordtable">
                                        <thead class="default__table__header">
                                            <tr class="default__table__header__content">
                                                <th scope="col" class="default__table__header__content--item">
                                                    {{ __('Username') }}</th>
                                                <th scope="col" class="default__table__header__content--item">
                                                    {{ __('Name') }}</th>
                                                <th scope="col" class="default__table__header__content--item">
                                                    {{ __('Description') }}</th>
                                                <th scope="col" class="default__table__header__content--item">
                                                    {{ __('Before balance') }}</th>
                                                <th scope="col" class="default__table__header__content--item">
                                                    {{ __('Value') }}</th>
                                                <th scope="col" class="default__table__header__content--item">
                                                    {{ __('New balance sheet') }}</th>
                                                <th scope="col" class="default__table__header__content--item">
                                                    {{ __('Transaction Date') }}</th>
                                            </tr>
                                        </thead>

                                        <tbody class="default__table__body">
                                        </tbody>

                                    </table>
                                </div>

                            </div>
                        </div>

                        <div class="my-tab-content  tab__styled__referral position-relative" id="referralMembers">
                            <div class="referral__details">
                            <div class="referral__details__selects d-flex gap-3 align-items-center mb-2">

                                    <div class="dropdown w-mb-100">
                                        <div class="dropdown__select">
                                            <select class="select--pix--input" id="registerdate_filter"
                                                name="registerdate_filter">
                                                <option value="1">{{ __('last 7 days') }}</option>
                                                <option value="2">{{ __('Today') }}</option>
                                                <option value="3">{{ __('Yesterday') }}</option>
                                                <option value="4">{{ __('Within a month') }}</option>
                                                <option value="5">{{ __('Within the year') }}</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="dropdown w-mb-100">
                                        <div class="dropdown__select">
                                            <select class="select--pix--input" id="register_limit" name="register_limit">
                                                <option value="10">10</option>
                                                <option value="20">20</option>
                                                <option value="50">50</option>
                                                <option value="100">100</option>
                                            </select>
                                        </div>
                                    </div>

                                </div>

                                <div class="dt00 table__scroll">
                                    <table class="default__table" id="TeamMembers">
                                        <thead class="default__table__header">
                                            <tr class="default__table__header__content">
                                                <th scope="col" class="default__table__header__content--item">
                                                    {{ __('Reference Code') }}</th>
                                                <th scope="col" class="default__table__header__content--item">
                                                    {{ __('Username') }}</th>
                                                <th scope="col" class="default__table__header__content--item">
                                                    {{ __('Name') }}</th>
                                                <th scope="col" class="default__table__header__content--item">
                                                    {{ __('Registered Date') }}</th>
                                                <th scope="col" class="default__table__header__content--item">
                                                    {{ __('Last login time') }}</th>
                                            </tr>
                                        </thead>

                                        <tbody class="default__table__body">
                                        </tbody>

                                    </table>
                                </div>

                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {

            const token = $('meta[name=csrf-token]').attr('content');

            var ReferralCabinetTab = localStorage.getItem('ReferralCabinetTab');

            if (ReferralCabinetTab !== null) {
                $('.my-tab').eq(ReferralCabinetTab).click();

                if (ReferralCabinetTab == 3) {
                    TransactionTable();
                }else if(ReferralCabinetTab == 4){
                    CommissionTable();
                }else if(ReferralCabinetTab == 5){
                    RechargeRecordtable();
                }else if(ReferralCabinetTab == 6){
                    TeamMemberTable();
                }

            }

            $('.my-tab').click(function() {

                var tabIndex = $(this).index();
                localStorage.setItem('ReferralCabinetTab', tabIndex);

            });

            function TransactionTable() {

                var TransactionTable = new DataTable('#transaction', {
                    pagingType: 'full_numbers',
                    processing: true,
                    serverSide: true,
                    lengthChange: false,
                    pageLength: 10,
                    stateSave: true,
                    language: {
                        "emptyTable": "{{ __('No data available in table')}}",
                        "zeroRecords":    "{{ __('No matching records found')}}",
                        "info":           "{{ __('Showing')}} _START_ {{ __('to')}} _END_ {{ __('of')}} _TOTAL_ {{ __('entries')}}",
                        "infoEmpty":      "{{ __('Showing 0 to 0 of 0 entries')}}",
                        "infoFiltered":   "( {{ __('filtered from')}} _MAX_ {{ __('total entries')}} )",
                        "zeroRecords":    "{{ __('No matching records found')}}",
                        "search": "{{ __('Search:')}}",
                        "paginate": {
                            "first":      "{{ __('First')}}",
                            "last":       "{{ __('Last')}}",
                            "next":       "{{ __('Next')}}",
                            "previous":   "{{ __('Previous')}}"
                        },
                    },
                    stateSaveParams: function(settings, data) {

                        data.transactiontype_filter = $('#transactiontype_filter').val();
                        data.transactiondate_filter = $('#transactiondate_filter').val();

                    },
                    stateLoadParams: function(settings, data) {

                        const transaction_filter = "7, 8, 12, 14, 15, 16, 17, 18, 19, 26, 27, 28, 29, 30, 31, 32, 35, 36, 37, 46, 48";
                        $('#transactiontype_filter').val(data.transactiontype_filter || transaction_filter);
                        $('#transactiondate_filter').val(data.transactiondate_filter || 1);

                    },
                    initComplete: function() {

                        $('#transactiontype_filter').on('change', function() {

                            TransactionTable.ajax.reload();

                        });

                        $('#transactiondate_filter').on('change', function() {

                            TransactionTable.ajax.reload();

                        });

                        $('#transaction_limit').on('change', function() {

                            TransactionTable.page.len($(this).val()).draw();

                        });

                    },
                    ajax: {

                        url: '{{ route("transaction_table") }}',
                        type: 'POST',
                        headers: {

                            'Content-Type': 'appication/json',
                            'X-CSRF-TOKEN': token,
                            'Authorization': 'Bearer ' + token

                        },
                        data: function(d) {

                            d.action_id = $('#transactiontype_filter').val();
                            d.date = $('#transactiondate_filter').val();
                            return JSON.stringify(d);
                        }

                    },
                    order: [
                        [5, 'desc']
                    ],
                    columns: [

                        {
                            data: 'transaction_id'
                        },
                        {
                            data: 'transaction_type'
                        },
                        {
                            data: 'before_balance'
                        },
                        {
                            data: 'amount'
                        },
                        {
                            data: 'new_balance'
                        },
                        {
                            data: 'date_transacted'
                        }

                    ],
                    columnDefs: [

                        {

                            targets: [0, 1, 2, 3, 4, 5],
                            createdCell: function(cell, cellData, rowData, rowIndex, colIndex) {


                                $(cell).addClass('default__table__body__content--item');

                            }

                        },

                    ]

                });

            }

            $('[data-tab-target="referralDetails"]').one('click', function() {

                if (ReferralCabinetTab != 3) {

                    TransactionTable();

                }

            });

            function CommissionTable() {

                var CommissionTable = new DataTable('#Commission', {
                    pagingType: 'full_numbers',
                    processing: true,
                    serverSide: true,
                    lengthChange: false,
                    pageLength: 10,
                    stateSave: true,
                    language: {
                        "emptyTable": "{{ __('No data available in table')}}",
                        "zeroRecords":    "{{ __('No matching records found')}}",
                        "info":           "{{ __('Showing')}} _START_ {{ __('to')}} _END_ {{ __('of')}} _TOTAL_ {{ __('entries')}}",
                        "infoEmpty":      "{{ __('Showing 0 to 0 of 0 entries')}}",
                        "infoFiltered":   "( {{ __('filtered from')}} _MAX_ {{ __('total entries')}} )",
                        "zeroRecords":    "{{ __('No matching records found')}}",
                        "search": "{{ __('Search:')}}",
                        "paginate": {
                            "first":      "{{ __('First')}}",
                            "last":       "{{ __('Last')}}",
                            "next":       "{{ __('Next')}}",
                            "previous":   "{{ __('Previous')}}"
                        },
                    },
                    stateSaveParams: function(settings, data) {

                        data.commissiondate_filter = $('#commissiondate_filter').val();
                        data.commissiontype_filter = $('#commissiontype_filter').val();

                    },
                    stateLoadParams: function(settings, data) {

                        $('#commissiondate_filter').val(data.commissiondate_filter || 1);
                        $('#commissiontype_filter').val(data.commissiontype_filter || '44, 47');

                    },
                    initComplete: function() {

                        $('#commissiondate_filter').on('change', function() {

                            CommissionTable.ajax.reload();

                        });

                        $('#commissiontype_filter').on('change', function() {

                            CommissionTable.ajax.reload();

                        });

                        $('#commission_limit').on('change', function() {

                            CommissionTable.page.len($(this).val()).draw();

                        });

                    },
                    ajax: {

                        url: '{{ route("commission") }}',
                        type: 'POST',
                        headers: {

                            'Content-Type': 'appication/json',
                            'X-CSRF-TOKEN': token,
                            'Authorization': 'Bearer ' + token

                        },
                        data: function(d) {

                            d.date = $('#commissiondate_filter').val();
                            return JSON.stringify(d);
                        }

                    },
                    order: [
                        [5, 'desc']
                    ],
                    columns: [

                        { data: 'transaction_id' },
                        { data: 'transaction_type' },
                        { data: 'before_balance' },
                        { data: 'amount' },
                        { data: 'new_balance' },
                        { data: 'date_transacted' }

                    ],
                    columnDefs: [

                        {

                            targets: [0, 1, 2, 3, 4, 5],
                            createdCell: function(cell, cellData, rowData, rowIndex, colIndex) {

                    
                                $(cell).addClass('default__table__body__content--item');

                            }

                        },

                    ]

                });

            }

            $('[data-tab-target="referralComission"]').one('click', function() {

                if (ReferralCabinetTab != 4) {

                    CommissionTable();

                }

            });

            function RechargeRecordtable() {

                var RechargeRecordtable = new DataTable('#RechargeRecordtable', {
                    pagingType: 'full_numbers',
                    processing: true,
                    serverSide: true,
                    lengthChange: false,
                    pageLength: 10,
                    stateSave: true,
                    language: {
                        "emptyTable": "{{ __('No data available in table')}}",
                        "zeroRecords":    "{{ __('No matching records found')}}",
                        "info":           "{{ __('Showing')}} _START_ {{ __('to')}} _END_ {{ __('of')}} _TOTAL_ {{ __('entries')}}",
                        "infoEmpty":      "{{ __('Showing 0 to 0 of 0 entries')}}",
                        "infoFiltered":   "( {{ __('filtered from')}} _MAX_ {{ __('total entries')}} )",
                        "zeroRecords":    "{{ __('No matching records found')}}",
                        "search": "{{ __('Search:')}}",
                        "paginate": {
                            "first":      "{{ __('First')}}",
                            "last":       "{{ __('Last')}}",
                            "next":       "{{ __('Next')}}",
                            "previous":   "{{ __('Previous')}}"
                        },
                    },
                    stateSaveParams: function(settings, data) {

                        data.rechargetype_filter = $('#rechargetype_filter').val();
                        data.rechargedate_filter = $('#rechargedate_filter').val();

                    },
                    stateLoadParams: function(settings, data) {

                        $('#rechargetype_filter').val(data.rechargetype_filter ||
                            "7, 8, 12, 14, 15, 16, 17, 18, 19, 26, 27, 28, 29, 30, 31, 32");
                        $('#rechargedate_filter').val(data.rechargedate_filter || 1);

                    },
                    initComplete: function() {

                        $('#rechargetype_filter').on('change', function() {

                            RechargeRecordtable.ajax.reload();

                        });

                        $('#rechargedate_filter').on('change', function() {

                            RechargeRecordtable.ajax.reload();

                        });

                        $('#recharge_limit').on('change', function() {

                            RechargeRecordtable.page.len($(this).val()).draw();

                        });

                    },
                    ajax: {

                        url: '{{ route("recharge_record") }}',
                        type: 'POST',
                        headers: {

                            'Content-Type': 'appication/json',
                            'X-CSRF-TOKEN': token,
                            'Authorization': 'Bearer ' + token

                        },
                        data: function(d) {

                            d.action_id = $('#rechargetype_filter').val();
                            d.date = $('#rechargedate_filter').val();

                            return JSON.stringify(d);

                        }

                    },
                    order: [
                        [6, 'desc']
                    ],
                    columns: [

                        {
                            data: 'username'
                        },
                        {
                            data: 'name'
                        },
                        {
                            data: 'transaction_type'
                        },
                        {
                            data: 'before_balance'
                        },
                        {
                            data: 'amount'
                        },
                        {
                            data: 'new_balance'
                        },
                        {
                            data: 'date_transacted'
                        }

                    ],
                    columnDefs: [

                        {

                            targets: [0, 1, 2, 3, 4, 5, 6],
                            createdCell: function(cell, cellData, rowData, rowIndex, colIndex) {


                                $(cell).addClass('default__table__body__content--item');

                            }

                        },

                    ]

                });

            }

            $('[data-tab-target="referralRecharge"]').one('click', function() {

                if (ReferralCabinetTab != 5) {

                    RechargeRecordtable();

                }

            });

            function TeamMemberTable() {

                var TeamMemberTable = new DataTable('#TeamMembers', {
                    pagingType: 'full_numbers',
                    processing: true,
                    serverSide: true,
                    lengthChange: false,
                    pageLength: 10,
                    stateSave: true,
                    language: {
                        "emptyTable": "{{ __('No data available in table')}}",
                        "zeroRecords":    "{{ __('No matching records found')}}",
                        "info":           "{{ __('Showing')}} _START_ {{ __('to')}} _END_ {{ __('of')}} _TOTAL_ {{ __('entries')}}",
                        "infoEmpty":      "{{ __('Showing 0 to 0 of 0 entries')}}",
                        "infoFiltered":   "( {{ __('filtered from')}} _MAX_ {{ __('total entries')}} )",
                        "zeroRecords":    "{{ __('No matching records found')}}",
                        "search": "{{ __('Search:')}}",
                        "paginate": {
                            "first":      "{{ __('First')}}",
                            "last":       "{{ __('Last')}}",
                            "next":       "{{ __('Next')}}",
                            "previous":   "{{ __('Previous')}}"
                        },
                    },
                    stateSaveParams: function(settings, data) {

                        data.historydate_filter = $('#registerdate_filter').val();
                        data.history_limit = $('#register_limit').val();

                    },
                    stateLoadParams: function(settings, data) {

                        $('#registerdate_filter').val(data.historydate_filter || 1);
                        $('#register_limit').val(data.history_limit || 10);

                    },
                    initComplete: function() {

                        $('#registerdate_filter').on('change', function() {

                            TeamMemberTable.ajax.reload();

                        });

                        $('#register_limit').on('change', function() {

                            TeamMemberTable.page.len($(this).val()).draw();

                        });

                    },
                    ajax: {

                        url: '{{ route("team_members") }}',
                        type: 'POST',
                        headers: {

                            'Content-Type': 'appication/json',
                            'X-CSRF-TOKEN': token,
                            'Authorization': 'Bearer ' + token

                        },
                        data: function(d) {

                            d.date = $('#registerdate_filter').val();
                            return JSON.stringify(d);
                        }

                    },
                    order: [
                        [3, 'desc']
                    ],
                    columns: [

                        {
                            data: 'referral_id'
                        },
                        {
                            data: 'username'
                        },
                        {
                            data: 'name'
                        },
                        {
                            data: 'date_registered'
                        },
                        {
                            data: 'date_modified'
                        },

                    ],
                    columnDefs: [

                        {

                            targets: [0, 1, 2, 3, 4],
                            createdCell: function(cell, cellData, rowData, rowIndex, colIndex) {


                                $(cell).addClass('default__table__body__content--item');

                            }

                        },

                    ]

                });

            }

            $('[data-tab-target="referralMembers"]').one('click', function() {

                if (ReferralCabinetTab != 6) {

                    TeamMemberTable();

                }

            });

            
            $.ajax({
                type: 'POST',
                url: '{{ route("overview") }}',
                headers: {

                    'Content-Type': 'appication/json',
                    'X-CSRF-TOKEN': token,
                    'Authorization': 'Bearer ' + token

                },
                success: function(response) {
                    const GuestUser = response.user_guest || 0;
                    const DepositUser = response.user_deposit || 0;
                    const BonusToday = response.bonus_today.toFixed(2) || 0;
                    const BonusYesterday = response.bonus_yesterday.toFixed(2) || 0;

                    $('#TotalGuestUser').text(GuestUser);
                    $('#TotalDepositUser').text(DepositUser);
                    $('#TotalBonusToday').text(BonusToday);
                    $('#TotalBonusYesterday').text(BonusYesterday);

                },
                error: function(error) {
                    console.log(error);
                }
            });

        });
    </script>

    <script>
        const numDepositantesInput = document.getElementById('num-depositantes');
        const contadorConvidadosSpan = document.getElementById('contador-convidados');
        const valorGanhoSpan = document.getElementById('valor-ganho');

        numDepositantesInput.addEventListener('input', atualizarContadorConvidados);
        numDepositantesInput.addEventListener('input', calcularValorGanho);

        function atualizarContadorConvidados() {
            const numDepositantes = parseInt(numDepositantesInput.value);
            contadorConvidadosSpan.textContent = numDepositantes;
        }

        function calcularValorGanho() {
            const numDepositantes = parseInt(numDepositantesInput.value);
            const valorGanho = Math.floor(numDepositantes / 5) * 100; // Cada 10 depositantes ganham R$100

            valorGanhoSpan.textContent = valorGanho;
        }

        const progress = document.querySelector('.referral__explication__earnings__invitate-number--range');
        const progressTask = document.querySelector('.referral__discount__ranking__progress__task--range');

        progress.addEventListener('input', function() {
            const value = this.value;
            this.style.background =
                `linear-gradient(to right, #2283f6 0%, #2283f6 ${value}%, #fff ${value}%, white 100%)`
        })
        progressTask.addEventListener('input', function() {
            const value = this.value;
            this.style.background =
                `linear-gradient(to right, #2283f6 0%, #2283f6 ${value}%, #fff ${value}%, white 100%)`
        })
    </script>


    <script>
        $('.btn-claim').on('click', function(e) {

            var id = this.id;
            var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            $.ajax({
                "method": "POST",
                "url": "{{ route('claim_reward') }}",
                data: {
                    "_token": token,
                    "id": id.substring(id.lastIndexOf("-") + 1),
                },
                success: function(response) {
                    if (response.success) {
                        console.log("dito")
                        iziToast.success({ //success, error, info
                            message: response.message,
                            position: 'center',
                            icon: "fa fa-check" //fa fa-info or fa fa-check
                        });
                        location.reload();
                    } else {
                        iziToast.error({ //success, error, info
                            message: response.message,
                            position: 'center',
                            icon: "fa fa-times-circle " //fa fa-info or fa fa-check
                        });
                    }
                },
                error: function(xhr, status, error) {
                    iziToast.error({ //success, error, info
                        message: error,
                        position: 'center',
                        icon: "fa fa-times-circle " //fa fa-info or fa fa-check
                    });
                }
            });
        })
    </script>
@endsection
