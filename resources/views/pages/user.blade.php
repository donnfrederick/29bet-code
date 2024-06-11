@extends('welcome')
@section('css')
    <style>
        .selectCat{
            font-size: 20px;
        }
        .not-container {
            max-width: 100%;
            padding: 0;
        }

        .game {
            min-height: 700px;
            margin: 0;
        }
        .dropdown__select select {
            background-image: url('https://cdn.29bet.com/assets/img/arrow.svg')!important;
        }
    </style>
@endsection

@section('content')
    <div class="profile">

        <div class="profile__background" style="background-image: url('{{ asset(Auth::user()->avatar) }}')">
            <div class="container p-0 p-lg-2">

                <div class="profile__cover">
                    <div class="profile__cover__image"
                        style="background-image: url('{{ asset(Auth::user()->avatar) }}')">
                    </div>
                    <div class="profile__cover__info">
                        <h3>
                            <span>{{ Auth::user()->username }}</span>
                            <button class="profile__cover__copy" onclick="copyUsername()">
                                <svg width="24" height="24" focusable="false" aria-hidden="true"
                                    class="copy_btn_icon" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M5 9c0-1.1.9-2 2-2h7a2 2 0 0 1 2 2v9a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V9Z"></path>
                                    <path
                                        d="M8 4c0-.6.4-1 1-1h8a3 3 0 0 1 3 3v10a1 1 0 1 1-2 0V7a2 2 0 0 0-2-2H9a1 1 0 0 1-1-1Z">
                                    </path>
                                </svg>
                            </button>
                        </h3>
                        <p>Lvl {{ $rank_match['level'] }} - {{ __('Player')}}</p>
                    </div>
                </div>
                <ul class="profile__tabs tab-list  d-none d-md-flex d-lg-flex gap-2">
                    <li class="profile__tab my-tab" data-tab-target="profileOverview">
                        <p>{{ __('Overview')}}</p>
                    </li>
                    <li class="profile__tab my-tab" data-tab-target="profileGameHistoric">
                        <p>{{ __('Play history')}}</p>
                    </li>
                    <li class="profile__tab my-tab" data-tab-target="registerAccountHistoric">
                        <p>{{ __('Account registration')}}</p>
                    </li>
                    <li class="profile__tab my-tab" data-tab-target="profileTransaction">
                        <p>{{ __('Transactions')}}</p>
                    </li>
                    <li class="profile__tab my-tab" data-tab-target="profileConfiguration">
                        <p>{{ __('Settings')}}</p>
                    </li>
                </ul>

                <div class="dropdown w-100 d-block d-md-none d-lg-none position-relative mt-4" style="z-index: 2;">
                    <div class="dropdown__select">
                        <ul class="dropdown__select__default game__select__default dropdown__users w-100">
                            <li>
                                <div class="dropdown__select__default__option">
                                   <p class="selectCat">{{ __('Select a category')}}</p>
                                </div>
                            </li>
                        </ul>
                        <ul class="dropdown__select__list tab-list">
                            <li class="my-tab" data-tab-target="profileOverview">
                                <div class="dropdown__select__list__option select__list__option__game">
                                    <p>{{ __('Overview')}}</p>
                                </div>
                            </li>
                            <li class="my-tab" data-tab-target="profileGameHistoric">
                                <div class="dropdown__select__list__option select__list__option__game">
                                    <p>{{ __('Play history')}}</p>
                                </div>
                            </li>
                            <li class="my-tab" data-tab-target="registerAccountHistoric">
                                <div class="dropdown__select__list__option select__list__option__game">
                                    <p>{{ __('Account registration')}}</p>
                                </div>
                            </li>
                            <li class="my-tab" data-tab-target="profileTransaction">
                                <div class="dropdown__select__list__option select__list__option__game">
                                    <p>{{ __('Transactions')}}</p>
                                </div>
                            </li>
                            <li class="my-tab" data-tab-target="profileConfiguration">
                                <div class="dropdown__select__list__option select__list__option__game">
                                    <p>{{ __('Settings')}}</p>
                                </div>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>
            </div>


        </div>

        <div class="profile__body">
            <div class="my-tab-content  tab__styled__profile" id="profileOverview">
                <div class="container">
                    <div class="row mt-3 mb-5 justify-content-center">
                        <div class="col-md-4 col-lg-5 my-3 p-0 p-lg-2">
                            <div class="profile__body__card">
                                <div class="profile__body__card__wallet">
                                    <div class="profile__body__card__wallet__sale my-3">
                                        <p>{{ __('wallet')}}</p>
                                        <h3>R$: <span>0,00</span></h3>
                                    </div>
                                    <div class="profile__body__card__wallet__balance my-3">
                                        <p>{{ __('Balance')}}</p>
                                        <h3>R$: <span>{{ Auth::user()->balance()->control_balance }}</span></h3>
                                    </div>
                                    <div class="profile__body__card__wallet__agent my-3">
                                        <p>{{ __('Agent balance')}}</p>
                                        <h3>R$: <span>{{ Auth::user()->balance()->agency_balance }}</span></h3>
                                    </div>

                                    <div class="profile__body__card__wallet__buttons my-2 d-lg-flex gap-3">
                                        <button
                                            class="profile__body__card__wallet__buttons--deposit my-2 my-lg-0" onclick="ClickDeposit()">{{ __('Deposit')}}</button>
                                        <button
                                            class="profile__body__card__wallet__buttons--withdrawl my-2 my-lg-0" onclick="ClickWithdraw()">{{ __('Withdraw')}}</button>
                                    </div>
                                    <div class="profile__body__card__wallet__member my-2">
                                        <button class="profile__body__card__wallet__member--btn" onclick="$('.md-password-member').toggleClass('md-show', true)">{{ __('Transfer member balance')}}</button>
                                    </div>
                                    {{-- <img src="{{ asset('img/all/pages/referralcabinet/money-discount.png') }}"
                                        alt=""> --}}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-5 my-3  p-0 p-lg-2">
                            <div class="profile__card">
                                <div class="profile__card__cover mb-3">
                                    <div class="profile__card__cover__change">
                                        <img class="profile__card__cover__change--img mb-2"
                                            src="{{ asset(Auth::user()->avatar) }}"
                                            alt="{{ asset(Auth::user()->avatar) }}">
                                        <h4 class="profile__card__cover__change--username" id ="copyUsername">{{ Auth::user()->username }}</h4>
                                        <button class="profile__card__cover__change--btn mt-2" onclick="$('.md-profile-covers').toggleClass('md-show', true)">{{ __('To change')}}</button>
                                    </div>
                                </div>
                                <div class="profile__card__profit">
                                    <div class="profile__card__ranking">
                                        <div class="profile__card__ranking__img">
                                            <img src="{{ asset($rank_match['image_lvl']) }}" alt="{{ asset($rank_match['image_lvl']) }}">
                                        </div>
                                        <div class="profile__card__ranking__lvl">
                                            <h4 class="profile__card__ranking__lvl--number mb-3">{{ __('LVL')}}-{{ $rank_match['level'] }}</h4>
                                            <div class="profile__card__ranking__lvl__progress my-3">
                                                <div class="profile__card__ranking__lvl__progress__info mb-2">
                                                    <p class="profile__card__ranking__lvl__progress__info--apost">{{ __('Bet')}}</p>
                                                    <p class="profile__card__ranking__lvl__progress__info--amount">R$ {{$rank_match['current_bet']}} /
                                                        <span>R$ {{$rank_match['bet']}}</span>
                                                    </p>
                                                </div>
                                                <div class="profile__card__ranking__lvl__progress__info__range">
                                                    <div class="profile__card__ranking__lvl__progress__info__range__found">
                                                        <div class="profile__card__ranking__lvl__progress__info__range__found--line"
                                                            style="width: {{$rank_match['percentage_bet']}}%"></div>
                                                    </div>
                                                    <p>{{ $rank_match['percentage_bet']}}%</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>



                    </div>
                </div>
            </div>

            <div class="my-tab-content  tab__styled__profile" id="profileGameHistoric">
                <div class="container p-0">
                    <div class="profile__gamehistoric">
                        <div class="referral__details">
                            <div class="referral__details__selects d-lg-flex gap-3 align-items-center mb-2">

                                <div class="d-flex gap-2 w-mb-100">
                                    <div class="dropdown mb-2 w-mb-100">
                                        <div class="dropdown__select">
                                            <select class="select--pix--input" id="historydate_filter" name="historydate_filter">
                                                <option value="1" selected>{{ __('last 7 days')}}</option>
                                                <option value="2">{{ __('Today')}}</option>
                                                <option value="3">{{ __('Yesterday')}}</option>
                                                <option value="4">{{ __('Within a month')}}</option>
                                                <option value="5">{{ __('Within the year')}}</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="dropdown mb-2 w-mb-100">
                                        <div class="dropdown__select">
                                            <select class="select--pix--input" id="gametype_filter" name="gametype_filter">
                                                <option value="1, 2, 3, 4, 5, 6, 7" selected>{{ __('All')}}</option>
                                                <option value="1">{{ __('Live games')}}</option>
                                                <option value="2">{{ __('Slot machine games')}}</option>
                                                <option value="3">{{ __('Fishing games')}}</option>
                                                <option value="4">{{ __('Sport games')}}</option>
                                                <option value="5">{{ __('Card games')}}</option>
                                                <option value="6">{{ __('Lottery games')}}</option>
                                                <option value="7">{{ __('Esports')}}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="dropdown mb-2 w-mb-100">
                                    <div class="dropdown__select">
                                        <select class="select--pix--input" id="history_limit" name="history_limit">
                                            <option value="10" selected>10</option>
                                            <option value="20">20</option>
                                            <option value="50">50</option>
                                            <option value="100">100</option>
                                        </select>
                                    </div>
                                </div>

                            </div>

                            <div class="dt00 table__scroll">
                                <table class="default__table" id="historic" style="width:100%">
                                    <thead class="default__table__header">
                                        <tr class="default__table__header__content">
                                            <th scope="col" class="default__table__header__content--item">{{ __('Game Name')}}</th>
                                            <th scope="col" class="default__table__header__content--item">{{ __('Description')}}</th>
                                            <th scope="col" class="default__table__header__content--item">{{ __('Game Type')}}</th>
                                            <th scope="col" class="default__table__header__content--item">{{ __('Amount')}}</th>
                                            <th scope="col" class="default__table__header__content--item">{{ __('Date Transacted')}}</th>
                                        </tr>
                                    </thead>
                                    <tbody class="de  fault__table__body">

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="my-tab-content  tab__styled__profile" id="registerAccountHistoric">
                <div class="container p-0">
                    <div class="profile__gamehistoric">
                        <div class="referral__details">
                            <div class="referral__details__selects d-lg-flex gap-3 align-items-center mb-1">

                                <div class="d-flex gap-2 w-mb-100">
                                    <div class="dropdown mb-2 w-mb-100">
                                        <div class="dropdown__select">
                                            <select class="select--pix--input" id="registerdate_filter" name="registerdate_filter">
                                                <option value="1" selected>{{ __('last 7 days')}}</option>
                                                <option value="2">{{ __('Today')}}</option>
                                                <option value="3">{{ __('Yesterday')}}</option>
                                                <option value="4">{{ __('Within a month')}}</option>
                                                <option value="5">{{ __('Within the year')}}</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="dropdown mb-2 w-mb-100">
                                        <div class="dropdown__select">
                                            <select class="select--pix--input" id="register_limit" name="register_limit">
                                                <option value="10" selected>10</option>
                                                <option value="20">20</option>
                                                <option value="50">50</option>
                                                <option value="100">100</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="dt00 table__scroll">
                                <table class="default__table" id="register">

                                    <thead class="default__table__header">
                                        <tr class="default__table__header__content">
                                            <th scope="col" class="default__table__header__content--item">{{ __('Reference Code')}}</th>
                                            <th scope="col" class="default__table__header__content--item">{{ __('Username')}}</th>
                                            <th scope="col" class="default__table__header__content--item">{{ __('Nome')}}</th>
                                            <th scope="col" class="default__table__header__content--item">{{ __('Registered Date')}}</th>
                                            <th scope="col" class="default__table__header__content--item">{{ __('Last login time')}}</th>
                                        </tr>
                                    </thead>

                                    <tbody class="default__table__body">
                                    </tbody>

                                </table>

                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="my-tab-content  tab__styled__profile" id="profileTransaction">
                <div class="container p-0">
                    <div class="profile__gamehistoric">
                        <div class="referral__details">
                            <div class="referral__details__selects d-lg-flex gap-3 align-items-center mb-2">

                                <div class="d-flex gap-2 w-mb-100">
                                    <div class="dropdown mb-2 w-mb-100">
                                        <div class="dropdown__select">
                                            <select class="select--pix--input" id="transactiondate_filter" name="transactiondate_filter">
                                                <option value="1" selected>{{ __('last 7 days')}}</option>
                                                <option value="2">{{ __('Today')}}</option>
                                                <option value="3">{{ __('Yesterday')}}</option>
                                                <option value="4">{{ __('Within a month')}}</option>
                                                <option value="5">{{ __('Within the year')}}</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="dropdown mb-2 w-mb-100">
                                        <div class="dropdown__select">
                                            <select class="select--pix--input" id="transactiontype_filter" name="transactiontype_filter">
                                                <option value="7, 8, 12, 14, 15, 16, 17, 18, 19, 26, 27, 28, 29, 30, 31, 32, 35, 36, 37, 46, 48" selected>{{ __('All')}}</option>
                                                <option value="8, 12, 28, 29">{{ __('Withdrawal')}}</option>
                                                <option value="7, 19, 26, 27">{{ __('Recharge')}}</option>
                                                <option value="14, 30, 31, 32, 35, 36">{{ __('Transfer Balance')}}</option>
                                                <option value="15, 16, 17, 37, 46, 48">{{ __('Claim promotion')}}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>


                                <div class="dropdown mb-2 w-mb-100">
                                    <div class="dropdown__select">
                                        <select class="select--pix--input" id="transaction_limit" name="transaction_limit">
                                            <option value="10" selected>10</option>
                                            <option value="20">20</option>
                                            <option value="50">50</option>
                                            <option value="100">100</option>
                                        </select>
                                    </div>
                                </div>

                            </div>

                            <div class="dt00 table__scroll">
                                <table class="default__table w-100" id="transaction">

                                    <thead class="default__table__header">
                                        <tr class="default__table__header__content">
                                        <th scope="col" class="default__table__header__content--item">{{ __('Transaction ID')}}</th>
                                        <th scope="col" class="default__table__header__content--item">{{ __('Description')}}</th>
                                        <th scope="col" class="default__table__header__content--item">{{ __('Before balance')}}</th>
                                        <th scope="col" class="default__table__header__content--item">{{ __('Value')}}</th>
                                        <th scope="col" class="default__table__header__content--item">{{ __('New balance sheet')}}</th>
                                        <th scope="col" class="default__table__header__content--item">{{ __('Transaction Date')}}</th>
                                        </tr>
                                    </thead>

                                    <tbody class="default__table__body">
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="my-tab-content  tab__styled__profile" id="profileConfiguration">
                <div class="container">
                    <div class="profile__config">
                        <div class="row justify-content-center">
                            <div class="col-12 col-lg-5 my-3">
                                <div class="profile__config__password">
                                    <h4>
                                        <span>
                                            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"
                                                fill="currentColor">
                                                <path
                                                    d="M144 144v48H304V144c0-44.2-35.8-80-80-80s-80 35.8-80 80zM80 192V144C80 64.5 144.5 0 224 0s144 64.5 144 144v48h16c35.3 0 64 28.7 64 64V448c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V256c0-35.3 28.7-64 64-64H80z" />
                                            </svg>
                                        </span>
                                        {{ __('Login password')}}
                                    </h4>
                                    <p>{{ __('Must contain at least 8 characters: a combination of letters and characters')}}</p>
                                    <button onclick="$('.md-reset-login-password').toggleClass('md-show', true)">{{ __('Change Password')}}</button>
                                </div>
                            </div>

                            <div class="col-12 col-lg-5 my-3">
                                <div class="profile__config__password">
                                    <h4>
                                        <span>
                                            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"
                                                fill="currentColor">
                                                <path
                                                    d="M144 144v48H304V144c0-44.2-35.8-80-80-80s-80 35.8-80 80zM80 192V144C80 64.5 144.5 0 224 0s144 64.5 144 144v48h16c35.3 0 64 28.7 64 64V448c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V256c0-35.3 28.7-64 64-64H80z" />
                                            </svg>
                                        </span>
                                        {{ __('Password withdrawn')}}
                                    </h4>

                                    <p>{{ __('Must contain at least 8 characters: a combination of letters and characters')}}</p>
                                    <button onclick="$('.md-reset-password-withdrawal').toggleClass('md-show', true)">{{ __('Change Password')}}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>

        $(document).ready(function() {


            const token = $('meta[name=csrf-token]').attr('content');

            var PersonalCenterTab = localStorage.getItem('PersonalCenterTab');

            if (PersonalCenterTab !== null) {
                $('.my-tab').eq(PersonalCenterTab).click();

                if (PersonalCenterTab == 1) {
                    PlayHistoryTable();
                }else if(PersonalCenterTab == 2){
                    AccountRegistrationTable();
                }else if(PersonalCenterTab == 3){
                    TransactionTable();
                }
                
            }

            $('.my-tab').click(function() {

                var tabIndex = $(this).index();
                localStorage.setItem('PersonalCenterTab', tabIndex);
                    
            });

            
            function PlayHistoryTable() {

                var PlayHistoryTable = new DataTable('#historic', {

                    pagingType: 'full_numbers',
                    processing: true,
                    serverSide: true,
                    lengthChange: false,
                    pageLength: 10,
                    stateSave: true,
                    language: {
                        "emptyTable": "{{ __('No data available in table')}}",
                        "zeroRecords":    "{{ __('No matching records found')}}",
                        "info":           "{{ __('Showing')}} _START_ {{ __('to')}} _END_ {{ __('of')}} _TOTAL_ {{ __('entries')}}",
                        "infoEmpty":      "{{ __('Showing 0 to 0 of 0 entries')}}",
                        "infoFiltered":   "( {{ __('filtered from')}} _MAX_ {{ __('total entries')}} )",
                        "search": "{{ __('Search:')}}",
                        "paginate": {
                            "first":      "{{ __('First')}}",
                            "last":       "{{ __('Last')}}",
                            "next":       "{{ __('Next')}}",
                            "previous":   "{{ __('Previous')}}"
                        },
                    },
                    stateSaveParams: function(settings, data) {

                        data.historydate_filter = $('#historydate_filter').val();
                        data.gametype_filter = $('#gametype_filter').val();
                        data.history_limit = $('#history_limit').val();

                    },
                    stateLoadParams: function(settings, data) {

                        $('#historydate_filter').val(data.historydate_filter || 1);
                        $('#gametype_filter').val(data.gametype_filter || "1, 2, 3, 4, 5, 6, 7");
                        $('#history_limit').val(data.history_limit || 10);

                    },
                    initComplete: function() {

                        $('#history_limit').on('change', function() {

                            PlayHistoryTable.page.len($(this).val()).draw();

                        });

                        $('#historydate_filter').on('change', function() {

                            PlayHistoryTable.ajax.reload();

                        });

                        $('#gametype_filter').on('change', function() {

                            PlayHistoryTable.ajax.reload();

                        });

                    },
                    ajax: {

                        url: '{{ route("playhistory_table") }}',
                        type: 'POST',
                        headers: {

                            'Content-Type': 'appication/json',
                            'X-CSRF-TOKEN': token,
                            'Authorization': 'Bearer ' + token

                        },
                        data: function(d) {

                            d.date = $('#historydate_filter').val();
                            d.game_type = $('#gametype_filter').val();
                            return JSON.stringify(d);
                        }

                    },
                    order: [
                        [4, 'desc']
                    ],
                    columns: [

                        { data: 'game_name'},
                        { data: 'action_description'},
                        { data: 'category_name'},
                        { data: 'amount'},
                        { data: 'date_transacted'}

                    ],
                    columnDefs: [

                        {

                            targets: [0, 2],
                            createdCell: function(cell, cellData, rowData, rowIndex, colIndex) {

                                $(cell).attr('data-label', 'Accountfs');
                                $(cell).addClass('default__table__body__content--item');
                                $(cell).css('text-transform', 'capitalize');

                            }

                        },
                        {

                            targets: [1, 3, 4],
                            createdCell: function(cell, cellData, rowData, rowIndex, colIndex) {

                                $(cell).attr('data-label', 'Accountd');
                                $(cell).addClass('default__table__body__content--item');

                            }

                        },

                    ]

                });

            }

            $('[data-tab-target="profileGameHistoric"]').one('click', function() {

                if (PersonalCenterTab != 1) {
                    
                    PlayHistoryTable();

                }

            });


            function AccountRegistrationTable() {

                var AccountRegistrationTable = new DataTable('#register', {

                    pagingType: 'full_numbers',
                    processing: true,
                    serverSide: true,
                    lengthChange: false,
                    pageLength: 10,
                    stateSave: true,
                    language: {
                        "emptyTable": "{{ __('No data available in table')}}",
                        "zeroRecords":    "{{ __('No matching records found')}}",
                        "info":           "{{ __('Showing')}} _START_ {{ __('to')}} _END_ {{ __('of')}} _TOTAL_ {{ __('entries')}}",
                        "infoEmpty":      "{{ __('Showing 0 to 0 of 0 entries')}}",
                        "infoFiltered":   "( {{ __('filtered from')}} _MAX_ {{ __('total entries')}} )",
                        "zeroRecords":    "{{ __('No matching records found')}}",
                        "search": "{{ __('Search:')}}",
                        "paginate": {
                            "first":      "{{ __('First')}}",
                            "last":       "{{ __('Last')}}",
                            "next":       "{{ __('Next')}}",
                            "previous":   "{{ __('Previous')}}"
                        },
                    },
                    stateSaveParams: function(settings, data) {

                        data.historydate_filter = $('#registerdate_filter').val();
                        data.history_limit = $('#register_limit').val();

                    },
                    stateLoadParams: function(settings, data) {

                        $('#registerdate_filter').val(data.historydate_filter || 1);
                        $('#register_limit').val(data.history_limit || 10);

                    },
                    initComplete: function() {

                        $('#registerdate_filter').on('change', function() {

                            AccountRegistrationTable.ajax.reload();

                        });

                        $('#register_limit').on('change', function() {

                            AccountRegistrationTable.page.len($(this).val()).draw();

                        });

                    },
                    ajax: {

                        url: '{{ route("registration_table") }}',
                        type: 'POST',
                        headers: {

                            'Content-Type': 'appication/json',
                            'X-CSRF-TOKEN': token,
                            'Authorization': 'Bearer ' + token

                        },
                        data: function(d) {

                            d.date = $('#registerdate_filter').val();

                            return JSON.stringify(d);

                        }

                    },
                    order: [
                        [3, 'desc']
                    ],
                    columns: [

                        { data: 'referral_id' },
                        { data: 'username' },
                        { data: 'name' },
                        { data: 'date_registered' },
                        { data: 'date_modified' },

                    ],
                    columnDefs: [

                        {

                            targets: [0, 1, 2, 4],
                            createdCell: function(cell, cellData, rowData, rowIndex, colIndex) {

                                $(cell).attr('data-label', 'Accountfs');
                                $(cell).addClass('default__table__body__content--item');

                            }

                        }

                    ]

                });

            }

            $('[data-tab-target="registerAccountHistoric"]').one('click', function() {

                if (PersonalCenterTab != 2) {
                    
                    AccountRegistrationTable();

                }

            });

            function TransactionTable() {

                var TransactionTable = new DataTable('#transaction', {
                    pagingType: 'full_numbers',
                    processing: true,
                    serverSide: true,
                    lengthChange: false,
                    pageLength: 10,
                    stateSave: true,
                    language: {
                        "emptyTable": "{{ __('No data available in table')}}",
                        "zeroRecords":    "{{ __('No matching records found')}}",
                        "info":           "{{ __('Showing')}} _START_ {{ __('to')}} _END_ {{ __('of')}} _TOTAL_ {{ __('entries')}}",
                        "infoEmpty":      "{{ __('Showing 0 to 0 of 0 entries')}}",
                        "infoFiltered":   "( {{ __('filtered from')}} _MAX_ {{ __('total entries')}} )",
                        "zeroRecords":    "{{ __('No matching records found')}}",
                        "search": "{{ __('Search:')}}",
                        "paginate": {
                            "first":      "{{ __('First')}}",
                            "last":       "{{ __('Last')}}",
                            "next":       "{{ __('Next')}}",
                            "previous":   "{{ __('Previous')}}"
                        },
                    },
                    stateSaveParams: function(settings, data) {

                        data.transactiontype_filter = $('#transactiontype_filter').val();
                        data.transactiondate_filter = $('#transactiondate_filter').val();

                    },
                    stateLoadParams: function(settings, data) {
                        
                        const transaction_filter = "7, 8, 12, 14, 15, 16, 17, 18, 19, 26, 27, 28, 29, 30, 31, 32, 35, 36, 37, 46, 48";
                        $('#transactiontype_filter').val(data.transactiontype_filter || transaction_filter);
                        $('#transactiondate_filter').val(data.transactiondate_filter || 1);

                    },
                    initComplete: function() {

                        $('#transactiontype_filter').on('change', function() {

                            TransactionTable.ajax.reload();

                        });

                        $('#transactiondate_filter').on('change', function() {

                            TransactionTable.ajax.reload();

                        });

                        $('#transaction_limit').on('change', function() {

                            TransactionTable.page.len($(this).val()).draw();

                        });

                    },
                    ajax: {

                        url: '{{ route("transaction_table") }}',
                        type: 'POST',
                        headers: {

                            'Content-Type': 'appication/json',
                            'X-CSRF-TOKEN': token,
                            'Authorization': 'Bearer ' + token

                        },
                        data: function(d) {

                            d.action_id = $('#transactiontype_filter').val();
                            d.date = $('#transactiondate_filter').val();
                            return JSON.stringify(d);
                        }

                    },
                    order: [
                        
                        [5, 'desc']
                        
                    ],
                    columns: [

                        { data: 'transaction_id' },
                        { data: 'transaction_description' },
                        { data: 'before_balance' },
                        { data: 'amount' },
                        { data: 'new_balance' },
                        { data: 'date_transacted' }

                    ],
                    columnDefs: [

                        {

                            targets: [0, 1, 2, 3, 4, 5],
                            createdCell: function(cell, cellData, rowData, rowIndex, colIndex) {

                                $(cell).attr('data-label', 'Accountfs');
                                $(cell).addClass('default__table__body__content--item');

                            }

                        },

                    ]

                });

            }


            $('[data-tab-target="profileTransaction"]').one('click', function() {

                if (PersonalCenterTab != 3) {
                    
                    TransactionTable();
                    
                }

            });

        });

    </script>

    {{-- modal for no set password for save box --}}
    {{-- <form method="POST" action="{{ route('set-password-vault') }}">
        @csrf
        <div class="md-modal md-extra md-s-height md-effect-1" id="modal-transfer-balance">
            <div class="md-content">
                <i class="fal fa-times md-close" onclick="$('.md-popup-error').toggleClass('md-show', false)"></i>
                <div style="width: 100%;text-align:center;margin-top: 10%;">
                    <p id="set-title"></p>
                    <input type="password" class="" id="password" name="password">
                    @if ($errors->verifypassword->has('password'))
                        <p class=" text-danger">
                            {{ $errors->verifypassword->first('password') }}
                        </p>
                    @endif
                    <input type="password" class="" id="password_confirmation" name="password_confirmation">
                    @if ($errors->verifypassword->has('password_confirmation'))
                        <p class=" text-danger">
                            {{ $errors->verifypassword->first('password_confirmation') }}
                        </p>
                    @endif
                    @if (session()->has('password_did_not_match'))
                        <p class=" text-danger">
                            {{ session('password_did_not_match') }}
                        </p>
                    @endif
                    <input type="hidden" id="redirect-input" name="redirect-input" style="display: none;">
                    <button type="submit">Save</button>
                </div>
            </div>
        </div>
    </form> --}}
    {{-- end modal  --}}

    {{-- modal for already have password --}}
    {{-- <form method="POST" action="{{ route('verify-vault') }}">
        @csrf
        <div class="md-modal md-extra md-s-height md-effect-1" id="modal-transfer-balance2">
            <div class="md-content">
                <i class="fa fa-times md-close" onclick="$('.md-popup-error').toggleClass('md-show', false)"></i>
                <div style="width: 100%;text-align:center;margin-top: 10%;">
                    <input type="text" class="" id="btn-verify-vault" name="password">
                    <div class="warning__message">
                        @if ($errors->verifypassword->has('password'))
                            <p class="text-danger" id="warning-password">
                                {{ $errors->verifypassword->first('password') }}
                            </p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </form> --}}
    {{-- end modal --}}

    {{-- <script>
        $('.profile__body__card__wallet__member--btn').on('click', function() {

            $.ajax({
                "method": "POST",
                "url": "{{ route('verify-vault') }}",
                data: {
                    "_token": "{{ csrf_token() }}"
                },
                success: function(response) {
                    console.log(response.verifypasswory);
                    if (response.msg == true) {
                        $('#set-title').text("Enter Password");
                        $('#redirect-input').val(1);
                        $('#modal-transfer-balance').addClass('md-show');
                        $('#password_confirmation').css('display', 'none');
                        $('#password_confirmation').prop('disabled', true);

                        $('#modal-transfer-balance').append(hiddenInput);
                    } else {
                        $('#modal-transfer-balance').addClass('md-show');
                        $('#set-title').text("Set Password");
                        $('#set-title').text("Set Password");
                    }
                }
            });

            $('#modal-transfer-balance').addClass('md-show');


        })
    </script> --}}
    {{-- @if (session()->has('session_verifypassword'))
        <script>
            $('#modal-transfer-balance').addClass('md-show');
            $('#warning-password').text("{{ session('session_verifypassword') }}");
        </script>
    @endif
    @if (session()->has('password_did_not_match'))
        console.log('asd');
        <script>
            $('#redirect-input').val(1);
            // $('#modal-transfer-balance2').removeClass('md-clash');
            $('#modal-transfer-balance').addClass('md-show');
            $('#password_confirmation').css('display', 'none');
            $('#password_confirmation').prop('disabled', false);
        </script>
    @endif --}}
@endsection
