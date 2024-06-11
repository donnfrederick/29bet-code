@extends('welcome')
@section('content')

<style>
    .card-slice {
        display: none;
    }
</style>

    <div class="row justify-content-center">
        <div class="col-lg-12">
        <div class="row">
            <div class="col-md-6">
                <h2 class="titulo__games my-3">{{ __('ALL THE GAMES') }}</h2>
            </div>
            <div class="col-md-6">
                <div class="busca">
                    <div class="busca__ico">
                        <i class="fal fa-search"></i>
                    </div>
                    <div class="busca__campo">
                        <input id="filtro" type="text" placeholder="{{ __('Busca Rápida') }}">
                    </div>
                </div>
                <div class="clear"></div>
            </div>       
            <div class="home__sliders">
                <div class="row row-cols-lg-6 row-cols-md-4  row-cols-3">
                    <script>
                        const isSafari = /^((?!chrome|android).)*safari/i.test(navigator.userAgent);
                    </script>
                    @foreach ($games as $game)
                
                    <div class="col px-1 my-1 card-slice">
                        <div class="initGames__item w-100 p-0">
                            <div class="initGames__content">
                                <div class="iniGames__new"><img src="https://cdn.29bet.com/img/all/components/games/tag-new.png" alt="https://cdn.29bet.com/img/all/components/games/tag-new.png">
                                </div>
                                <div class="initGames__img" style="background-image:url('https://cdn.29bet.com/uat-images/games/{{ $game['computers_icon'] }}')">
                                </div>
                                @if (Auth::guest())
                                <a href="javascript:void()" onclick="$('#b_si').click();">
                                @else
                                <a id="red_url_{{ $game['id'] }}" href="{{ $game['api_url'] }}">
                                    @if ($game['game_origin'] == "API Game")
                                <script>
                                    if (isSafari && window.innerWidth <= 590) {
                                        const url = '{!! $game["api_url"] !!}';
                                        const new_url = url.replace('amp;', '').replace('amp;', '');
                                        $('#red_url_{{ $game["id"] }}').attr('href', new_url);
                                        $('#red_url_{{ $game["id"] }}').attr('target', '_blank');
                                    }
                                </script>
                                    @endif

                                    @if ($game['game_provider'] != 4 && $game['game_provider'] != 8)
                                        <script>
                                            if (isSafari && window.innerWidth <= 590) {
                                                const url = '{!! $game["api_url"] !!}';
                                                $('#red_url_{{ $game["id"] }}').attr('href', url + '/true');
                                                $('#red_url_{{ $game["id"] }}').attr('target', '_blank');
                                            }
                                        </script>
                                    @endif

                                @endif
                                    <div class="initGames__hover">
                                        <div class="initGames_hover--name">{{ strtoupper($game['game_name']) }}</div>
                                        <div class="initGames_hover--play"><i class=" pesquisa__icon fa fa-play"></i></div>
                                        <div class="initGames_hover--sssg">{{ $game['game_provider_name'] }}</div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="my-4 text-center">
                    <button class="btn-29" id="loadMoreCards">{{ __('View More') }}</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
<script>
$(document).ready(function () {
//Function to add and remove class on seacrh games field
    $('.busca__ico').click(function(){
        $('.busca__campo').toggleClass('open');
    });

//Function to filter cards
    $("#filtro").keyup(function(){
        var texto = $(this).val();
        
        $(".card-slice").each(function(){
        var resultado = $(this).text().toUpperCase().indexOf(' '+texto.toUpperCase());
        
        if(resultado < 0) {
            $(this).fadeOut();
        }else {
            $(this).fadeIn();
        }
        }); 

    });   

    var screenWidth = $(window).width();
    var sliceSize = 6;
    if (screenWidth >= 768) {
        sliceSize = 36;
    }
    $(".card-slice").slice(0, sliceSize).show();
    if ($(".card-slice:hidden").length != 0) {
        $("#loadMoreCards").show();
    }
    $("#loadMoreCards").on("click", function (e) {
        e.preventDefault();
        $(".card-slice:hidden").slice(0, sliceSize).slideDown();
        if ($(".card-slice:hidden").length == 0) {
            $("#loadMoreCards").text("NO MORE")
                $( "#loadMoreCards" ).fadeOut("fast");
        }
    });
    if ($(".card-slice:hidden").length == 0) {
            $("#loadMoreCards").text("NO MORE")
                $( "#loadMoreCards" ).fadeOut("fast");
    }
});
</script>
@endsection
