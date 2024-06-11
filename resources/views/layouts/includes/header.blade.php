<header>
    <div class="navbar">

        <div class="navbar__brand">
            <a class="navbar__brand__logotype linksidebar" href="{{ route('index') }}">
                <img class="navbar__brand__logotype--img-desktop d-lg-block d-none"
                    src="https://cdn.29bet.com/assets/img/all/pages/layout/logotype.png" alt="https://cdn.29bet.com/assets/img/all/pages/layout/logotype.png" width="100%">
                <img class="navbar__brand__logotype--img-mobile" src="https://cdn.29bet.com/assets/img/all/pages/layout/small-logo.png"
                    alt="https://cdn.29bet.com/assets/img/all/pages/layout/small-logo.png">
            </a>
        </div>

        <div class="navbar__sidemenu d-md-block d-lg-block d-none">
            <div class="navbar__sidemenu__hamburger hamburguer" id="sidemenu">
                <a class="navbar__sidemenu__hamburger__close">
                    <svg class="navbar__sidemenu__hamburger--icon" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke="none">
                        <path fillRule="evenodd" clipRule="evenodd"
                            d="M18.064 6.773a1 1 0 0 0-.04 1.414L20.68 11H3a1 1 0 1 0 0 2h17.68l-2.657 2.813a1 1 0 0 0 1.454 1.374l4.25-4.5a1 1 0 0 0 0-1.374l-4.25-4.5a1 1 0 0 0-1.413-.04ZM15 6a1 1 0 0 0-1-1H3a1 1 0 1 0 0 2h11a1 1 0 0 0 1-1ZM15 18a1 1 0 0 0-1-1H3a1 1 0 1 0 0 2h11a1 1 0 0 0 1-1Z"
                            fill="currentColor" />
                    </svg>
                </a>

                <a class="navbar__sidemenu__hamburger__open">
                    <svg class="navbar__sidemenu__hamburger--icon" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke="none">
                        <path fillRule="evenodd" clipRule="evenodd"
                            d="M5.936 6.773a1 1 0 0 1 .04 1.414L3.32 11H21a1 1 0 1 1 0 2H3.32l2.657 2.813a1 1 0 1 1-1.454 1.374l-4.25-4.5a1 1 0 0 1 0-1.374l4.25-4.5a1 1 0 0 1 1.413-.04ZM9 6a1 1 0 0 1 1-1h11a1 1 0 1 1 0 2H10a1 1 0 0 1-1-1ZM9 18a1 1 0 0 1 1-1h11a1 1 0 1 1 0 2H10a1 1 0 0 1-1-1Z"
                            fill="currentColor" />
                    </svg>
                </a>
            </div>
        </div>

        <div class="user ">
            <div class="d-none d-lg-block d-md-block">
                <form id="languageForm" class="form-lang language__select" action="{{ route('changelanguage', app()->getLocale()) }}" method="POST">
                    @csrf
                    <select id="frm_brand" class="form-select" name="locale" onchange="submitForm()">

                        @foreach (config('app.available_locales') as $locale => $title)
                            <option value="{{ $title[0] }}" {{ app()->getLocale() === $title[0] ? 'selected' : '' }}>
                                <p>{{ __($locale) }}</p>

                            </option>
                        @endforeach

                    </select>
                </form>
            </div>
        </div>

        @if (Auth::guest())

            <div class="userd">
                <a id="b_si"
                    onclick="$('[data-auth-action=\'auth\']').click(); $('.md-auth').toggleClass('md-show', true)"
                    class="btn-vk"> {{ __('Login') }}</a>
            </div>
            <div class="create--user" id="create-user">
                <a id="b_si"
                    onclick="$('[data-auth-action=\'register\']').click(); $('.md-auth').toggleClass('md-show', true)"
                    class="btn-cc"> {{ __('Register') }} </a>
            </div>
        @else

            <div class="userd">
                <div class="profile-component">
                    <div class="money-block">
                        <div class="moremoney__gif"><img id="money_gif__gain" src=""></div>
                        <div class="lessmoney__gif"><img id="money_gif__lose" src=""></div>
                        <div class="d-flex align-items-center wallet__money">
                            <span class="money-block__money-icon">
                                <h5>R$</h5>
                            </span>
                            <div id="money" data-current-balance="{{ Auth::user()->showBalance() }}"
                                title="R$: {{ Auth::user()->showBalance() }}"
                                class="money-block__money-area"
                                onclick="ClickDeposit()">
                                {{ round(Auth::user()->showBalance(), 2) }}
                            </div>
                            <div class="money-block__actions wallet__button">
                                <button type="button" onclick="ClickDeposit()" class="wallet-link" id="_payin">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" fill="currentColor"
                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="none" width="15"
                                        height="15">
                                        <path fill="currentColor"
                                            d="M461.2 128H80c-8.84 0-16-7.16-16-16s7.16-16 16-16h384c8.84 0 16-7.16 16-16 0-26.51-21.49-48-48-48H64C28.65 32 0 60.65 0 96v320c0 35.35 28.65 64 64 64h397.2c28.02 0 50.8-21.53 50.8-48V176c0-26.47-22.78-48-50.8-48zM416 336c-17.67 0-32-14.33-32-32s14.33-32 32-32 32 14.33 32 32-14.33 32-32 32z" />
                                    </svg>
                                    <p class="d-lg-block d-none">{{ __('Wallet') }}</p>
                                </button>
                            </div>
                        </div>

                        <div id="div_money_update" style="position: absolute;margin-left:2rem;display:none;">
                            <h4 id="money_update"></h4>
                        </div>

                        <div class="money-block__money-area-demo" style="display: none;"><i class="far fa-infinity"></i>
                        </div>


                        <div class="money-block__actions-demo" style="display: none;">
                            <a class="wallet-link">Demo &nbsp;&nbsp;</a>
                        </div>

                    </div>
                </div>
            </div>

            <div class="profile__droppdown">
                <ul class="dropdown__menu">
                    <li class="dropdown__menu__item" id="dropdownMenuProfile">
                        <div class="menu__profile">
                            <div class="menu__profile__items">
                                <img class="menu__profile--img" src="{{ asset(Auth::user()->avatar) }}"
                                    alt="{{ asset(Auth::user()->avatar) }}">
                                {{-- <h4 class="d-md-none">LVL-{{ Auth::user()->level }}</h4> --}}
                            </div>
                            <span class="menu__profile__svg">
                                <svg width="17" height="17" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M19.5 8.25L12 15.75L4.5 8.25" stroke="currentColor" stroke-width="3"
                                        stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </span>
                        </div>
                        
                        <div class="dropdown__area" id="dropdownMenuProfileArea">
                            <ul class="dropdown__secondary">
                                <div class="background__linear">
                                    <div class="dropdown__secondary__info">
                                        <img class="menu__profile--img" src="{{ Auth::user()->avatar }}"
                                            alt="{{ Auth::user()->avatar }}">
                                        <h4 id="copyUsername">{{ Auth::user()->username }}</h4>
                                        <button class="dropdown__secondary__info--copy" onclick="copyUsername()">
                                            <span>
                                                <svg width="24" height="24" focusable="false"
                                                    aria-hidden="true" class="copy_btn_icon">
                                                    <use xlink:href="#icon-copy"></use>
                                                    <symbol id="icon-copy" viewBox="0 0 24 24" fill="currentColor">
                                                        <path
                                                            d="M5 9c0-1.1.9-2 2-2h7a2 2 0 0 1 2 2v9a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V9Z">
                                                        </path>
                                                        <path
                                                            d="M8 4c0-.6.4-1 1-1h8a3 3 0 0 1 3 3v10a1 1 0 1 1-2 0V7a2 2 0 0 0-2-2H9a1 1 0 0 1-1-1Z">
                                                        </path>
                                                    </symbol>
                                                </svg>
                                            </span>
                                        </button>
                                        <input type="text" hidden id="referalcoder"
                                            value="https://{{ $_SERVER['SERVER_NAME'] }}/?referalcode={{ Auth::user()->ref_code }}">
                                    </div>
                                    <div class="dropdown__secondary__lvl">
                                        <div class="secondary__lvl__user">
                                         
                                            <img src="{{$matchedRank['image_lvl']}}" alt="{{$matchedRank['image_lvl']}}">
                                            <h4>LVL {{ $matchedRank['level'] }}</h4>
                                        </div>
                                        <div class="secondary__lvl__progress" style="width: 50%;">
                                            <div class="block__profile__content__progress">
                                                <div class="inner">
                                                    <span class="text-left">{{ __('Next LVL:')}}</span>
                                                    <span class="title">{{ $matchedRank['level'] }}</span>
                                                    <div
                                                        class="ant-progress ant-progress-line ant-progress-status-active ant-progress-show-info ant-progress-default">
                                                        <div class="ant-progress-outer ">

                                                            <div class="user-level-progress styled-progress">
                                                                <div class="level-bg-{{ $matchedRank['level'] }}"
                                                                    style="width: {{ $matchedRank['rank_percentage'] }}%">
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <span class="ant-progress-text"
                                                            title="{{ $matchedRank['rank_percentage'] }}%">
                                                            {{ $matchedRank['rank_percentage'] }}%</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="secondary__lvl__buttons">
                                    <a href="{{ route('ranks') }}" class="secondary__lvl__buttons--btn">
                                        <img src="https://cdn.29bet.com/assets/img/all/components/dropdown-menu/ico-vip.webp"
                                            alt="https://cdn.29bet.com/assets/img/all/components/dropdown-menu/ico-vip.webp">
                                        <p>{{ __('My vip level')}}</p>
                                    </a>
                                    <a href="{{ route('referralcabinet') }}" class="secondary__lvl__buttons--btn">
                                        <img src="https://cdn.29bet.com/assets/img/all/components/dropdown-menu/ico-invite.webp"
                                            alt="https://cdn.29bet.com/assets/img/all/components/dropdown-menu/ico-invite.webp">
                                        <p>{{ __('Invitation')}}</p>
                                    </a>
                                    {{-- <a class="secondary__lvl__buttons--btn" href="/user?id={{ Auth::user()->id }}">
                                    <img src="https://cdn.29bet.com/assets/img/all/components/dropdown-menu/ico-profile.webp" alt="Icone - Perfil">
                                    <p>Centro Pessoal</p>
                                </a> --}}
                                    <a class="secondary__lvl__buttons--btn" href="{{ route('personal-center') }}">
                                        <img src="https://cdn.29bet.com/assets/img/all/components/dropdown-menu/ico-profile.webp"
                                            alt="https://cdn.29bet.com/assets/img/all/components/dropdown-menu/ico-profile.webp">
                                        <p>{{ __('Personal Center')}}</p>
                                    </a>
                                    <a class="secondary__lvl__buttons--btn" href="{{ route('promotions') }}">
                                        <img src="https://cdn.29bet.com/assets/img/all/components/dropdown-menu/ico-game.webp"
                                            alt="https://cdn.29bet.com/assets/img/all/components/dropdown-menu/ico-game.webp">
                                        <p>{{ __('Promotions')}}</p>
                                    </a>
                                </div>

                                <div class="px-2 my-2">
                                    <a type="button" id="btn-safe-box" name="btn-safe-box" class="secondary__lvl__buttons--btn justify-content-center">
                                        <img src="https://cdn.29bet.com/assets/img/all/components/dropdown-menu/ico-profile.webp"
                                            alt="https://cdn.29bet.com/assets/img/all/components/dropdown-menu/ico-profile.webp">
                                        <p>{{ __('Safe')}}</p>
                                    </a>
                                </div>

                                <div class="secondary__lvl__admin">
                                    <div class="dropdown__secondary__item">
                                        <div class="">
                                            <a href="{{ route('logout') }}" class="user__profile__logout"
                                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                <span>
                                                    <svg width="24" height="24" viewBox="0 0 24 24"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M15.75 9V5.25C15.75 4.65326 15.5129 4.08097 15.091 3.65901C14.669 3.23705 14.0967 3 13.5 3H7.5C6.90326 3 6.33097 3.23705 5.90901 3.65901C5.48705 4.08097 5.25 4.65326 5.25 5.25V18.75C5.25 19.3467 5.48705 19.919 5.90901 20.341C6.33097 20.7629 6.90326 21 7.5 21H13.5C14.0967 21 14.669 20.7629 15.091 20.341C15.5129 19.919 15.75 19.3467 15.75 18.75V15M12 9L9 12M9 12L12 15M9 12H21.75"
                                                            stroke="currentColor" stroke-width="1.5"
                                                            stroke-linecap="round" stroke-linejoin="round" />
                                                    </svg>
                                                </span>
                                                <p>{{ __('Logout')}}</p>
                                            </a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                style="display: none;" class="d-none">
                                                @csrf
                                            </form>
                                        </div>
                                    </div>
                                </div>

                            </ul>
                        </div>
                    </li>
                </ul>
            </div>

            <a id="notifications" class="d-flex align-items-center menu-button profile-notifications  active">
                <div>
                    <div class="header__badge" id="header_notif_badge"></div>
                    <svg class="navbar__sidemenu__hamburger--icon" width="30" height="30" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke="none">
                        <path xmlns="http://www.w3.org/2000/svg"
                            d="M4.05 17.98c.25.43.68.68 1.18.68h13.4c.49 0 .98-.25 1.17-.68.25-.43.19-.92-.06-1.34l-.68-1.04a9.77 9.77 0 0 1-1.68-5.51A5.42 5.42 0 0 0 13.72 5a2.01 2.01 0 0 0-1.8-1.04c-.74 0-1.42.37-1.8 1.04a5.42 5.42 0 0 0-3.65 5.08c0 1.96-.56 3.85-1.67 5.5l-.69 1.05c-.24.42-.3.91-.06 1.34ZM11.93 22.33a3.1 3.1 0 0 1-3.04-2.45h6.07a3.1 3.1 0 0 1-3.03 2.45Z"
                            fill="currentColor" />
                    </svg>
                </div>
            </a>

    </div>
    @endif
</header>
<script>
    function submitForm(){
        document.getElementById('languageForm').submit();
    }
</script>
