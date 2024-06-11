<noindex>
    <div class="ll_container">
        <div class="container">
            <div class="ll_header">
                <div class="pulsating-circle"></div>
                <span>LIVE</span>
            </div>
            <div>
                <table class="live_table" id="ll">
                    <thead>
                        <tr class="live_table-header">
                            <th>ИГРА</th>
                            <th>ИГРОК</th>
                            <th class="hidden-xs">ВРЕМЯ</th>
                            <th class="hidden-xs">СТАВКА</th>
                            <th class="hidden-xs">КОЭФФ.</th>
                            <th>ВЫИГРЫШ</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach(\App\Http\Controllers\GeneralController::get_drop() as $d)
                        @if($d['game_id'] == 12 && floatval($d['amount']) <= 0) @continue @endif

                        <tr class="live_table-game">
                            <th>
                                <div class="live_table-animated">
                                    <div class="ll_icon hidden-xs" onclick="load('/{{strtolower($d['name'])}}')">
                                        <i class="{{$d['icon']}}"></i>
                                    </div>
                                    <div class="ll_game">
                                        <span onclick="@if($d['game_id'] != 12) load('/{{strtolower($d['name'])}}'); @else load('/cases'); @endif">{{$d['name']}}</span>
                                        @if($d['game_id'] != 12) <p onclick="user_game_info({{$d['id']}})">Просмотр</p>
                                        @else <p onclick="load('/cases')">Перейти</p> @endif
                                    </div>
                                </div>
                            </th>
                            <th>
                                <div class="live_table-animated">
                                    <a class="ll_user" href="/user?id={{$d['user_id']}}">
                                        {{$d['username']}}
                                    </a>
                                </div>
                            </th>
                            <th class="hidden-xs">
                                <div class="live_table-animated">
                                    {{!isset($d['time']) || $d['time'] == null ? '' : $d['time']}}
                                </div>
                            </th>
                            <th class="hidden-xs">
                                <div class="live_table-animated">
                                    {{$d['bet']}} &nbsp;<i class="fad fa-coins"></i>
                                </div>
                            </th>
                            <th class="hidden-xs">
                                <div class="live_table-animated">
                                 <!--   @if($d['game_id'] != 12) x{{$d['mul']}} @endif --->
                            @if($d['game_id'] == 12) — @endif 
                            @if($d['game_id'] != 12) x{{$d['mul']}} @endif
                                </div>
                            </th>
                            <th>
                                <div class="live_table-animated">
                                    @if($d['status'] == 1) +{{$d['amount']}} &nbsp;<i class="fad fa-coins"></i> @else 0.00 &nbsp;<i class="fad fa-coins"></i> @endif
                                </div>
                            </th>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</noindex>