@extends('welcome')
@section('css')
    <style>
        .game::before {
            background: linear-gradient(180deg, #2283f6, rgba(0, 9, 87, 0));
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
<div class="center__faq d-lg-flex  align-items-center">
    <div class="my-2">
        <h2 class="center__faq--title">{{ __('CENTER OF')}}<br><span>{{ __('DOUBTS')}}</span></h2>
        <p class="center__faq--description">
           {{ __('Welcome to our FAQ Center, where we are here to answer all your questions. Our team has carefully selected responses to ensure your concerns are addressed promptly. comprehensive way.')}}
        </p>
    </div>
    <div class="images__promotions d-md-block d-lg-block d-none">
        <img class="center__faq--image" src="https://cdn.29bet.com/assets/img/all/pages/layout/faq.png" alt="https://cdn.29bet.com/assets/img/all/pages/layout/faq.png">
    </div>
</div>
<div class="faq-qd mt-5">

    <div class="row">
        <div class="col-lg-3 d-lg-block d-none">
            <div class="center__faq__card">
                <a href="#topic1" class="center__faq__card--link active">{{ __('Registration and Account')}}</a>
                <a href="#topic2" class="center__faq__card--link">{{ __('Deposits and Withdrawals')}}</a>
                <a href="#topic3" class="center__faq__card--link">{{ __('Games and Promotions')}}</a>
                <a href="#topic4" class="center__faq__card--link">{{ __('Security and Privacy')}}</a>
                <a href="#topic5" class="center__faq__card--link">{{ __('Customer support')}}</a>
                <a href="#topic6" class="center__faq__card--link">{{__('Bonuses and Promotions')}}</a>
                <a href="#topic7" class="center__faq__card--link">{{ __('Responsible Gaming')}}</a>
                <a href="#topic8" class="center__faq__card--link">{{ __('Technology and Platform')}}</a>
                <a href="#topic9" class="center__faq__card--link">{{ __('Partnerships and Affiliates')}}</a>
            </div>
        </div>
        <div class="col-lg-9">
            <div class="window-body p-0">
                <div class="pb-5" id="topic1">
                    <h3 class="faq__accordion--title mb-2" >{{ __('Registration and Account')}}</h3>
                    <div id="accordion" class="ui-accordion ui-widget ui-helper-reset" role="tablist">

                        <div class="help-q ui-accordion-header ui-corner-top ui-accordion-header-collapsed  ui-state-default  ui-corner-all"
                            role="tab" id="ui-id-3" aria-controls="ui-id-4" aria-selected="false" aria-expanded="false"
                            tabindex="-1">
                            {{__('How can I register with 29Bet?')}}
                        </div>
                        <div class="help-a ui-accordion-content ui-corner-bottom ui-helper-reset ui-widget-content"
                            id="ui-id-4" aria-labelledby="ui-id-3" role="tabpanel" aria-hidden="true"
                            style="display: none;">
                            {{__('To register with 29Bet, click on the “Register” button in the top right corner of the home page and follow the instructions provided.')}}
                        </div>

                        <div class="help-q ui-accordion-header ui-corner-top ui-accordion-header-collapsed  ui-state-default ui-accordion-icons ui-corner-all mt-3"
                            role="tab" id="ui-id-3" aria-controls="ui-id-4" aria-selected="false" aria-expanded="false"
                            tabindex="-1">
                                {{__('What documents are needed to verify my account?')}}
                        </div>
                        <div class="help-a ui-accordion-content ui-corner-bottom ui-helper-reset ui-widget-content"
                            id="ui-id-4" aria-labelledby="ui-id-3" role="tabpanel" aria-hidden="true"
                            style="display: none;">
                            {{__('For account verification, we typically require a valid CPF number and SMS number verification.')}}
                        </div>

                        <div class="help-q ui-accordion-header ui-corner-top ui-accordion-header-collapsed  ui-state-default ui-accordion-icons ui-corner-all mt-3
                            role="tab" id="ui-id-35" aria-controls="ui-id-36" aria-selected="false" aria-expanded="false" tabindex="-1">
                            {{__('How do I reset my password?')}}
                        </div>
                        <div class="help-a ui-accordion-content ui-corner-bottom ui-helper-reset ui-widget-content"
                            id="ui-id-36" aria-labelledby="ui-id-35" role="tabpanel" aria-hidden="true"style="display: none;">
                            <p class="help-a__text">
                                {{__('To reset your password, go to your personal center page and click "Change my password". Follow the instructions to create a new password')}}
                            </p>
                        </div>

                        <div class="help-q ui-accordion-header ui-corner-top ui-accordion-header-collapsed  ui-state-default ui-accordion-icons ui-corner-all mt-3"
                            role="tab" id="ui-id-35" aria-controls="ui-id-36" aria-selected="false"
                            aria-expanded="false" tabindex="-1">
                                {{__('What is the minimum age to register with 29Bet?')}}
                        </div>
                        <div class="help-a ui-accordion-content ui-corner-bottom ui-helper-reset ui-widget-content"
                            id="ui-id-36" aria-labelledby="ui-id-35" role="tabpanel" aria-hidden="true"
                            style="display: none;">
                            <p class="help-a__text">
                                {{__('You must be at least 18 years of age to register and play at 29Bet. We will verify your age during the registration process.')}}
                            </p>
                        </div>

                        <div class="help-q ui-accordion-header ui-corner-top ui-accordion-header-collapsed  ui-state-default ui-accordion-icons ui-corner-all mt-3"
                            role="tab" id="ui-id-33" aria-controls="ui-id-34" aria-selected="false"
                            aria-expanded="false" tabindex="-1">
                            {{__('How long does it take to verify my account?')}}
                        </div>
                        <div class="help-a ui-accordion-content ui-corner-bottom ui-helper-reset ui-widget-content"
                            id="ui-id-34" aria-labelledby="ui-id-33" role="tabpanel" aria-hidden="true" style="display: none;">
                            <p class="help-a__text">
                                {{__('Typically, the verification process and acceptance at the same time after account registration')}}
                            </p>
                        </div>

                        <div class="help-q ui-accordion-header ui-corner-top ui-accordion-header-collapsed  ui-state-default ui-accordion-icons ui-corner-all mt-3"
                            role="tab" id="ui-id-3" aria-controls="ui-id-4" aria-selected="false" aria-expanded="false" tabindex="-1">
                            {{__('How to play?')}}
                        </div>
                        <div class="help-a ui-accordion-content ui-corner-bottom ui-helper-reset ui-widget-content"
                            id="ui-id-4" aria-labelledby="ui-id-3" role="tabpanel" aria-hidden="true"
                            style="display: none;">
                            {{__('Go to the page of any game, click on the button with the icon')}}
                            <i class="g_sidebar_footer_button tooltip" title="{{ __('Game information')}}">
                                <svg width="15" height="15" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M10 1.25C5.16745 1.25 1.25 5.16745 1.25 10C1.25 14.8325 5.16745 18.75 10 18.75C14.8325 18.75 18.75 14.8325 18.75 10C18.75 5.16745 14.8325 1.25 10 1.25ZM10.2574 14.5791C10.093 14.7564 9.85964 14.845 9.55594 14.845C9.2526 14.845 9.01964 14.7585 8.8574 14.5854C8.69515 14.4121 8.61385 14.1698 8.61385 13.858C8.61385 13.2128 8.92776 12.8904 9.55594 12.8904C9.86365 12.8904 10.0984 12.9746 10.261 13.1435C10.4236 13.3123 10.5046 13.5504 10.5046 13.858C10.5046 14.1614 10.4218 14.4016 10.2574 14.5791ZM12.5426 8.32401C12.4485 8.57411 12.3064 8.81219 12.116 9.0386C11.9257 9.265 11.5983 9.55995 11.1328 9.92307C10.7354 10.2348 10.4692 10.4933 10.3347 10.6985C10.2209 10.8717 10.1586 11.0981 10.1411 11.3719C10.14 11.3778 10.1382 11.3796 10.1371 11.3854C10.0605 11.8167 9.55959 11.8138 9.55959 11.8138H9.29635C9.29635 11.8138 8.86067 11.7453 8.87709 11.4037C8.87709 10.9337 8.9624 10.5429 9.13339 10.2308C9.30437 9.9187 9.6037 9.5964 10.0306 9.26318C10.5392 8.8614 10.8666 8.54969 11.0139 8.32765C11.1612 8.10562 11.2352 7.84057 11.2352 7.53286C11.2352 7.17411 11.1156 6.89849 10.8765 6.70599C10.6373 6.51349 10.2931 6.4176 9.84469 6.4176C9.43854 6.4176 9.06265 6.47521 8.71666 6.59078C8.52781 6.65385 8.34224 6.72531 8.15813 6.80224C8.15411 6.8037 8.15265 6.80296 8.14828 6.80479C7.72318 6.96923 7.52594 6.6349 7.52594 6.6349L7.35896 6.28526C7.35896 6.28526 7.17084 5.85615 7.58865 5.66839C8.33349 5.32786 9.12135 5.15577 9.95334 5.15577C10.7904 5.15577 11.4551 5.36104 11.9462 5.7712C12.4372 6.18135 12.683 6.74755 12.683 7.46943C12.6834 7.78916 12.6362 8.07428 12.5426 8.32401Z" fill="currentColor"/>
                                </svg>
                            </i>.
                                 {{__('A window with instructions for the game will open in front of you, then enter the bet amount and click Play.')}}
                        </div>
                    </div>
                </div>

                <div class="pb-5" id="topic2">
                    <h3 class="faq__accordion--title mb-2">{{ __('Deposits and Withdrawals')}}</h3>
                    <div id="accordion2" class="ui-accordion ui-widget ui-helper-reset" role="tablist">
                        <div class="help-q ui-accordion-header ui-corner-top ui-accordion-header-collapsed  ui-state-default ui-accordion-icons ui-corner-all"
                            role="tab" id="ui-id-3" aria-controls="ui-id-4" aria-selected="false" aria-expanded="false"
                            tabindex="-1">
                            {{__('What payment methods does 29Bet accept deposits?')}}
                        </div>
                        <div class="help-a ui-accordion-content ui-corner-bottom ui-helper-reset ui-widget-content"
                            id="ui-id-4" aria-labelledby="ui-id-3" role="tabpanel" aria-hidden="true"
                            style="display: none;">{{__('We accept payments through pix. Secure and fast payment, immediate approval')}}
                        </div>

                        <div class="help-q ui-accordion-header ui-corner-top ui-accordion-header-collapsed  ui-state-default ui-accordion-icons ui-corner-all mt-3"
                            role="tab" id="ui-id-3" aria-controls="ui-id-4" aria-selected="false" aria-expanded="false"
                            tabindex="-1">
                            {{__('What is the minimum amount to make a withdrawal?')}}
                        </div>
                        <div class="help-a ui-accordion-content ui-corner-bottom ui-helper-reset ui-widget-content"
                            id="ui-id-4" aria-labelledby="ui-id-3" role="tabpanel" aria-hidden="true"
                            style="display: none;">
                            {{__('The minimum amount for withdrawals at 29Bet varies according to the chosen payment method. See our terms and conditions for precise details.')}}
                        </div>
                        <div class="help-q ui-accordion-header ui-corner-top ui-accordion-header-collapsed  ui-state-default ui-accordion-icons ui-corner-all mt-3"
                            role="tab" id="ui-id-3" aria-controls="ui-id-4" aria-selected="false" aria-expanded="false" tabindex="-1">
                            {{__('How long does it take to process a withdrawal?')}}
                        </div>
                        <div class="help-a ui-accordion-content ui-corner-bottom ui-helper-reset ui-widget-content" id="ui-id-4" aria-labelledby="ui-id-3" role="tabpanel" aria-hidden="true" style="display: none;">
                            {{__("Withdrawal processing time may vary depending on the payment method chosen. It usually takes 1-5 business days.")}}
                        </div>

                        <div class="help-q ui-accordion-header ui-corner-top ui-accordion-header-collapsed  ui-state-default ui-accordion-icons ui-corner-all mt-3"
                            role="tab" id="ui-id-35" aria-controls="ui-id-36" aria-selected="false" aria-expanded="false" tabindex="-1">
                                {{__('Can I cancel a pending withdrawal?')}}
                        </div>
                        <div class="help-a ui-accordion-content ui-corner-bottom ui-helper-reset ui-widget-content"
                            id="ui-id-36" aria-labelledby="ui-id-35" role="tabpanel" aria-hidden="true"
                            style="display: none;">
                            <p class="help-a__text">
                                {{__('Yes, as long as the withdrawal has not yet been processed, you can cancel it by contacting support')}}
                            </p>
                        </div>

                        <div class="help-q ui-accordion-header ui-corner-top ui-accordion-header-collapsed  ui-state-default ui-accordion-icons ui-corner-all mt-3"
                            role="tab" id="ui-id-35" aria-controls="ui-id-36" aria-selected="false" aria-expanded="false" tabindex="-1">
                                {{__('Are there fees for deposits or withdrawals?')}}
                        </div>
                        <div class="help-a ui-accordion-content ui-corner-bottom ui-helper-reset ui-widget-content" id="ui-id-36" aria-labelledby="ui-id-35" role="tabpanel" aria-hidden="true" style="display: none;">
                            <p class="help-a__text">
                                {{__('29Bet does not charge additional fees for deposits or withdrawals, but payment methods may have their own fees.')}}
                            </p>
                        </div>

                        <div class="help-q ui-accordion-header ui-corner-top ui-accordion-header-collapsed  ui-state-default ui-accordion-icons ui-corner-all mt-3"
                            role="tab" id="ui-id-33" aria-controls="ui-id-34" aria-selected="false" aria-expanded="false" tabindex="-1">
                                {{__('Is it safe to provide my payment information?')}}
                        </div>
                        <div class="help-a ui-accordion-content ui-corner-bottom ui-helper-reset ui-widget-content" id="ui-id-34" aria-labelledby="ui-id-33" role="tabpanel" aria-hidden="true" style="display: none;">
                            <p class="help-a__text">
                                {{__('IYes, your payment information is encrypted and kept secure according to the highest industry security standards.')}}
                            </p>
                        </div>
                    </div>
                </div>

                <div class="pb-5" id="topic3">
                    <h3 class="faq__accordion--title mb-2">{{ __('Games and Promotions')}}</h3>
                    <div id="accordion3" class="ui-accordion ui-widget ui-helper-reset " role="tablist">
                        <div class="help-q ui-accordion-header ui-corner-top ui-accordion-header-collapsed  ui-state-default ui-accordion-icons ui-corner-all" role="tab" id="ui-id-3" aria-controls="ui-id-4" aria-selected="false" aria-expanded="false" tabindex="-1">
                                {{__('What types of games are available at 29Bet?')}}
                        </div>
                        <div class="help-a ui-accordion-content ui-corner-bottom ui-helper-reset ui-widget-content"
                            id="ui-id-4" aria-labelledby="ui-id-3" role="tabpanel" aria-hidden="true" style="display: none;">
                            {{__("We offer a wide selection of games including slots, table games, poker and much more. Check out our games page for the full list.")}}
                        </div>

                        <div class="help-q ui-accordion-header ui-corner-top ui-accordion-header-collapsed  ui-state-default ui-accordion-icons ui-corner-all mt-3" role="tab" id="ui-id-35" aria-controls="ui-id-36" aria-selected="false" aria-expanded="false" tabindex="-1">
                                {{__('How can I participate in 29Bet promotions?')}}
                        </div>
                        <div class="help-a ui-accordion-content ui-corner-bottom ui-helper-reset ui-widget-content"
                            id="ui-id-36" aria-labelledby="ui-id-35" role="tabpanel" aria-hidden="true" style="display: none;">
                            <p class="help-a__text">
                                {{__('To participate in promotions, simply check our promotions page and follow the specific instructions for each offer.')}}
                            </p>
                        </div>

                        <div class="help-q ui-accordion-header ui-corner-top ui-accordion-header-collapsed  ui-state-default ui-accordion-icons ui-corner-all mt-3"
                            role="tab" id="ui-id-35" aria-controls="ui-id-36" aria-selected="false" aria-expanded="false" tabindex="-1">
                                {{__('What are the wagering requirements for the bonuses?')}}
                        </div>
                        <div class="help-a ui-accordion-content ui-corner-bottom ui-helper-reset ui-widget-content"
                            id="ui-id-36" aria-labelledby="ui-id-35" role="tabpanel" aria-hidden="true" style="display: none;">
                            <p class="help-a__text">
                                {{__('Wagering requirements may vary depending on the promotion. Please see the terms and conditions of each offer for specific details.')}}
                            </p>
                        </div>

                        <div class="help-q ui-accordion-header ui-corner-top ui-accordion-header-collapsed  ui-state-default ui-accordion-icons ui-corner-all mt-3"
                            role="tab" id="ui-id-33" aria-controls="ui-id-34" aria-selected="false" aria-expanded="false" tabindex="-1">
                                {{__('Can I play live casino games at 29Bet?')}}
                        </div>
                        <div class="help-a ui-accordion-content ui-corner-bottom ui-helper-reset ui-widget-content"
                            id="ui-id-34" aria-labelledby="ui-id-33" role="tabpanel" aria-hidden="true" style="display: none;">
                            <p class="help-a__text">
                                {{__('Yes, we offer a variety of live casino games where you can play with real dealers in real time.')}}
                            </p>
                        </div>

                        <div class="help-q ui-accordion-header ui-corner-top ui-accordion-header-collapsed  ui-state-default ui-accordion-icons ui-corner-all mt-3"
                            role="tab" id="ui-id-3" aria-controls="ui-id-4" aria-selected="false" aria-expanded="false" tabindex="-1">
                            {{__('How does the 29Bet loyalty program work?')}}
                        </div>
                        <div class="help-a ui-accordion-content ui-corner-bottom ui-helper-reset ui-widget-content"
                            id="ui-id-4" aria-labelledby="ui-id-3" role="tabpanel" aria-hidden="true" style="display: none;">
                            {{__('Our loyalty program rewards players with points that can be redeemed for bonuses and prizes. The more you play, the more points you accumulate.')}}
                        </div>

                        <div class="help-q ui-accordion-header ui-corner-top ui-accordion-header-collapsed  ui-state-default ui-accordion-icons ui-corner-all mt-3"
                            role="tab" id="ui-id-3" aria-controls="ui-id-4" aria-selected="false" aria-expanded="false" tabindex="-1">
                            {{__('Is there a limit to how much I can win playing at 29Bet?')}}
                        </div>
                        <div class="help-a ui-accordion-content ui-corner-bottom ui-helper-reset ui-widget-content"
                            id="ui-id-4" aria-labelledby="ui-id-3" role="tabpanel" aria-hidden="true" style="display: none;">
                            {{__('There are no hard limits on winnings, but some games may have specific betting limits. Check the game terms for detailed information.')}}
                        </div>
                    </div>
                </div>

                <div class="pb-5" id="topic4">
                    <h3 class="faq__accordion--title mb-2">{{ __('Security and Privacy')}}</h3>
                    <div id="accordion4" class="ui-accordion ui-widget ui-helper-reset " role="tablist">
                        <div class="help-q ui-accordion-header ui-corner-top ui-accordion-header-collapsed  ui-state-default ui-accordion-icons ui-corner-all"
                            role="tab" id="ui-id-3" aria-controls="ui-id-4" aria-selected="false" aria-expanded="false" tabindex="-1">
                            {{__('How does 29Bet protect my personal data?')}}
                        </div>
                        <div class="help-a ui-accordion-content ui-corner-bottom ui-helper-reset ui-widget-content"
                            id="ui-id-4" aria-labelledby="ui-id-3" role="tabpanel" aria-hidden="true"
                            style="display: none;">
                            {{__('We use advanced encryption to protect your personal information and ensure the security of player data.')}}
                        </div>

                        <div class="help-q ui-accordion-header ui-corner-top ui-accordion-header-collapsed  ui-state-default ui-accordion-icons ui-corner-all mt-3"
                            role="tab" id="ui-id-3" aria-controls="ui-id-4" aria-selected="false" aria-expanded="false" tabindex="-1">
                                {{__('What is 29Bet´s privacy policy?')}}
                        </div>
                        <div class="help-a ui-accordion-content ui-corner-bottom ui-helper-reset ui-widget-content"
                            id="ui-id-4" aria-labelledby="ui-id-3" role="tabpanel" aria-hidden="true" style="display: none;">
                            {{__("Our privacy policy can be found in the Policies section on our website. It describes how we handle your personal information.")}}
                        </div>

                        <div class="help-q ui-accordion-header ui-corner-top ui-accordion-header-collapsed  ui-state-default ui-accordion-icons ui-corner-all mt-3"
                            role="tab" id="ui-id-35" aria-controls="ui-id-36" aria-selected="false" aria-expanded="false" tabindex="-1">
                                {{__('Are 29Bet games fair?')}}
                        </div>
                        <div class="help-a ui-accordion-content ui-corner-bottom ui-helper-reset ui-widget-content"
                            id="ui-id-36" aria-labelledby="ui-id-35" role="tabpanel" aria-hidden="true" style="display: none;">
                            <p class="help-a__text">
                                {{__('Yes, all of our games undergo rigorous testing to ensure randomness and fairness. We work with trusted casino software providers.')}}
                            </p>
                        </div>

                        <div class="help-q ui-accordion-header ui-corner-top ui-accordion-header-collapsed  ui-state-default ui-accordion-icons ui-corner-all mt-3"
                            role="tab" id="ui-id-35" aria-controls="ui-id-36" aria-selected="false" aria-expanded="false" tabindex="-1">
                                {{__('How to report suspicious activity at 29Bet?')}}
                        </div>
                        <div class="help-a ui-accordion-content ui-corner-bottom ui-helper-reset ui-widget-content"
                            id="ui-id-36" aria-labelledby="ui-id-35" role="tabpanel" aria-hidden="true" style="display: none;">
                            <p class="help-a__text">
                                {{__('If you notice suspicious activity or believe fraud is occurring, please contact our support team immediately to report the issue.')}}
                            </p>
                        </div>

                        <div class="help-q ui-accordion-header ui-corner-top ui-accordion-header-collapsed  ui-state-default ui-accordion-icons ui-corner-all mt-3"
                            role="tab" id="ui-id-33" aria-controls="ui-id-34" aria-selected="false" aria-expanded="false" tabindex="-1">
                                {{__('What measures does 29Bet take against compulsive gambling?')}}
                        </div>
                        <div class="help-a ui-accordion-content ui-corner-bottom ui-helper-reset ui-widget-content"
                            id="ui-id-34" aria-labelledby="ui-id-33" role="tabpanel" aria-hidden="true" style="display: none;">
                            <p class="help-a__text">
                                {{__('We take the issue of compulsive gambling seriously. We have self-exclusion measures and deposit limits to help protect our players.')}}
                            </p>
                        </div>

                        <div class="help-q ui-accordion-header ui-corner-top ui-accordion-header-collapsed  ui-state-default ui-accordion-icons ui-corner-all mt-3"
                            role="tab" id="ui-id-3" aria-controls="ui-id-4" aria-selected="false" aria-expanded="false" tabindex="-1">
                            {{__('Can I trust the fairness of casino game results?')}}
                        </div>
                        <div class="help-a ui-accordion-content ui-corner-bottom ui-helper-reset ui-widget-content"
                            id="ui-id-4" aria-labelledby="ui-id-3" role="tabpanel" aria-hidden="true" style="display: none;">
                            {{__('Yes, all of our games use certified random number generators to ensure fair and unbiased results.')}}
                        </div>
                    </div>
                </div>

                <div class="pb-5" id="topic5">
                    <h3 class="faq__accordion--title mb-2">{{ __('Customer support')}}</h3>
                    <div id="accordion5" class="ui-accordion ui-widget ui-helper-reset " role="tablist">
                        <div class="help-q ui-accordion-header ui-corner-top ui-accordion-header-collapsed  ui-state-default ui-accordion-icons ui-corner-all"
                            role="tab" id="ui-id-3" aria-controls="ui-id-4" aria-selected="false" aria-expanded="false" tabindex="-1">
                            {{__('How can I contact 29Bet customer support?')}}
                        </div>
                        <div class="help-a ui-accordion-content ui-corner-bottom ui-helper-reset ui-widget-content"
                            id="ui-id-4" aria-labelledby="ui-id-3" role="tabpanel" aria-hidden="true"
                            style="display: none;">
                            {{__('You can contact our support team 24/7 via live chat, email or phone.')}}
                        </div>

                        <div class="help-q ui-accordion-header ui-corner-top ui-accordion-header-collapsed  ui-state-default ui-accordion-icons ui-corner-all mt-3"
                            role="tab" id="ui-id-3" aria-controls="ui-id-4" aria-selected="false" aria-expanded="false" tabindex="-1">
                                {{__('What is the average customer support response time?')}}
                        </div>
                        <div class="help-a ui-accordion-content ui-corner-bottom ui-helper-reset ui-widget-content"
                            id="ui-id-4" aria-labelledby="ui-id-3" role="tabpanel" aria-hidden="true" style="display: none;">
                            {{__("We typically respond to inquiries within minutes on live chat and within a few hours via email.")}}
                        </div>

                        <div class="help-q ui-accordion-header ui-corner-top ui-accordion-header-collapsed  ui-state-default ui-accordion-icons ui-corner-all mt-3"
                            role="tab" id="ui-id-35" aria-controls="ui-id-36" aria-selected="false" aria-expanded="false" tabindex="-1">
                                {{__('Is 29Bet customer support available in other languages?')}}
                        </div>
                        <div class="help-a ui-accordion-content ui-corner-bottom ui-helper-reset ui-widget-content"
                            id="ui-id-36" aria-labelledby="ui-id-35" role="tabpanel" aria-hidden="true" style="display: none;">
                            <p class="help-a__text">
                                {{__('Yes, we offer support in multiple languages ​​to meet the needs of our international players.')}}
                            </p>
                        </div>

                        <div class="help-q ui-accordion-header ui-corner-top ui-accordion-header-collapsed  ui-state-default ui-accordion-icons ui-corner-all mt-3"
                            role="tab" id="ui-id-35" aria-controls="ui-id-36" aria-selected="false" aria-expanded="false" tabindex="-1">
                                {{__('Can I get help if I have a problem with a specific game?')}}
                        </div>
                        <div class="help-a ui-accordion-content ui-corner-bottom ui-helper-reset ui-widget-content"
                            id="ui-id-36" aria-labelledby="ui-id-35" role="tabpanel" aria-hidden="true" style="display: none;">
                            <p class="help-a__text">
                                {{__('Of course, our support team can help resolve any issues you may encounter with our games.')}}
                            </p>
                        </div>

                        <div class="help-q ui-accordion-header ui-corner-top ui-accordion-header-collapsed  ui-state-default ui-accordion-icons ui-corner-all mt-3"
                            role="tab" id="ui-id-33" aria-controls="ui-id-34" aria-selected="false" aria-expanded="false" tabindex="-1">
                                {{__('Is there a Frequently Asked Questions (FAQ) section on the website?')}}
                        </div>
                        <div class="help-a ui-accordion-content ui-corner-bottom ui-helper-reset ui-widget-content"
                            id="ui-id-34" aria-labelledby="ui-id-33" role="tabpanel" aria-hidden="true" style="display: none;">
                            <p class="help-a__text">
                                {{__('Yes, we have a comprehensive FAQ section on our website that can answer many of the common player questions.')}}
                            </p>
                        </div>

                        <div class="help-q ui-accordion-header ui-corner-top ui-accordion-header-collapsed  ui-state-default ui-accordion-icons ui-corner-all mt-3"
                            role="tab" id="ui-id-3" aria-controls="ui-id-4" aria-selected="false" aria-expanded="false" tabindex="-1">
                            {{__('Does 29Bet offer support for players with special needs?')}}
                        </div>
                        <div class="help-a ui-accordion-content ui-corner-bottom ui-helper-reset ui-widget-content"
                            id="ui-id-4" aria-labelledby="ui-id-3" role="tabpanel" aria-hidden="true" style="display: none;">
                            {{__('We are committed to providing appropriate support for players with special needs. Please contact our support team to discuss how we can help.')}}
                        </div>
                    </div>
                </div>

                <div class="pb-5" id="topic6">
                    <h3 class="faq__accordion--title mb-2">{{ __('Bonuses and Promotions')}}</h3>
                    <div id="accordion6" class="ui-accordion ui-widget ui-helper-reset " role="tablist">
                        <div class="help-q ui-accordion-header ui-corner-top ui-accordion-header-collapsed  ui-state-default ui-accordion-icons ui-corner-all"
                            role="tab" id="ui-id-3" aria-controls="ui-id-4" aria-selected="false" aria-expanded="false" tabindex="-1">
                            {{__('How do 29Bet welcome bonuses work?')}}
                        </div>
                        <div class="help-a ui-accordion-content ui-corner-bottom ui-helper-reset ui-widget-content"
                            id="ui-id-4" aria-labelledby="ui-id-3" role="tabpanel" aria-hidden="true"
                            style="display: none;">
                            {{__('Our welcome bonuses are offered to new players as an incentive. They usually consist of deposit matching and free spins.')}}
                        </div>

                        <div class="help-q ui-accordion-header ui-corner-top ui-accordion-header-collapsed  ui-state-default ui-accordion-icons ui-corner-all mt-3"
                            role="tab" id="ui-id-3" aria-controls="ui-id-4" aria-selected="false" aria-expanded="false" tabindex="-1">
                                {{__('Can I accumulate multiple bonuses at the same time?')}}
                        </div>
                        <div class="help-a ui-accordion-content ui-corner-bottom ui-helper-reset ui-widget-content"
                            id="ui-id-4" aria-labelledby="ui-id-3" role="tabpanel" aria-hidden="true" style="display: none;">
                            {{__("Generally, bonuses cannot be accumulated. You must complete the wagering requirements for one bonus before claiming another.")}}
                        </div>

                        <div class="help-q ui-accordion-header ui-corner-top ui-accordion-header-collapsed  ui-state-default ui-accordion-icons ui-corner-all mt-3"
                            role="tab" id="ui-id-35" aria-controls="ui-id-36" aria-selected="false" aria-expanded="false" tabindex="-1">
                                {{__('What are wagering requirements?')}}
                        </div>
                        <div class="help-a ui-accordion-content ui-corner-bottom ui-helper-reset ui-widget-content"
                            id="ui-id-36" aria-labelledby="ui-id-35" role="tabpanel" aria-hidden="true" style="display: none;">
                            <p class="help-a__text">
                                {{__('Wagering requirements are conditions that you must meet in order to withdraw winnings obtained from a bonus. They vary depending on the promotion.')}}
                            </p>
                        </div>

                        <div class="help-q ui-accordion-header ui-corner-top ui-accordion-header-collapsed  ui-state-default ui-accordion-icons ui-corner-all mt-3"
                            role="tab" id="ui-id-35" aria-controls="ui-id-36" aria-selected="false" aria-expanded="false" tabindex="-1">
                                {{__('How can I check the status of an active bonus?')}}
                        </div>
                        <div class="help-a ui-accordion-content ui-corner-bottom ui-helper-reset ui-widget-content"
                            id="ui-id-36" aria-labelledby="ui-id-35" role="tabpanel" aria-hidden="true" style="display: none;">
                            <p class="help-a__text">
                                {{__('You can check the status of your bonus on the “bonus” page of the platform.')}}
                            </p>
                        </div>

                        <div class="help-q ui-accordion-header ui-corner-top ui-accordion-header-collapsed  ui-state-default ui-accordion-icons ui-corner-all mt-3"
                            role="tab" id="ui-id-33" aria-controls="ui-id-34" aria-selected="false" aria-expanded="false" tabindex="-1">
                                {{__('What happens if I don´t meet the wagering requirements?')}}
                        </div>
                        <div class="help-a ui-accordion-content ui-corner-bottom ui-helper-reset ui-widget-content"
                            id="ui-id-34" aria-labelledby="ui-id-33" role="tabpanel" aria-hidden="true" style="display: none;">
                            <p class="help-a__text">
                                {{__('If you do not meet the wagering requirements of a bonus, any winnings associated with it will be forfeited.')}}
                            </p>
                        </div>

                        <div class="help-q ui-accordion-header ui-corner-top ui-accordion-header-collapsed  ui-state-default ui-accordion-icons ui-corner-all mt-3"
                            role="tab" id="ui-id-3" aria-controls="ui-id-4" aria-selected="false" aria-expanded="false" tabindex="-1">
                            {{__('Does 29Bet offer loyalty programs?')}}
                        </div>
                        <div class="help-a ui-accordion-content ui-corner-bottom ui-helper-reset ui-widget-content"
                            id="ui-id-4" aria-labelledby="ui-id-3" role="tabpanel" aria-hidden="true" style="display: none;">
                            {{__('Yes, we have a loyalty program that rewards frequent players with exclusive benefits.')}}
                        </div>
                    </div>
                </div>

                <div class="pb-5" id="topic7">
                    <h3 class="faq__accordion--title mb-2">{{ __('Responsible Gaming')}}</h3>
                    <div id="accordion7" class="ui-accordion ui-widget ui-helper-reset " role="tablist">
                        <div class="help-q ui-accordion-header ui-corner-top ui-accordion-header-collapsed  ui-state-default ui-accordion-icons ui-corner-all"
                            role="tab" id="ui-id-3" aria-controls="ui-id-4" aria-selected="false" aria-expanded="false" tabindex="-1">
                            {{__('How does 29Bet promote responsible gaming?')}}
                        </div>
                        <div class="help-a ui-accordion-content ui-corner-bottom ui-helper-reset ui-widget-content"
                            id="ui-id-4" aria-labelledby="ui-id-3" role="tabpanel" aria-hidden="true"
                            style="display: none;">
                            {{__('We promote responsible gaming by offering self-exclusion tools, deposit limits and resources to help players with problems.')}}
                        </div>

                        <div class="help-q ui-accordion-header ui-corner-top ui-accordion-header-collapsed  ui-state-default ui-accordion-icons ui-corner-all mt-3"
                            role="tab" id="ui-id-3" aria-controls="ui-id-4" aria-selected="false" aria-expanded="false" tabindex="-1">
                                {{__('What is self-exclusion?')}}
                        </div>
                        <div class="help-a ui-accordion-content ui-corner-bottom ui-helper-reset ui-widget-content"
                            id="ui-id-4" aria-labelledby="ui-id-3" role="tabpanel" aria-hidden="true" style="display: none;">
                            {{__("Self-exclusion is a measure that allows players to temporarily suspend their accounts to prevent excessive gambling.")}}
                        </div>

                        <div class="help-q ui-accordion-header ui-corner-top ui-accordion-header-collapsed  ui-state-default ui-accordion-icons ui-corner-all mt-3"
                            role="tab" id="ui-id-35" aria-controls="ui-id-36" aria-selected="false" aria-expanded="false" tabindex="-1">
                                {{__('How can I set deposit limits?')}}
                        </div>
                        <div class="help-a ui-accordion-content ui-corner-bottom ui-helper-reset ui-widget-content"
                            id="ui-id-36" aria-labelledby="ui-id-35" role="tabpanel" aria-hidden="true" style="display: none;">
                            <p class="help-a__text">
                                {{__('No')}}
                            </p>
                        </div>

                        <div class="help-q ui-accordion-header ui-corner-top ui-accordion-header-collapsed  ui-state-default ui-accordion-icons ui-corner-all mt-3"
                            role="tab" id="ui-id-35" aria-controls="ui-id-36" aria-selected="false" aria-expanded="false" tabindex="-1">
                                {{__('Does 29Bet support players with gambling problems?')}}
                        </div>
                        <div class="help-a ui-accordion-content ui-corner-bottom ui-helper-reset ui-widget-content"
                            id="ui-id-36" aria-labelledby="ui-id-35" role="tabpanel" aria-hidden="true" style="display: none;">
                            <p class="help-a__text">
                                {{__('Yes, we have resources and information available for players with gambling issues. Please contact our support team for assistance.')}}
                            </p>
                        </div>
                    </div>
                </div>

                <div class="pb-5" id="topic8">
                    <h3 class="faq__accordion--title mb-2">{{ __('Technology and Platform')}}</h3>
                    <div id="accordion8" class="ui-accordion ui-widget ui-helper-reset " role="tablist">
                        <div class="help-q ui-accordion-header ui-corner-top ui-accordion-header-collapsed  ui-state-default ui-accordion-icons ui-corner-all"
                            role="tab" id="ui-id-3" aria-controls="ui-id-4" aria-selected="false" aria-expanded="false" tabindex="-1">
                            {{__('Does 29Bet offer mobile games?')}}
                        </div>
                        <div class="help-a ui-accordion-content ui-corner-bottom ui-helper-reset ui-widget-content"
                            id="ui-id-4" aria-labelledby="ui-id-3" role="tabpanel" aria-hidden="true"
                            style="display: none;">
                            {{__('Yes, our platform is mobile-friendly, allowing you to play on smartphones and tablets.')}}
                        </div>

                        <div class="help-q ui-accordion-header ui-corner-top ui-accordion-header-collapsed  ui-state-default ui-accordion-icons ui-corner-all mt-3"
                            role="tab" id="ui-id-3" aria-controls="ui-id-4" aria-selected="false" aria-expanded="false" tabindex="-1">
                                {{__('Which browsers are supported by 29Bet?')}}
                        </div>
                        <div class="help-a ui-accordion-content ui-corner-bottom ui-helper-reset ui-widget-content"
                            id="ui-id-4" aria-labelledby="ui-id-3" role="tabpanel" aria-hidden="true" style="display: none;">
                            {{__("Our platform is compatible with most modern browsers, including Chrome, Firefox, Safari and Edge.")}}
                        </div>
                    </div>
                </div>

                <div class="pb-5" id="topic9">
                    <h3 class="faq__accordion--title mb-2">{{ __('Partnerships and Affiliates')}}</h3>
                    <div id="accordion10" class="ui-accordion ui-widget ui-helper-reset " role="tablist">
                        <div class="help-q ui-accordion-header ui-corner-top ui-accordion-header-collapsed  ui-state-default ui-accordion-icons ui-corner-all"
                            role="tab" id="ui-id-3" aria-controls="ui-id-4" aria-selected="false" aria-expanded="false" tabindex="-1">
                            {{__('Does 29Bet have an affiliate program?')}}
                        </div>
                        <div class="help-a ui-accordion-content ui-corner-bottom ui-helper-reset ui-widget-content"
                            id="ui-id-4" aria-labelledby="ui-id-3" role="tabpanel" aria-hidden="true"
                            style="display: none;">
                            {{__('Yes, we have an affiliate program that allows partners to earn commissions by referring players to our platform.')}}
                        </div>

                        <div class="help-q ui-accordion-header ui-corner-top ui-accordion-header-collapsed  ui-state-default ui-accordion-icons ui-corner-all mt-3"
                            role="tab" id="ui-id-3" aria-controls="ui-id-4" aria-selected="false" aria-expanded="false" tabindex="-1">
                                {{__('How can I become a 29Bet affiliate?')}}
                        </div>
                        <div class="help-a ui-accordion-content ui-corner-bottom ui-helper-reset ui-widget-content"
                            id="ui-id-4" aria-labelledby="ui-id-3" role="tabpanel" aria-hidden="true" style="display: none;">
                            {{__("Para se tornar um afiliado, visite nossa página de afiliados e siga as instruções para se inscrever.")}}
                        </div>

                    </div>
                </div>


            </div>
        </div>
    </div>
</div>
@endsection
