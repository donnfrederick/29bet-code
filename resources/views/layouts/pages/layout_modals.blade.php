@php
    $data = \App\Models\FreeSpin::getData();
@endphp

<style>
    .wheel__new__historic__item {
        background: url('https://cdn.29bet.com/assets/img/all/components/wheel-bonus/historic-wheel.webp');
    }

    .wheel__new__historic__item.big-prize p{
        font-size: 15px;
    }

    .wheel__new__historic__item.big-prize img{
        width: 17px;
    }

    .wheel__new__historic__item.jackpot p{
        font-size: 13px;
    }

    .wheel__new__historic__item.jackpot img{
        width: 19px;
    }
    </style>
    <div class="md-modal-wrapper">
        {{-- @if (!Auth::guest() && !Auth::user()->isActivated()) --}}
        @if (!Auth::guest() && !Auth::user())
        <div class="md-modal md-email-activation md-s-height md-show md-effect-1">
            <div class="md-content">
                <div class="email-icon">
                    <i class="fal fa-at"></i>
                </div>
                <div class="email-container">
                    <div style="text-align: center">{{ __('Confirmation of your Email')}}</div>
                    <div>На {{ Auth::user()->email }} было отправлено письмо с ссылкой на подтверждение аккаунта.</div>
                    <br>
                    <div class="email_links">
                        <a href="javascript:void(0)" onclick="resend_email()" class="ll">Отправить заново</a>
                        <a href="javascript:void(0)" onclick="window.location.href='/logout'" class="ll" style="margin-left: 5px">Выйти из аккаунта</a>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <div class="md-modal md-bonus-code md-s-height md-effect-1" id="modal_please_login">
            <div class="md-content h-100 md-please-login-content shadow-blue">
                <i class="fal fa-times md-close" onclick="$('#modal_please_login').toggleClass('md-show', false)"></i>
                <div class="w-100 pt-2 text-center">
                    <img src="https://cdn.29bet.com/assets/img/warning.webp" alt="https://cdn.29bet.com/assets/img/warning.webp" style="width: 8rem;">
                    <h1 style="font-size: 200%;" id="md_error_header">{{ __("Retry Login") }}</h1>
                    <p class="mt-2 mb-3">Desculpe pelo transtorno, mas sua sessão expirou. faça login novamente. Isso é necessário por motivos
                        de segurança e para proteger suas informações pessoais. Clique no botão abaixo para iniciar a sessão novamente.
                    </p>
                    <button class="btn-29" id="md_logout_btn" onclick="window.location.href = '/login';">{{ __("Okay") }}</button>
                </div>
           </div>
        </div>


        @if (Auth::guest())

        <div class="md-modal md-s-height md-auth md-effect-1" id="modal_auth">
            <div class="md-content md-auth-content">
                <div class="row">
                    <div class="col-md-6 colLogin__left" style="background-image: url('https://cdn.29bet.com/assets/img/background-auth.webp')"></div>
                    <div class="col-md-6 colLogin__right">

                        <div class="modal-ui-block" style="display: none">
                            <div class="profile-loader">
                                <div></div>
                            </div>
                        </div>

                        <i class="fal fa-times md-close" onclick="$('.md-auth').toggleClass('md-show', false)"></i>
                        <div class="sport-bet-tabs tabs-ignore-scroll auth-tabs">
                            <div class="sport-bet-tab sport-bet-tab-active auth-tab-active auth-tab" data-auth-action="auth">
                                <span>{{ __('Login')}}</span>
                                <div class="sport-bet-tab-indicator"></div>
                            </div>
                            <div class="sport-bet-tab auth-tab" data-auth-action="register">
                                <span>{{ __('Register')}}</span>
                                <div class="sport-bet-tab-indicator"></div>
                            </div>
                        </div>

                        <div class="login_fields">
                            @if (session()->has('session_error'))
                            <span class="text-danger">{{ session('session_error') }}</span>
                            @endif
                            {{-- dito --}}

                            @error('fields')
                            <div class="warning__message">
                                <span class="invalid-feedback" role="alert">
                                    <p class=" text-danger">{{ $message }}
                                    </p>
                                </span>
                            </div>
                            <script>
                                $(document).ready(function() {
                                    var err = '{{ __("Cadastrar")}}';
                                    $('.md-auth').addClass('md-show');
                                    $('[data-auth-action="register"]').addClass('sport-bet-tab-active auth-tab-active');
                                    $('[data-auth-action="auth"]').removeClass('sport-bet-tab-active auth-tab-active');

                                    if ($('.auth-tab-active').attr('data-auth-action') === 'register') {
                                        $("#vk_auth_label").html("Регистрация через ВКонтакте");
                                        $("#email").fadeIn(200);
                                        $("#fullname").fadeIn(200);
                                        $("#phone").fadeIn(200);

                                        $("#invite").fadeIn(200);
                                        $("#number").fadeIn(200);
                                        $("#cpf").fadeIn(200);
                                        $("#l_b").val(err);
                                    }
                                });
                            </script>
                            @endif

                            @error('username')
                            <div class="warning__message">
                                <span class="invalid-feedback" role="alert">
                                    <p class=" text-danger">{{ $message }}
                                    </p>
                                </span>
                            </div>

                            <script>
                                $(document).ready(function() {
                                    $('.md-auth').addClass('md-show');
                                    $('[data-auth-action="register"]').removeClass('sport-bet-tab-active auth-tab-active');
                                    $('[data-auth-action="auth"]').addClass('sport-bet-tab-active auth-tab-active');

                                    if ($('.auth-tab-active').attr('data-auth-action') === 'register') {
                                        $("#vk_auth_label").html("{{ __('Registration via VKontakte')}}");
                                        $("#username").fadeIn(200);
                                        $("#password").fadeIn(200);
                                    }
                                    if ($('[data-auth-action="auth"]').hasClass('auth-tab-active')) {
                                        // $('#form_auth').attr('action', '/login');
                                        var csrfToken = $('meta[name="csrf-token"]').attr('content');
                                        $('#form_auth')
                                            .attr('action', '/login')
                                            .append('<input type="hidden" name="_token" value="' + csrfToken + '">');          
                                    }
                                    if ($('[data-auth-action="register"]').hasClass('auth-tab-active')) {
                                        // $('#form_auth').attr('action', '/register');
                                        var csrfToken = $('meta[name="csrf-token"]').attr('content');
                                        $('#form_auth')
                                            .attr('action', '/register')
                                            .append('<input type="hidden" name="_token" value="' + csrfToken + '">');
                                                      
                                    }
                                });
                            </script>
                            @enderror

                            <form method="POST" action="{{ route('login') }}" id="form_auth">
                                @csrf
                                <!-- <div class="login_fields__user" id="fullname" style="display: none">
                                    <div class="icon user-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" fill="currentColor" stroke="none" width="20" height="20">
                                            <path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z" />
                                        </svg>
                                    </div>
                                    <input id="_fullname" name="fullname" placeholder="{{ __('Full Name')}}" value="{{ old('fullname')}}" type="text" name=/>
                                    <div class="warning__message">
                                        @if ($errors->error_regis->has('fullname'))
                                        <p class=" text-danger">
                                            {{ __($errors->error_regis->first('fullname')) }}
                                        </p>
                                        @endif
                                    </div>
                                    <div class="validation">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" fill="#23e923" stroke="1.5" width="20" height="20">
                                            <path d="M438.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L160 338.7 393.4 105.4c12.5-12.5 32.8-12.5 45.3 0z" />
                                        </svg>
                                    </div>
                                </div> -->


                                <div class="login_fields__user">
                                    <div class="icon user-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" fill="currentColor" stroke="none" width="20" height="20">
                                            <path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z" />
                                        </svg>
                                    </div>
                                    <input id="_username" name="username" placeholder="{{ __('User Name')}}" value="{{ old('username')}}" type="text">
                                    <div class="warning__message">
                                        @if ($errors->error_reg->has('username'))
                                        <p class="text-danger">
                                            {{ __($errors->error_reg->first('username')) }}
                                        </p>
                                        @endif
                                        @if ($errors->error_regis->has('username'))
                                        <p class=" text-danger">
                                            {{ __($errors->error_regis->first('username')) }}
                                        </p>
                                        @endif
                                    </div>

                                    <div class="validation">
                                        {{-- <img src="{{ asset('img/tick.webp') }}" alt=""> --}}
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" fill="#23e923" stroke="1.5" width="20" height="20">
                                            <path d="M438.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L160 338.7 393.4 105.4c12.5-12.5 32.8-12.5 45.3 0z" />
                                        </svg>
                                    </div>
                                </div>


                                <div class="login_fields__password">
                                    <div class="icon password-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" fill="currentColor" stroke="none" width="20" height="20">
                                            <path d="M144 144v48H304V144c0-44.2-35.8-80-80-80s-80 35.8-80 80zM80 192V144C80 64.5 144.5 0 224 0s144 64.5 144 144v48h16c35.3 0 64 28.7 64 64V448c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V256c0-35.3 28.7-64 64-64H80z" />
                                        </svg>
                                        {{-- <img src="/img/lock_icon_copy.webp" alt=""> --}}
                                    </div>

                                    <input id="_password" name="password" value="{{ old('') }}" placeholder="{{ __('Password')}}" type="password">
                                    <div class="warning__message">
                                        @if ($errors->error_reg->has('password'))
                                        <p class="text-danger">
                                            {{ __($errors->error_reg->first('password')) }}
                                        </p>
                                        @endif
                                        @if ($errors->error_regis->has('password'))
                                        <p class="text-danger">
                                            {{ __($errors->error_regis->first('password')) }}
                                        </p>
                                        @endif
                                    </div>
                                    <div class="validation">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" fill="currentColor" stroke="none" width="20" height="20">
                                            <path d="M144 144v48H304V144c0-44.2-35.8-80-80-80s-80 35.8-80 80zM80 192V144C80 64.5 144.5 0 224 0s144 64.5 144 144v48h16c35.3 0 64 28.7 64 64V448c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V256c0-35.3 28.7-64 64-64H80z" />
                                        </svg>
                                        {{-- <img src="{{ asset('img/tick.webp') }}" alt=""> --}}
                                    </div>

                                </div>

                                <div class="login_fields__user" id="fullname" style="display: none">
                                    <div class="icon password-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" fill="currentColor" stroke="none" width="20" height="20">
                                            <path d="M144 144v48H304V144c0-44.2-35.8-80-80-80s-80 35.8-80 80zM80 192V144C80 64.5 144.5 0 224 0s144 64.5 144 144v48h16c35.3 0 64 28.7 64 64V448c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V256c0-35.3 28.7-64 64-64H80z" />
                                        </svg>
                                        {{-- <img src="/img/lock_icon_copy.webp" alt=""> --}}
                                    </div>
                                    <input id="_confirm_password" name="confirm_password" placeholder="{{ __('Confirm Password')}}" value="{{ old('confirm_password')}}" type="password" name=/>
                                    <div class="warning__message">
                                        @if ($errors->error_regis->has('confirm_password'))
                                        <p class=" text-danger">
                                            {{ __($errors->error_regis->first('confirm_password')) }}
                                        </p>
                                        @endif
                                    </div>
                                    <div class="validation">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" fill="#23e923" stroke="1.5" width="20" height="20">
                                            <path d="M438.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L160 338.7 393.4 105.4c12.5-12.5 32.8-12.5 45.3 0z" />
                                        </svg>
                                    </div>
                                </div>


                                <!-- <div class="login_fields__user" id="email" style="display: none">
                                    <div class="icon email-l-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" fill="currentColor" stroke="none" width="20" height="20">
                                            <path d="M48 64C21.5 64 0 85.5 0 112c0 15.1 7.1 29.3 19.2 38.4L236.8 313.6c11.4 8.5 27 8.5 38.4 0L492.8 150.4c12.1-9.1 19.2-23.3 19.2-38.4c0-26.5-21.5-48-48-48H48zM0 176V384c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V176L294.4 339.2c-22.8 17.1-54 17.1-76.8 0L0 176z" />
                                        </svg>
                                    </div>

                                    <input id="_email" name="email" placeholder="{{ __('Email')}}" value="{{ old('email')}}" type="text">
                                    <div class="warning__message">
                                        @if ($errors->error_reg->has('email'))
                                        <p class="text-danger">
                                            {{ __($errors->error_reg->first('email')) }}
                                        </p>
                                        @endif
                                        @if ($errors->error_regis->has('email'))
                                        <p class=" text-danger">
                                            {{ __($errors->error_regis->first('email')) }}
                                        </p>
                                        @endif
                                    </div>
                                    <div class="validation">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" fill="#23e923" stroke="1.5" width="20" height="20">
                                            <path d="M438.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L160 338.7 393.4 105.4c12.5-12.5 32.8-12.5 45.3 0z" />
                                        </svg>
                                    </div>
                                    {{-- <i class="fas fa-info-circle register-email-info tooltip" ></i> --}}
                                </div> -->

                                <!-- <div class="login_fields__user" id="cpf" style="display: none;">
                                    <div class="icon user-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" stroke="none" width="20" height="20" viewBox="0 0 448 512">
                                            <path d="M0 64C0 28.7 28.7 0 64 0H384c35.3 0 64 28.7 64 64V448c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V64zM183 278.8c-27.9-13.2-48.4-39.4-53.7-70.8h39.1c1.6 30.4 7.7 53.8 14.6 70.8zm41.3 9.2l-.3 0-.3 0c-2.4-3.5-5.7-8.9-9.1-16.5c-6-13.6-12.4-34.3-14.2-63.5h47.1c-1.8 29.2-8.1 49.9-14.2 63.5c-3.4 7.6-6.7 13-9.1 16.5zm40.7-9.2c6.8-17.1 12.9-40.4 14.6-70.8h39.1c-5.3 31.4-25.8 57.6-53.7 70.8zM279.6 176c-1.6-30.4-7.7-53.8-14.6-70.8c27.9 13.2 48.4 39.4 53.7 70.8H279.6zM223.7 96l.3 0 .3 0c2.4 3.5 5.7 8.9 9.1 16.5c6 13.6 12.4 34.3 14.2 63.5H200.5c1.8-29.2 8.1-49.9 14.2-63.5c3.4-7.6 6.7-13 9.1-16.5zM183 105.2c-6.8 17.1-12.9 40.4-14.6 70.8H129.3c5.3-31.4 25.8-57.6 53.7-70.8zM352 192A128 128 0 1 0 96 192a128 128 0 1 0 256 0zM112 384c-8.8 0-16 7.2-16 16s7.2 16 16 16H336c8.8 0 16-7.2 16-16s-7.2-16-16-16H112z" />
                                        </svg>
                                    </div>

                                    <input id="_cpf" name="cpf" placeholder="CPF" name="{{ old('cpf')}}" type="text" />
                                    <div class="warning__message">
                                        @if ($errors->error_regis->has('cpf'))
                                        <p class="text-danger">
                                            {{ __($errors->error_regis->first('cpf')) }}
                                        </p>
                                        @endif
                                    </div>
                                    <div class="validation">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" fill="#23e923" stroke="1.5" width="20" height="20">
                                            <path d="M438.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L160 338.7 393.4 105.4c12.5-12.5 32.8-12.5 45.3 0z" />
                                        </svg>
                                    </div>
                                </div> -->

                                <div class="login_fields__user" id="phone" style="display: none">
                                    <div class="icon user-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" stroke="none" width="20" height="20" viewBox="0 0 448 512">
                                            <path d="M164.9 24.6c-7.7-18.6-28-28.5-47.4-23.2l-88 24C12.1 30.2 0 46 0 64C0 311.4 200.6 512 448 512c18 0 33.8-12.1 38.6-29.5l24-88c5.3-19.4-4.6-39.7-23.2-47.4l-96-40c-16.3-6.8-35.2-2.1-46.3 11.6L304.7 368C234.3 334.7 177.3 277.7 144 207.3L193.3 167c13.7-11.2 18.4-30 11.6-46.3l-40-96z" />
                                        </svg>
                                        {{-- <img src="{{ asset('/img/user_icon_copy.webp') }}" alt="" /> --}}
                                    </div>

                                    <input id="_phone" name="phone" value="{{ old('phone') }}" placeholder="{{ __('Phone')}}" type="text" />
                                    <div class="warning__message">
                                        @if ($errors->error_regis->has('phone'))
                                        <p class="text-danger">
                                            {{ __($errors->error_regis->first('phone')) }}
                                        </p>
                                        @endif
                                    </div>
                                    <div class="validation">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" fill="#23e923" stroke="1.5" width="20" height="20">
                                            <path d="M438.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L160 338.7 393.4 105.4c12.5-12.5 32.8-12.5 45.3 0z" />
                                        </svg>
                                    </div>
                                </div>

                                <div class="login_fields__user" id="email" style="display: none">
                                    
                                    @if(isset($referral_code) != '')
                                        <div class="icon">
                                            <i class="fas fa-sitemap"></i>
                                        </div>
                                        <input id="_invitation_code" name="invitation_code" value="{{ $referral_code }}" placeholder="{{ __('Referral Code')}}" type="text" />
                                    @else
                                        <div class="icon">
                                            <i class="fas fa-sitemap"></i>
                                        </div>
                                        <input id="_invitation_code" name="invitation_code" value="" placeholder="{{ __('Referral Code')}}" type="text" />
                                    @endif
                                
                                    <div class="warning__message">
                                        @if ($errors->error_regis->has('invitation_code'))
                                        <p class="text-danger">
                                            {{ __($errors->error_regis->first('invitation_code')) }}
                                        </p>
                                        @endif
                                    </div>
                                    <div class="validation">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" fill="#23e923" stroke="1.5" width="20" height="20">
                                            <path d="M438.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L160 338.7 393.4 105.4c12.5-12.5 32.8-12.5 45.3 0z" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="warning__message">
                                    @if (session()->has('error'))
                                    <p class="text-danger">
                                        {{ session('error') }}
                                    </p>
                                    @endif
                                </div>
                                @isset($referral_code)
                                <input type="hidden" name="code" value="{{ $referral_code }}">
                                @endisset
                            </form>
                        </div>
                        <div class="login_fields__submit">
                            <input type="submit" id="l_b" name="btn-auth" form="form_auth" value="{{ __('Enter') }}">
                        </div>
                        <div class="social_auth_desc">
                            {{ __('Or log in with:')}}
                            <div class="icogoogle"><img onclick="socialAuth('google')" src="https://cdn.29bet.com/assets/img/all/components/modals/ico-google.webp" alt="https://cdn.29bet.com/assets/img/all/components/modals/ico-google.webp" /></div>
                        </div>

                        <div class="social_auth_desc">
                            {{ __('By accessing the site, I confirm that I am 18 years of age and that I have read the')}}
                            <a href="javascript:void(0)" onclick="load('faq')" class="colored-link">{{ __('terms of service')}}</a>
                        </div>
                    </div>


                </div>
            </div>
        </div>

        <script>
            $('.auth-tab').click(function() {
                if ($(this).attr('data-auth-action') == 'auth') {
                    $('#id_reg').empty();
                    $('.sport-bet-tab').data('active_tab');
                    var csrfToken = $('meta[name="csrf-token"]').attr('content');
                    $('#form_auth')
                            .attr('action', '/login')
                            .append('<input type="hidden" name="_token" value="' + csrfToken + '">');  
                    // $('#id_reg').empty();
                    //$('#form_auth').attr('action', '/login');
                } else {
                    var csrfToken = $('meta[name="csrf-token"]').attr('content');
                    $('#form_auth').attr('action', '/register')
                                   .append('<input type="hidden" name="_token" value="' + csrfToken + '">');  
                    var reg = '<input name="reg" type="hidden"  />';
                    $('#id_reg').append(reg);
                }
            });
        </script>
        @else
        <div class="md-modal md-s-height md-pre-reg md-effect-1" id="preRegister">
            <div class="md-content h-100">
                <i class="fal fa-times md-close" onclick="$('.md-pre-reg').toggleClass('md-show', false)"></i>
                <h1>{{ __('Complete Registration:')}}</h1>
                <form class="complete__c" method="POST" action="{{ route('google-registration') }}">
                    @csrf
                    <div class="login_fields">

                        <div class="login_fields__user" id="cpf">
                            <div class="icon user-icon">
                                <img src="https://cdn.29bet.com/assets/img/user_icon_copy.webp" alt="https://cdn.29bet.com/assets/img/user_icon_copy.webp" />
                            </div>
                            <input id="_cpf" name="cpf" placeholder="CPF" value="{{ old('cpf')}}" type="text" />
                            <div class="validation">
                                <img src="https://cdn.29bet.com/assets/img/tick.webp" alt="https://cdn.29bet.com/assets/img/tick.webp" />
                            </div>
                            @if ($errors->error_google_reg->has('cpf'))
                            <p class="text-danger">
                                {{ $errors->error_google_reg->first('cpf') }}
                            </p>
                            @endif
                        </div>

                        <div class="login_fields__user" id="number">
                            <div class="icon user-icon">
                                <img src="https://cdn.29bet.com/assets/img/user_icon_copy.webp" alt="https://cdn.29bet.com/assets/img/user_icon_copy.webp" />
                            </div>
                            <input id="_phone" name="phone" placeholder="Phone" type="text" />
                            <div class="validation">
                                <img src="https://cdn.29bet.com/assets/img/tick.webp" alt="https://cdn.29bet.com/assets/img/tick.webp" />
                            </div>
                            @if ($errors->error_google_reg->has('phone'))
                            <p class="text-danger">
                                {{ $errors->error_google_reg->first('phone') }}
                            </p>
                            @endif
                        </div>
                        

                        <div class="login_fields__user" id="email">
                            <div class="icon user-icon">
                                <img src="https://cdn.29bet.com/assets/img/user_icon_copy.webp" alt="https://cdn.29bet.com/assets/img/user_icon_copy.webp" />
                            </div>
                            <input id="_email" name="email" placeholder="Email" value="{{ old('email')}}" type="text" />
                            <div class="validation">
                                <img src="https://cdn.29bet.com/assets/img/tick.webp" alt="https://cdn.29bet.com/assets/img/tick.webp" />
                            </div>
                            @if ($errors->error_google_reg->has('email'))
                            <p class="text-danger">
                                {{ $errors->error_google_reg->first('email') }}
                            </p>
                            @endif
                        </div>
                       
                                
                        <div class="login_fields__user" id="invitation_code">
                            <!-- <div class="icon">
                                <i class="fas fa-sitemap"></i>
                            </div>
                            @isset($invitation_code)
                                <input id="_invite" name="invitation_code" value="{{ $invitation_code }}" placeholder="{{ __('Invitation Code')}}" type="text" />
                            @endisset -->

                            @if(isset($invitation_code) != '')
                                <div class="icon">
                                            <i class="fas fa-sitemap"></i>
                                        </div>
                                        <input id="_invitation_code" name="invitation_code" value="{{ $referral_code }}" placeholder="{{ __('Referral Code')}}" type="text" />
                                    @else
                                        <div class="icon">
                                            <i class="fas fa-sitemap"></i>
                                        </div>
                                        <input id="_invitation_code" name="invitation_code" value="" placeholder="{{ __('Referral Code')}}" type="text" />
                                    @endif
                            
                            <div class="validation">
                                <img src="https://cdn.29bet.com/assets/img/tick.webp" alt="https://cdn.29bet.com/assets/img/tick.webp" />
                            </div>
                            <i class="fas fa-info-circle register-email-info tooltip" title="{{ __('You are using an Invitation Code')}}"></i>
                            @if ($errors->error_google_reg->has('invitation_code'))
                            <p class="text-danger">
                                {{ $errors->error_google_reg->first('invitation_code') }}
                            </p>
                            @endif
                        </div>
                    </div>

                    <div class="login_fields__submit">
                        <input type="submit" id="l_b" name="btn-save-info" value="Finalizar Cadastro" />
                    </div>
                </form>

            </div>
        </div>


        <div class="md-modal md-s-height md-pre-reg md-effect-1" id="preRegister-normal-reg">
            <div class="md-content h-100">
                <i class="fal fa-times md-close" onclick="$('.md-pre-reg').toggleClass('md-show', false)"></i>
                <h1>{{ __('Complete Registration:')}}</h1>
                <form class="complete__c" method="POST" action="{{ route('complete-reg') }}">
                    @csrf
                    <div class="login_fields">

                        <div class="login_fields__user" id="fullname">
                            <div class="icon user-icon">
                                <img src="https://cdn.29bet.com/assets/img/user_icon_copy.webp" alt="https://cdn.29bet.com/assets/img/user_icon_copy.webp" />
                            </div>
                            <input id="_fullname" name="fullname" placeholder="Fullname" value="{{ old('fullname')}}" type="text" />
                            <div class="validation">
                                <img src="https://cdn.29bet.com/assets/img/tick.webp" alt="https://cdn.29bet.com/assets/img/tick.webp" />
                            </div>
                            @if ($errors->error_normal_reg->has('fullname'))
                            <p class="text-danger">
                                {{ $errors->error_normal_reg->first('fullname') }}
                            </p>
                            @endif
                        </div>


                        <div class="login_fields__user" id="cpf">
                            <div class="icon user-icon">
                                <img src="https://cdn.29bet.com/assets/img/user_icon_copy.webp" alt="https://cdn.29bet.com/assets/img/user_icon_copy.webp" />
                            </div>
                            <input id="_cpf" name="cpf" placeholder="CPF" value="{{ old('cpf')}}" type="text" />
                            <div class="validation">
                                <img src="https://cdn.29bet.com/assets/img/tick.webp" alt="https://cdn.29bet.com/assets/img/tick.webp" />
                            </div>
                            @if ($errors->error_normal_reg->has('cpf'))
                            <p class="text-danger">
                                {{ $errors->error_normal_reg->first('cpf') }}
                            </p>
                            @endif
                        </div>

                        <div class="login_fields__user" id="email">
                            <div class="icon user-icon">
                                <img src="https://cdn.29bet.com/assets/img/user_icon_copy.webp" alt="https://cdn.29bet.com/assets/img/user_icon_copy.webp" />
                            </div>
                            <input id="_email" name="email" placeholder="Email" value="{{ old('email')}}" type="text" />
                            <div class="validation">
                                <img src="https://cdn.29bet.com/assets/img/tick.webp" alt="https://cdn.29bet.com/assets/img/tick.webp" />
                            </div>
                            @if ($errors->error_normal_reg->has('email'))
                            <p class="text-danger">
                                {{ $errors->error_normal_reg->first('email') }}
                            </p>
                            @endif
                        </div>


                        <!-- <div class="d-block d-md-block p-0 w-100 my-3">
                            <div class="dropdown__select">
                                <select class="select--pix--input dropdown__referral" id="account-type" name="account-type">
                                    <option value="">Select Account Type</option>
                                    <option value="1">CPF</option>
                                    <option value="2">Email</option>
                                    <option value="3">Phone</option>
                                </select>
                            </div>
                            @if ($errors->error_normal_reg->has('account-type'))
                            <p class="text-danger">
                                {{ $errors->error_normal_reg->first('account-type') }}
                            </p>
                            @endif
                        </div> -->

                        <!-- <div class="login_fields__user" id="account-type-details">
                            <div class="icon">
                                <i class="fas fa-sitemap"></i>
                            </div>
                            <input id="_account-type-details" name="account-type-details" placeholder="{{ __('Account Type')}}" type="text" />
                            <div class="validation">
                                <img src="https://cdn.29bet.com/assets/img/tick.webp" alt="https://cdn.29bet.com/assets/img/tick.webp" />
                            </div>
                            @if ($errors->error_normal_reg->has('account-type-details'))
                            <p class="text-danger">
                                {{ $errors->error_normal_reg->first('account-type-details') }}
                            </p>
                            @endif
                        </div> -->
                    </div>

                    <div class="login_fields__submit">
                        <input type="submit" id="l_b" name="btn-save-info-normal-reg" value="Submit" />
                    </div>
                </form>

            </div>
        </div>


        <div class="md-modal md-s-height md-details-payment md-effect-1 md-min-width-modal" id="detailsPayment">
            <div class="md-content shadow-blue">
                <i class="fal fa-times md-close" onclick="$('.md-details-payment').toggleClass('md-show', false)"></i>
                <div class="profile__modal">
                    <!-- <form method="POST" action="{{ route('wallet') }}"> -->
                    <form id="form_deposit">
                        @csrf
                        <div class="profile__modal__title">
                            <h3>{{ __("Wallets")}}</h3>
                            <div class="scroller__mobile">
                                <div class="payments__tabs">
                                    <div class="mm_header_tab styled-tab mm_header_tab_active" data-tab="#a" data-details-payment-action="deposit">
                                        {{ __('Deposit') }}
                                    </div>
                                    <div class="mm_header_tab styled-tab" data-tab="#b" data-details-payment-action="withdrawl">
                                        {{ __('Withdrawal') }}
                                    </div>
                                    <div class="mm_header_tab styled-tab" data-tab="#c" data-details-payment-action="pix" style="display: none;">
                                        {{ __('PIX') }}
                                    </div>
                                </div>

                                <div class="found-tab-content">
                                    <div class="mm_general_tab mm_general_tab_active tab__styled__payment" id="a">
                                        <div class="background__rize">
                                            <div id="depositValue">
                                                <h4>{{ __("Deposit Amount")}}</h4>
                                                <div class="">
                                                    @if ($errors->validator->has('amount'))
                                                    <div class="form-text text-danger col-sm-12 d-flex justify-content-center">
                                                        {{ $errors->validator->first('amount') }}
                                                    </div>
                                                    @endif
                                                </div>
                                                <div class="input__deposit">
                                                    <label for="#one">
                                                        R$
                                                    </label>
                                                    <input type="text" class="deposito input__deposit--ipt" type='text' id='one' name="deposit_amount" placeholder="00.00">
                                                    <!-- @if ($errors->validator->has('amount'))
                                                                    <div class="form-text text-danger col-sm-12">
                                                                {{ $errors->validator->first('amount') }}
                                                                    </div>
                                                            @endif -->
                                                </div>

                                                <div class="buttons__deposit">
                                                    <button class="deposit__button amount_button" type="button" onclick='ik(this.value);' value='30'>
                                                        <div class="light_img rotate_active">
                                                            <img src="https://cdn.29bet.com/assets/img/all/components/modals/espiral-ico.webp" alt="https://cdn.29bet.com/assets/img/all/components/modals/espiral-ico.webp">
                                                        </div>
                                                        <p>R$ <small>30</small></p>
                                                            <small class="info-bonus recharge_30"></small>
                                                    </button>

                                                    <button class="deposit__button add amount_button" type='button' onclick='ik(this.value);' value='100'>
                                                        <div class="light_img rotate_active">
                                                            <img src="https://cdn.29bet.com/assets/img/all/components/modals/espiral-ico.webp" alt="https://cdn.29bet.com/assets/img/all/components/modals/espiral-ico.webp">
                                                        </div>
                                                        <div>
                                                            <p>R$ <small>100</small></p>
                                                            <small class="info-bonus recharge_100"></small>
                                                        </div>
                                                    </button>
                                                    <button class="deposit__button add amount_button" type='button' onclick='ik(this.value);' value='200'>
                                                        <div class="light_img rotate_active">
                                                            <img src="https://cdn.29bet.com/assets/img/all/components/modals/espiral-ico.webp" alt="https://cdn.29bet.com/assets/img/all/components/modals/espiral-ico.webp">
                                                        </div>
                                                        <div>
                                                            <p>R$ <small>200</small></p>
                                                            <small class="info-bonus recharge_200"></small>
                                                        </div>
                                                    </button>
                                                    <button class="deposit__button add amount_button" type='button' onclick='ik(this.value);' value='500'>
                                                        <div class="light_img rotate_active">
                                                            <img src="https://cdn.29bet.com/assets/img/all/components/modals/espiral-ico.webp" alt="https://cdn.29bet.com/assets/img/all/components/modals/espiral-ico.webp">
                                                        </div>
                                                        <div>
                                                            <p>R$ <small>500</small></p>
                                                            <small class="info-bonus recharge_500"></small>
                                                        </div>
                                                    </button>
                                                    <button class="deposit__button add amount_button" type='button' onclick='ik(this.value);' value='1000'>
                                                        <div class="light_img rotate_active">
                                                            <img src="https://cdn.29bet.com/assets/img/all/components/modals/espiral-ico.webp" alt="https://cdn.29bet.com/assets/img/all/components/modals/espiral-ico.webp">
                                                        </div>
                                                        <div>
                                                            <p>R$ <small>1000</small></p>
                                                            <small class="info-bonus recharge_1000"></small>
                                                        </div>
                                                    </button>
                                                    <button class="deposit__button add amount_button" type='button' onclick='ik(this.value);' value='2000'>
                                                        <div class="light_img rotate_active">
                                                            <img src="https://cdn.29bet.com/assets/img/all/components/modals/espiral-ico.webp" alt="https://cdn.29bet.com/assets/img/all/components/modals/espiral-ico.webp">
                                                        </div>
                                                        <div>
                                                            <p>R$ <small>2000</small></p>
                                                            <small class="info-bonus recharge_2000"></small>
                                                        </div>
                                                    </button>
                                                    <button class="deposit__button add amount_button" type='button' onclick='ik(this.value);' value='5000'>
                                                        <div class="light_img rotate_active">
                                                            <img src="https://cdn.29bet.com/assets/img/all/components/modals/espiral-ico.webp" alt="https://cdn.29bet.com/assets/img/all/components/modals/espiral-ico.webp">
                                                        </div>
                                                        <div>
                                                            <p>R$ <small>5000</small></p>
                                                            <small class="info-bonus recharge_5000"></small>
                                                        </div>
                                                    </button>
                                                    <button class="deposit__button add amount_button" type='button' onclick='ik(this.value);' value='19999'>
                                                        <div class="light_img rotate_active">
                                                            <img src="https://cdn.29bet.com/assets/img/all/components/modals/espiral-ico.webp" alt="https://cdn.29bet.com/assets/img/all/components/modals/espiral-ico.webp">
                                                        </div>
                                                        <div>
                                                            <p>R$ <small>19999</small></p>
                                                            <small class="info-bonus recharge_19999"></small>
                                                        </div>
                                                    </button>
                                                </div>

                                                <div class="background__bonus">
                                                    <div class="background__bonus__porcent">
                                                        <div class="light_img">
                                                            <img src="https://cdn.29bet.com/assets/img/all/components/modals/espiral-ico.webp" alt="https://cdn.29bet.com/assets/img/all/components/modals/espiral-ico.webp">
                                                        </div>
                                                        <div style="width: 100%; display: flex; justify-content: space-between; margin: 20px 0px; gap: 10px;">
                                                            <p class="text__bonus" id="promo_name"></p>
                                                            <!-- <p class="text__bonus">{{ __('100% First Time Reload Bonus')}}</p> -->
                                                            <h3 class="text__bonus__porcent promo_bonus"></h3>
                                                            <!-- <h3 class="text__bonus__porcent">100%</h3> -->
                                                        </div>
                                                    </div>
                                                    <div class="background__bonus__deposit">
                                                        <p>{{ __("Deposit Bonus")}}</p>
                                                        <p style="color: #ffe029" class="promo_bonus"></p>
                                                        <p style="color: #ffe029" class="deposit_bonus"></p>
                                                    </div>
                                                </div>
                                                <div class="background__bonus mt-3">
                                                    <div class="btn__checked">
                                                        <input name="doNotParcipate" type="checkbox" id="recharge_consent" class="checked__consent">
                                                        <label for="recharge_consent">{{ __('I do not participate in this promotions')}}.</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="deposit__pix" id="depositPix" style="display: none;">
                                                <h5>
                                                    <span>
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="25" height="25" fill="#32BCAD">
                                                            <path d="M242.4 292.5C247.8 287.1 257.1 287.1 262.5 292.5L339.5 369.5C353.7 383.7 372.6 391.5 392.6 391.5H407.7L310.6 488.6C280.3 518.1 231.1 518.1 200.8 488.6L103.3 391.2H112.6C132.6 391.2 151.5 383.4 165.7 369.2L242.4 292.5zM262.5 218.9C256.1 224.4 247.9 224.5 242.4 218.9L165.7 142.2C151.5 127.1 132.6 120.2 112.6 120.2H103.3L200.7 22.76C231.1-7.586 280.3-7.586 310.6 22.76L407.8 119.9H392.6C372.6 119.9 353.7 127.7 339.5 141.9L262.5 218.9zM112.6 142.7C126.4 142.7 139.1 148.3 149.7 158.1L226.4 234.8C233.6 241.1 243 245.6 252.5 245.6C261.9 245.6 271.3 241.1 278.5 234.8L355.5 157.8C365.3 148.1 378.8 142.5 392.6 142.5H430.3L488.6 200.8C518.9 231.1 518.9 280.3 488.6 310.6L430.3 368.9H392.6C378.8 368.9 365.3 363.3 355.5 353.5L278.5 276.5C264.6 262.6 240.3 262.6 226.4 276.6L149.7 353.2C139.1 363 126.4 368.6 112.6 368.6H80.78L22.76 310.6C-7.586 280.3-7.586 231.1 22.76 200.8L80.78 142.7H112.6z" />
                                                        </svg>
                                                    </span>
                                                    PIX
                                                </h5>
                                                <p>{{ __('Please open your payment app and scan the QR code below to pay.')}}</p>
                                                <div class="deposit__pix__image">
                                                    <img src="https://cdn.29bet.com/assets/img/all/components/modals/qrcode-example.webp" id="qr-code-img" alt="https://cdn.29bet.com/assets/img/all/components/modals/qrcode-example.webp">
                                                </div>
                                                <p>{{ __('Amount')}}:
                                                    R$<strong>{{ session()->has('amount') ? session('amount') : '' }}</strong>
                                                </p>
                                                <p>{{ __('Click the link below or scan the QR Code there to your payment app to checkout.')}}</p>
                                                <!-- <p>{{ __('Click the link below and paste it into your payment app to checkout.')}}</p> -->
                                                <div class="deposit__pix__copy">
                                                    <a href="#" class="bonus_card--btn" id="deposit_link">{{ __('Click To Redirect to Checkout')}}</a>
                                                </div>
                                                <p>{{ __('You can also download the QR Code or Copy the the QR Code to use in payment.')}}</p>
                                                <div class="deposit__pix__copy">
                                                    <!-- <input class="deposit__pix__copy--value" type="text"
                                                            id="pixqrcode" style="cursor: default;"
                                                            value="DSAD342432GH5BCF435657XDF4543543543TBNGY644543T5435535431GG15GFD5GFDGSDFF2SDF15ERSE2D21SEF522"
                                                            disabled>
                                                        <button class="deposit__pix__copy--btn" type="button"
                                                            onclick="copyPix()">Cópiar
                                                            codigo PIX</button> -->
                                                    <button class="deposit__pix__copy--btn mb-3" type="button" id="copyPIXQR">{{ __('Download QR Code')}}</button>
                                                    <button class="deposit__pix__copy--btn mb-3" type="button" id="copyPIXQRDATA">{{ __('Copy QR Code')}}</button>
                                                </div>
                                            </div>

                                            <div class="btn__bonus">
                                                <button class="deposit__pix__copy--btn dim-text-readonly" id="deposit" style="cursor:not-allowed; display:block;" disabled>{{ __('Deposit')}}</button>
                                            </div>

                                        </div>
                                        <a class="link__historic__withdrawl" href="{{route('personal-center')}}">{{ __('Deposit Records')}}</a>
                                    </div>

                                    <div class="mm_general_tab tab__styled__payment" id="b">
                                        <form id="form-retirada">
                                            <div class="background__rize">
                                                <h4>{{ __("Enter Withdrawal Amount")}}</h4>

                                                @if (session('withdraw_error'))
                                                @foreach ($errors->validator->all() as $error)
                                                <div class="form-text text-danger col-sm-12 d-flex justify-content-center">
                                                    {{ $error }}
                                                </div>
                                                @endforeach
                                                @endif

                                                <div class="input__deposit">
                                                    <label for="#pix">
                                                        R$
                                                    </label>
                                                    <input type="text" name="withdraw_amount" class="retirada input__deposit--ipt" type='text' id='pix'>
                                                </div>
                                                <div class="input__pix">
                                                    <div class="input__pix__item pix__input__item">
                                                        <label for="">{{ __('Cardholder Name')}}</label>
                                                        <input name="cardholder_name" type="text" id="name" class="pix--input dim-text-readonly" value="{{ Auth::user()->name }}">
                                                    </div>
                                                   {{--  
                                                    <div class="input__pix__items">
                                                        <div class="pix__input__item">
                                                            <label for="account_number">{{ __('Account Number')}}</label>
                                                            <select class="select--pix--input" id="account_number" name="select_account">
                                                                <option value="">{{ __('Select Type of Account Number')}}
                                                                </option>
                                                                <option value="number_id">{{ __('CPF')}}</option>
                                                                <option value="mobile_number">{{ __('Phone Number')}}</option>
                                                                <option value="email">{{ __('Email')}}</option>
                                                            </select>
                                                        </div>
                                                        <div class="pix__input__item">
                                                            <div id="inputAccountNumber">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    --}}
                                                </div>
                                                <div class="background__bonus mt-3">
                                                    <div class="btn__checked">
                                                        <input name="ACEITO" type="checkbox" id="consent" class="checked__consent">
                                                        <label for="consent">{{ __('Statement of Withdrawal Consent')}}</label>
                                                    </div>
                                                </div>
                                                <div class="informations__deposit">
                                                    <p id="tax"></p>
                                                    <p id="free_withdraw"></p>
                                                    <p id="minimum_withdrawal"></p>
                                                    <p id="maximum_withdraw"></p>
                                                    <p id="month_cycle"></p>
                                                    <p>{{ __('Payment time: from 5 minutes to 24 hours.')}}</p>
                                                </div>
                                                <div class="btn__bonus">
                                                    <button type="submit" class="btn__bonus--btn dim-text-readonly" name="withdrawal" id="withdrawal" style="cursor:not-allowed; display:block;" disabled>{{ __('Withdrawal')}}</button>
                                                </div>
                                            </div>
                                        </form>

                                        <a class="link__historic__withdrawl" href="{{route('personal-center')}}">{{ __('Deposit Records')}}</a>

                                    </div>

                                    <!-- <div class="mm_general_tab tab__styled__payment" id="c">
                                            <div class="background__rize">

                                                <div class="deposit__pix" id="depositPix" style="display: none;">
                                                    <h5>
                                                        <span>
                                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
                                                                width="25" height="25" fill="#32BCAD">
                                                                <path
                                                                    d="M242.4 292.5C247.8 287.1 257.1 287.1 262.5 292.5L339.5 369.5C353.7 383.7 372.6 391.5 392.6 391.5H407.7L310.6 488.6C280.3 518.1 231.1 518.1 200.8 488.6L103.3 391.2H112.6C132.6 391.2 151.5 383.4 165.7 369.2L242.4 292.5zM262.5 218.9C256.1 224.4 247.9 224.5 242.4 218.9L165.7 142.2C151.5 127.1 132.6 120.2 112.6 120.2H103.3L200.7 22.76C231.1-7.586 280.3-7.586 310.6 22.76L407.8 119.9H392.6C372.6 119.9 353.7 127.7 339.5 141.9L262.5 218.9zM112.6 142.7C126.4 142.7 139.1 148.3 149.7 158.1L226.4 234.8C233.6 241.1 243 245.6 252.5 245.6C261.9 245.6 271.3 241.1 278.5 234.8L355.5 157.8C365.3 148.1 378.8 142.5 392.6 142.5H430.3L488.6 200.8C518.9 231.1 518.9 280.3 488.6 310.6L430.3 368.9H392.6C378.8 368.9 365.3 363.3 355.5 353.5L278.5 276.5C264.6 262.6 240.3 262.6 226.4 276.6L149.7 353.2C139.1 363 126.4 368.6 112.6 368.6H80.78L22.76 310.6C-7.586 280.3-7.586 231.1 22.76 200.8L80.78 142.7H112.6z" />
                                                            </svg>
                                                        </span>
                                                        PIX
                                                    </h5>
                                                    <p>{{ __('Please open your payment app and scan the QR code below to pay.')}}</p>
                                                    <div class="deposit__pix__image" id="scanner-container">
                                                        <img src="https://cdn.29bet.com/assets/img/all/components/modals/qrcode-example.webp"
                                                            id="qr-code-img" alt="https://cdn.29bet.com/assets/img/all/components/modals/qrcode-example.webp">
                                                    </div>
                                                    <p>Valor:
                                                        R$<strong>{{ session()->has('amount') ? session('amount') : '' }}</strong>
                                                    </p>
                                                    <p>{{ __('Copy the Pix code below and paste it into your payment app to checkout.')}}</p>
                                                    <p>{{ __('You can also download the QR Code or Go to the payment gateway.')}}</p>
                                                    <div class="deposit__pix__copy">
                                                        <input class="deposit__pix__copy--value" type="text"
                                                            id="pixqrcode" style="cursor: default;"
                                                            value="DSAD342432GH5BCF435657XDF4543543543TBNGY644543T5435535431GG15GFD5GFDGSDFF2SDF15ERSE2D21SEF522"
                                                            disabled>
                                                        <button class="deposit__pix__copy--btn mb-3" type="button" id="copyPIXQR">Download QR Code</button>
                                                            <a href="#" class="bonus_card--btn" id="deposit_link">{{ __('Click To Redirect to Checkout')}}</a>
                                                    </div>
                                                </div>

                                            </div>
                                        </div> -->

                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div id="ConfirmAlert" class="md-modal md-confirm-promotion md-s-height md-effect-1">
            <div class="md-content shadow-blue h-100">
                <div class="modal-header">
                    <i class="fa fa-question-circle bonus__confirm--ico"></i>
                </div>
                <div class="modal-body">
                    <p class="bonus__confirm--description">{{ __('Do you want to proceed?')}}</p>
                </div>
                <div class="modal-footer d-flex gap-3">
                    <button class="bonuscode__confirm" id="YesButton" class="pr">{{ __('Yes')}}</button>
                    <button class="bonuscode__cancel" id="NoButton" onclick="$('#ConfirmAlert').toggleClass('md-show', false)">{{ __('No')}}</button>
                </div>
            </div>
        </div>

        <div id="NotificationModal" class="md-modal md-notification md-s-height max-600 md-effect-1">
            <div class="md-content shadow-blue h-100">
                <div class="modal-header">
                    <i class="fal fa-times md-close" onclick="$('#NotificationModal').toggleClass('md-show', false)"></i>
                </div>
                <div class="modal-body modal__notification">

                    <h2 id="notification_title" class="modal__notification--title mb-1"></h2>
                    <h4 id="notification_sub_title" class="modal__notification--subtitle"></h4>

                    <div class="modal__notification__content my-3 text-center">
                        <p id="notification_message" class="modal__notification__content--message"></p>
                        <p id="notification_sub_message" class="modal__notification__content--submessage"></p>
                    </div>

                    <div class="modal__notification__datapost my-3">
                        <span id="date_post" class="modal__notification--date"></span>, <span  id="time_post" class="modal__notification--time"></span>
                    </div>
                </div>
                <div class="modal-footer d-flex gap-3">
                    <button class="bonuscode__cancel" onclick="$('#NotificationModal').toggleClass('md-show', false)">{{ __('Close')}}</button>
                </div>
            </div>
        </div>



        <div class="md-modal md-bonus-wheel md-s-height md-effect-1" id="ref">
            <div class="md-content">
                <i class="fal fa-times md-close" onclick="$('.md-bonus-wheel').toggleClass('md-show', false)"></i>

                <canvas id="ref_canvas" style="width: 160%" width="880" height="600">
                    Canvas not supported, use another browser.
                </canvas>
                <img id="prizePointer" src="https://cdn.29bet.com/assets/img/pointer_white.webp" alt="https://cdn.29bet.com/assets/img/pointer_white.webp" />
                <div class="wh_circle hidden-xs hidden-md"></div>
                <div class="wh_outside_circle hidden-sm hidden-xs"></div>
                <div class="wheel_block row" id="ref_block">
                    <div class="wb_c">
                        <div class="col-xs-12 col-sm-6 bonus_reload">
                            <span class="ref_reload_text">.../10</span>
                            <p id="ref_reload_hint">{{ __('active referrals')}}</p>
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <div class="spin_button" onclick="spin_ref()">{{ __('twist')}}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="md-modal md-promo md-s-height md-effect-1">
            <div class="md-content">
                <i class="fal fa-times md-close" onclick="$('.md-promo').toggleClass('md-show', false)"></i>
                <div style="margin-top: 14px;">
                    <div class="vk-btn2"><i class="fab fa-vk"></i> {{ __('Promo codes')}}</div>
                    <input style="width: 92%;" class="b_input_s bg_bet_input" id="_promo" placeholder="{{ __('Promo codes')}}">
                    <div class="bg_bet_btn" style="padding: 8px;" onclick="activatePromo($('#_promo').val())"><i class="fal fa-check"></i></div>
                </div>
            </div>
        </div>
        <div class="md-modal md-rain md-s-height md-effect-1" id="rain">
            <div class="md-content">
                <i class="fal fa-times md-close" onclick="$('.md-rain').toggleClass('md-show', false)"></i>
                <div class="nano">
                    <div class="nano-content">
                        <p style="font-size: 1.3em; text-align: center">Rain/Snow</p>
                        <br>
                        <ul>
                            <li>
                                <p style="text-align: center" {{ __('Five random people are selected by the system every 3 hours and are awarded with a bonus, along with sending a message about it to the chat.')}}</p>
                            </li>
                            <li>
                                <p style="text-align: center">{{ __('To get caught in the rain, you need to top up your account with 30 coins or more in the last 24 hours.')}}</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        @endif
        <div class="md-modal md-modalwin md-s-height md-effect-1" id="ref">
            <div class="md-content no-scroll">
                <i class="fal fa-times md-close" onclick="$('.md-modalwin').toggleClass('md-show', false)"></i>
                <div>
                    @include('layouts.includes.all-games')
                </div>
            </div>
        </div>
        <div class="md-modal md-unavailable md-s-height md-effect-1">
            <div class="md-content">
                <i class="fal fa-times md-close" onclick="$('.md-unavailable').toggleClass('md-show', false);load('/')"></i>
                <div class="md-unavailable-title">:(</div>
                <div class="md-unavailable-desc">{{ __('This game is currently unavailable.')}}</div>
            </div>
        </div>

        <div class="md-modal md-effect-1" id="modal-1">
            <div class="md-content">
                <div class="case-modal-header">
                    <div id="modal-1-header"></div>
                    <i class="fal fa-times md-close" id="md-close"></i>
                </div>
                <div id="modal-1-content"></div>
            </div>
        </div>

        <div class="md-modal md-s-height md-historic-game md-effect-1" id="profileHistoricGame">
            <div class="md-content">
                <i class="fal fa-times md-close" onclick="$('.md-historic-game').toggleClass('md-show', false)"></i>
                <div class="profile__modal">
                    <div class="profile__modal__title">
                        <h3>{{ __('Game History')}}</h3>
                    </div>
                    <div class="table__profile__game__historic">
                        {{ __('Content')}}
                    </div>
                </div>
            </div>
        </div>

        <div class="md-modal md-popup-hover md-s-height md-effect-1" id="ref">
            <div class="md-content h-100">
                <i class="fal fa-times md-close" onclick="$('.md-popup-hover').toggleClass('md-show', false)"></i>
                <div class="popupimg"><img class="w-100" src="https://cdn.29bet.com/assets/img/all/components/modals/popup-top-img.webp" alt="https://cdn.29bet.com/assets/img/all/components/modals/popup-top-img.webp"></div>
                <h1>
                    &nbsp; <span>{{ __('29 Bet')}} </span>{{ __('is the leading diversified online casino and one of the largest gambling companies in the world.')}}
                </h1>
                <p>
                </p>'1. New user deposit bonus: 100% bonus up to 800BRL.<br>2.Unlimited invite bonus: For each invited depositing user, you will receive up to R$12. The more friends you invite, the more bonuses you will receive.<br>3. Join our Telegram channel and be the first to stay abreast of the latest activities and benefits.br><a href="https://t.me/29bet">https://t.me/29bet</a><br>May all players have fun at 29Bet!'
            </div>
        </div>

        <div class="md-modal md-popup-error md-s-height md-effect-1" id="error">
            <div class="md-content shadow-blue h-100">
                <i class="fal fa-times md-close" onclick="$('.md-popup-error').toggleClass('md-show', false)"></i>
                <div class="w-100 text-center mt-4">
                    <img src="https://cdn.29bet.com/assets/img/block.webp" alt="https://cdn.29bet.com/assets/img/block.webp" width="150" height="150">
                    <h1 id="error_header"></h1>
                    <p id="error_message"></p>
                </div>
            </div>
        </div>

        <div class="md-modal md-extra md-s-height md-effect-1" id="modalextra">
            <div class="md-content">
                <i class="fal fa-times md-close" onclick="$('.md-extra').toggleClass('md-show', false)"></i>
                <div style="width: 100%;text-align:center;margin-top: 10%;">
                    extra modal
                </div>
            </div>
        </div>


        <div class="md-modal md-reset-login-password md-s-height md-effect-1" id="resetLoginPassword">
            <div class="md-content h-100">
                <i class="fal fa-times md-close" onclick="$('.md-reset-login-password').toggleClass('md-show', false)"></i>
                <div class="resetLoginPassword">
                    <h3>{{ __('Set New Password')}}</h3>
                    <form method="POST" action="{{ route('change-password-login') }}">
                        @csrf
                        <div class="my-3">
                            <label class="d-block w-100" for="#">{{ __('Current Password')}}</label>
                            <input type="password" id="current_password" name="current_password" class="resetLoginPassword--input mt-2">
                        </div>
                        @if ($errors->error_changepass->has('current_password'))
                        <p class="text-danger">
                            {{ $errors->error_changepass->first('current_password') }}
                        </p>
                        @endif
                        @if (session()->has('session_changepass_md_not_match'))
                        <p class="text-danger">
                            {{ session('session_changepass_md_not_match') }}
                        </p>
                        @endif
                        <div class="my-3">
                            <label class="d-block w-100" for="#">{{ __('New Password')}}</label>
                            <input type="password" id="new_password" name="new_password" class="resetLoginPassword--input mt-2">
                        </div>
                        @if ($errors->error_changepass->has('new_password'))
                        <p class="text-danger">
                            {{ $errors->error_changepass->first('new_password') }}
                        </p>
                        @endif
                        <div class="my-3">
                            <label class="d-block w-100" for="#">{{ __('Confirm Password')}}</label>
                            <input type="password" id="new_password_confirmation" name="new_password_confirmation" class="resetLoginPassword--input mt-2">
                        </div>
                        @if ($errors->error_changepass->has('new_password_confirmation'))
                        <p class="text-danger">
                            {{ $errors->error_changepass->first('new_password_confirmation') }}
                        </p>
                        @endif
                        <button type="submit" id="btn-confirm-changepassword" class="btn-confirm-changepassword" name="btn-confirm-changepassword">{{ __('Confirm')}}</button>
                    </form>
                </div>
            </div>
        </div>

        {{-- transfer member balance modal --}}
        <div class="md-modal md-password-member md-s-height md-effect-1" id="passwordMember">
            <div class="md-content h-100">
                <i class="fal fa-times md-close" onclick="$('.md-password-member').toggleClass('md-show', false)"></i>
                <h3 class="password__multipliers__title mb-3">{{ __('Set Password')}}</h3>
                <div class="passwords__multipliers">
                    <form action="{{ route('set-password-vault') }}" method="post">
                        @csrf
                        <label id="label_pass" for="">{{ __('Password')}}</label>
                        <div class="my-3">
                            <input class="member__password" name="passwordMember1" type="password" maxlength="1">
                            <input class="member__password" name="passwordMember2" type="password" maxlength="1">
                            <input class="member__password" name="passwordMember3" type="password" maxlength="1">
                            <input class="member__password" name="passwordMember4" type="password" maxlength="1">
                            <input class="member__password" name="passwordMember5" type="password" maxlength="1">
                            <input class="member__password" name="passwordMember6" type="password" maxlength="1">
                        </div>
                        <label id="label_confirm" name="label_confirm" for="">{{ __('Confirm Password')}}</label>
                        <div class="my-3">
                            <input class="member__password" id="passwordMemberConfirm" name="passwordMemberConfirm1" type="password" maxlength="1">
                            <input class="member__password" id="passwordMemberConfirm" name="passwordMemberConfirm2" type="password" maxlength="1">
                            <input class="member__password" id="passwordMemberConfirm" name="passwordMemberConfirm3" type="password" maxlength="1">
                            <input class="member__password" id="passwordMemberConfirm" name="passwordMemberConfirm4" type="password" maxlength="1">
                            <input class="member__password" id="passwordMemberConfirm" name="passwordMemberConfirm5" type="password" maxlength="1">
                            <input class="member__password" id="passwordMemberConfirm" name="passwordMemberConfirm6" type="password" maxlength="1">
                        </div>
                        @if ($errors->verifypassword->has('password'))
                        <p class=" text-danger">
                            {{ $errors->verifypassword->first('password') }}
                        </p>
                        @endif
                        @if (session()->has('password_did_not_match'))
                        <p class=" text-danger">
                            {{ session('password_did_not_match') }}
                        </p>
                        @endif
                        <input type="hidden" id="redirect-input" name="redirect-input" style="display: none;">
                        <button type="submit" id="btn-save-set-pass" name="btn-save-set-pass" class="btn-confirm-changepassword">{{ __('Confirm')}}</button>
                    </form>
                </div>
            </div>
        </div>
        {{-- end  --}}

        {{-- transfer safe --}}
        <div class="md-modal md-password-safebox md-s-height md-effect-1 max-600" id="password-safebox">
            <div class="md-content h-100 shadow-blue">
                <i class="fal fa-times md-close" onclick="$('.md-password-safebox').toggleClass('md-show', false)"></i>
                <h3 class="password__multipliers__title mb-3">{{ __('Set Password')}}</h3>
                <div class="passwords__multipliers">
                    <form action="{{ route('set-password-safebox') }}" method="post">
                        @csrf
                        <label id="label_pass_safe" for="">{{ __('Password')}}</label>
                        <div class="my-3">
                            <input class="member__password" name="passwordSafe1" type="password" maxlength="1">
                            <input class="member__password" name="passwordSafe2" type="password" maxlength="1">
                            <input class="member__password" name="passwordSafe3" type="password" maxlength="1">
                            <input class="member__password" name="passwordSafe4" type="password" maxlength="1">
                            <input class="member__password" name="passwordSafe5" type="password" maxlength="1">
                            <input class="member__password" name="passwordSafe6" type="password" maxlength="1">
                        </div>
                        <label id="label_confirm_safe" name="label_confirm_safe" for="">{{ __('Confirm Password')}}</label>
                        <div class="my-3">
                            <input class="member__password" id="passwordSafeConfirm" name="passwordSafeConfirm1" type="password" maxlength="1">
                            <input class="member__password" id="passwordSafeConfirm" name="passwordSafeConfirm2" type="password" maxlength="1">
                            <input class="member__password" id="passwordSafeConfirm" name="passwordSafeConfirm3" type="password" maxlength="1">
                            <input class="member__password" id="passwordSafeConfirm" name="passwordSafeConfirm4" type="password" maxlength="1">
                            <input class="member__password" id="passwordSafeConfirm" name="passwordSafeConfirm5" type="password" maxlength="1">
                            <input class="member__password" id="passwordSafeConfirm" name="passwordSafeConfirm6" type="password" maxlength="1">
                        </div>
                        @if ($errors->verifypasswordsafe->has('password'))
                        <p class=" text-danger">
                            {{ $errors->verifypasswordsafe->first('password') }}
                        </p>
                        @endif
                        @if (session()->has('password_did_not_match_safe'))
                        <p class=" text-danger">
                            {{ session('password_did_not_match_safe') }}
                        </p>
                        @endif
                        <input type="hidden" id="redirect-input-safe" name="redirect-input-safe" style="display: none;">
                        <button type="submit" id="btn-save-set-pass" name="btn-save-set-pass-safe" class="btn-confirm-changepassword">{{ __('Confirm')}}</button>
                    </form>
                </div>
            </div>
        </div>
        {{-- end transfer --}}

        {{-- modal for change profile --}}

        <div class="md-modal md-s-height md-profile-covers md-effect-1" id="profileCovers">
            <div class="md-content md-styled">
                <i class="fal fa-times md-close" onclick="$('.md-profile-covers').toggleClass('md-show', false)"></i>
                <div class="profile__modal">
                    <div class="profile__modal__title">
                        <h3>{{ __('Modifications')}}</h3>
                    </div>

                    <div class="profile__modal__pic">
                        <div class="profile__modal__pic__content">
                            <div class="profile__modal__pic__content--line"></div>
                            <div class="profile__modal__pic__content__image">
                                @if (!Auth::guest())
                                <img class="w-100" id="main_profile" src="{{ asset(Auth::user()->avatar) }}" alt="{{ asset(Auth::user()->avatar) }}">
                                @else
                                <img id="main_profile" class="w-100" src="https://cdn.29bet.com/assets/images/user-profile/image_user3.webp" alt="https://cdn.29bet.com/assets/images/user-profile/image_user3.webp">
                                @endif
                            </div>
                        </div>
                        <div class="profile__modal__pic--username">
                            <h4>
                                @if (!Auth::guest())
                                {{ Auth::user()->username }}
                                @else
                                User00
                                @endif
                            </h4>
                        </div>+
                    </div>

                    <div class="profile__modal__couvers">
                        <div class="profile__modal__couvers__box">
                            <div class="profile__modal__couvers__box__item">
                                @empty($avatars)
                                <div class="profile__modal__couvers__box__item--pic">

                                </div>
                                @else
                                @foreach ($avatars as $usericons)
                                <div class="profile__modal__couvers__box__item--pic">
                                    <img src="{{ asset($usericons['avatar']) }}" alt="{{ asset($usericons['avatar']) }}">
                                </div>
                                @endforeach
                                @endempty
                            </div>
                        </div>
                    </div>

                    <div class="profile__modal__buttons">
                        <button class="profile__modal__buttons--back profile__modal__buttons--default" onclick="$('.md-profile-covers').toggleClass('md-show', false)">{{ __('To go back')}}</button>
                        <button class="profile__modal__buttons--save profile__modal__buttons--default" id="btn-save-image">{{ __('To save')}}</button>
                    </div>
                </div>
            </div>
        </div>
        {{-- end modal --}}
        {{-- Transfer Modal --}}
        <div class="md-modal md-s-height md-effect-1" id="transfer_member_balance">
            <form method="POST" action="{{ route('transfer-agent-balance') }}">
                @csrf
                <div class="md-content h-100">
                    <i class="fal fa-times md-close" onclick="$('#transfer_member_balance').toggleClass('md-show', false)"></i>
                    <div class="members__withdrawl">
                        <h3 class="members__withdrawl__title mb-2">{{ __('Transfer to member balance')}}</h3>
                        <a href="#" class="members__withdrawl__historic">{{ __("Transfer Details for Member's Balance")}}</a>

                        <div class="d-flex align-items-center justify-content-center mt-4">
                            <div class="members__withdrawl__item">
                                <h5 class="members__withdrawl__item__title">{{ __('Agent balance')}}</h5>
                                <p class="members__withdrawl__item__amount" id="agency-balance-text">
                                    @auth
                                    {{ number_format(Auth::user()->balance()->agency_balance, 2) }}
                                    @endauth
                                </p>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" height="40px" width="40px" fill="currentColor" viewBox="0 0 448 512">
                                    <path d="M297.4 9.4c12.5-12.5 32.8-12.5 45.3 0l96 96c12.5 12.5 12.5 32.8 0 45.3l-96 96c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L338.7 160H128c-35.3 0-64 28.7-64 64v32c0 17.7-14.3 32-32 32s-32-14.3-32-32V224C0 153.3 57.3 96 128 96H338.7L297.4 54.6c-12.5-12.5-12.5-32.8 0-45.3zm-96 256c12.5-12.5 32.8-12.5 45.3 0l96 96c12.5 12.5 12.5 32.8 0 45.3l-96 96c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L242.7 416H96c-17.7 0-32 14.3-32 32v32c0 17.7-14.3 32-32 32s-32-14.3-32-32V448c0-53 43-96 96-96H242.7l-41.4-41.4c-12.5-12.5-12.5-32.8 0-45.3z" />
                                </svg>
                            </div>
                            <div class="members__withdrawl__item">
                                <h5 class="members__withdrawl__item__title">{{ __('Member balance')}}</h5>
                                <p class="members__withdrawl__item__amount" id="member-balance-text">
                                    @auth
                                    {{ number_format(Auth::user()->balance()->control_balance, 2) }}
                                    @endauth
                                </p>
                            </div>
                        </div>

                        <div class="my-3">
                            <label for="#">{{ __('Transfer Amount')}}</label>
                            <div class="d-flex align-items-center gap-2 members__withdrawl__value mt-2">
                                <input type="text" id="amount" name="amount" placeholder="{{ __('Enter the amount you want to transfer')}}" required>
                            </div>
                            @if (session()->has('session_transfer_balance'))
                            <div class="form-text text-danger col-sm-12">
                                {{ session('session_transfer_balance') }}
                            </div>
                            @endif
                        </div>
                        <div class="my-3">
                            <button class="members__withdrawl__submit" name="members__withdrawl__submit" id="convert_button">{{ __('Convert')}}</button>
                        </div>

                    </div>
                </div>

            </form>
        </div>
        {{-- end --}}
        {{-- Transfer Safe Modal --}}
        <div class="md-modal md-s-height md-effect-1 max-600" id="transfer_safe_balance">
            <form method="POST" action="{{ route('transfer-safety-normal') }}">
                @csrf
                <div class="md-content h-100 shadow-blue">
                    <i class="fal fa-times md-close" onclick="$('#transfer_safe_balance').toggleClass('md-show', false)"></i>
                    <div class="members__withdrawl" id="transfer_safe_balance_content">
                        <h3 class="members__withdrawl__title mb-2">{{ __('Transfer to Safety Wallet')}}</h3>
                        <a href="#" class="members__withdrawl__historic">{{ __("Transfer details for Member's Safety Wallet")}}</a>

                        <div class="d-lg-flex d-md-flex align-items-center justify-content-center mt-4">
                            <div class="members__withdrawl__item">
                                <h5 class="members__withdrawl__item__title">{{ __('Normal Wallet')}}</h5>
                                @auth
                                <p class="members__withdrawl__item__amount safety_normal" data-value="{{ Auth::user()->balance()->control_balance }}" id="member-balance-text">
                                    {{ number_format(Auth::user()->balance()->control_balance, 2, ',', '.') }}
                                </p>
                                @endauth
                            </div>
                            <div>
                                <svg class="transfer__ico" xmlns="http://www.w3.org/2000/svg" height="40px" width="40px" fill="currentColor" viewBox="0 0 448 512">
                                    <path d="M297.4 9.4c12.5-12.5 32.8-12.5 45.3 0l96 96c12.5 12.5 12.5 32.8 0 45.3l-96 96c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L338.7 160H128c-35.3 0-64 28.7-64 64v32c0 17.7-14.3 32-32 32s-32-14.3-32-32V224C0 153.3 57.3 96 128 96H338.7L297.4 54.6c-12.5-12.5-12.5-32.8 0-45.3zm-96 256c12.5-12.5 32.8-12.5 45.3 0l96 96c12.5 12.5 12.5 32.8 0 45.3l-96 96c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L242.7 416H96c-17.7 0-32 14.3-32 32v32c0 17.7-14.3 32-32 32s-32-14.3-32-32V448c0-53 43-96 96-96H242.7l-41.4-41.4c-12.5-12.5-12.5-32.8 0-45.3z" />
                                </svg>
                            </div>
                            <div class="members__withdrawl__item">
                                <h5 class="members__withdrawl__item__title">{{ __('Safety Wallet')}}</h5>
                                @auth
                                <p class="members__withdrawl__item__amount safety_safety" data-value="{{ Auth::user()->balance()->safety_balance }}" id="agency-balance-text">
                                    {{ number_format(Auth::user()->balance()->safety_balance, 2, ',', '.') }}
                                </p>
                                @endauth
                            </div>
                        </div>

                        <div class="my-3">
                            <label for="#">{{ __('Transfer Amount')}}</label>
                            <div class="d-flex align-items-center gap-2 members__withdrawl__value mt-2">
                                <input type="text" id="amount" name="safety_amount" placeholder="{{ __("Please enter a number") }}">
                            </div>
                        </div>
                        <div >
                            <button class="members__withdrawl__submit my-2" name="members__withdrawl__submit_safe" id="convert_button">{{ __('Convert')}}</button>
                            <button type="button" class="members__withdrawl__submit my-2" onclick="toggleContent()">{{ __("Transfer to Normal Wallet") }}</button>
                        </div>
                    </div>
                    <div id="transfer_normal_balance_content" style="display: none;">
                        <div class="members__withdrawl">
                            <div>
                                <h3 class="members__withdrawl__title mb-2">{{ __('Transfer to Normal Wallet')}}</h3>
                                <a href="#" class="members__withdrawl__historic">{{ __("Transfer details for Member's Normal Balance")}}</a>
                                <div class="d-lg-flex d-md-flex align-items-center justify-content-center mt-4">
                                    <div class="members__withdrawl__item">
                                        <h5 class="members__withdrawl__item__title">{{ __("Safety Wallet")}}</h5>
                                        @auth
                                        <p class="members__withdrawl__item__amount normal_safety" data-value="{{ Auth::user()->balance()->safety_balance }}" id="member-balance-text">
                                            {{ number_format(Auth::user()->balance()->safety_balance, 2, ',', '.') }}
                                        </p>
                                        @endauth
                                    </div>
                                    <div>
                                        <svg xmlns="http://www.w3.org/2000/svg" height="40px" width="40px" fill="currentColor" viewBox="0 0 448 512">
                                            <path d="M297.4 9.4c12.5-12.5 32.8-12.5 45.3 0l96 96c12.5 12.5 12.5 32.8 0 45.3l-96 96c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L338.7 160H128c-35.3 0-64 28.7-64 64v32c0 17.7-14.3 32-32 32s-32-14.3-32-32V224C0 153.3 57.3 96 128 96H338.7L297.4 54.6c-12.5-12.5-12.5-32.8 0-45.3zm-96 256c12.5-12.5 32.8-12.5 45.3 0l96 96c12.5 12.5 12.5 32.8 0 45.3l-96 96c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L242.7 416H96c-17.7 0-32 14.3-32 32v32c0 17.7-14.3 32-32 32s-32-14.3-32-32V448c0-53 43-96 96-96H242.7l-41.4-41.4c-12.5-12.5-12.5-32.8 0-45.3z" />
                                        </svg>
                                    </div>
                                    <div class="members__withdrawl__item">
                                        <h5 class="members__withdrawl__item__title">{{ __('Normal Wallet')}}</h5>
                                        @auth
                                        <p class="members__withdrawl__item__amount normal_normal" data-value="{{ Auth::user()->balance()->control_balance }}" id="member-balance-text">
                                            {{ number_format(Auth::user()->balance()->control_balance, 2, ',', '.') }}
                                        </p>
                                        @endauth
                                    </div>
                                </div>

                                <div class="my-3">
                                    <label for="#">{{ __("Transfer Amount") }}</label>
                                    <div class="d-flex align-items-center gap-2 members__withdrawl__value mt-2 my">
                                        <input type="text" id="amount" name="normal_amount" placeholder="{{ __("Please enter a number") }}">
                                    </div>

                                </div>
                                <div >
                                    <button class="members__withdrawl__submit my-2" name="members__withdrawl__submit" id="convert_button">{{ __('Convert')}}</button>
                                    <button type="button" class="members__withdrawl__submit my-2" onclick="revertContent()">{{ __("Transfer Safety Wallet")}}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </div>

        @if (session()->has('session_transfer_safety_normal'))
            <div class="md-modal md-bonus-code md-s-height md-effect-1 md-show" id="errorSession">
                <div class="md-content h-100 md-please-login-content shadow-blue">
                    <i class="fal fa-times md-close" onclick="$('.md-bonus-code').toggleClass('md-show', false)"></i>
                    <div class="w-100 pt-2 text-center">
                        <img src="https://cdn.29bet.com/assets/img/warning.webp" alt="https://cdn.29bet.com/assets/img/warning.webp" style="width: 8rem;">
                        <p class="mt-2 mb-3">{{ __(session('session_transfer_safety_normal')) }}</p>
                        <button class="btn btn-29" onclick="window.location.href = '/';">{{ __("Okay") }}</button>
                    </div>
                </div>
            </div>
        @endif

        {{-- end --}}
        {{-- Change Transfer Balance  --}}
        <div class="md-modal md-reset-password-withdrawal md-s-height md-effect-1" id="resetWithdrawPassword">
            <div class="md-content h-100">
                <i class="fal fa-times md-close" onclick="$('.md-reset-password-withdrawal').toggleClass('md-show', false)"></i>
                <div class="resetWithdrawPassword">
                    <h3>{{ __('Change Password Transfer Balance')}}</h3>
                    <form action="{{ route('change-password-transfer-balance') }}" method="POST">
                        @csrf
                        <div class="my-3">
                            <label class="d-block w-100" for="#">{{ __('Transfer Current Password')}}</label>
                            <input type="password" id="transfer_current_password" name="transfer_current_password" class="resetWithdrawPassword--input mt-2">
                            @if ($errors->error_transfer->has('transfer_current_password'))
                            <p class="text-danger">
                                {{ $errors->error_transfer->first('transfer_current_password') }}
                            </p>
                            @endif
                            @if (session()->has('session_changepass_md_not_match_transfer'))
                            <p class="text-danger">
                                {{ session('session_changepass_md_not_match_transfer') }}
                            </p>
                            @endif
                        </div>
                        <div class="my-3">
                            <label class="d-block w-100" for="#">{{ __('Transfer New Password')}}</label>
                            <input type="password" id="transfer_new_password" name="transfer_new_password" class="resetWithdrawPassword--input mt-2">
                            @if ($errors->error_transfer->has('transfer_new_password'))
                            <p class="text-danger">
                                {{ $errors->error_transfer->first('transfer_new_password') }}
                            </p>
                            @endif
                        </div>
                        <div class="my-3">
                            <label class="d-block w-100" for="#">{{ __('Transfer Confirm New Password')}}</label>
                            <input type="password" id="transfer_confirm_new_password" name="transfer_confirm_new_password" class="resetWithdrawPassword--input mt-2">
                            @if ($errors->error_transfer->has('transfer_confirm_new_password'))
                            <p class="text-danger">
                                {{ $errors->error_transfer->first('transfer_confirm_new_password') }}
                            </p>
                            @endif
                        </div>
                        <div class="my-3">
                            <button id="btn-reset-password-withdrawal" name="btn-reset-password-withdrawal" type="submit" class="btn-confirm-changepassword">{{ __('Save')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <div class="md-modal md-bonus-code md-s-height md-effect-1" id="modalBonusCode">
            <div class="md-content h-100">
                <i class="fal fa-times md-close" onclick="$('.md-bonus-code').toggleClass('md-show', false)"></i>
                <div class="bonuscode">
                    <h3 class="bonuscode--title mb-3">{{ __('Promotion code')}}</h3>
                    <p class="bonuscode--description mb-3">{{ __('Enter your promo code and get cool Bonus at 29Bet.')}}</p>
                    <input type="text" class="bonuscode--input mb-3">
                    {{-- <img src="{{ asset('img/GIFT_MODAL.webp') }}" alt=""> --}}
                    <button class="bonuscode--btn">{{ __('Redeem code')}}</button>
                </div>
            </div>
        </div>

        <div class="md-modal md-password-transfer-security md-s-height md-effect-1 max-600" id="passwordWithdrawl">
            <div class="md-content h-100">
                <i class="fal fa-times md-close" onclick="$('.md-password-transfer-security').toggleClass('md-show', false)"></i>
                <div class="passwords__withdrawl">
                    <h3 class="my-2">{{ __('Withdrawal password')}}</h3>
                    <form action="dd" method="post">
                        <input class="member__password" name="passwordMember" type="password" maxlength="1">
                        <input class="member__password" name="passwordMember" type="password" maxlength="1">
                        <input class="member__password" name="passwordMember" type="password" maxlength="1">
                        <input class="member__password" name="passwordMember" type="password" maxlength="1">
                        <input class="member__password" name="passwordMember" type="password" maxlength="1">
                        <input class="member__password" name="passwordMember" type="password" maxlength="1">
                    </form>
                </div>
            </div>
        </div>

        <div class="md-modal md-transfer-security md-s-height md-effect-1 max-600" id="transferSecurity">
            <div class="md-content h-100">
                <i class="fal fa-times md-close" onclick="$('.md-transfer-security').toggleClass('md-show', false)"></i>
                <div class="members__withdrawl">
                    <h3 class="members__withdrawl__title mb-2">{{ __('Secure Transfer')}}</h3>
                    <a href="#" class="members__withdrawl__historic">{{ __('View your vault security details')}}</a>

                    <ul class="profile__tabs tab-list  d-flex gap-2 justify-content-center">
                        <li class="profile__tab my-tab" data-tab-target="transferSecurity1">
                            <p>{{ __('Transfer to insurance')}}</p>
                        </li>
                        <li class="profile__tab my-tab" data-tab-target="transferSecurity2">
                            <p>{{ __('Transfer out of the vault')}}</p>
                        </li>
                    </ul>


                    <div class="my-tab-content  tab__styled__profile" id="transferSecurity1">
                        <div>
                            <div class="d-flex align-items-center justify-content-center mt-4">
                                <div class="members__withdrawl__item">
                                    <h5 class="members__withdrawl__item__title">{{ __('wallet value')}}</h5>
                                    <p class="members__withdrawl__item__amount" id="agency-balance-text">
                                        0
                                    </p>
                                </div>
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" height="40px" width="40px" fill="currentColor" viewBox="0 0 448 512">
                                        <path d="M297.4 9.4c12.5-12.5 32.8-12.5 45.3 0l96 96c12.5 12.5 12.5 32.8 0 45.3l-96 96c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L338.7 160H128c-35.3 0-64 28.7-64 64v32c0 17.7-14.3 32-32 32s-32-14.3-32-32V224C0 153.3 57.3 96 128 96H338.7L297.4 54.6c-12.5-12.5-12.5-32.8 0-45.3zm-96 256c12.5-12.5 32.8-12.5 45.3 0l96 96c12.5 12.5 12.5 32.8 0 45.3l-96 96c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L242.7 416H96c-17.7 0-32 14.3-32 32v32c0 17.7-14.3 32-32 32s-32-14.3-32-32V448c0-53 43-96 96-96H242.7l-41.4-41.4c-12.5-12.5-12.5-32.8 0-45.3z" />
                                    </svg>
                                </div>
                                <div class="members__withdrawl__item">
                                    <h5 class="members__withdrawl__item__title">{{ __('Amount of safe deposit')}}</h5>
                                    <p class="members__withdrawl__item__amount" id="member-balance-text">
                                        43
                                    </p>
                                </div>
                            </div>

                            <div class="my-3">
                                <label for="#">{{ __('transfer amount')}}</label>
                                <div class="d-flex align-items-center gap-2 members__withdrawl__value mt-2">
                                    <input type="text" id="amount" name="amount" placeholder="Por favor, insira um valor inteiro!" required>
                                </div>

                            </div>
                            <div class="my-3">
                                <button class="members__withdrawl__submit" name="members__withdrawl__submit" id="convert_button">{{ __('Converter')}}</button>
                            </div>
                        </div>
                    </div>
                    <div class="my-tab-content  tab__styled__profile" id="transferSecurity2">
                        <div>
                            <div class="d-flex align-items-center justify-content-center mt-4">
                                <div class="members__withdrawl__item">
                                    <h5 class="members__withdrawl__item__title">{{ __('Amount of safe deposit')}}</h5>
                                    <p class="members__withdrawl__item__amount" id="agency-balance-text">
                                        2
                                    </p>
                                </div>
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" height="40px" width="40px" fill="currentColor" viewBox="0 0 448 512">
                                        <path d="M297.4 9.4c12.5-12.5 32.8-12.5 45.3 0l96 96c12.5 12.5 12.5 32.8 0 45.3l-96 96c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L338.7 160H128c-35.3 0-64 28.7-64 64v32c0 17.7-14.3 32-32 32s-32-14.3-32-32V224C0 153.3 57.3 96 128 96H338.7L297.4 54.6c-12.5-12.5-12.5-32.8 0-45.3zm-96 256c12.5-12.5 32.8-12.5 45.3 0l96 96c12.5 12.5 12.5 32.8 0 45.3l-96 96c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L242.7 416H96c-17.7 0-32 14.3-32 32v32c0 17.7-14.3 32-32 32s-32-14.3-32-32V448c0-53 43-96 96-96H242.7l-41.4-41.4c-12.5-12.5-12.5-32.8 0-45.3z" />
                                    </svg>
                                </div>
                                <div class="members__withdrawl__item">
                                    <h5 class="members__withdrawl__item__title">{{ __('wallet value')}}</h5>
                                    <p class="members__withdrawl__item__amount" id="member-balance-text">
                                        43
                                    </p>
                                </div>
                            </div>

                            <div class="my-3">
                                <label for="#">{{ __('Transfer amount')}}</label>
                                <div class="d-flex align-items-center gap-2 members__withdrawl__value mt-2">
                                    <input type="text" id="amount" name="amount" placeholder="Por favor, insira um valor inteiro!" required>
                                </div>

                            </div>
                            <div class="my-3">
                                <button class="members__withdrawl__submit" name="members__withdrawl__submit" id="convert_button">{{ __('Converter')}}</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>


        <div class="md-modal md-s-height md-wheel-new-bonus md-effect-1 dsdsdsds" id="wheel">
            <div class="md-content wheel__new fs">
                <div class="wheel__new__controls d-flex gap-0 gap-sm-1 align-items-center">
                    <button class="wheel__new__controls__btn wheel__new--faq" onclick="CslXL.sCF()">
                        <img src="https://cdn.29bet.com/assets/img/all/components/wheel-bonus/faq.webp" alt="https://cdn.29bet.com/assets/img/all/components/wheel-bonus/faq.webp">
                    </button>
                    <button class="wheel__new__controls__btn wheel__new--sound">
                        <img src="https://cdn.29bet.com/assets/img/all/components/wheel-bonus/sound-on.webp" alt="https://cdn.29bet.com/assets/img/all/components/wheel-bonus/sound-on.webp">
                    </button>
                    <button class="wheel__new__controls__btn wheel__new--close " onclick="$('#wheel').toggleClass('md-show', false)">
                        <img src="https://cdn.29bet.com/assets/img/all/components/wheel-bonus/x.webp" alt="https://cdn.29bet.com/assets/img/all/components/wheel-bonus/x.webp">
                    </button>
                </div>
                <div class="wheel__new__all d-lg-flex">
                    <div class="wheel__new__all__roulett">
                        <div class="wheel__new__content position-relative">
                            <div class="wheel__new__content__background fs_bg">
                                <img class="wheel__new__content__background--line fs_bl" alt="">
                                <img class="wheel__new__content__background--spin fs_bs" alt="">
                                <div class="wheel__new__content__roulette">
                                    <canvas class="wheel__new__content__roulette--canvas" id="canvas" width="460" height="460"></canvas>
                                </div>
                                <a class="wheel__btn" id="spin_button" @auth onclick="CslXL.sPn()" @else onclick="$('[data-auth-action=\'auth\']').click(); $('.md-auth').toggleClass('md-show', true); $('.md-wheel-new-bonus').toggleClass('md-show', false)" @endauth>
                                    <img class="fs_ws" alt="">
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="wheel__new__content__info">
                        <div class="wheel__new__content__info__others">
                            <div class="wheel__new__content__others__award"
                            >
                                <img class="wheel__new__content__others__award__found fs_af" alt="">
                                <h5>Prêmio total da roleta</h5>
                                <h2>R$ <span id="tTldPst">{{ number_format($data['total'], 2, ',', '.') }}</span></h2>
                            </div>
                            <div class="wheel__new__content__others__person">
                                <img class="fs_wp" alt="">
                            </div>
                            <div class="wheel__new__content__others__play">
                                <img class="wheel__new__content__others__play--line d-none d-lg-block fs_pl" alt="">
                                @auth
                                    <div class="wheel__new__content__others__play__progress fs_py">
                                        <div class="wheel__new__content__others__play__progress__bg">
                                            <p><span id="tTlmAp">0</span> / <span id="tTlnCs">0</span></p>
                                        </div>
                                        <div class="wheel__new__content__others__play--number fs_nm">
                                            <p id="tTlccS">0</p>
                                        </div>
                                    </div>
                                @else
                                    <div class="wheel__new__content__others__play__progress ua_bg">
                                        <p>Faça o login e gire</p>
                                    </div>
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
                <div class="wheel__new__historic d-flex gap-5 align-items-center">
                    <div class="wheel__new__historic__value d-flex gap-1 align-items-center">
                    @foreach ($data['freeSpin_data'] as $dt)
                        <div class="wheel__new__historic__item prize"><p>{{ $dt->win }}</p><img src="https://cdn.29bet.com/assets/img/all/components/wheel-bonus/money-ico.webp" alt="https://cdn.29bet.com/assets/img/all/components/wheel-bonus/money-ico.webp"></div>
                    @endforeach
                    </div>
                    <div class="wheel__new__historic__description">
                        <a class="d-flex gap-1 align-items-center" onclick="CslXL.sCJ()" href="javascript:void(0);">
                            <span class="d-none d-lg-block">{{ __("Recent jackpots") }}</span>
                            <span class="mt-1"><i class="fas fa-chevron-right"></i></span>
                        </a>
                    </div>
                </div>

                <div class="wheel__new__informations">
                    <div class="wheel__new__informations__card " id="wheelNewInformationFaq">
                        <div class="wheel__new__informations__card__header">
                            <h3 class="wheel__new__informations__card__header--title">Regras</h3>
                            <button class="wheel__new__controls__btn wheel__new--close wheel__new__informations__card__header--close" onclick="CslXL.sCF()">
                                <img src="https://cdn.29bet.com/assets/img/all/components/wheel-bonus/x.webp" alt="https://cdn.29bet.com/assets/img/all/components/wheel-bonus/x.webp">
                            </button>
                        </div>
                        <div class="wheel__new__informations__card__body">
                            <div class="rule_father">
                                <p>
                                    Condições:
                                    <br>
                                    1.&nbsp;
                                    <span>ROLETA DA SORTE 29BET</span>
                                </p>
                                <p>
                                    <br>
                                    Faça suas apostas no jogo todos os dias e gire nossa roleta da Sorte para ganhar prêmios em dinheiro real ou até mesmo o maior prêmio, um IPHONE 14, avaliado em R$ 6.000,00!
                                    <br><br>
                                    Regras da Roleta da Sorte:
                                    <br><br>
                                    1 - O horário padrão é 00:00-24:00 todos os dias;
                                    <br><br>
                                    2 - Os membros podem girar a Roleta da Sorte uma vez para cada R$ 1.000 apostado em qualquer jogo, quanto mais apostas forem feitas, mais vezes para girar você ganha, não há limite máximo;
                                    <br><br>
                                    3 - Os membros que ganharem um prêmio físico (iPhone 14) receberão uma carta interna da 29BET e um gerente de atendimento ao cliente VIP entrará em contato com o cliente para enviar o prêmio.
                                    <br><br>
                                    Termos e Condições.
                                    <br><br>
                                    1 - Cada jogador só pode ter uma conta;
                                    <br><br>
                                    2 - Os jogadores que abrirem várias contas ou se fizerem passar por uma conta serão desqualificados da promoção. Os saldos podem ser confiscados e as contas serão bloqueadas;
                                    <br><br>
                                    3 - 29BET se reserva o direito de modificar, alterar, suspender, rejeitar ou cancelar esta promoção a seu exclusivo critério.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="wheel__new__informations__card " id="wheelNewInformationJackpot">
                        <div class="wheel__new__informations__card__header">
                            <h3 class="wheel__new__informations__card__header--title">{{ __("Recent jackpots") }}</h3>
                            <button class="wheel__new__controls__btn wheel__new--close wheel__new__informations__card__header--close" onclick="CslXL.sCJ()">
                                <img src="https://cdn.29bet.com/assets/img/all/components/wheel-bonus/x.webp" alt="https://cdn.29bet.com/assets/img/all/components/wheel-bonus/x.webp">
                            </button>
                        </div>

                        <div class="wheel__new__informations__card__tabs mb-3">
                            <div class="tab-wheel-container">
                                <div class="tab-wheel-bonus freespin_tab_1 activer" onclick="CslXL.sT('wheelContentResultRecent', 1)">Recent award</div>
                                <div class="tab-wheel-bonus freespin_tab_2" onclick="CslXL.sT('wheelContentResultJackpot', 2)">Jackpot</div>
                            </div>
                        </div>

                        <div class="content-wheel-bonus active" id="wheelContentResultRecent">
                            <div class="wheel__new__informations__card__body">
                                <div class="wheel__new__informations__card__body__table">
                                    <table class="table__jackpot">
                                        <thead class="table__jackpot__header">
                                            <tr class="default__table__header__content table__jackpot__header__content">
                                                <th scope="col" class="default__table__header__content--item table__jackpot__header__content--item" style="width: 146px;">Time</th>
                                                <th scope="col" class="default__table__header__content--item table__jackpot__header__content--item" style="width: 146px;">User</th>
                                                <th scope="col" class="default__table__header__content--item table__jackpot__header__content--item" style="width: 146px;">Bonus</th>
                                            </tr>
                                        </thead>

                                        <tbody class="default__table__body table__jackpot__body">
                                        @foreach ($data['freeSpin_data'] as $dt)
                                            <tr class="odd table__jackpot__body__content">
                                                <td valign="top" class="dataTables_empty table__jackpot__body__content--item">{{ $dt->created_at }}</td>
                                                <td valign="top" class="dataTables_empty table__jackpot__body__content--item">User{{ $dt->username }}</td>
                                                <td valign="top" class="dataTables_empty table__jackpot__body__content--item d-flex align-items-center gap-2">{{ $dt->win }} <img width="25" height="25" src="https://cdn.29bet.com/assets/img/all/components/wheel-bonus/money-ico.webp" alt="https://cdn.29bet.com/assets/img/all/components/wheel-bonus/money-ico.webp"></td>
                                            </tr>
                                        @endforeach
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="content-wheel-bonus" id="wheelContentResultJackpot">
                            <div class="wheel__new__informations__card__body">
                                <div class="wheel__new__informations__card__body__table">
                                    <table class="table__jackpot">
                                        <thead class="table__jackpot__header">
                                            <tr class="default__table__header__content table__jackpot__header__content">
                                                <th scope="col" class="default__table__header__content--item table__jackpot__header__content--item" style="width: 146px;">User</th>
                                                <th scope="col" class="default__table__header__content--item table__jackpot__header__content--item" style="width: 146px;">Bonus</th>
                                            </tr>
                                        </thead>

                                        <tbody class="default__table__body table__jackpot__body">
                                        @foreach ($data['freeSpin_jackpot'] as $dt)
                                            <tr class="odd table__jackpot__body__content">
                                                <td valign="top" class="dataTables_empty table__jackpot__body__content--item">User{{ $dt->uid }}</td>
                                                <td valign="top" class="dataTables_empty table__jackpot__body__content--item d-flex align-items-center gap-2">
                                            @if ($dt->win == 0)
                                            <img width="25" height="25" src="https://cdn.29bet.com/assets/img/apple.webp" alt="https://cdn.29bet.com/assets/img/apple.webp">
                                            {{ "iPhone14" }}
                                            @else
                                                <img width="25" height="25" src="https://cdn.29bet.com/assets/img/all/components/wheel-bonus/money-ico.webp" alt="https://cdn.29bet.com/assets/img/all/components/wheel-bonus/money-ico.webp">
                                                {{ $dt->win }}
                                            @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>

        <div class="confetti" style="display: none" id="confetti__wheel__win">
            @for ($i = 0; $i < 32; $i++)
              <div class="confetti-piece"></div>
            @endfor
        </div>

        <div class="md-modal md-result-wheel-bonus md-s-height md-effect-1 max-600 result__wheel" id="mdResultWheelBonus" style="max-width: 500px">
            <div class="md-content shadow-blue h-100">
                <i class="fal fa-times md-close" onclick="$('.md-result-wheel-bonus').toggleClass('md-show', false);"></i>
                <div class="result__wheel__content">
                    <div class="result__wheel__content__images text-center">
                        <img class="result__wheel__content__images--gift" src="https://cdn.29bet.com/assets/img/all/components/wheel-bonus/wheel-gift.webp" alt="https://cdn.29bet.com/assets/img/all/components/wheel-bonus/wheel-gift.webp">
                        <img class="result__wheel__content__images--stars" src="https://cdn.29bet.com/assets/img/stars.webp" alt="https://cdn.29bet.com/assets/img/stars.webp">
                    </div>
                    <div class="result__wheel__content__status mt-4">
                        <p class="result__wheel__content__status--text">{{ __("CONGRATULATION, YOU WON!!") }}</p>
                        <p class="result__wheel__content__status--money">R$ <span class="color-red" id="free_spin_win">0.00</span></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="md-modal md-result-wheel-lose md-s-height md-effect-1 max-600 result__wheel" id="mdResultWheelBonus" style="max-width: 500px">
            <div class="md-content shadow-blue h-100">
                <i class="fal fa-times md-close" onclick="$('.md-result-wheel-lose').toggleClass('md-show', false);"></i>
                <div class="result__wheel__content">
                    <div class="result__wheel__content__status mt-4 text-center">
                        <img class="result__wheel__content__status--lose mb-2" src="https://cdn.29bet.com/assets/img/all/components/wheel-bonus/wheel-result-lose.webp" alt="https://cdn.29bet.com/assets/img/all/components/wheel-bonus/wheel-result-lose.webp">
                        <p class="result__wheel__content__status--text">{{ __("THAT WAS CLOSE! TRY NEXT") }}</p>
                    </div>
                </div>
            </div>
        </div>


        @include('layouts.includes.all-modals-games')

        {{-- end --}}
        <div class="md-overlay"></div>
    </div>
    <div>

<script>
    let freespin = new Object();
    freespin.segments = JSON.parse("{{ $data['segments'] }}".replace(/&quot;/g, '"'));
    freespin.rouletteBG = "{{ $data['prizes'] }}";
    $('.wheel__new__historic__item.prize').find('img').attr(
        {
            "src" : "https://cdn.29bet.com/assets/img/all/components/wheel-bonus/money-ico.webp",
            "alt" : "https://cdn.29bet.com/assets/img/all/components/wheel-bonus/money-ico.webp"
        }
    );
    $('.wheel__new__historic__item.big-prize').find('img').attr(
        {
            "src" : "https://cdn.29bet.com/assets/img/all/pages/layout/favicon.webp",
            "alt" : "https://cdn.29bet.com/assets/img/all/pages/layout/favicon.webp",
        }
    );
    $('.wheel__new__historic__item.jackpot').find('img').attr(
        {
            "src" : "https://cdn.29bet.com/assets/img/apple.webp",
            "alt" : "https://cdn.29bet.com/assets/img/apple.webp",
        }
    );


    const jsonStrOpt = {
        style: 'decimal',
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
    };


    $('input[name=safety_amount]').on("keyup", function() {
        let val = parseFloat($(this).val()).toFixed(2);
        let safety_normal_val = parseFloat($('.safety_normal').attr('data-value')).toFixed(2);
        let safety_safety_val = parseFloat($('.safety_safety').attr('data-value')).toFixed(2);

        if (isNaN(val)) {
            val = 0.00;
        }

        if (Number(val) > Number(safety_normal_val)) {
            val = safety_normal_val;
            $(this).val(safety_normal_val.toLocaleString("pt-BR", jsonStrOpt));
        }

        $('.safety_normal').text(parseFloat(Number(safety_normal_val) - Number(val)).toLocaleString("pt-BR", jsonStrOpt));
        $('.safety_safety').text(parseFloat(Number(val) + Number(safety_safety_val)).toLocaleString("pt-BR", jsonStrOpt));
    });

    $('input[name=normal_amount]').on("keyup", function() {
        let val = parseFloat($(this).val()).toFixed(2);
        let normal_safety_val = parseFloat($('.normal_safety').attr('data-value')).toFixed(2);
        let normal_normal_val = parseFloat($('.normal_normal').attr('data-value')).toFixed(2);

        if (isNaN(val)) {
            val = 0.00;
        }

        if (Number(val) > Number(normal_safety_val)) {
            val = normal_safety_val;
            $(this).val(normal_safety_val.toLocaleString("pt-BR", jsonStrOpt));
        }

        $('.normal_safety').text(parseFloat(Number(normal_safety_val) - Number(val)).toLocaleString("pt-BR", jsonStrOpt));
        $('.normal_normal').text(parseFloat(Number(val) + Number(normal_normal_val)).toLocaleString("pt-BR", jsonStrOpt));
    });

    const content1 = document.getElementById('transfer_safe_balance_content');
    const content2 = document.getElementById('transfer_normal_balance_content');

    function toggleContent() {
        if (content1.style.display === 'none') {
            content1.style.display = 'block';
            content2.style.display = 'none';
        } else {
            content1.style.display = 'none';
            content2.style.display = 'block';
        }
    }

    function revertContent() {
        content1.style.display = 'block';
        content2.style.display = 'none';
    }

    $('.passwords__withdrawl [type="password"]').each(function(i) {
        $(this).on('input', function() {
            if (this.value.length === 1) {
                let next = $(this).next('input[type="password"]');
                if (next.length) {
                    this.blur();
                    next.focus();
                } else if (!next.length && i === $('.passwords__withdrawl [type="password"]').length -
                    1 && $('.passwords__withdrawl [type="password"]').toArray().every(input => input
                        .value.length > 0)) {
                    $('.md-password-transfer-security').removeClass('md-show');
                    $('.md-transfer-security').addClass('md-show');
                }
            }
        });

        $(this).on('keydown', function(event) {
            if (event.key === 'Backspace' && this.value.length === 0) {
                let prev = $(this).prev('input[type="password"]');
                if (prev.length) {
                    this.blur();
                    prev.focus();
                }
            }
        });
    });


    </script>
    <script src="/js/LJWlqyz.js"></script>
    <script>
    function WalletLink() {

    // const token = $('meta[name=csrf-token]').attr('content');
    $.ajax({

        url: '{{route("level_info")}}',
        type: 'POST',
        data: {
            "_token": $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {

            const data = response.data;
            $('#tax').text('{{ __("Withdrawal Fee: ")}}' + data.level_info.withdrawal_rate + '%');
            $('#free_withdraw').text('{{ __("Free monthly withdrawal amount: BRL ")}}' + data.level_info.monthly_free_withdrawal);
            $('#minimum_withdrawal').text('{{ __("Minimum withdrawal request: BRL ")}}' + data.minimum_withdrawal);
            $('#maximum_withdraw').text('{{ __("Maximum withdrawal request: BRL ")}}' + data.level_info.max_withdraw_amount);
            $('#month_cycle').text('{{ __("The withdrawal amount will be replenished every ")}}' + data.level_info.max_withdraw_amount_period_cover + ' {{ __("months")}}');
            $('#pix').attr('placeholder', '{{ __("Enter the amount (BRL ")}}' + data.minimum_withdrawal + '{{ __(" - BRL ")}}' + data.level_info.max_withdraw_amount + '.00)');

        },
        error: function() {

            console.log('Error occurred during AJAX request');

        }

    });

    }

    var promotionId = 0;
    var promotion = null;
    var calculation_method = 0;
    function getPromoRecharge(){

        $('.pageLoaderRecharge').css('display', 'flex');
        $('.pageLoaderRecharge').addClass('bg-callback-overlay');

        $.ajax({

        url: '{{route("getPromoRecharge")}}',
        type: 'POST',
        data: {
            "_token": $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {

            var amount_array = [30, 100, 200, 500, 1000, 2000, 5000, 19999];
            var discount_amount = response.discount_amount;
            var i = 0;

            if (discount_amount.length > 0) {

                $.each(amount_array, function(index, amount){

                    if (amount == response.amount[i] && response.amount[i] != null) {

                        var bonus = discount_amount[i] + " Bonus";
                        $('.recharge_'+amount).text(bonus);

                        i++;

                    }else{

                        if (i == 0) {

                            if (amount == response.amount[i] && response.amount[i] != null) {

                                var bonus = discount_amount[i] + " Bonus";
                                $('.recharge_'+amount).text(bonus);

                            }

                        }else{

                            var bonus = discount_amount[i-1] + " Bonus";
                            $('.recharge_'+amount).text(bonus);

                        }

                    }

                });

            }else{
                
                promotionId = 0;

            }

            $('#promo_name').text(response.name ?? "");
            promotion = response.promotion;
            calculation_method = parseInt(response.calculation_method);

            $('.pageLoaderRecharge').css('display', 'none');
            $('.pageLoaderRecharge').removeClass('bg-callback-overlay');

        },
        error: function() {

            $('.pageLoaderRecharge').css('display', 'none');
            $('.pageLoaderRecharge').removeClass('bg-callback-overlay');
            location.reload();

        }

    });

    }

    $('#one').on("keyup", function() {

        $('.deposit_bonus').text("");
        var inputValue = $(this).val();
        var inputLength = inputValue.length;

        const rch_ranges = [
            { min: 30, max: 99, class: 'recharge_30' },
            { min: 100, max: 199, class: 'recharge_100' },
            { min: 200, max: 499, class: 'recharge_200' },
            { min: 500, max: 999, class: 'recharge_500' },
            { min: 1000, max: 1999, class: 'recharge_1000' },
            { min: 2000, max: 4999, class: 'recharge_2000' },
            { min: 5000, max: 19998, class: 'recharge_5000' },
            { min: 19999, max: Infinity, class: 'recharge_19999' }
        ];

        let textBonus = "";

        for (const range of rch_ranges) {
            if (inputValue >= range.min && inputValue <= range.max) {
                textBonus = $(`.${range.class}`).text();
                if (textBonus != "") {

                    textBonus = textBonus.replace(" Bonus", "");
                    promotionId = 1;

                }
                break;
            }else{
                promotionId = 0;
            }
        }

        textBonus = textBonus.replace(" Bonus", "");
        $('.promo_bonus').text(textBonus);

        if (textBonus != "") {

            if (calculation_method == 1) {

                const text = textBonus.match(/\+(\d+)%/);
                const bonusValue = parseInt(text[1]);
                const bonus = (bonusValue / 100) * inputValue;
                const FixBonus = bonus.toFixed(2);
                $('.deposit_bonus').text("+"+FixBonus+" BRL");

            }else if(calculation_method == 2){

                const text = textBonus.match(/\+(\d+)/);
                const bonusValue = parseInt(text[1]);
                const bonus = bonusValue;
                $('.deposit_bonus').text("+"+bonus+" BRL");

            }

        }

        if (inputLength > 0) {

            $('#deposit').css('cursor', 'pointer');
            $('#deposit').removeClass('dim-text-readonly');
            $('#deposit').prop('disabled', false);

        } else {

            $('#deposit').css('cursor', 'not-allowed');
            $('#deposit').addClass('dim-text-readonly');
            $('#deposit').prop('disabled', true);

        }

    });

    function ik(val){

        $('.deposit_bonus').text("");
        const valueToClass = {
            30: 'recharge_30',
            100: 'recharge_100',
            200: 'recharge_200',
            500: 'recharge_500',
            1000: 'recharge_1000',
            2000: 'recharge_2000',
            5000: 'recharge_5000',
            19999: 'recharge_19999'
        };
        let textBonus = valueToClass[val] ? $(`.${valueToClass[val]}`).text() : "";
        textBonus = textBonus.replace(" Bonus", "");

        if (textBonus != ""){

            if (calculation_method == 1) {

                const text = textBonus.match(/\+(\d+)%/);
                const bonusValue = parseInt(text[1]);
                const bonus = (bonusValue / 100) * val;
                const FixBonus = bonus.toFixed(2);
                $('.deposit_bonus').text("+"+FixBonus+" BRL");

            }else if (calculation_method == 2){

                const text = textBonus.match(/\+(\d+)/);
                const bonusValue = parseInt(text[1]);
                const bonus = bonusValue;
                $('.deposit_bonus').text("+"+bonus+" BRL");

            }

            promotionId = 1;

        }else{

            promotionId = 0;

        }

        $('.promo_bonus').text(textBonus);
        document.getElementById('one').value = val;

    }

    function ClickDeposit() {
        $.ajax({
            "method": "POST",
            "url": "{{ route('check_if_complete_info')}}",
            data: {
                "_token": "{{ csrf_token() }}"
            },
            success: function(response) {
                if(response == 1){
                    setTimeout(function() {
                        $('#preRegister-normal-reg').toggleClass('md-show', true);
                    }, 200); // Adjust the delay time as needed
                }
                else{
                    getPromoRecharge();
                    setTimeout(function(){

                    $('.md-details-payment').toggleClass('md-show', true);
                    $('[data-details-payment-action=\'deposit\']').click();

                    }, 1000);
                }
            }
        });
    }

    $('#recharge_consent').on('click', function(event){

        if ($(this).is(':checked')) {

            $('.info-bonus').css('display', 'none');
            $('.promo_bonus').css('display', 'none');
            $('.deposit_bonus').css('display', 'none');
            $('#promo_name').css('display', 'none');

        }else{

            $('.info-bonus').css('display', 'block');
            $('.promo_bonus').css('display', 'block');
            $('.deposit_bonus').css('display', 'block');
            $('#promo_name').css('display', 'block');

        }

    });

    $(document).on('mouseup', function(event) {

        if ($('.md-details-payment').has(event.target).length === 0) {

            $('.md-details-payment').toggleClass('md-show', false);

        }

    });

    $(document).on('keydown', function(event) {

    if (event.keyCode === 27) {

        $('.md-details-payment').toggleClass('md-show', false);

    }

    });


    function ClickWithdraw() {

    WalletLink();
    setTimeout(function(){

        $('.md-details-payment').toggleClass('md-show', true);
        $('[data-details-payment-action=\'withdrawl\']').click();

    }, 1000);

    }


    $('[data-tab="#b"]').on('click', function() {

    WalletLink();

    });

    </script>
        {{-- @if (!$errors->validator->isEmpty())
            <script type="text/javascript">
                $(document).ready(function() {
                    $('#detailsPayment').modal('show');
                });
            </script>
        @endif --}}
        {{-- modal show transfer money modal --}}

        <script>
            $('.profile__body__card__wallet__member--btn').on('click', function() {

                $.ajax({
                    "method": "POST",
                    "url": "{{ route('verify-vault') }}",
                    data: {
                        "_token": "{{ csrf_token() }}"
                    },
                    success: function(response) {

                        if (response.msg == true) {
                            // $('#set-title').text("{{ __("Enter Password")}}");
                            console.log(response);
                            $('#redirect-input').val(1);
                            $('#passwordMember').addClass('md-show');
                            var elements = document.querySelectorAll('#passwordMemberConfirm');
                            var elementsLength = elements.length;
                            var i;

                            for (i = 0; i < elementsLength; i++) {
                                elements[i].disabled = true;
                                elements[i].style.display = "none";
                            }
                            $('#label_confirm').text('');
                            $('#label_pass').text('');
                            $('.password__multipliers__title').text('{{ __("Enter Password")}}');

                            var hiddenInput = document.createElement('input');
                            hiddenInput.type = 'hidden';
                            hiddenInput.name = 'redirect-input';
                            hiddenInput.value = '1';

                            // Append the hidden input to a parent element
                            var parentElement = document.getElementById('modal-transfer-balance');
                            parentElement.appendChild(hiddenInput);

                        } else {
                            $('#passwordMember').addClass('md-show');
                        }
                    }
                });

                // $('#passwordMember').addClass('md-show');


            })
        </script>
        {{-- end --}}

        {{-- modal show safe box  --}}

        <script>
            $('#btn-safe-box').on('click', function() {

                $.ajax({
                    "method": "POST",
                    "url": "{{ route('verifySafeBox') }}",
                    data: {
                        "_token": "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        if (response.msg == true) {
                            // $('#set-title').text("{{ __("Enter Password")}}");

                            $('#redirect-input-safe').val(1);
                            $('#password-safebox').addClass('md-show');
                            var elements = document.querySelectorAll('#passwordSafeConfirm');
                            var elementsLength = elements.length;
                            var i;

                            for (i = 0; i < elementsLength; i++) {
                                elements[i].disabled = true;
                                elements[i].style.display = "none";
                            }
                            $('#label_confirm_safe').text('');
                            $('#label_pass_safe').text('');
                            $('.password__multipliers__title').text('{{ __("Enter Password")}}');

                            var hiddenInput = document.createElement('input');
                            hiddenInput.type = 'hidden';
                            hiddenInput.name = 'redirect-input-safe';
                            hiddenInput.value = '1';

                            // Append the hidden input to a parent element
                            var parentElement = document.getElementById('modal-safe-balance');
                            parentElement.appendChild(hiddenInput);

                        } else {
                            $('#password-safebox').addClass('md-show');
                        }
                    }
                });

                // $('#passwordMember').addClass('md-show');


            })
        </script>

        {{-- end --}}
        {{-- set password modal --}}
        @if (session()->has('session_verifypassword'))
        <script>
            $('#passwordMember').addClass('md-show');
            $('#warning-password').text({
                {
                    session('session_verifypassword')
                }
            });
        </script>
        @endif
        @if (session()->has('session_verifypassword_safe'))
        <script>
            $('#password-safebox').addClass('md-show');
            $('#warning-password-safe').text({
                {
                    session('session_verifypassword_safe')
                }
            });
        </script>
        @endif
        {{-- end --}}
        {{-- set password modal Safe --}}
        @if (session()->has('session_verifypassword_safe'))
        <script>
            $('#password-safebox').addClass('md-show');
            $('#warning-password-safe').text({
                {
                    session('session_verifypassword_safe')
                }
            });
        </script>
        @endif
        @if (session()->has('session_verifypassword_safe'))
        <script>
            $('#password-safebox').addClass('md-show');
            $('#warning-password-safe').text({
                {
                    session('session_verifypassword_safe')
                }
            });
        </script>
        @endif
        {{-- change transfer password --}}
        @if (session()->has('session_changepass_transfer'))
        <script>
            $('.md-reset-password-withdrawal').addClass('md-show');
        </script>
        @endif
        {{-- end --}}
        @if (session()->has('password_did_not_match'))
        console.log('asd');
        <script>
            $('#redirect-input').val(1);
            // $('#modal-transfer-balance2').removeClass('md-clash');
            $('#passwordMember').addClass('md-show');

            var elements = document.querySelectorAll('#passwordMemberConfirm');
            var elementsLength = elements.length;
            var i;

            for (i = 0; i < elementsLength; i++) {
                elements[i].disabled = true;
                elements[i].style.display = "none";
            }
            $('#label_confirm').text('');
            $('#label_pass').text('');
            $('.password__multipliers__title').text('{{ __("Enter Password")}}');

            var hiddenInput = document.createElement('input');
            hiddenInput.type = 'hidden';
            hiddenInput.name = 'redirect-input';
            hiddenInput.value = '1';

            // Append the hidden input to a parent element
            var parentElement = document.getElementById('modal-transfer-balance');
            parentElement.appendChild(hiddenInput);
        </script>
        @endif
        @if (session()->has('password_did_not_match_safe'))
        <script>
            $('#redirect-input-safe').val(1);
            // $('#modal-transfer-balance2').removeClass('md-clash');
            $('#password-safebox').addClass('md-show');

            var elements = document.querySelectorAll('#passwordSafeConfirm');
            var elementsLength = elements.length;
            var i;

            for (i = 0; i < elementsLength; i++) {
                elements[i].disabled = true;
                elements[i].style.display = "none";
            }
            $('#label_confirm_safe').text('');
            $('#label_pass_safe').text('');
            $('.password__multipliers__title').text('{{ __("Enter Password")}}');

            var hiddenInput = document.createElement('input');
            hiddenInput.type = 'hidden';
            hiddenInput.name = 'redirect-input-safe';
            hiddenInput.value = '1';

            // Append the hidden input to a parent element
            var parentElement = document.getElementById('modal-transfer-balance-safe');
            parentElement.appendChild(hiddenInput);
        </script>
        @endif
        {{-- end --}}
        @if (session()->has('session_changepass_md'))
        <script>
            $(document).ready(function() {
                $('#resetLoginPassword').addClass('md-show');
                $('.md-popup-hover').toggleClass('md-show', false);
                // $('.md-popup-hover #ref').removeClass('md-show');
            });
        </script>
        @endif
        @if (session()->has('session_changepass_md_not_match'))
        <script>
            $(document).ready(function() {
                $('#resetLoginPassword').addClass('md-show');
                $('.md-popup-hover').toggleClass('md-show', false);
                // $('.md-popup-hover #ref').removeClass('md-show');
            });
        </script>
        @endif

        <script>
            var inputs = document.querySelectorAll('.passwords__multipliers [type="password"]');
            var withdrawlinput = document.querySelectorAll('.passwords__withdrawl [type="password"]');
            withdrawlinput.forEach((input, i) => {
                input.addEventListener('input', function() {
                    if (this.value.length === 1) {
                        let next = this.nextElementSibling;
                        if (next && next.type === 'password') {
                            this.blur();
                            next.focus();
                        } else if (!next && i === withdrawlinput.length - 1 && Array.from(withdrawlinput).every(
                                input => input.value.length > 0)) {
                            // $('.md-password-withdrawl').removeClass('md-show');
                            // $('.md-reset-password-withdrawl').addClass('md-show');
                        }
                    }
                });
                input.addEventListener('keydown', function(event) {
                    if (event.key === 'Backspace' && this.value.length === 0) {
                        let prev = this.previousElementSibling;
                        if (prev && prev.type === 'password') {
                            this.blur();
                            prev.focus();
                        }
                    }
                });
            });
            inputs.forEach((input, i) => {
                input.addEventListener('input', function() {
                    if (this.value.length === 1) {
                        let next = this.nextElementSibling;
                        if (next && next.type === 'password') {
                            this.blur();
                            next.focus();
                        } else if (!next && i === inputs.length - 1 && Array.from(inputs).every(input => input
                                .value.length > 0)) {
                            // $('.md-password-member').removeClass('md-show');
                            // $('.md-member-withdrawl').addClass('md-show');
                        }
                    }
                });
                input.addEventListener('keydown', function(event) {
                    if (event.key === 'Backspace' && this.value.length === 0) {
                        let prev = this.previousElementSibling;
                        if (prev && prev.type === 'password') {
                            this.blur();
                            prev.focus();
                        }
                    }
                });
            });
        </script>

        @if (session()->has('session'))
        <script>
            $(document).ready(function() {
                getPromoRecharge();
                setTimeout(function(){

                    $('.md-details-payment').toggleClass('md-show', true);
                    $('[data-details-payment-action=\'deposit\']').click();

                }, 1000);
            });
        </script>
        @endif
        @if (session()->has('withdraw_error'))
        <script>
            $(document).ready(function() {

                $('#detailsPayment').addClass('md-show');
                $('.md-popup-hover').toggleClass('md-show', false);
                $('[data-details-payment-action=\'withdrawl\']').click();

                iziToast.error({
                    message: "{{ __('Withdrawal request error, answer all required information')}}",
                    position: 'center',
                    icon: "fa fa-times"
                });

            });
        </script>
        @endif
        {{-- returns error message of locked account --}}
        @if (session()->has('session_error'))
        <script>
            $(document).ready(function() {

                $('.md-popup-hover').toggleClass('md-show', false);
                $('.md-auth').toggleClass('md-show', true);
                // $('.md-popup-hover #ref').removeClass('md-show');
                if ($('[data-auth-action="auth"]').hasClass('auth-tab-active')) {
                    $('#form_auth')
                            .attr('action', '/login')
                            .append('<input type="hidden" name="_token" value="' + csrfToken + '">');  
                }
                if ($('[data-auth-action="register"]').hasClass('auth-tab-active')) {
                    $('#form_auth')
                            .attr('action', '/register')
                            .append('<input type="hidden" name="_token" value="' + csrfToken + '">');  
                }
            });
        </script>
        @endif
        <!-- @if (session()->has('session_errors'))
    <script>
        console.log('asd');
        $(document).ready(function() {
            $('#detailsPayment').addClass('md-show');
            $('.md-popup-hover').toggleClass('md-show', false);
            $('.md-auth').toggleClass('md-show', true);
            // $('.md-popup-hover #ref').removeClass('md-show');
        });
    </script>
    @endif -->

        @if (session()->has('pay'))
        <script>
            var ses = '{{ session("pay") }}';
            var qrCodeString = '{{ session("pixcode") }}';
            var url = '{{ session("url") }}';
            var QRCODE = 'https://api.qrserver.com/v1/create-qr-code/?size=200x200&color=1c1e23&bgcolor=d4ddf0&data=' + qrCodeString;
            var QRCODE_Download = 'https://api.qrserver.com/v1/create-qr-code/?download=1&size=200x200&color=1c1e23&bgcolor=d4ddf0&data=' + qrCodeString;
            // var QRCODE = 'https://api.qrserver.com/v1/create-qr-code/?size=200x200&color=1c1e23&bgcolor=d4ddf0&data=' + ses;
            $('#detailsPayment').addClass('md-show');
            $('#depositValue').css('display', 'none');
            $('.md-popup-hover').removeClass('md-show');
            $("#depositPix").css('display', 'block');
            $("#qr-code-img").attr('src', QRCODE);
            $("#deposit_link").attr('href', ses);
            // $('.deposit__pix__copy--value').val(ses);
            // $('.deposit__pix__copy--value').val(qrCodeString);
            $('[data-details-payment-action="pix"]').click();
            $('#deposit').css('display', 'none');

            function callbackCheck() {

                $.ajax({
                    url: '{{ route("callback") }}',
                    method: 'POST',
                    data: {
                        "_token": $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {

                        if (response.status === 'success') {

                            $('.pageLoaderRecharge').css('display', 'flex');
                            $('.pageLoaderRecharge').addClass('bg-callback-overlay');

                            setTimeout(function(){

                                $('.pageLoaderRecharge').css('display', 'none');
                                $('.pageLoaderRecharge').removeClass('bg-callback-overlay');

                                iziToast.success({
                                    
                                    title: 'Deposit Successfully Made!',
                                    message: "Deposit Successful With Transaction Id of " + response.orderId + ", please check your balance",
                                    position: 'center',
                                    icon: "fa fa-times",
                                    timeout: 5000,
                                    pauseOnHover: false,
                                    closeOnEscape: true,
                                    closeOnClick: true,
                                    onClosed: function() {

                                        $('#div_money_update').css('dsiplay', 'none');
                                        window.location.reload();

                                    }

                                });

                                clearInterval(callbackInterval);

                            }, 3000);

                        } else if (response.status === 'error') {

                            $('.pageLoaderRecharge').css('display', 'flex');
                            $('.pageLoaderRecharge').addClass('bg-callback-overlay');

                            setTimeout(function(){

                                $('.pageLoaderRecharge').css('display', 'none');
                                $('.pageLoaderRecharge').removeClass('bg-callback-overlay');
                                var message = response.failMessage ?? "Deposit Was Unsuccessful";

                                iziToast.error({
                                    title: "Deposit Error!",
                                    message: message + " with Transaction Id of " + response.orderId,
                                    position: 'center',
                                    icon: "fa fa-times",
                                    timeout: 5000,
                                    pauseOnHover: false,
                                    closeOnEscape: true,
                                    closeOnClick: true,

                                });

                                clearInterval(callbackInterval);

                            }, 3000);

                        }

                    },
                    error: function(xhr, status, error) {

                        console.log(error);

                    }

                });

            }

            var callbackInterval = setInterval(callbackCheck, 5000);
            WalletLink();

            $(document).ready(function() {

                $("#copyPIXQR").on("click", function() {

                    window.location.href = QRCODE_Download;

                });

                $("#copyPIXQRDATA").on("click", function() {

                    var $HTMLinput = $('<input>');
                    $('body').append($HTMLinput);
                    var input = qrCodeString;
                    $HTMLinput.val(input).select();
                    document.execCommand('copy');
                    $HTMLinput.remove();
                    alert("Text copied to clipboard!");

                });

            });
        </script>
        @endif

        @if (session()->has('error'))
        <script>
            $(document).ready(function() {
                var err = '{{ __("Cadastrar")}}';
                $('.md-auth').addClass('md-show');
                $('[data-auth-action="register"]').addClass('sport-bet-tab-active auth-tab-active');
                $('[data-auth-action="auth"]').removeClass('sport-bet-tab-active auth-tab-active');

                if ($('.auth-tab-active').attr('data-auth-action') === 'register') {
                    $("#vk_auth_label").html("Регистрация через ВКонтакте");
                    $("#email").fadeIn(200);
                    $("#fullname").fadeIn(200);
                    $("#phone").fadeIn(200);
                    $("#invite").fadeIn(200);
                    $("#number").fadeIn(200);
                    $("#cpf").fadeIn(200);
                    $("#l_b").val(err);
                }
            });
        </script>
        @endif
        {{-- for registration return --}}
        @if (session()->has('session_login_modal_cadastrar'))
        <script>
            $(document).ready(function() {
                var err = '{{ __("Cadastrar")}}';
                $('.md-auth').addClass('md-show');
                $('[data-auth-action="register"]').addClass('sport-bet-tab-active auth-tab-active');
                $('[data-auth-action="auth"]').removeClass('sport-bet-tab-active auth-tab-active');

                if ($('.auth-tab-active').attr('data-auth-action') === 'register') {

                    $("#vk_auth_label").html("Регистрация через ВКонтакте");
                    $("#email").fadeIn(200);
                    $("#fullname").fadeIn(200);
                    $("#phone").fadeIn(200);
                    $("#invite").fadeIn(200);
                    $("#number").fadeIn(200);
                    $("#cpf").fadeIn(200);
                    $("#l_b").val(err);

                }

                if ($('[data-auth-action="auth"]').hasClass('auth-tab-active')) {
                    $('#form_auth')
                            .attr('action', '/login')
                            .append('<input type="hidden" name="_token" value="' + csrfToken + '">'); 
                }

                if ($('[data-auth-action="register"]').hasClass('auth-tab-active')) {

                    $('#form_auth')
                            .attr('action', '/register')
                            .append('<input type="hidden" name="_token" value="' + csrfToken + '">'); 
                }
                
            });
        </script>
        @endif
        {{-- for registration return --}}
        @if (session()->has('session_login_modal_cadastrar'))
        <script>
            $(document).ready(function() {
                var err = '{{ __("Cadastrar")}}';
                $('.md-auth').addClass('md-show');
                $('[data-auth-action="register"]').addClass('sport-bet-tab-active auth-tab-active');
                $('[data-auth-action="auth"]').removeClass('sport-bet-tab-active auth-tab-active');

                if ($('.auth-tab-active').attr('data-auth-action') === 'register') {
                    $("#vk_auth_label").html("Регистрация через ВКонтакте");
                    $("#email").fadeIn(200);
                    $("#fullname").fadeIn(200);
                    $("#phone").fadeIn(200);
                    $("#invite").fadeIn(200);
                    $("#number").fadeIn(200);
                    $("#cpf").fadeIn(200);
                    $("#l_b").val(err);
                }
                if ($('[data-auth-action="auth"]').hasClass('auth-tab-active')) {
                    $('#form_auth').attr('action', '/login')
                                   .append('<input type="hidden" name="_token" value="' + csrfToken + '">'); 
                }               
                if ($('[data-auth-action="register"]').hasClass('auth-tab-active')) {
                    $('#form_auth').attr('action', '/register')
                                   .append('<input type="hidden" name="_token" value="' + csrfToken + '">'); 
                }
            });
        </script>
        @endif

        {{-- for login return --}}
        @if (session()->has('session_login_modal_entrar'))
        <script>
            $(document).ready(function() {
                $('.md-auth').addClass('md-show');
                $('[data-auth-action="register"]').removeClass('sport-bet-tab-active auth-tab-active');
                $('[data-auth-action="auth"]').addClass('sport-bet-tab-active auth-tab-active');

                if ($('.auth-tab-active').attr('data-auth-action') === 'register') {
                    $("#vk_auth_label").html("Регистрация через ВКонтакте");
                    $("#username").fadeIn(200);
                    $("#password").fadeIn(200);
                }
                if ($('[data-auth-action="auth"]').hasClass('auth-tab-active')) {
                    $('#form_auth').attr('action', '/login')
                                   .append('<input type="hidden" name="_token" value="' + csrfToken + '">');
                }
                if ($('[data-auth-action="register"]').hasClass('auth-tab-active')) {
                    $('#form_auth').attr('action', '/register')
                                   .append('<input type="hidden" name="_token" value="' + csrfToken + '">');
                }
            });
        </script>
        @endif
        {{-- user profile update --}}
        <script>
            $(document).ready(function() {
                var newImageSrc;
                $('.profile__modal__couvers__box__item--pic').click(function() {
                    var ImageSrc = $(this).find('img').attr('src');
                    $('#main_profile').attr({
                        'src': ImageSrc,
                        'alt' : ImageSrc
                    });
                    newImageSrc = ImageSrc;

                });


                $('#btn-save-image').on('click', function() {
                    var path = newImageSrc;
                    $.ajax({
                        "url": "{{ route('updateImage') }}",
                        "type": "post",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "img_url": path
                        },
                        success: function(response) {
                            $('.md-profile-covers').toggleClass('md-show', false)
                            location.reload();
                        }
                    });
                });
            });
        </script>
        {{-- end --}}

        {{-- transfer balance script --}}
        @if (session()->has('show_modal_transfer'))
        <script>
            $('#transfer_member_balance').addClass('md-show');
            // $('#passwordMember').removeClass('md-show');
        </script>
        @endif
        @if (session()->has('session_transfer_balance_safe'))
        <script>
            $('#transfer_safe_balance').addClass('md-show');
            // $('#passwordMember').removeClass('md-show');
        </script>
        @endif

        <script>
            $(document).ready(function() {

                var agency_balance = parseFloat($('#agency-balance-text').text().replace(/,/g, ''));
                var member_balance = parseFloat($('#member-balance-text').text().replace(/,/g, ''));

                $('#amount').on('keyup', function(e) {

                    var amount_text = $(this).val().replace(/,/g, '');
                    var amt = (amount_text.length === 0) ? 0 : parseFloat(amount_text);

                    if (amt > agency_balance) {

                        var diff = (agency_balance - 0).toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ',');
                        var sum = (member_balance + 0).toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ',');
                        $(this).val('');
                        $('#convert_button').css('cursor', 'not-allowed');
                        $('#convert_button').addClass('dim-text-readonly');
                        $('#convert_button').prop('disabled', true);

                    } else {

                        var diff = (agency_balance - amt).toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ',');
                        var sum = (member_balance + amt).toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ',');

                        $('#convert_button').css('cursor', 'pointer');
                        $('#convert_button').removeClass('dim-text-readonly');
                        $('#convert_button').prop('disabled', false);

                    }

                    $('#agency-balance-text').text(diff);
                    $('#member-balance-text').text(sum);

                });

            });
        </script>
        @if (session()->has('message_transfer'))
        <script>
            iziToast.success({ //success, error, info
                message: "{{ session('message_transfer') }}",
                position: 'center',
                icon: "fa fa-times" //fa fa-info or fa fa-check or fa-times
            });
        </script>
        @endif
        {{-- end --}}

        {{-- transfer balance script --}}
        @if (session()->has('show_modal_transfer_safe'))
        <script>
            $('#transfer_safe_balance').addClass('md-show');
            // $('#passwordMember').removeClass('md-show');
        </script>
        @endif
        @if (session()->has('session_transfer_balance'))
        <script>
            $('#transfer_member_balance').addClass('md-show');
            // $('#passwordMember').removeClass('md-show');
        </script>
        @endif
        {{-- end --}}

        {{-- Change Password Transfer Balance --}}
        @if (session()->has('session_changepass_md_not_match_transfer'))
        <script>
            $(document).ready(function() {
                $('.md-reset-password-withdrawal').addClass('md-show');
                $('.md-popup-hover').toggleClass('md-show', false);
                // $('.md-popup-hover #ref').removeClass('md-show');
            });
        </script>
        @endif
        {{-- end --}}
        {{-- Notification Session --}}
        @if (session()->has('session_notification'))
        <script>
            iziToast.success({ //success, error, info
                message: "{{ session('session_notification') }}",
                position: 'center',
                icon: "fa fa-times" //fa fa-info or fa fa-check or fa-times
            });
        </script>
        @endif

        @if ($errors->first('error_title'))
        <script>
            var title = '{{ $errors->first("error_title") }}';
            var message = '{{ $errors->first("error_message") }}';
            iziToast.error({
                title: title,
                message: message,
                timeout: 6000,
                position: 'center',
                icon: "fa fa-times"
            });
        </script>
        @endif

        @if ($errors->first('success_title'))
        <script>
            var title = '{{ $errors->first("success_title") }}';
            var message = '{{ $errors->first("success_message") }}';
            var amount = parseInt('{{ $errors->first("amount") }}');
            var new_balance = parseInt('{{ $errors->first("new_balance") }}');
            iziToast.success({
                title: title,
                message: message,
                timeout: 8000,
                position: 'center',
                icon: "fa fa-times",
                onOpening: function() {

                    $('#money_update').html("-$" + amount.toFixed(2));
                    $('#div_money_update').css('display', "block");
                    $('#money_update').css('color', "red");

                },
                onClosing: function() {

                    $('#div_money_update').css('display', "none");

                }
            });
        </script>
        @endif
        <script>
            $(document).ready(function() {

                $('#consent').change(function() {

                    if ($(this).is(':checked')) {

                        $('#withdrawal').css('cursor', 'pointer');
                        $('#withdrawal').removeClass('dim-text-readonly');
                        $('#withdrawal').prop('disabled', false);

                    } else {

                        $('#withdrawal').css('cursor', 'not-allowed');
                        $('#withdrawal').addClass('dim-text-readonly');
                        $('#withdrawal').prop('disabled', true);

                    }

                });

                @if (Auth::check())
                    {{-- @if (Auth::user()->member_type == 3) --}}
                        $("#deposit").one('click', function() {

                            $(this).append('<input type="hidden" name="btn-deposit" >');

                            if(!$('#recharge_consent').is(':checked')){

                                if (parseInt(promotionId) == 1) {

                                    $(this).append(`<input type="hidden" name="promotion" value="${promotion}" >`);

                                }

                            }

                            var form_deposit = $('#form_deposit');
                            form_deposit.attr("method", "POST");
                            form_deposit.attr("action", "{{ route('wallet') }}");

                            form_deposit.submit(function() {

                                $('#deposit').css('cursor', 'not-allowed');
                                $('#deposit').addClass('dim-text-readonly');
                                $('#deposit').prop('disabled', true);

                            });


                        });

                        $("#withdrawal").one('click', function() {

                            $(this).append('<input type="hidden" name="withdrawal" >');

                            var form_deposit = $('#form_deposit');
                            form_deposit.attr("method", "POST");
                            form_deposit.attr("action", "{{ route('wallet') }}");

                            form_deposit.submit(function() {

                                $('#withdrawal').css('cursor', 'not-allowed');
                                $('#withdrawal').addClass('dim-text-readonly');
                                $('#withdrawal').prop('disabled', true);

                            });

                        });

                    {{-- @else

                        $('#form_deposit').contents().unwrap();

                    @endif --}}
                @endif

                $(".amount_button").on("click", function() {

                    $('#deposit').css('cursor', 'pointer');
                    $('#deposit').removeClass('dim-text-readonly');
                    $('#deposit').prop('disabled', false);

                });

                $('#one').on("keyup", function() {

                    var inputValue = $(this).val();
                    var inputLength = inputValue.length;

                    const rch_ranges = [
                        { min: 30, max: 99, class: 'recharge_30' },
                        { min: 100, max: 199, class: 'recharge_100' },
                        { min: 200, max: 499, class: 'recharge_200' },
                        { min: 500, max: 999, class: 'recharge_500' },
                        { min: 1000, max: 1999, class: 'recharge_1000' },
                        { min: 2000, max: 4999, class: 'recharge_2000' },
                        { min: 5000, max: 19998, class: 'recharge_5000' },
                        { min: 19999, max: Infinity, class: 'recharge_19999' }
                    ];

                    let textBonus = "";

                    for (const range of rch_ranges) {
                        if (inputValue >= range.min && inputValue <= range.max) {
                            textBonus = $(`.${range.class}`).text();
                            textBonus = textBonus.replace(" Bonus", "");
                            promotionId = 1;
                            if (calculation_method == 1) {

                            }else{

                            }
                            break;
                        }else{
                            promotionId = 0;
                        }
                    }

                    $('.promo_bonus').text(textBonus);

                    if (inputLength > 0) {

                        $('#deposit').css('cursor', 'pointer');
                        $('#deposit').removeClass('dim-text-readonly');
                        $('#deposit').prop('disabled', false);

                    } else {

                        $('#deposit').css('cursor', 'not-allowed');
                        $('#deposit').addClass('dim-text-readonly');
                        $('#deposit').prop('disabled', true);

                    }

                });

                // $('#account_number').on('change', function() {

                //     var selectedOption = $(this).val();
                //     $('#inputAccountNumber').empty();

                //     if (selectedOption === 'number_id') {

                //         inputAccountNumber('account_cpf', 'CPF', selectedOption);

                //     } else if (selectedOption === 'mobile_number') {

                //         inputAccountNumber('account_phonenumber', 'Phone Number', selectedOption);

                //     } else if (selectedOption === 'email') {

                //         inputAccountNumber('account_email', 'Email', selectedOption);

                //     }

                // });

                // function inputAccountNumber(name, label, selectedOption) {

                //     var inputHtml = `
                //         <label for="${name}">${label}</label>
                //         <input name="account_number" type="text" id="${name}" class="pix--input dim-text-readonly" readonly>
                //     `;
                //     $('#inputAccountNumber').append(inputHtml);

                //     // const token = $('meta[name=csrf-token]').attr('content');
                //     $.ajax({

                //         url: '{{ route("withdrawal_info") }}',
                //         type: 'POST',
                //         data: {
                //             '_token': $('meta[name=csrf-token]').attr('content')
                //         },
                //         success: function(response) {

                //             if (selectedOption === 'number_id') {

                //                 var inputValue = response.number_id;

                //             } else if (selectedOption === 'mobile_number') {

                //                 var inputValue = response.mobile_number;

                //             } else if (selectedOption === 'email') {

                //                 var inputValue = response.email;

                //             }

                //             $('#' + name).val(inputValue);

                //         },
                //         error: function() {

                //             console.log('Error occurred during AJAX request');

                //         }

                //     });

                // }

            });
        </script>

         @isset($invitation_code)
        <script>
            $(document).ready(function() {

                $('.btn-cc').click();

            });
        </script> 
        @endisset

        @if(session()->has('error_normal_reg'))
            <script>
                $(document).ready(function(){
                    setTimeout(function() {
                        $('#preRegister-normal-reg').toggleClass('md-show', true);
                    }, 200); // Adjust the delay time as needed
                });
            </script>
        @endif

        @if(session()->has('continue_registration'))
            <script>
                window.onload = function() {
                    // After the page reloads, show the modal
                    setTimeout(function() {
                        $('#preRegister-normal-reg').toggleClass('md-show', true);
                    }, 1000); // Adjust the delay time as needed
                };
            </script>
        @endif
        
        <script>
            $(document).on('click', '.see_more', function() {

                var title = $(this).data('title');
                var sub_title = $(this).data('sub-title');
                var date = $(this).data('date');
                var time = $(this).data('time');
                var message = $(this).data('message');
                var sub_message = $(this).data('sub-message');


                $('#notification_title').text(title);
                $('#notification_sub_title').text(sub_title);
                $('#date_post').text(date);
                $('#time_post').text(time);
                $('#notification_message').text(message);
                $('#notification_sub_message').text(sub_message);
                $('#NotificationModal').toggleClass('md-show', true);

            });

            $(document).on('mouseup', function(event) {

                if ($('#NotificationModal').has(event.target).length === 0) {

                    $('#NotificationModal').toggleClass('md-show', false);

                }

            });

            $(document).on('keydown', function(event) {

                if (event.keyCode === 27) {

                    $('#NotificationModal').toggleClass('md-show', false);

                }

            });

            $(document).ready(function() {

                $.ajax({
                    "method": "POST",
                    "url": "{{ route('post-google-registration') }}",
                    data: {
                        "_token": $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {

                        if (response.code == 1) {

                            $('#preRegister').toggleClass('md-show', true);
                            var decode_details = JSON.parse(response.contents);

                            if (response.referral_id != null) {

                                $('#_invite').attr("disabled", true);
                                $('#_invite').val(response.referral_id);
                                
                            }

                        } else {

                            $('#preRegister').toggleClass('md-show', false);

                        }

                    },
                    error: function(xhr) {
                        console.log(xhr);
                    }
                })
            })
        </script>

        @if(session()->has('continue_registration'))
            <script>
                window.onload = function() {
                    // After the page reloads, show the modal
                    setTimeout(function() {
                        $('#preRegister-normal-reg').toggleClass('md-show', true);
                    }, 1000); // Adjust the delay time as needed
                };
            </script>
        @endif
        <!-- <script>
            $(document).ready(function(){
                $('#preRegister-normal-reg').toggleClass('md-show', true);
            });
        </script> -->
