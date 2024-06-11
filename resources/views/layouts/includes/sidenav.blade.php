@php
    $AdminGameList = new App\Models\Admin\GameList();
    $hasActive = \App\Models\FreeSpin::hasActive();
@endphp

<div class="sidebar">

    <div class="user d-block d-md-none d-lg-none">
        <form class="form-lang language__select" action="{{ route('changelanguage', app()->getLocale()) }}" method="POST">
            @csrf
            <select id="frm_brands" class="form-select" name="locale" onchange="this.form.submit()">

                @foreach (config('app.available_locales') as $locale => $title)
                    <option value="{{ $title[0] }}" {{ app()->getLocale() === $title[0] ? 'selected' : '' }}>
                        <p>{{ $locale }}</p>
                    </option>
                @endforeach

            </select>
        </form>
    </div>

    <div class="sidebar__tab">
        <div class="sidebar__tab__select @if (request()->is('/')) active @endif" id="sidebar__tab__select--jogos" >
            <a class="sidebar__tab__select__link linksidebar" href="{{ route('index') }}">
                <span class="sidebar__tab__select__link--icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="15.221" height="12" viewBox="0 0 15.221 12"><path d="M14.2,55.893a3.055,3.055,0,0,0-2.716-1.579H3.965A3.055,3.055,0,0,0,1.25,55.893,8.47,8.47,0,0,0,.176,60c0,3.474,1.389,6.316,3.158,6.316.947,0,1.705-.884,2.274-2.716a.627.627,0,0,1,.632-.442H9.334a.76.76,0,0,1,.632.442c.568,1.832,1.326,2.716,2.274,2.716,1.768,0,3.158-2.842,3.158-6.316A10.3,10.3,0,0,0,14.2,55.893ZM5.86,59.367H5.229V60a.6.6,0,0,1-.632.632A.6.6,0,0,1,3.966,60v-.632H3.334a.632.632,0,1,1,0-1.263h.632v-.632A.6.6,0,0,1,4.6,56.84a.6.6,0,0,1,.632.632V58.1H5.86a.632.632,0,1,1,0,1.263Zm4.168,1.263a.947.947,0,1,1,.947-.947A1.018,1.018,0,0,1,10.029,60.63Zm1.832-1.895a.947.947,0,1,1,0-1.895,1.018,1.018,0,0,1,.947.947A.971.971,0,0,1,11.86,58.735Z" fill="currentColor" transform="translate(-0.176 -54.314)"></path></svg>
                </span>
                <span class="sidebar__tab__select__text fw-monserrat">{{ __('ALL THE GAMES') }}</span>
            </a>
        </div>
        <div class="sidebar__tab__select @if (request()->is('sports')) active @endif" id="sidebar__tab__select--sports">
            <a class="sidebar__tab__select__link linksidebar" href="{{ route('site.sports') }}">
                <span class="sidebar__tab__select__link--icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12">
                        <path d="M6.609.054a6.01,6.01,0,0,1,5.433,5.433A4.787,4.787,0,0,1,7.955,4.14,4.785,4.785,0,0,1,6.609.054Zm4.736,6.5A5.788,5.788,0,0,1,5.6.048,5.994,5.994,0,0,0,.047,5.608a5.709,5.709,0,0,1,6.44,6.44A5.993,5.993,0,0,0,12.047,6.5a5.8,5.8,0,0,1-.7.047ZM4.159,7.936A4.725,4.725,0,0,0,.054,6.618,6.012,6.012,0,0,0,5.475,12.04a4.723,4.723,0,0,0-1.316-4.1Z" fill="currentColor" transform="translate(-0.047 -0.048)"></path></svg>
                </span>
                <span class="sidebar__tab__select__text fw-monserrat ">{{__('Sports')}}</span>
            </a>
        </div>
    </div>

  <div class="sidebar__banners">

      {{-- <div class="sidebar__banners__spin">
          <a @auth onclick="$('#wheel').toggleClass('md-show', true)" @else onclick="$('[data-auth-action=\'auth\']').click(); $('.md-auth').toggleClass('md-show', true)" @endauth class="sidebar__banners__spin__circle linksidebar">
              <img class="sidebar__banners__spin__circle--img" src="https://cdn.29bet.com/assets/img/all/components/sidebar/roulette.webp" alt="https://cdn.29bet.com/assets/img/all/components/sidebar/roulette.webp">
              <span class="sidebar__banners__spin__circle--text">
                  <span class="fw-monserrat">29BET</span>
                  <span style="display: block;" class="fw-monserrat">{{__('SPIN')}}</span>
              </span>
          </a>
      </div> --}}

      {{-- <div class="sidebar__banners__ticket">
          <a class="sidebar__banners_sidebar__banners__roulette_ticket__card linksidebar" href="#" onclick="@auth $('#bonusCode').toggleClass('md-show', true)  @else $('[data-auth-action=\'auth\']').click(); $('.md-auth').toggleClass('md-show', true) @endauth">
              <img src="https://cdn.29bet.com/assets/img/all/components/sidebar/chicket.webp" class="sidebar__banners__ticket__card--img" alt="https://cdn.29bet.com/assets/img/all/components/sidebar/chicket.webp">
              <span class="sidebar__banners__ticket__card--text">
                  <span class="fw-monserrat">{{__('BONUS')}}</span>
                  <span class="fw-monserrat">{{__('CODE')}}</span>
              </span>
          </a>
      </div> --}}

    @if ($hasActive)
        <div class="sidebar__banners__roulette" >
            <a
            @auth
                onclick="app.LdFSpn()"
            @else
                onclick="app.LdFSpnUA()"
            @endauth
            href="javascript:void(0)" class="sidebar__banners__roulette__background">
                <div class="sidebar__banners__roulette__background__found">
                    <div class="sidebar__banners__roulette__background__found__text">
                        <p class="fw-monserrat">
                            29BET
                            <br>
                            {{ __('SPIN')}}
                        </p>
                    </div>
                    <div class="sidebar__banners__roulette__background__found__images">
                        <img class="sidebar__banners__roulette__background__found__images--wheel animation-rotate" src="https://cdn.29bet.com/assets/img/all/components/sidebar/roulette-bonus.webp" alt="https://cdn.29bet.com/assets/img/all/components/sidebar/roulette-bonus.webp">
                        <img class="sidebar__banners__roulette__background__found__images--money-1 animation-top" src="https://cdn.29bet.com/assets/img/all/pages/sports/moedas2.webp" alt="https://cdn.29bet.com/assets/img/all/pages/sports/moedas2.webp">
                        <img class="sidebar__banners__roulette__background__found__images--money-2 animation-bottom" src="https://cdn.29bet.com/assets/img/all/pages/sports/moedas1.webp" alt="https://cdn.29bet.com/assets/img/all/pages/sports/moedas1.webp">
                    </div>
                </div>
            </a>
        </div>
    @endif

       <div class="sidebar__banners__gift">
            <!-- <a href="javascript:void(0)" class="sidebar__banners__gift__background" onclick="@auth $('.md-bonus-code').toggleClass('md-show', true)  @else $('[data-auth-action=\'auth\']').click(); $('.md-auth').toggleClass('md-show', true) @endauth"> -->
            <a href="{{ route('promo_bonus') }}" class="sidebar__banners__gift__background">
                <div class="sidebar__banners__gift__background__found">
                    <div class="sidebar__banners__gift__background__found__text">
                        <p class="fw-monserrat">
                            {{ __('BONUS')}}
                            <br>
                            {{ __('CODE')}}
                        </p>
                    </div>
                    <div class="sidebar__banners__gift__background__found__images">
                        <img class="sidebar__banners__gift__background__found__images--gift" src="https://cdn.29bet.com/assets/img/all/components/sidebar/gift-sidebar.webp" alt="https://cdn.29bet.com/assets/img/all/components/sidebar/gift-sidebar.webp">
                        <img class="sidebar__banners__gift__background__found__images--conffet animation-top" src="https://cdn.29bet.com/assets/img/all/components/sidebar/conffet-gift.webp" alt="https://cdn.29bet.com/assets/img/all/components/sidebar/conffet-gift.webp">
                    </div>
                </div>
            </a>
        </div>


      <div class="sidebar__banners__games">
          <a onclick="toogleFunction()" class="sidebar__banners__games__card">
              <img src="https://cdn.29bet.com/assets/img/all/components/sidebar/games.webp" class="sidebar__banners__games__card--img" alt="https://cdn.29bet.com/assets/img/all/components/sidebar/games.webp">
              <span class="sidebar__banners__games__card--text">
                  <span class="fw-monserrat">{{__('CENTER')}}</span> <br>
                  <span class="muted fw-monserrat">{{__('OF GAMES')}}</span>
              </span>
          </a>
      </div>

  </div>

  <div class="sidebar__multiples" id="btn__multiples">
      <div class="sidebar__multiples__banners">
            @if($AdminGameList->getGameBy('game_name', 'Dice'))
                <a href="{{ route('dice') }}" @if (Auth::user()) onclick="app.gcs(4)" @else onclick="$('#b_si').click();" @endif class="sidebar__multiples__banners__dice linksidebar" >
                    <img class="sidebar__multiples__banners__dice--img" src="https://cdn.29bet.com/assets/img/all/components/sidebar/dice.webp" alt="https://cdn.29bet.com/assets/img/all/components/sidebar/dice.webp">
                    <span class="sidebar__multiples__banners__dice--text fw-monserrat">{{ $AdminGameList->getGameBy('game_name', 'Dice')->game_name }}</span>
                </a>
            @endif
            @if($AdminGameList->getGameBy('game_name', 'Mines'))
                <a href="{{ route('mines') }}" @if (Auth::user()) onclick="app.gcs(3)" @else onclick="$('#b_si').click();" @endif class="sidebar__multiples__banners__mines linksidebar">
                    <img class="sidebar__multiples__banners__mines--img" src="https://cdn.29bet.com/assets/img/all/components/sidebar/mines.webp" alt="https://cdn.29bet.com/assets/img/all/components/sidebar/mines.webp">
                    <span class="sidebar__multiples__banners__mines--text fw-monserrat">{{ $AdminGameList->getGameBy('game_name', 'Mines')->game_name }}</span>
                </a>
            @endif
            @if($AdminGameList->getGameBy('game_name', 'Crash'))
                <a href="{{ route('crash') }}" @if (Auth::user()) onclick="app.gcs(2)" @else onclick="$('#b_si').click();" @endif class="sidebar__multiples__banners__crash linksidebar">
                    <img class="sidebar__multiples__banners__crash--img" src="https://cdn.29bet.com/assets/img/all/components/sidebar/crash.webp" alt="https://cdn.29bet.com/assets/img/all/components/sidebar/crash.webp">
                    <span class="sidebar__multiples__banners__crash--text fw-monserrat">{{ $AdminGameList->getGameBy('game_name', 'Crash')->game_name }}</span>
                </a>
            @endif
            @if($AdminGameList->getGameBy('game_name', 'Double'))
                <a href="{{ route('double') }}" @if (Auth::user()) onclick="app.gcs(1)" @else onclick="$('#b_si').click();" @endif class="sidebar__multiples__banners__double linksidebar">
                    <img class="sidebar__multiples__banners__double--img" src="https://cdn.29bet.com/assets/img/all/components/sidebar/wheel.webp" alt="https://cdn.29bet.com/assets/img/all/components/sidebar/wheel.webp">
                    <span class="sidebar__multiples__banners__double--text fw-monserrat">{{ $AdminGameList->getGameBy('game_name', 'Double')->game_name }}</span>
                </a>
            @endif
      </div>
      <div class="sidebar__multiples__btn">
          <a href="{{ route('index') }}"><button class="sidebar__multiples__btn--all fw-monserrat linksidebar">{{__('ALL THE GAMES')}}</button></a>
      </div>
  </div>

  <div class="sidebar__simple">

      <div class="sidebar__simple__banner">
          <a href="{{ route('promotions') }}" class="sidebar__simple__banner__bell">
              <img class="sidebar__simple__banner__bell--img" src="https://cdn.29bet.com/assets/img/all/components/sidebar/promotions.webp" alt="https://cdn.29bet.com/assets/img/all/components/sidebar/promotions.webp">
              <span class="sidebar__simple__banner__bell--text">
                  <span class="fw-monserrat">{{__('CENTER OF')}}</span>
                  <span class="muted fw-monserrat">{{__('PROMOTIONS')}}</span>
              </span>
          </a>
      </div>

  </div>

  <div class="sidebar__menuitem">

      <ul class="sidebar__menuitem__list">

        <li>
            <a href="" class="sidebar__menuitem__list__item @if (request()->is('/')) active @endif">
                <span class="sidebar__menuitem__list__item--icon">
                    <svg width="16" height="14" viewBox="0 0 38 35" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path d="M35.227 8.96802L22.961 1.15503C21.7773 0.40094 20.403 0.000366211 18.9995 0.000366211C17.596 0.000366211 16.2217 0.40094 15.038 1.15503L2.771 8.96802C1.92138 9.50929 1.22198 10.2561 0.737457 11.1393C0.252939 12.0225 -0.00104419 13.0136 -0.000999445 14.021V29.598C-0.000734329 30.8636 0.502114 32.0772 1.39698 32.972C2.29185 33.8669 3.50546 34.3697 4.771 34.37H33.227C34.4927 34.37 35.7066 33.8672 36.6017 32.9724C37.4968 32.0775 37.9997 30.8637 38 29.598V14.021C38.0001 13.0135 37.7461 12.0222 37.2614 11.139C36.7766 10.2557 36.0769 9.50904 35.227 8.96802ZM20.862 26.681C20.862 27.1749 20.6658 27.6484 20.3166 27.9976C19.9674 28.3468 19.4938 28.543 19 28.543C18.5062 28.543 18.0326 28.3468 17.6834 27.9976C17.3342 27.6484 17.138 27.1749 17.138 26.681V15.137C17.138 14.6432 17.3342 14.1696 17.6834 13.8204C18.0326 13.4712 18.5062 13.275 19 13.275C19.4938 13.275 19.9674 13.4712 20.3166 13.8204C20.6658 14.1696 20.862 14.6432 20.862 15.137V26.681Z" fill="currentColor"/>
                    </svg>
              </span>
              <p class="sidebar__menuitem__list__item--text fw-monserrat">{{__('Start')}}</p>
            </a>
        </li>


        <li>
            <a href="{{ route('ranks') }}" class="sidebar__menuitem__list__item @if (request()->is('ranks')) active @endif">
                <span class="sidebar__menuitem__list__item--icon">
                    <svg width="16" height="14" viewBox="0 0 16 14" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path d="M2.16521 13.7945L2.40061 12.6566H13.5998L13.8352 13.7945H2.16521ZM10.7242 12.2694C11.2905 11.0899 13.2324 6.64769 11.7117 4.13552C11.6744 4.07385 11.6297 4.02041 11.5887 3.96163C13.8496 3.56287 15.1234 5.44155 15.1234 5.44155C17.2559 8.28589 13.6158 12.2685 13.6158 12.2685L10.7242 12.2694ZM8.00022 12.2694H5.97224C5.97224 12.2694 1.17931 3.04572 8.00022 3.04572C14.8211 3.04572 10.0278 12.2698 10.0278 12.2698L8.00022 12.2694ZM2.38544 12.2694C2.38544 12.2694 -1.25385 8.28671 0.877474 5.44237C0.877474 5.44237 2.14881 3.56287 4.41178 3.96245C4.37077 4.02082 4.32566 4.07427 4.28875 4.13634C2.76848 6.64851 4.71034 11.0903 5.27629 12.2702L2.38544 12.2694ZM6.66778 1.53989C6.66811 1.2758 6.74653 1.01773 6.89313 0.798302C7.03974 0.578875 7.24795 0.407939 7.49145 0.3071C7.73495 0.206262 8.00281 0.180046 8.26117 0.231767C8.51953 0.283489 8.75679 0.410825 8.94298 0.597682C9.12916 0.784539 9.2559 1.02253 9.30718 1.28157C9.35846 1.54061 9.33197 1.80908 9.23108 2.05304C9.13018 2.297 8.9594 2.5055 8.74031 2.65219C8.52123 2.79888 8.26368 2.87717 8.00022 2.87717C7.82517 2.87717 7.65184 2.8426 7.49013 2.77542C7.32842 2.70825 7.18149 2.60979 7.05775 2.48568C6.93401 2.36157 6.83588 2.21423 6.76897 2.05209C6.70206 1.88995 6.66767 1.71618 6.66778 1.54071V1.53989Z" fill="currentColor"/>
                        <path d="M14.087 14H1.9134L2.2337 12.451H2.27471L2.2337 12.4099C1.60049 11.6848 1.06686 10.8781 0.646991 10.0112C0.287569 9.29645 0.0709372 8.5182 0.009274 7.72018C-0.0525896 6.86225 0.196578 6.01078 0.710968 5.32229C0.936333 5.01562 1.20408 4.74266 1.50617 4.51162C2.15492 3.99241 2.95869 3.70637 3.78882 3.6993C4.00965 3.69975 4.23002 3.71942 4.44746 3.75809L4.76529 3.814L4.57992 4.07874C4.56393 4.10135 4.54752 4.12355 4.53112 4.14534C4.50651 4.17822 4.48314 4.20947 4.46468 4.2403C3.84501 5.26391 3.75602 6.74795 4.20016 8.65418C4.49859 9.86939 4.92118 11.0505 5.46124 12.1789L5.59125 12.4498H5.83731L5.7922 12.363C5.31542 11.4082 4.92176 10.4139 4.6156 9.39126C4.35015 8.54332 4.18942 7.66594 4.13701 6.77878C4.06545 5.93766 4.24276 5.09404 4.64677 4.35335C5.15448 3.51431 6.02555 3.021 7.24193 2.88164C6.94669 2.71374 6.71518 2.45261 6.58352 2.13899C6.45185 1.82538 6.42742 1.47689 6.51404 1.1479C6.60066 0.818905 6.79346 0.527893 7.06237 0.320248C7.33128 0.112603 7.66118 0 8.00063 0C8.34007 0 8.66998 0.112603 8.93889 0.320248C9.2078 0.527893 9.4006 0.818905 9.48722 1.1479C9.57384 1.47689 9.54941 1.82538 9.41774 2.13899C9.28607 2.45261 9.05457 2.71374 8.75933 2.88164C9.97571 3.02141 10.8468 3.51472 11.3545 4.35335C11.7585 5.09404 11.9358 5.93766 11.8643 6.77878C11.8125 7.66629 11.6523 8.54408 11.3873 9.3925C11.0811 10.4152 10.6875 11.4095 10.2107 12.3643L10.1656 12.451H10.4116L10.5417 12.1801C11.082 11.0519 11.5048 9.8707 11.8031 8.65541C12.2469 6.75001 12.1579 5.26515 11.5386 4.24194C11.5206 4.21193 11.4976 4.18151 11.4734 4.14904C11.4566 4.12684 11.4394 4.10382 11.4222 4.07874L11.2388 3.81482L11.555 3.75891C11.7716 3.72011 11.9912 3.70016 12.2112 3.6993C13.0412 3.70606 13.8449 3.99164 14.4939 4.51038C14.7959 4.74143 15.0637 5.01439 15.2891 5.32105C15.8034 6.00943 16.0525 6.86075 15.9908 7.71854C15.9291 8.51655 15.7125 9.29481 15.353 10.0095C14.933 10.8759 14.3994 11.682 13.7663 12.4066L13.7253 12.4477H13.7663L14.087 14ZM2.41702 13.5889H13.583L13.4329 12.8621H2.56711L2.41702 13.5889ZM11.0465 12.0638H13.5223C14.1023 11.3819 14.5943 10.6296 14.9868 9.82455C15.8013 8.10948 15.7914 6.67642 14.9585 5.56483L14.9528 5.55702C14.7485 5.28137 14.5065 5.036 14.2339 4.82816C13.6599 4.36677 12.9469 4.11378 12.2112 4.11039C12.1222 4.11039 12.032 4.11409 11.9414 4.12149C13.307 6.54569 11.7601 10.5033 11.0465 12.0638ZM6.09855 12.0638H9.90066C10.3392 11.1627 10.7049 10.2279 10.9944 9.26835C11.4222 7.82377 11.7707 5.83492 11.0022 4.56547C10.4744 3.69355 9.4643 3.25121 8.00022 3.25121C6.53613 3.25121 5.52604 3.69355 4.99782 4.5667C4.22723 5.83697 4.57746 7.82419 5.00643 9.26876C5.29555 10.2282 5.6609 11.1628 6.09896 12.0638H6.09855ZM2.4773 12.0638H4.95312C4.23994 10.5016 2.69343 6.54446 4.05785 4.12314C3.96722 4.11574 3.877 4.11204 3.788 4.11204C3.25203 4.1313 2.72726 4.27131 2.25265 4.52167C1.77804 4.77204 1.36577 5.12633 1.04644 5.55825L1.04069 5.56606C0.208176 6.6793 0.199154 8.11565 1.01732 9.83401C1.40901 10.6357 1.89924 11.3848 2.4773 12.0638ZM8.00022 0.410577C7.77726 0.410659 7.55933 0.477006 7.37399 0.601231C7.18864 0.725456 7.04421 0.901981 6.95894 1.10848C6.87368 1.31499 6.85141 1.5422 6.89496 1.76139C6.9385 1.98058 7.04591 2.1819 7.20359 2.3399C7.36128 2.49791 7.56216 2.6055 7.78084 2.64907C7.99952 2.69264 8.22618 2.67024 8.43215 2.58469C8.63813 2.49915 8.81418 2.3543 8.93804 2.16847C9.0619 1.98263 9.12801 1.76416 9.12801 1.54067C9.12769 1.24098 9.00875 0.953662 8.79731 0.741788C8.58586 0.529914 8.29919 0.410795 8.00022 0.410577Z" fill="currentColor"/>
                    </svg>
                </span>
                <p class="sidebar__menuitem__list__item--text fw-monserrat">{{__('VIP rating')}}</p>
            </a>
        </li>

        <li>
           <a href="{{ route('referralcabinet') }}" class="sidebar__menuitem__list__item @if (request()->is('referralcabinet')) active @endif">
                <span class="sidebar__menuitem__list__item--icon">
                    <svg width="16" height="13" viewBox="0 0 16 13" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path d="M3.87129 6.93437C3.87017 7.08609 3.81582 7.23168 3.71927 7.34163C3.67185 7.39587 3.61481 7.43918 3.55156 7.46896C3.48832 7.49874 3.42017 7.51438 3.3512 7.51493H0.518717C0.422246 7.51484 0.327827 7.48476 0.24667 7.42828C0.163813 7.37115 0.0973108 7.29013 0.0546368 7.19432C0.0117449 7.09783 -0.00642796 6.99063 0.00201721 6.88393C0.0104624 6.77723 0.0452157 6.67494 0.102645 6.58776C0.555281 5.9086 1.1652 5.37063 1.87095 5.02803C1.56352 4.71591 1.3286 4.32948 1.18537 3.90028C1.04214 3.47109 0.99466 3.0113 1.04681 2.55845C1.09425 2.10913 1.23656 1.67768 1.46273 1.29751C1.6889 0.917337 1.99285 0.598656 2.35103 0.366152C2.88958 0.029166 3.52416 -0.080268 4.13272 0.0588999C4.74128 0.198068 5.28084 0.576008 5.6476 1.12002C5.90364 1.4753 6.07167 1.89989 6.15168 2.35048C6.16769 2.46313 6.15168 2.58444 6.11168 2.69709C6.06861 2.80481 5.99598 2.89557 5.90364 2.95704C5.27695 3.37394 4.76047 3.95927 4.40436 4.65618C4.04824 5.35309 3.86461 6.1379 3.87129 6.93437ZM15.8974 6.58776C15.4447 5.9086 14.8348 5.37063 14.1291 5.02803C14.4365 4.71591 14.6714 4.32948 14.8146 3.90028C14.9579 3.47109 15.0053 3.0113 14.9532 2.55845C14.9058 2.10913 14.7634 1.67768 14.5373 1.29751C14.3111 0.917337 14.0072 0.598656 13.649 0.366152C13.1104 0.029166 12.4758 -0.080268 11.8673 0.0588999C11.2587 0.198068 10.7192 0.576008 10.3524 1.12002C10.0964 1.4753 9.92833 1.89989 9.84832 2.35048C9.83231 2.46313 9.84832 2.58444 9.88832 2.69709C9.93633 2.80107 10.0083 2.89639 10.0964 2.95704C10.7231 3.37394 11.2395 3.95927 11.5956 4.65618C11.9518 5.35309 12.1354 6.1379 12.1287 6.93437C12.1298 7.08609 12.1842 7.23168 12.2807 7.34163C12.3281 7.39587 12.3852 7.43918 12.4484 7.46896C12.5117 7.49874 12.5798 7.51438 12.6488 7.51493H15.4813C15.5773 7.51493 15.6733 7.48027 15.7533 7.42828C15.8333 7.36763 15.9054 7.28964 15.9454 7.19432C15.9883 7.09783 16.0064 6.99063 15.998 6.88393C15.9895 6.77723 15.9548 6.67494 15.8974 6.58776ZM9.88032 9.68123C10.2597 9.33938 10.5635 8.90985 10.7695 8.42418C10.9755 7.93852 11.0785 7.40904 11.0708 6.87465C11.0631 6.34025 10.945 5.81451 10.7252 5.33601C10.5053 4.85752 10.1893 4.43843 9.80031 4.10951C9.27889 3.69293 8.64796 3.46816 8 3.46816C7.35204 3.46816 6.72111 3.69293 6.19969 4.10951C5.8107 4.43843 5.49467 4.85752 5.27481 5.33601C5.05495 5.81451 4.93685 6.34025 4.92918 6.87465C4.9215 7.40904 5.02445 7.93852 5.23046 8.42418C5.43647 8.90985 5.74032 9.33938 6.11968 9.68123C5.10551 10.1881 4.29134 11.0698 3.82328 12.1681C3.7842 12.2569 3.76594 12.3548 3.77013 12.453C3.77432 12.5513 3.80082 12.6469 3.84729 12.7314C3.8953 12.818 3.95931 12.8787 4.03932 12.9307C4.11933 12.974 4.19935 13 4.27936 13H11.7206C11.808 12.9996 11.8937 12.9746 11.9695 12.9275C12.0452 12.8804 12.1084 12.8129 12.1527 12.7314C12.1999 12.6472 12.2268 12.5515 12.231 12.4531C12.2352 12.3547 12.2165 12.2567 12.1767 12.1681C11.7087 11.0698 10.8945 10.1881 9.88032 9.68123Z" fill="currentColor"/>
                    </svg>
                </span>
                <p class="sidebar__menuitem__list__item--text fw-monserrat">{{__('Reference')}}</p>
           </a>
        </li>

        <li>
            <a href="{{ route('site.faq') }}" class="sidebar__menuitem__list__item @if (request()->is('faq')) active @endif">
                <span class="sidebar__menuitem__list__item--icon">
                    <svg width="16" height="17" viewBox="0 0 16 17" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path d="M7.401 1.93668V10.4487H3.516C2.5835 10.4487 1.68919 10.0782 1.02981 9.41886C0.370435 8.75949 0 7.86518 0 6.93268V5.45268C0 4.52017 0.370435 3.62587 1.02981 2.96649C1.68919 2.30711 2.5835 1.93668 3.516 1.93668H7.401Z" fill="currentColor"/>
                        <path d="M15.375 0.246682C15.2088 0.126078 15.0163 0.0467621 14.8134 0.0152888C14.6104 -0.0161844 14.4029 0.00108916 14.208 0.0656819L8.139 2.09168V10.2917L14.208 12.3127C14.3398 12.3572 14.4779 12.3798 14.617 12.3797C14.7874 12.3805 14.9563 12.3476 15.114 12.2829C15.2717 12.2182 15.4151 12.123 15.5359 12.0028C15.6567 11.8826 15.7525 11.7397 15.8179 11.5823C15.8833 11.4249 15.917 11.2561 15.917 11.0857V1.29768C15.9162 1.09212 15.8666 0.889686 15.7724 0.706988C15.6782 0.524289 15.542 0.366538 15.375 0.246682Z" fill="currentColor"/>
                        <path d="M8.253 15.4667C7.98121 15.8137 7.61745 16.0774 7.20314 16.2278C6.78883 16.3782 6.34061 16.4093 5.9095 16.3175C5.4784 16.2257 5.08173 16.0147 4.76466 15.7085C4.44758 15.4023 4.22283 15.0133 4.116 14.5857L3.264 11.1737C3.3474 11.1861 3.43172 11.1911 3.516 11.1887H8.116L8.674 13.4437C8.76238 13.7907 8.7704 14.1533 8.69745 14.5039C8.62449 14.8544 8.47248 15.1837 8.253 15.4667Z" fill="currentColor"/>
                    </svg>
                </span>
                <p class="sidebar__menuitem__list__item--text fw-monserrat">{{ __('Doubts')}}</p>
            </a>
        </li>

    </ul>

  </div>

  <div class="sidebar__cardbtns">
      <a class="sidebar__cardbtns__btn--support fw-monserrat" href="https://t.me/bet29brasil">
          <span>
              <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                  <path d="M16.0594 0H3.94007C2.89613 0.00417346 1.89591 0.520294 1.15774 1.4357C0.41956 2.35111 0.00336543 3.5915 0 4.88608V11.7465C0.00336543 13.0411 0.41956 14.2814 1.15774 15.1968C1.89591 16.1122 2.89613 16.6284 3.94007 16.6325H6.85462L8.84463 19.3639C8.99066 19.5642 9.16894 19.7243 9.36795 19.8338C9.56695 19.9434 9.78227 20 10 20C10.2177 20 10.4331 19.9434 10.6321 19.8338C10.8311 19.7243 11.0094 19.5642 11.1554 19.3639L13.1454 16.6325H16.0599C17.1039 16.6284 18.1041 16.1122 18.8423 15.1968C19.5804 14.2814 19.9966 13.0411 20 11.7465V4.88469C19.9963 3.59023 19.5799 2.35012 18.8417 1.43499C18.1034 0.519857 17.1032 0.00399012 16.0594 0ZM13.1371 10.2862H6.86237C6.5899 10.2862 6.36904 9.86777 6.36904 9.35095C6.36904 8.83413 6.59101 8.41571 6.86237 8.41571H13.1371C13.4095 8.41571 13.6304 8.83413 13.6304 9.35095C13.6304 9.86777 13.4095 10.2862 13.1371 10.2862ZM14.7963 7.37727H5.20311C5.00317 7.37727 4.81142 7.27878 4.67004 7.10346C4.52865 6.92813 4.44923 6.69032 4.44923 6.44237C4.44923 6.19442 4.52865 5.95665 4.67004 5.78133C4.81142 5.606 5.00317 5.50747 5.20311 5.50747H14.7963C14.9963 5.50747 15.188 5.606 15.3294 5.78133C15.4708 5.95665 15.5502 6.19442 15.5502 6.44237C15.5502 6.69032 15.4708 6.92813 15.3294 7.10346C15.188 7.27878 14.9963 7.37727 14.7963 7.37727Z" fill="currentColor"/>
              </svg>
          </span>
          {{ __('Live Support')}}
      </a>
      <a href="https://t.me/bet29brasil" target="_blank" class="sidebar__cardbtns__btn--tell fw-monserrat">
          <span>
              <svg width="20" height="17" viewBox="0 0 20 17" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                  <path d="M18.1925 0.0600579C14.9225 1.31006 4.37249 5.51006 0.382495 7.11006C0.265379 7.15159 0.164048 7.22846 0.0924948 7.33006C0.0258864 7.43107 -0.00621504 7.55093 0.000995695 7.67171C0.00820643 7.79249 0.0543417 7.90769 0.132495 8.00006C0.212495 8.10006 0.312495 8.17006 0.432495 8.20006L5.0325 9.57006L15.2925 3.62006C15.3035 3.61022 15.3177 3.60478 15.3325 3.60478C15.3473 3.60478 15.3615 3.61022 15.3725 3.62006C15.3789 3.62569 15.384 3.63261 15.3875 3.64037C15.391 3.64813 15.3928 3.65655 15.3928 3.66506C15.3928 3.67357 15.391 3.68199 15.3875 3.68974C15.384 3.6975 15.3789 3.70443 15.3725 3.71006L7.5225 10.8501L14.6325 15.8201C14.8288 15.9618 15.071 16.0251 15.3116 15.9973C15.5522 15.9695 15.7736 15.8528 15.9325 15.6701C16.0325 15.5501 16.0925 15.4101 16.1225 15.2601L18.9925 0.660058C19.0125 0.560058 19.0025 0.460058 18.9725 0.360058C18.9331 0.26369 18.8673 0.180467 18.7825 0.120058C18.6976 0.0563724 18.5974 0.0163396 18.4919 0.00404236C18.3865 -0.00825487 18.2798 0.00762327 18.1825 0.0500576L18.1925 0.0600579Z" fill="currentColor"/>
              </svg>
          </span>
          {{__('Telegram')}}
       </a>
  </div>
</div>
