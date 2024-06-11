@extends('welcome')

@section('content')
    <div class="rank-q">
        <div class="rank__wrapper">
            <div class="rank__container">
                <div class="rank__vip">
                    <div class="rank__vip__content">

                        <div class="vip__items__left my-4">
                            <div class="vip__items__left__inner">
                                <div class="vip__items__left__body">

                                    <div class="vip__items__head">
                                        <h2 class="vip__items__head__lvl">{{ __('Your VIP level is LV')}} @if (!Auth::guest())
                                                {{ $rank_list['level'] }}
                                            @else
                                                0
                                            @endif
                                        </h2>
                                        <div class="vip__items__head__help">
                                            <span class="tooltiparea">
                                                <div class="tooltip__content tooltip-bottom" style="height: 150px;">
                                                   {{  __(' Upgrade Levels and Bonuses VIP upgrade needs to reach both the next
                                                   deposit level and the bet amount upgrade conditions, you will
                                                   automatically receive the corresponding VIP level bonus.')}}
                                                </div>
                                                <i class="far fa-question-circle tooltip__ico"></i>
                                            </span>
                                        </div>
                                    </div>


                                    <div class="user__info__head">
                                        <div class="user__info__head__bg">
                                            <div class="user_info__head--light"></div>
                                            <div class="user__info--pic">
                                                @if (!Auth::guest())
                                                    <img src="{{ asset($rank_list['image_lvl']) }}" alt="{{ asset($rank_list['image_lvl']) }}">
                                                @else
                                                    <img src="https://cdn.29bet.com/assets/images/ranks/nBfolqEx6i7LtebFRKLLR1pTUrELPcyctBEQEXPM.webp"
                                                        alt="https://cdn.29bet.com/assets/images/ranks/nBfolqEx6i7LtebFRKLLR1pTUrELPcyctBEQEXPM.webp">
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="user__score__body">
                                        <div class="flex-items">
                                            <div class="user__score--title">{{ __('Deposit')}}</div>
                                            @if (!Auth::guest())
                                                <div class="user__score__value">
                                                    <span>R$ {{ $rank_list['current_deposit'] }}</span> / <span
                                                        class="color-orange"> R${{ $rank_list['deposit'] }}</span>
                                                </div>
                                            @else
                                                <div class="user__score__value">
                                                    <span>R$ 0</span> / <span class="color-orange"> R$ 0</span>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="score_process blue">
                                            @if (!Auth::guest())
                                                <div
                                                    class="ant-progress ant-progress-line ant-progress-status-active ant-progress-show-info ant-progress-default">
                                                    <div class="ant-progress-outer">
                                                        <div class="ant-progress-inner">
                                                            <div class="ant-progress-bg"
                                                                style="width: {{ $rank_list['percentage_deposit'] }}%; height: 10px; background: rgb(26, 85, 239);">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <span class="color-white"
                                                        title="%">{{ $rank_list['percentage_deposit'] }}%</span>
                                                </div>
                                            @else
                                                <div
                                                    class="ant-progress ant-progress-line ant-progress-status-active ant-progress-show-info ant-progress-default">
                                                    <div class="ant-progress-outer">
                                                        <div class="ant-progress-inner">
                                                            <div class="ant-progress-bg"
                                                                style="width: 0%; height: 10px; background: rgb(26, 85, 239);">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <span class="color-white" title="%">0%</span>
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="user__score__body">
                                        <div class="flex-items">
                                            <div class="user__score--title">{{ __('Bet')}}</div>
                                            <div class="user__score__value">
                                                @if (!Auth::guest())
                                                    <span>R$ {{ $rank_list['current_bet'] }}</span> / <span
                                                        class="color-orange">R${{ $rank_list['bet'] }}</span>
                                                @else
                                                    <span>R$ 0</span> / <span class="color-orange">R$ 0</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="score_process blue">
                                            <div
                                                class="ant-progress ant-progress-line ant-progress-status-active ant-progress-show-info ant-progress-default">
                                                <div class="ant-progress-outer">
                                                    <div class="ant-progress-inner">
                                                        @if (!Auth::guest())
                                                            <div class="ant-progress-bg"
                                                                style="width: {{ $rank_list['percentage_bet'] }}%; height: 10px; background: rgb(26, 85, 239);">
                                                            </div>
                                                        @else
                                                            <div class="ant-progress-bg"
                                                                style="width: 10%; height: 10px; background: rgb(26, 85, 239);">
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                                @if (!Auth::guest())
                                                    <span class="color-white"
                                                        title="%">{{ $rank_list['percentage_bet'] }}%</span>
                                                @else
                                                    <span class="color-white" title="%">0%</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    @if (!Auth::guest())
                                        <div class="user__vip__txt">{{__('The update for')}} <span class="color-orange">VIP
                                                {{ $rank_list['level'] }}</span> {{ __('also requires')}}</div>
                                    @else
                                        <div class="user__vip__txt">{{ __('The update for')}} <span class="color-orange">VIP
                                                0</span> {{ __('also requires')}}</div>
                                    @endif

                                    @if (!Auth::guest())
                                        <div class="user__score__inner">
                                            <div class="user__score__box">
                                                <div class="user__score__box__item">
                                                    <h5>{{ __('Bet')}}</h5>
                                                    <h3 class="user__score__box__item--yellow color-orange">R$
                                                        {{ $rank_list['bet'] }}
                                                    </h3>
                                                </div>
                                                <div class="user__score__box__item">
                                                    <h5>{{ __('Deposit')}}</h5>
                                                    <h3 class="user__score__box__item--yellow color-orange">R$
                                                        {{ $rank_list['deposit'] }}
                                                    </h3>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <div class="user__score__inner">
                                            <div class="user__score__box">
                                                <div class="user__score__box__item">
                                                    <h5>{{ __('Bet')}}</h5>
                                                    <h3 class="user__score__box__item--yellow">R$ 0</h3>
                                                </div>
                                                <div class="user__score__box__item">
                                                    <h5>{{ __('Deposit')}}</h5>
                                                    <h3 class="user__score__box__item--yellow">R$ 0</h3>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                </div>
                            </div>
                        </div>

                        <div class="vip__items__right my-4">
                            <div class="vip__items__right__inner">
                                <div class="vip__items__right__body">

                                    <div class="user__items__head">
                                        <h2>{{ __('Full VIP Bonus')}}</h2>
                                    </div>

                                    <div class="user__lvl__list px-0">
                                        <div class="user__lvl__list__body p-0 slider-trunk">
                                            
                                            @if (!Auth::guest())
                                                @foreach ($new_level_list as $new_level_lists => $list)
                                                <div class="lvl__box__item">
                                                    <div class="lvl__box__item__body open active">
                                                        <div id="lvl__box--pic-{{ $list->level_requirement }}"
                                                            name="lvl__box--pic-{{ $list->level_requirement }}"
                                                            class="lvl__box--pic @if($achievement->level_requirement >= $list->level_requirement && $list->status == 0) lvl__box-vip-bonus @endif"
                                                            @if($achievement->level_requirement >= $list->level_requirement)
                                                                @if($list->status == 1 ) style="background: url('https://cdn.29bet.com/assets/img/all/pages/ranks/rank-bau-aberto.svg')
                                                                @else style="background: url('https://cdn.29bet.com/assets/img/all/pages/ranks/active-box.svg')
                                                                @endif
                                                            @else style="background: url('https://cdn.29bet.com/assets/img/all/pages/ranks/rank-bau-para-abrir.svg')
                                                            @endif 50% no-repeat;">
                                                           @if($list->status == 1)
                                                             <h3 class="lvl-box__item__body--msg">{{ __('claimed')}}</h3>
                                                           @endif
                                                        </div>

                                                        <div class="lvl__box--price">R$
                                                            {{ $list->discount_amount }}</div>
                                                        <div class="lvl__box--title">lv-
                                                            {{ $list->level_requirement }}</div>
                                                    </div>
                                                </div>
                                            @endforeach
                                            
                                            @else
                                               {{-- guest here  --}}
                                            <div class="lvl__box__item">
                                                <div class="lvl__box__item__body">
                                                    <div id="lvl__box--pic-2"
                                                        name="lvl__box--pic-2"
                                                        class="lvl__box--pic"
                                                        style="background: url('https://cdn.29bet.com/img/all/pages/ranks/rank-bau-para-abrir.svg') 50% no-repeat;">
                                                    </div>
                                                    <div class="lvl__box--price">R$
                                                        1 </div>
                                                    <div class="lvl__box--title">lv-
                                                        1</div>
                                                </div>
                                            </div>

                                            @endif
                                        </div>
                                    </div>

                                    <div class="user__lvl__process">
                                        <div class="ant-progress ant-progress-line ant-progress-status-normal ant-progress-default">
                                            <div class="ant-progress-outer w-100">
                                                <div class="ant-progress-inner">
                                                    @if (!Auth::guest())
                                                        <div class="ant-progress-bg"
                                                            style="width: {{ $rank_list['rank_percentage'] }}%; height: 18px; background: rgb(26, 85, 239); border-radius: 18px;">
                                                        </div>
                                                    @else
                                                        <div class="ant-progress-bg"
                                                            style="width: 10%; height: 18px; background: rgb(26, 85, 239); border-radius: 18px;">
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="user__vip__lvl__desc">
                                        <p>{{ __('The 29Bet VIP level system is created with 10 levels, each with a correspondingcash prize. The more you play, the higher your VIP level and the more you will receive.')}}</p>
                                    </div>

                                    @if (!Auth::guest())
                                        <div class="user__score__inner">
                                            <div class="user__score__box big_score_box">
                                                <div class="user__score__box__item" style="margin-top: 7px;">
                                                    <h5>{{ __('Accumulated Bet Value')}}</h5>
                                                    <h3 class="user__score__box__item--yellow">R$
                                                        {{ $rank_list['current_bet'] }}</h3>
                                                </div>
                                                <div class="user__score__box__item" style="margin-top: 7px;">
                                                    <h5>{{ __('Cumulative deposit amount')}}</h5>
                                                    <h3 class="user__score__box__item--yellow">R$
                                                        {{ $rank_list['current_deposit'] }}</h3>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <div class="user__score__inner">
                                            <div class="user__score__box big_score_box">
                                                <div class="user__score__box__item" style="margin-top: 7px;">
                                                    <h5>{{ __('Accumulated Bet Value')}}</h5>
                                                    <h3 class="user__score__box__item--yellow">R$
                                                        120</h3>
                                                </div>
                                                <div class="user__score__box__item" style="margin-top: 7px;">
                                                    <h5>{{ __('Cumulative deposit amount')}}</h5>
                                                    <h3 class="user__score__box__item--yellow">R$
                                                        300</h3>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="card__overview my-4">
                        <div class="card__overview__title">
                            <div style="display: flex; justify-content: center; gap: 5px;">
                                <h2 class="pc_h2">
                                    <img src="https://cdn.29bet.com/assets/img/all/pages/ranks/rank-stars.svg" alt="https://cdn.29bet.com/assets/img/all/pages/ranks/rank-stars.svg"
                                        class="title_star">
                                    {{ __('HOW TO GET THE CASHBACK BONUS')}}
                                    {{-- <span class="tooltiparea">
                                        <div class="tooltip__content tooltip-bottom" style="height: 155px;">
                                            Cashback é o maior bônus no sistema 29BET VIP, no decorrer do jogo
                                            especificado, a quantidade de dinheiro que você acumulou em apostas naquele dia,
                                            não importa se ganha ou perde, irá para a porcentagem de cashback correspondente
                                            ao seu nível VIP atual.Aproveite os bônus de reembolso em dinheiro na 29BET
                                            para um melhor desfrute do jogo.
                                        </div>
                                        <i class="far fa-question-circle tooltip__ico orange-red"></i>
                                    </span> --}}
                                </h2>
                                <img src="https://cdn.29bet.com/assets/img/all/pages/ranks/rank-stars.svg" alt="https://cdn.29bet.com/assets/img/all/pages/ranks/rank-stars.svg"
                                    class="title_star">
                            </div>

                        </div>
                        <div class="card__overview__inner">
                            <div class="card__itemn">
                                <div class="card__item__total__inner">
                                    <div class="card__itemn__pic pic1"> <img
                                            src="https://cdn.29bet.com/assets/img/all/pages/ranks/rank-foguete.svg" alt="https://cdn.29bet.com/assets/img/all/pages/ranks/rank-foguete.svg">
                                    </div>
                                    <div class="card__itemn__num">01</div>
                                    <div class="card__item__desc">
                                        <p>{{ __('Place a bet on an original or LIVE game and the CASH BACK mechanism will automatically calculate the payback value based on your VIP level as you enjoy the game.')}}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="card__itemn">
                                <div class="card__item__total__inner">
                                    <div class="card__itemn__pic pic2"> <img
                                            src="https://cdn.29bet.com/assets/img/all/pages/ranks/rank-ampulheta.webp" alt="https://cdn.29bet.com/assets/img/all/pages/ranks/rank-ampulheta.webp">
                                    </div>
                                    <div class="card__itemn__num">02</div>
                                    <div class="card__item__desc">
                                        <p>{{ __('The cash back mechanism will be settled on your account balance at 00:00 based on your bets placed throughout the day.')}}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="card__itemn">
                                <div class="card__item__total__inner">
                                    <div class="card__itemn__pic pic3"> <img
                                            src="https://cdn.29bet.com/assets/img/all/pages/ranks/rank-moeda.svg" alt="https://cdn.29bet.com/assets/img/all/pages/ranks/rank-moeda.svg">
                                    </div>
                                    <div class="card__itemn__num">03</div>
                                    <div class="card__item__desc">
                                        <p>{{ __('The more you play, the higher your cash back, for example your [VIP1] $10,000 cumulative level bet will bring you a $20 cash back bonus. (The return for vip10 is BRL 50)')}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card__overview my-4">

                        <div class="card__overview__title">
                            <h2 class="pc_h2">
                                <img src="https://cdn.29bet.com/assets/img/all/pages/ranks/rank-stars.svg" alt="https://cdn.29bet.com/assets/img/all/pages/ranks/rank-stars.svg"
                                    class="title_star">
                                {{ __('ALL VIP LEVELS')}}
                                <img src="https://cdn.29bet.com/assets/img/all/pages/ranks/rank-stars.svg" alt="https://cdn.29bet.com/assets/img/all/pages/ranks/rank-stars.svg"
                                    class="title_star">
                            </h2>
                        </div>

                        <div class="rank_slider_wrapper">
                            <div class="swiper-container">
                                <div class="swiper sample-slider swiper-ranks">
                                    <div class="swiper-wrapper swiper-wrapper-ranks js-slider-ranks-user">
                                        @if (!Auth::guest())
                                            @foreach ($ranks as $rank)
                                                <div class="mx-2 pt-4">
                                                    <div class="rank__slider__card">
                                                        <div class="rank__slider__card__out">
                                                            <div class="rank__slider__card__image">
                                                                <img src="{{ ($rank['vip_level_badge']) }}"
                                                                    alt="{{ ($rank['vip_level_badge']) }}">
                                                            </div>
                                                            <div class="rank__slider__card__body">
                                                                <div class="rank__slider__card__title">
                                                                    <h4>{{ $rank['level_name'] }}</h4>
                                                                    <h5>{{ __('Update Conditions')}}</h5>
                                                                </div>
                                                                <div class="rank__slider__card__boxes">
                                                                    <div class="rank__slider__card__boxes__item">
                                                                        <p>{{ __('Total Deposits')}}</p>
                                                                        <h4>R$ {{ $rank['total_deposits'] }}</h4>
                                                                    </div>
                                                                    <div class="rank__slider__card__boxes__item">
                                                                        <p>{{ __('Total Bets')}}</p>
                                                                        <h4>R$ {{ $rank['total_bets'] }}</h4>
                                                                    </div>
                                                                </div>
                                                                <div class="rank__slider__card__rule">
                                                                    <h3>{{ __('Withdrawal Privileges')}}</h3>
                                                                    <p>{{ __('Update Conditions')}}</p>
                                                                    <p>{{ __('Maximum unit price R$')}}
                                                                        {{ $rank['max_withdraw_amount'] }}</p>
                                                                    <p>{{ __('Withdrawal fee:')}} {{ $rank['withdrawal_rate'] }}%</p>
                                                                    <p>{{ __('Free withdrawal:')}}
                                                                        R${{ $rank['monthly_free_withdrawal'] }}/month</p>
                                                                </div>
                                                                <hr>
                                                                <div class="rank__slider__card__subtitle">
                                                                    <h3>{{ __('CashBack')}}</h3>
                                                                </div>
                                                                <div class="rank__slider__card__options">
                                                                    <div class="rank__slider__card__options__item">
                                                                        <p>{{ __('Original Games & Slot')}}</p>
                                                                        <p>0%</p>
                                                                    </div>
                                                                    <div class="rank__slider__card__options__item">
                                                                        <p>{{ __('Live Casino')}}</p>
                                                                        <p>0%</p>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                            @php
                                                $cnt = 10;

                                                for ($i = 0; $i <= $cnt; $i++) {
                                                    echo '<div class="swiper-slide">
                                                <div class="rank__slider__card">
                                                    <div class="rank__slider__card__out">
                                                        <div class="rank__slider__card__image">
                                                            <img src=""
                                                                    alt="">
                                                        </div>
                                                        <div class="rank__slider__card__body">
                                                            <div class="rank__slider__card__title">
                                                                <h4>LV-0</h4>
                                                                <h5>Condições de atualização</h5>
                                                            </div>
                                                            <div class="rank__slider__card__boxes">
                                                                <div class="rank__slider__card__boxes__item">
                                                                    <p>Total de depósitos</p>
                                                                    <h4>R$ 0</h4>
                                                                </div>
                                                                <div class="rank__slider__card__boxes__item">
                                                                    <p>Total de apostas</p>
                                                                    <h4>R$ 0</h4>
                                                                </div>
                                                            </div>
                                                            <div class="rank__slider__card__rule">
                                                                <h3>Privilégios de Retirada</h3>
                                                                <p>Condições de atualização</p>
                                                                <p>Preço unitário máximo R$ 19999</p>
                                                                <p>Taxa de saque: 2,5%</p>
                                                                <p>Saque grátis: R$0/mês</p>
                                                            </div>
                                                            <hr>
                                                            <div class="rank__slider__card__subtitle">
                                                                <h3>CashBack</h3>
                                                            </div>
                                                            <div class="rank__slider__card__options">
                                                                <div class="rank__slider__card__options__item">
                                                                    <p>Jogos Originais & Slot</p>
                                                                    <p>0%</p>
                                                                </div>
                                                                <div class="rank__slider__card__options__item">
                                                                    <p>Cassino Ao Vivo</p>
                                                                    <p>0%</p>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>';
                                                }
                                            @endphp
                                        @endif

                                    </div>

                                    <div class="swiper-buttons-ranks">
                                        <div class="prev-ranks-user c-pointer"><img src="https://cdn.29bet.com/assets/img/all/pages/ranks/swiper-prev.svg" alt="https://cdn.29bet.com/assets/img/all/pages/ranks/swiper-prev.svg"></div>
                                        <div class="next-ranks-user"><img src="https://cdn.29bet.com/assets/img/all/pages/ranks/swiper-next.svg" alt="https://cdn.29bet.com/assets/img/all/pages/ranks/swiper-next.svg"></div>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="overview__contacts my-4">
                        <div class="overview__inner">
                            <div class="contacts__left">
                                <div class="contacts__img"> <img
                                        src="https://cdn.29bet.com/assets/img/all/pages/ranks/ranks-grupo-vip.svg" alt="https://cdn.29bet.com/assets/img/all/pages/ranks/ranks-grupo-vip.svg"
                                        width="100%" height="100%"> </div>
                            </div>
                            <div class="contacts__mid"><span>{{ __('Join our VIP group Get instant access to more events and bonuses')}}</span> </div>
                            <div class="contacts__right">
                                <button class="button__telegram">
                                    <span class="button__telegram__inner">
                                        <a href="https://t.me/29Bet" target="_blank" rel="noopener noreferrer">
                                            <span class="button__telegram--icon"><img
                                                    src="https://cdn.29bet.com/assets/img/all/pages/ranks/telegram-ico.png"
                                                    width="100%" height="100%" alt="https://cdn.29bet.com/assets/img/all/pages/ranks/telegram-ico.png">
                                                <span class="button__telegram--text">{{ __('Join now')}}</span>
                                            </span>
                                        </a>
                                    </span>
                                </button>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
    <script>
        $('.lvl__box-vip-bonus').on('click', function() {
            var id = this.id;

            var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            console.log(token);
            $.ajax({
                "method": "POST",
                "url": "{{ route('claim_reward-vip') }}",
                data: {
                    "_token": token,
                    "id": id.substring(id.lastIndexOf("-") + 1),
                },
                success: function(response) {

                    $('.lvl__box-vip-bonus').off('click');

                    if (response.success) {

                        iziToast.success({ //success, error, info
                            message: response.message,
                            position: 'center',
                            icon: "fa fa-check",
                            timeout: 2000,
                            closeOnEscape: true,
                            closeOnClick: true,
                            onClosed: function() {
                                
                                window.location.reload();

                            }
                            
                        });
                        
                    } else {

                        iziToast.error({ //success, error, info
                            message: response.message,
                            position: 'center',
                            icon: "fa fa-times-circle ",
                            timeout: 2000,
                            closeOnEscape: true,
                            closeOnClick: true,
                            onClosed: function() {
                                
                                window.location.reload();

                            }

                        });

                    }
                },
                error: function(xhr, status, error) {

                    $('.lvl__box-vip-bonus').off('click');

                    iziToast.error({ //success, error, info
                        message: error,
                        position: 'center',
                        icon: "fa fa-times-circle ",
                        timeout: 2000,
                        closeOnEscape: true,
                        closeOnClick: true,
                        onClosed: function() {

                            window.location.reload();

                        }
                    });
                    

                }
            });
        });
    </script>
@endsection

