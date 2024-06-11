
 <div class="mobile-menu">
    <div class="mobile-menu__contents" id="mybtn">
      <div style="display: none;" class="mobile-menu__submenu mobile-menu__submenu_games">
          <div class="mobile-menu__submenu__vertical-divider"></div>
      </div>

      <a @auth data-submenu="mobile-menu__submenu_more" @else  @endauth class="mobile-menu__link burguermobile linkmodal" id="sidemenumobile">
              <span class="mobile-menu__link-icon">
                  <svg width="30px" height="30px" viewBox="0 0 30 30" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                      <g id="页面-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                          <g id="底部栏入口" transform="translate(-311.000000, -13.000000)" fill="#3F4F70">
                              <g id="编组-9" transform="translate(0.000000, -576.000000)">
                                  <g id="形状结合-4" transform="translate(311.000000, 589.000000)">
                                      <path d="M4.5,6 L24.5,6 C25.0522847,6 25.5,6.44771525 25.5,7 L25.5,8 C25.5,8.55228475 25.0522847,9 24.5,9 L4.5,9 C3.94771525,9 3.5,8.55228475 3.5,8 L3.5,7 C3.5,6.44771525 3.94771525,6 4.5,6 Z M4.5,13 L24.5,13 C25.0522847,13 25.5,13.4477153 25.5,14 L25.5,15 C25.5,15.5522847 25.0522847,16 24.5,16 L4.5,16 C3.94771525,16 3.5,15.5522847 3.5,15 L3.5,14 C3.5,13.4477153 3.94771525,13 4.5,13 Z M4.5,20 L24.5,20 C25.0522847,20 25.5,20.4477153 25.5,21 L25.5,22 C25.5,22.5522847 25.0522847,23 24.5,23 L4.5,23 C3.94771525,23 3.5,22.5522847 3.5,22 L3.5,21 C3.5,20.4477153 3.94771525,20 4.5,20 Z" id="形状结合" fill="currentColor"></path>
                                  </g>
                              </g>
                          </g>
                      </g>
                  </svg>
              </span>
              <span class="mobile-menu__link_text">{{ __('Menu') }}</span>
      </a>

      <a data-submenu="mobile-menu__submenu_games" class="open-submenu mobile-menu__link linkmodal linksidebar" href="{{ route('ranks') }}">
          <span class="mobile-menu__link-icon">
              <svg height='29px' width='29px' xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><path fill="currentcolor" d="M528 448H112c-8.8 0-16 7.2-16 16v32c0 8.8 7.2 16 16 16h416c8.8 0 16-7.2 16-16v-32c0-8.8-7.2-16-16-16zm64-320c-26.5 0-48 21.5-48 48 0 7.1 1.6 13.7 4.4 19.8L476 239.2c-15.4 9.2-35.3 4-44.2-11.6L350.3 85C361 76.2 368 63 368 48c0-26.5-21.5-48-48-48s-48 21.5-48 48c0 15 7 28.2 17.7 37l-81.5 142.6c-8.9 15.6-28.9 20.8-44.2 11.6l-72.3-43.4c2.7-6 4.4-12.7 4.4-19.8 0-26.5-21.5-48-48-48S0 149.5 0 176s21.5 48 48 48c2.6 0 5.2-.4 7.7-.8L128 416h384l72.3-192.8c2.5 .4 5.1 .8 7.7 .8 26.5 0 48-21.5 48-48s-21.5-48-48-48z"/></svg>
            </span>
          <span class="mobile-menu__link_text">{{ __('VIP') }}
      </a>

      <a class="mobile-menu__link linkmodal linksidebar glass" href="{{ route('index') }}" id="glassElement">
        <span class="mobile-menu__link-icon lighttable icone-favicon">
             <!-- Initial image -->
            <img src="https://cdn.29bet.com/assets/img/all/pages/layout/favicon-menu.png" alt="Icone - 29Bet">
            <!-- Hover image -->
            <img src="https://cdn.29bet.com/assets/img/all/pages/layout/inver-favicon.png" alt="Icone - 29Bet" class="hover-image">
        </span>
    </a>
    

      <a class="mobile-menu__link linksidebar" href="{{ route('referralcabinet') }}">
          <span class="mobile-menu__link-icon ">
            <svg height="26px" width="26px" version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve" fill="currentcolor"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <style type="text/css"> </style> <g> <path class="st0" d="M512,230.431L283.498,44.621v94.807C60.776,141.244-21.842,307.324,4.826,467.379 c48.696-99.493,149.915-138.677,278.672-143.14v92.003L512,230.431z"></path> </g> </g></svg>
          </span>
           <span class="mobile-menu__link_text"> {{ __('Convidar') }}</span>
      </a>

      <a class="btn-toggle3 mobile-menu__link linkmodal linksidebar" href="{{ route('promotions') }}">
          <span class="mobile-menu__link-icon">
            <svg fill="currentcolor" version="1.1" id="Trophy_x5F_cup" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="27px" height="27px" viewBox="0 0 256.00 256.00" enable-background="new 0 0 256 256" xml:space="preserve" stroke="#7990b1" transform="rotate(0)" stroke-width="0.00256"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" stroke="#CCCCCC" stroke-width="7.68"></g><g id="SVGRepo_iconCarrier"> <path d="M190.878,111.272c31.017-11.186,53.254-40.907,53.254-75.733l-0.19-8.509h-48.955V5H64.222v22.03H15.266l-0.19,8.509 c0,34.825,22.237,64.546,53.254,75.733c7.306,18.421,22.798,31.822,41.878,37.728v20c-0.859,15.668-14.112,29-30,29v18h-16v35H195 v-35h-16v-18c-15.888,0-29.141-13.332-30-29v-20C168.08,143.094,183.572,129.692,190.878,111.272z M195,44h30.563 c-0.06,0.427-0.103,1.017-0.171,1.441c-3.02,18.856-14.543,34.681-30.406,44.007C195.026,88.509,195,44,195,44z M33.816,45.441 c-0.068-0.424-0.111-1.014-0.171-1.441h30.563c0,0-0.026,44.509,0.013,45.448C48.359,80.122,36.837,64.297,33.816,45.441z M129.604,86.777l-20.255,13.52l6.599-23.442L96.831,61.77l24.334-0.967l8.44-22.844l8.44,22.844l24.334,0.967L143.26,76.856 l6.599,23.442L129.604,86.777z"></path> </g></svg>
          </span>
          <span class="mobile-menu__link_text">{{ __('Promocões') }}
      </a>

    </div>
</div>

