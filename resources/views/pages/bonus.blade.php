@extends('welcome')

@section('css')
    <style>
        .game::before {
            background: linear-gradient(180deg,#2283f6,rgba(0,9,87,0));
            content: "";
            display: block;
            height: 45%;
            left: 0;
            position: absolute;
            top: 0;
            width: 100%;
            z-index: -1;
        }
    </style>
@endsection

@section('content')

    <section class="centro_promocoes">

        <div class="title__promotions d-flex align-items-center">
            <div>
                <h2> {{ __('Promotional code')}}
                <br>
                <span>{{ __('Bonus')}}</span></h2>
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Molestiae vero mollitia deserunt aperiam iure excepturi a delectus ad provident voluptate.</p>
            </div>
            <div class="images__gift">
                <img class="images__gift--present d-md-block d-lg-block d-none" src="https://cdn.29bet.com/assets/img/all/pages/bonuscode/gift.png" alt="https://cdn.29bet.com/assets/img/all/pages/bonuscode/gift.png">
                <img class="images__gift--conffet d-md-block d-lg-block d-none" src="https://cdn.29bet.com/assets/img/conffet.png" alt="https://cdn.29bet.com/assets/img/conffet.png">
            </div>
        </div>

        <div id="promoCodeContainer" class="row row-cols-lg-4 row-md-3 row-cols-sm-2 row-cols-1 justify-content-center mt-5">

            <!-- Uncomment Below Code If You Don't Have Sample Promo Database -->

             <!-- <div class="cat--novidades filterDiv col my-3">
                <div class="bonus_card">
                    <div class="bonus_card--dados">
                        <div class="bonus_card--img">
                            <img class="bonus_card--conffet animation-top" src="https://cdn.29bet.com/assets/img/all/components/sidebar/conffet-gift.png" alt="https://cdn.29bet.com/assets/img/all/components/sidebar/conffet-gift.png">
                            <img src="https://cdn.29bet.com/assets/img/free_gift.png" alt="https://cdn.29bet.com/assets/img/free_gift.png">
                        </div>
                        <div class="d-flex justify-content-center bonus_card--titulo mt-2">{{ __('Promotional code')}}: 123456</div>
                        <div class="d-flex justify-content-center mb-4">
                            <p>{{ __('Value')}}:
                                R$<strong>1</strong>
                            </p>
                        </div>
                        <div class="bonus_card--btn"><button type="button" class="bonus_card--claim-btn btn-claim" id="deposit" name="btn-deposit">{{ __('Claim Bonus')}}</button></div>
                    </div>
                </div>
            </div>

            <div class="cat--novidades filterDiv col my-3">
                <div class="bonus_card">
                    <div class="bonus_card--dados">
                        <div class="bonus_card--img">
                            <img class="bonus_card--conffet animation-top" src="https://cdn.29bet.com/assets/img/all/components/sidebar/conffet-gift.png" alt="https://cdn.29bet.com/assets/img/all/components/sidebar/conffet-gift.png">
                            <img src="{{ asset('img/free_gift.png') }}" alt="{{ asset('img/free_gift.png') }}">
                        </div>
                        <div class="d-flex justify-content-center bonus_card--titulo mt-2">{{ __('Promotional code')}}: 6521321</div>
                        <div class="d-flex justify-content-center mb-4">
                            <p>{{ __('Value')}}:
                                R$<strong>10</strong>
                            </p>
                        </div>
                        <div class="bonus_card--btn"><button class="bonus_card--claim-btn btn-claim" id="deposit" name="btn-deposit">{{ __('Claim Bonus')}}</button></div>
                    </div>
                </div>
            </div>

            <div class="cat--novidades filterDiv col my-3">
                <div class="bonus_card">
                    <div class="bonus_card--dados">
                        <div class="bonus_card--img">
                            <img class="bonus_card--conffet animation-top" src="https://cdn.29bet.com/assets/img/all/components/sidebar/conffet-gift.png" alt="https://cdn.29bet.com/assets/img/all/components/sidebar/conffet-gift.png">
                            <img src="https://cdn.29bet.com/assets/img/free_gift.png" alt="https://cdn.29bet.com/assets/img/free_gift.png">
                        </div>
                        <div class="d-flex justify-content-center bonus_card--titulo mt-2">{{ __('Promotional code')}}: 61883</div>
                        <div class="d-flex justify-content-center mb-4">
                            <p>{{ __('Value')}}:
                                R$<strong>20</strong>
                            </p>
                        </div>
                        <div class="bonus_card--btn"><button class="bonus_card--claim-btn btn-claim" id="deposit" name="btn-deposit">{{ __('Claim Bonus')}}</button></div>
                    </div>
                </div>
            </div>

            <div class="cat--novidades filterDiv col my-3">
                <div class="bonus_card">
                    <div class="bonus_card--dados">
                        <div class="bonus_card--img">
                            <img class="bonus_card--conffet animation-top" src="https://cdn.29bet.com/assets/img/all/components/sidebar/conffet-gift.png" alt="https://cdn.29bet.com/assets/img/all/components/sidebar/conffet-gift.png">
                            <img src="{{ asset('img/free_gift.png') }}" alt="{{ asset('img/free_gift.png') }}">
                        </div>
                        <div class="d-flex justify-content-center bonus_card--titulo mt-2">{{ __('Promotional code')}}: 158899</div>
                        <div class="d-flex justify-content-center mb-4">
                            <p>{{ __('Value')}}:
                                R$<strong>15</strong>
                            </p>
                        </div>
                        <div class="bonus_card--btn"><button class="bonus_card--claim-btn btn-claim" id="deposit" name="btn-bonus">{{ __('Claim Bonus')}}</button></div>
                    </div>
                </div>
            </div> -->

        </div>


    </section>

    <script>

        $(document).ready(function() {

            const token = $('meta[name=csrf-token]').attr('content');
            $.ajax({
                url: '{{route("user_promo")}}',
                type: 'GET',
                headers: {
                    'Content-Type': 'appication/json',
                    'X-CSRF-TOKEN': token,
                    'Authorization': 'Bearer ' + token
                },
                success: function(response) {
                    response.forEach(function(promoCode) {

                        var img_confetti = "https://cdn.29bet.com/assets/img/all/components/sidebar/conffet-gift.png";
                        var img_gift = "https://cdn.29bet.com/assets/img/free_gift.png";
                        var promoImgContainer = $('<div>', {
                            class: 'bonus_card--img',
                            html: '<img class="bonus_card--conffet animation-top" src="' + img_confetti + '"><img src="' + img_gift + '" >'
                        });
                        var promoCodeContainer = $('<div>', {
                            class: 'cat--novidades filterDiv col my-3'
                        });
                        var bonusCardContainer = $('<div>', {
                            class: 'bonus_card'
                        });
                        var bonusCardDataContainer = $('<div>', {
                            class: 'bonus_card--dados'
                        });
                        var promoCodeElementText = $('<div>', {
                            class: 'd-flex justify-content-center bonus_card--titulo mt-2',
                            text: '{{ __("Promotional code")}}:'
                        });
                        var promoCodeElement = $('<div>', {
                            class: 'd-flex justify-content-center bonus_card--titulo mt-2',
                            text: promoCode.promo_code
                        });
                        var bonusAmountElement = $('<div>', {
                            class: 'd-flex justify-content-center mb-4',
                            html: '{{ __("Amount: ")}}R$<strong>' + promoCode.amount + '</strong>'
                        });
                        var bonusCardButtonContainer = $('<div>', {
                            class: 'bonus_card--btn'
                        });
                        var buttonId = 'claimButton-' + promoCode.promo_rule_id;
                        var button = $('<button>', {
                            class: 'bonus_card--claim-btn btn-claim',
                            id: buttonId,
                            name: 'btn-bonus',
                            text: 'Claim Bonus',
                            click: function() {
                                var promoCodeId = promoCode.promo_rule_id;
                                var claimCode = promoCode.promo_code;
                                var amount = promoCode.amount;
                                ClickPromoCode(promoCodeId, claimCode, amount);
                            }
                        });

                        bonusCardButtonContainer.append(button);
                        bonusCardDataContainer.append(promoImgContainer);
                        bonusCardDataContainer.append(promoCodeElementText);
                        bonusCardDataContainer.append(promoCodeElement);
                        bonusCardDataContainer.append(bonusAmountElement);
                        bonusCardDataContainer.append(bonusCardButtonContainer);
                        bonusCardContainer.append(bonusCardDataContainer);
                        promoCodeContainer.append(bonusCardContainer);

                        $('#promoCodeContainer').append(promoCodeContainer);

                    });

                }

            });

            function ClickPromoCode(promoCodeId, claimCode, amount){

                $('#YesButton').off('click').on('click', function() {

                    claimPromoCode(promoCodeId, claimCode, amount);
                    $('#ConfirmAlert').toggleClass('md-show', false);

                });

                $(document).on('mouseup', function(event) {

                    if ($('#ConfirmAlert').has(event.target).length === 0) {

                        $('#ConfirmAlert').toggleClass('md-show', false);

                    }

                });

                $(document).on('keydown', function(event) {

                    if (event.keyCode === 27) {

                        $('#ConfirmAlert').toggleClass('md-show', false);

                    }

                });

                $('#ConfirmAlert').toggleClass('md-show', true);

            }

             $('.btn-claim').click(function() {

                 $(document).on('mouseup', function(event) {

                     if ($('#ConfirmAlert').has(event.target).length === 0) {

                         $('#ConfirmAlert').toggleClass('md-show', false);

                     }

                 });

                 $(document).on('keydown', function(event) {

                    if (event.keyCode === 27) {

                        $('#ConfirmAlert').toggleClass('md-show', false);

                    }

                 });

                 $('#ConfirmAlert').toggleClass('md-show', true);

            });

            $('#NoButton').click(function() {

                $('#ConfirmAlert').toggleClass('md-show', false);

            });

            function claimPromoCode(promo_rule_id, promo_code, amount) {

                $.ajax({

                    url: '{{route("claim_bonus")}}',
                    type: 'POST',
                    data: {
                        '_token': $('meta[name=csrf-token]').attr('content'),
                        promo_rule_id: promo_rule_id,
                        promo_code: promo_code
                    },
                    success: function(response) {

                        if (response.status == true) {

                            var new_balance = response.new_balance;
                            $('#money').html(new_balance.toFixed(2));
                            $('#money').attr('data-current-balance', new_balance.toFixed(2));
                            $('#money_update').html("+$" + amount);
                            $('#money_update').css('color', "yellow");
                            $('#div_money_update').css('display', "block");
                            $('.btn-claim').prop('disabled', true);
                            iziToast.success({

                                message: response.success_message,
                                position: 'center',
                                icon: "fa fa-times",
                                timeout: 3000,
                                pauseOnHover: false,
                                closeOnEscape: true,
                                closeOnClick: true,
                                onClosed: function() {

                                    $('#div_money_update').css('dsiplay', 'none');
                                    window.location.reload();

                                }

                            });

                        }else{

                            $('#div_money_update').css('display', "block");
                            $('.btn-claim').prop('disabled', true);
                            iziToast.error({

                                message: response.error_message,
                                position: 'center',
                                icon: "fa fa-times",
                                timeout: 3000,
                                closeOnEscape: true,
                                closeOnClick: true,
                                onClosed: function() {

                                    $('#div_money_update').css('dsiplay', 'none');
                                    window.location.reload();

                                }

                            });

                        }

                    },
                    error: function() {
                        console.log('Error occurred during AJAX request');
                    }
                });

            }

        });

    </script>

    @if ($errors->first('error_title'))
        <script>
            var message = '{{ $errors->first("error_message") }}';
        iziToast.error({
            message: message,
            position: 'center',
            icon: "fa fa-times"
        });
        </script>
    @endif

@endsection
