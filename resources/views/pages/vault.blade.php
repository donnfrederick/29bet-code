{{-- @extends('welcome')
@section('content')
    <form method="POST" action="{{ route('transfer-agent-balance') }}">
        @csrf
        <div class="md-content h-100">
            <i class="fal fa-times md-close" onclick="$('.md-member-withdrawl').toggleClass('md-show', false)"></i>
            <div class="members__withdrawl">
                <h3 class="members__withdrawl__title mb-2">Transfer to member balance</h3>
                <a href="#" class="members__withdrawl__historic">Transfer Details for Member's Balance</a>

                <div class="d-flex align-items-center justify-content-center mt-4">
                    <div class="members__withdrawl__item">
                        <h5 class="members__withdrawl__item__title">Agent balance</h5>
                        <p class="members__withdrawl__item__amount" id="agency-balance-text">
                            {{ number_format(Auth::user()->balance()->agency_balance, 2) }}</p>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" height="40px" width="40px" fill="currentColor"
                            viewBox="0 0 448 512">
                            <path
                                d="M297.4 9.4c12.5-12.5 32.8-12.5 45.3 0l96 96c12.5 12.5 12.5 32.8 0 45.3l-96 96c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L338.7 160H128c-35.3 0-64 28.7-64 64v32c0 17.7-14.3 32-32 32s-32-14.3-32-32V224C0 153.3 57.3 96 128 96H338.7L297.4 54.6c-12.5-12.5-12.5-32.8 0-45.3zm-96 256c12.5-12.5 32.8-12.5 45.3 0l96 96c12.5 12.5 12.5 32.8 0 45.3l-96 96c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L242.7 416H96c-17.7 0-32 14.3-32 32v32c0 17.7-14.3 32-32 32s-32-14.3-32-32V448c0-53 43-96 96-96H242.7l-41.4-41.4c-12.5-12.5-12.5-32.8 0-45.3z" />
                        </svg>
                    </div>
                    <div class="members__withdrawl__item">
                        <h5 class="members__withdrawl__item__title">Member balance</h5>
                        <p class="members__withdrawl__item__amount" id="member-balance-text">
                            {{ number_format(Auth::user()->balance()->control_balance, 2) }}</p>
                    </div>
                </div>

                <div class="my-3">
                    <label for="#">Transfer Amount</label>
                    <div class="d-flex align-items-center gap-2 members__withdrawl__value mt-2">
                        <input type="text" id="amount" name="amount"
                            placeholder="Por favor, insira um valor inteiro!">
                    </div>
                    @if (!empty($session_transfer_balance))
                        <div class="form-text text-danger col-sm-12">
                            {{ $session_transfer_balance }}
                        </div>
                    @endif
                </div>
                <div class="my-3">
                    <button class="members__withdrawl__submit" name="members__withdrawl__submit">Convert</button>
                </div>

            </div>
        </div>

    </form>
    <script>
        // to be continued logic script
        $('#amount').on('keyup', function(e) {
            //var difference =  $('#agency-balance-text').text() - $('#member-balance-text').val()
            let currentValue = $(this).val();
            var amt = parseFloat($('#amount').val());
            var agency_balance = $('#agency-balance-text').text();
            var member_balance = $('#member-balance-text').text();

            var diff = +agency_balance - amt;
            var sum = +member_balance + amt;
            let previousValue;
            console.log(currentValue);
            $('#agency-balance-text').text(diff);
            $('#member-balance-text').text(sum);

            if (diff < 0) {
                // put gray color
                $('.members__withdrawl__submit').prop('disabled', true);
            }
            if (currentValue.length < previousValue.length) {
                console.log("Character deleted");
            }

            previousValue = currentValue;

        });
    </script>
@endsection --}}
