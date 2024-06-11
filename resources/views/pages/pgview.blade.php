@extends('welcome')


@section('css')
<style>
    .container_full-width {
        max-width: 100%;
        padding: 0;
    }
    .game {
        margin: 0;
    }
    .btn--float {
        display: none;
    }
</style>
@endsection
@section('content')
<div class="game__wrapper row justify-content-center m-0">
    <div class="col-12 p-0">
            <div id="fullscreenDiv">
                {{-- <iframe style="min-height: 800px;width: 100%; height: 100%;" id="pg_iframe" onload="iframeReady(this)" scrolling="yes" allowTransparency="true" frameborder="0" src="{{ $pg_url }}"> --}}
                
                <iframe style="min-height: 800px;width: 100%; height: 100%;" id="pg_iframe" onload="iframeReady(this)" scrolling="yes" allowTransparency="true" frameborder="0" srcdoc="{{ $htmlContent }}" sandbox="allow-same-origin allow-scripts">
                </iframe>
                <button onclick="exitFullscreen()" class="btn-fullscreen-exit d-block d-lg-none d-md-none">
                    <svg xmlns="http://www.w3.org/2000/svg"  height="1.5em" viewBox="0 0 448 512" fill="currentColor">
                        <path d="M160 64c0-17.7-14.3-32-32-32s-32 14.3-32 32v64H32c-17.7 0-32 14.3-32 32s14.3 32 32 32h96c17.7 0 32-14.3 32-32V64zM32 320c-17.7 0-32 14.3-32 32s14.3 32 32 32H96v64c0 17.7 14.3 32 32 32s32-14.3 32-32V352c0-17.7-14.3-32-32-32H32zM352 64c0-17.7-14.3-32-32-32s-32 14.3-32 32v96c0 17.7 14.3 32 32 32h96c17.7 0 32-14.3 32-32s-14.3-32-32-32H352V64zM320 320c-17.7 0-32 14.3-32 32v96c0 17.7 14.3 32 32 32s32-14.3 32-32V384h64c17.7 0 32-14.3 32-32s-14.3-32-32-32H320z"/>
                    </svg>
                </button>
            </div>
            <button id="fullScreenGames" class="btn-fullscreen d-block d-lg-none d-md-none">
                <svg xmlns="http://www.w3.org/2000/svg" height="1.5em" viewBox="0 0 448 512" fill="currentColor"><path d="M32 32C14.3 32 0 46.3 0 64v96c0 17.7 14.3 32 32 32s32-14.3 32-32V96h64c17.7 0 32-14.3 32-32s-14.3-32-32-32H32zM64 352c0-17.7-14.3-32-32-32s-32 14.3-32 32v96c0 17.7 14.3 32 32 32h96c17.7 0 32-14.3 32-32s-14.3-32-32-32H64V352zM320 32c-17.7 0-32 14.3-32 32s14.3 32 32 32h64v64c0 17.7 14.3 32 32 32s32-14.3 32-32V64c0-17.7-14.3-32-32-32H320zM448 352c0-17.7-14.3-32-32-32s-32 14.3-32 32v64H320c-17.7 0-32 14.3-32 32s14.3 32 32 32h96c17.7 0 32-14.3 32-32V352z"/></svg>
            </button>
    </div>
</div>

@endsection

@section('js')
<script>
$(document).ready(function() {
    app.vldTkn($('meta[name=csrf-token]').attr('content'));
});

function iframeReady() {
    $('#loadingContentPG').fadeOut(300);

    if (window.innerWidth <= 590) {
        console.log("click");
        $('#fullScreenGames').click();
    }
}

</script>
<script src="{{ asset('js/pgview.js') }}"></script>
@endsection
