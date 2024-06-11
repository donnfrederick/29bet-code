@extends('welcome')
@section('css')
@section('content')
<section class="centro_promocoes">
    <div class="center__promotions pt-4 d-lg-flex align-items-center justify-content-center">
        <div>
            <div class="align-items-center">

                <div class="referral__bonus">
                    <center>
                    <span
                        class="referral__explication__title--h3 mb-2" style="color:#fa2f5c;">{{ $promotion_details['content_header'] }}
                    </span>
                    <br><br>
                    <h5 class="mb-2"> {{ $promotion_details['content_body'] }}</h5>
                    </center>


                    @if($promotion_details['content_image'])
                    <div class="referral__demonstration__image promo-card" style="background-color: #0d131c !important; color: #0d131c !important;">
                        <center>
                            <img src="{{ $promotion_details['content_image'] }}" alt="{{ $promotion_details['content_image'] }}" class="max-with-promo" style="max-width: 700px;">
                        </center>
                    </div>
                    @else

                    @endif

                </div>

                <br>
                <br>
                <center>
                    <h5>{{ $promotion_details['content_footer'] }}</h5>
                </center>
            </div>
        </div>
</section>
@endsection
