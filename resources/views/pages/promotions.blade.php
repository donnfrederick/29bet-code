@extends('welcome')


@section('css')
<style>
    .game::before {
        background: linear-gradient(180deg,#fa2f5c,rgba(0,9,87,0));
        content: "";
        display: block;
        height: 45%;
        left: 0;
        position: absolute;
        top: 0;
        width: 100%;
        z-index: -1;
    }
    .centro_promocoes .md-modal{
        /* position: fixed; */
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 50%; /* Adjust width as needed */
        max-height: 100%; /* Limit the maximum height of the modal */
        /* Other modal styles */
        overflow-y: auto; /* Enable vertical scrolling within the modal */
        align-items: center;
        justify-content: center;

        /* Hide scrollbar for Firefox */
        scrollbar-width: none;
        /* Hide scrollbar for WebKit-based browsers */
        &::-webkit-scrollbar {
        display: none;
        background-color: rgba(0, 0, 0, 0.5); /* semi-transparent background */
        z-index: 999;
        }
    }

    /* Media query for mobile devices */
    @media (max-width: 768px) {
        .centro_promocoes .md-modal {
            width: 100%; /* Set width to 100% for screens up to 768px wide (adjust as needed for your mobile view) */
            /* You can add additional styles specific to mobile view here if necessary */
        }
    }
    .centro_promocoes .new__banners__background__title--logo{
        font-size: 35px;
    }

    .centro_promocoes .content_bo{
        text-align: center !important;
    }

    .centro_promocoes .content_footer {
        text-align: center !important;
        word-wrap: break-word !important;
    }

    .responsive-img {
        max-width: 100%;
        height: auto;
        display: block;
        margin-left: auto;
        margin-right: auto;
    }

    @media only screen and (max-width: 676px) {
        .responsive-img {
            max-width: 100%;
        }
    }

    
</style>
@endsection

@section('content')
    <section class="centro_promocoes">
        {{-- <div class="promotions__center">
            <h1 class="titulopage">Centro de Promoções</h1>
            <img src="" alt="">
        </div> --}}

        <div class="center__promotions d-lg-flex  align-items-center">
            <div>
                <h2>{{ __('Center of')}}
                <br>
                <span>{{ __('promotions')}}</span></h2>
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Molestiae vero mollitia deserunt aperiam iure excepturi a delectus ad provident voluptate.</p>
            </div>

            <div class="images__promotions d-md-block d-lg-block d-none">
                <img class="images__promotions--present" src="https://cdn.29bet.com/assets/img/bag.png" alt="https://cdn.29bet.com/assets/img/bag.png">
                <img class="images__promotions--conffet" src="https://cdn.29bet.com/assets/img/conffet.png" alt="https://cdn.29bet.com/assets/img/conffet.png">
            </div>

        </div>



        <div class="containerfiltro mt-5 d-none d-lg-flex">
                <div class="filter__itempromo active" onclick="filterSelection('all')">{{ __('All')}}</span></div>
                @foreach ($types as $promotypes )
                    <div class="filter__itempromo" onclick="filterSelection('cat--{{ $promotypes->event_type }}')">{{ $promotypes->event_type }}</span></div>
                @endforeach
                {{-- <div class="filter__itempromo" onclick="filterSelection('cat--novidades')">{{ __('News')}}</span></div>
                <div class="filter__itempromo" onclick="filterSelection('cat--descontos')">{{ __('Discounts')}}</span></div>
                <div class="filter__itempromo" onclick="filterSelection('cat--cupons')">{{ __('Coupons')}}</span></div> --}}
        </div>

        <div class="dropdown w-100 d-block d-md-none d-lg-none position-relative mt-4" style="z-index: 2;">
            <div class="dropdown__select">

                <ul class="dropdown__select__default game__select__default dropdown__users w-100">
                    <li>
                        <div class="dropdown__select__default__option">
                            <p>{{ __('Select a category')}}</p>
                        </div>
                    </li>
                </ul>
                <ul class="dropdown__select__list tab-list">
                    @foreach ($types as $promotypes)
                        <li class="my-tab" onclick="filterSelection('cat--{{ $promotypes->event_type }}')">
                            <div class="dropdown__select__list__option select__list__option__game" >
                                <p>{{ $promotypes->event_type }}</p>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>

        </div>

        <div class="row row-cols-lg-4 row-md-3 row-cols-sm-2 row-cols-1 justify-content-center">
            @foreach ($promotions as $promos)
                @php
                    $promo_id = $promos['id'];
                @endphp
                <div class="cat--{{ $promos['event_type'] }} filterDiv col my-3">
                    <div class="card__item ">
                        <div class="card__item--img"><img src="{{ $promos['picture_of_event']}}" alt="{{ $promos['picture_of_event']}}"></div>
                        <div class="card__item--dados">
                            <div class="card__item--titulo">{{ $promos['name']}}</div>
                            <div class="card__item--txt">{{ $promos['description']}}</div>
                            <div class="card__item--btn" ><a href="{{ route('event_details_page', ['id' => $promo_id]) }}">{{ __('KNOW MORE')}}</a></div>
                        </div>
                    </div>
                </div>
            @endforeach

            {{-- <div class="cat--novidades filterDiv col my-3">
                <div class="card__item ">
                    <div class="card__item--img"><img src="https://cdn.29bet.com/assets/img/all/pages/promotions/mobile-b1.png" alt="https://cdn.29bet.com/assets/img/all/pages/promotions/mobile-b1.png"></div>
                    <div class="card__item--dados">
                        <div class="card__item--titulo">{{ __('Exclusive VIP Bonus')}}</div>
                        <div class="card__item--txt">{{ __('To give back to all 29bet users, the VIP reward mechanism is now open. As long as you can meet the requirements, you can receive generous bonuses!')}}</div>
                        <div class="card__item--btn"><a>{{ __('KNOW MORE')}}</a></div>
                    </div>
                </div>
            </div>

            <div class="cat--novidades filterDiv col my-3">
                <div class="card__item">
                    <div class="card__item--img"><img src="https://cdn.29bet.com/assets/img/all/pages/promotions/mobile-b2.png" alt="https://cdn.29bet.com/assets/img/all/pages/promotions/mobile-b2.png"></div>
                    <div class="card__item--dados">
                        <div class="card__item--titulo">{{ __('Come get 100% bonus')}}</div>
                        <div class="card__item--txt">{{ __('To give back to all 29bet users, the VIP reward mechanism is now open. As long as you can meet the requirements, you can receive generous bonuses!')}}</div>
                        <div class="card__item--btn"><a>{{ __('KNOW MORE')}}</a></div>
                    </div>
                </div>
            </div>

            <div class="cat--cupons filterDiv col my-3">
                <div class="card__item">
                    <div class="card__item--img"><img src="https://cdn.29bet.com/assets/img/all/pages/promotions/mobile-b3.png" alt="https://cdn.29bet.com/assets/img/all/pages/promotions/mobile-b3.png"></div>
                    <div class="card__item--dados">
                        <div class="card__item--titulo">{{ __('Come get 100% bonus')}}</div>
                        <div class="card__item--txt">{{ __('To give back to all 29bet users, the VIP reward mechanism is now open. As long as you can meet the requirements, you can receive generous bonuses!')}}</div>
                        <div class="card__item--btn"><a>{{ __('KNOW MORE')}}</a></div>
                    </div>
                </div>
            </div>

            <div class="cat--descontos filterDiv col my-3">
                <div class="card__item">
                    <div class="card__item--img"><img src="https://cdn.29bet.com/assets/img/all/pages/promotions/mobile-b4.png" alt="https://cdn.29bet.com/assets/img/all/pages/promotions/mobile-b4.png"></div>
                    <div class="card__item--dados">
                        <div class="card__item--titulo">{{ __('Come get 100% bonus')}}</div>
                        <div class="card__item--txt">{{ __('To give back to all 29bet users, the VIP reward mechanism is now open. As long as you can meet the requirements, you can receive generous bonuses!')}}</div>
                        <div class="card__item--btn"><a>{{ __('KNOW MORE')}}</a></div>
                    </div>
                </div>
            </div>

            <div class="cat--novidades filterDiv col my-3">
                <div class="card__item ">
                    <div class="card__item--img"><img src="https://cdn.29bet.com/assets/img/all/pages/promotions/mobile-b1.png" alt="https://cdn.29bet.com/assets/img/all/pages/promotions/mobile-b1.png"></div>
                    <div class="card__item--dados">
                        <div class="card__item--titulo">{{ __('Come get 100% bonus')}}</div>
                        <div class="card__item--txt">{{ __('To give back to all 29bet users, the VIP reward mechanism is now open. As long as you can meet the requirements, you can receive generous bonuses!')}}</div>
                        <div class="card__item--btn"><a>{{ __('KNOW MORE')}}</a></div>
                    </div>
                </div>
            </div>

            <div class="cat--descontos filterDiv col my-3">
                <div class="card__item">
                    <div class="card__item--img"><img src="https://cdn.29bet.com/assets/img/all/pages/promotions/mobile-b2.png" alt="https://cdn.29bet.com/assets/img/all/pages/promotions/mobile-b2.png"></div>
                    <div class="card__item--dados">
                        <div class="card__item--titulo">{{ __('Come get 100% bonus')}}</div>
                        <div class="card__item--txt">{{ __('To give back to all 29bet users, the VIP reward mechanism is now open. As long as you can meet the requirements, you can receive generous bonuses!')}}</div>
                        <div class="card__item--btn"><a>{{ __('KNOW MORE')}}</a></div>
                    </div>
                </div>
            </div>

            <div class="cat--cupons filterDiv col my-3">
                <div class="card__item">
                    <div class="card__item--img"><img src="https://cdn.29bet.com/assets/img/all/pages/promotions/mobile-b3.png" alt="https://cdn.29bet.com/assets/img/all/pages/promotions/mobile-b3.png"></div>
                    <div class="card__item--dados">
                        <div class="card__item--titulo">{{ __('Come get 100% bonus')}}</div>
                        <div class="card__item--txt">{{ __('To give back to all 29bet users, the VIP reward mechanism is now open. As long as you can meet the requirements, you can receive generous bonuses!')}}</div>
                        <div class="card__item--btn"><a>{{ __('KNOW MORE')}}</a></div>
                    </div>
                </div>
            </div>

            <div class="cat--cupons filterDiv col my-3">
                <div class="card__item">
                    <div class="card__item--img"><img src="https://cdn.29bet.com/assets/img/all/pages/promotions/mobile-b4.png" alt="https://cdn.29bet.com/assets/img/all/pages/promotions/mobile-b4.png"></div>
                    <div class="card__item--dados">
                        <div class="card__item--titulo">{{ __('Come get 100% bonus')}}</div>
                        <div class="card__item--txt">{{ __('To give back to all 29bet users, the VIP reward mechanism is now open. As long as you can meet the requirements, you can receive generous bonuses!')}}</div>
                        <div class="card__item--btn"><a>{{ __('KNOW MORE')}}</a></div>
                    </div>
                </div>
            </div> --}}
        </div>
        

        @foreach($promotions as $promo_datas)
  
       <div class="md-modal-wrapper">
            <div class="md-modal md-s-height md-promotion md-effect-1 promo--{{ $promo_datas['id']}}" >
                <div class="md-content h-100">
                    <i class="fal fa-times md-close"></i>
                    <center>
                    <div class="">
                        <h1>
                            <div class="row">
                                <span class="new__banners__background__title--logo">{{ $promo_datas['content_header']}}</span>
                            </div>
                            <br>
                                {{ $promo_datas['content_body']}}
                            <br>
                            <br>
                            @if($promo_datas['content_image'])
                                <div class="row">
                                    <img src="{{ $promo_datas['content_image']}}" alt="{{ $promo_datas['content_image']}}" height="80%" width="80%">
                                </div>
                            @else

                            @endif
                            
                            <br>
                            <br>
                            {{ $promo_datas['content_footer']}}
                            <br>
                            <br>
                        </h1>
                        <!-- <div>
                            <h2><br><span>{{ $promo_datas['content_header']}}</span></h2>
                            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Molestiae vero mollitia deserunt aperiam iure excepturi a delectus ad provident voluptate.</p>
                        </div> -->
                    </div>
                </div>
            </div>

            <div class="md-overlay"></div>
       </div>
       @endforeach

       @if(isset($id))
         <script>
            $(document).ready(function(){
                console.log('sdadsad');
                var promoId = "{{ $id }}";
                var modal = $('.promo--'+ promoId);
                modal.toggleClass('md-show', true);
            });
        </script>
        @endif
        
      
        <script>
            $(document).ready(function() {
                $('.card__item--btn').on('click', function(){
                    var promoId = $(this).data('promo-id');
                    var modal = $('.promo--'+ promoId);

                    modal.toggleClass('md-show', true);
                });
            });
        </script>
        

      
        

        <script>
            // $('.card__item--btn').on('click', function(){
            //     console.log(this.id);
            //     $('.md-promotion').toggleClass('md-show', true)
            // });
            $('.md-close').on('click', function(){
                $('.md-promotion').toggleClass('md-show', false)
            });
        </script>
    </section>
@endsection
