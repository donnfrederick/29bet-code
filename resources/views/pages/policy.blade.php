@extends('welcome')

@section('content')

<div class="terms">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="terms__wrapper">
                    <div class="navigator-line__wrapper mt-5">
                        <h3 class="navigator-line__text text--terms">{{__('Privacy Policy')}}</h3>
                    </div>

                    <div class="terms__title">1. {{__('What information is collected')}}</div>
                    <div class="terms__paragraph">1.1. {{__('Only information that provides the ability to support user feedback is subject to collection.')}}</div>
                    <div class="terms__paragraph">1.2. {{__('Some user actions are automatically stored in server logs:')}}</div>
                    <div class="terms__paragraph">1.2.1. {{__('IP address, browser type data;')}}</div>
                    <div class="terms__paragraph">1.2.2. {{__('add-ons, request time, etc.')}}</div>
                    <div class="terms__title">2. {{__('How the information is used')}}</div>
                    <div class="terms__paragraph">2.1. {{__('The information provided by the user is used to contact him, including for sending notifications.')}}</div>
                    <div class="terms__title">3. {{__('Personal data management')}}</div>
                    <div class="terms__paragraph">3.1. {{__("Personal data is available for viewing, modification and deletion in the user's personal account.")}}</div>
                    <div class="terms__paragraph">3.2. {{__('In order to prevent accidental deletion or data corruption, information is stored in backup copies for 7 days and can be restored at the request of the user.')}}</div>
                    <div class="terms__title">4. {{__('Providing data to third parties')}}</div>
                    <div class="terms__paragraph">4.1. {{__("Users' personal data may be transferred to persons not associated with this site, if necessary:")}}</div>
                    <div class="terms__paragraph">4.1.1. {{__('to comply with the law, regulatory legal act, execution of a court decision;')}}</div>
                    <div class="terms__paragraph">4.1.2. {{__('to detect or prevent fraud;')}}</div>
                    <div class="terms__paragraph">4.1.3. {{__('to eliminate technical malfunctions in the operation of the site;')}}</div>
                    <div class="terms__paragraph">4.1.4. {{ __('to provide information based on the request of authorized state bodies.')}}</div>
                    <div class="terms__paragraph">4.6. {{__('In the event of a sale of this site, users must be notified of this no later than 10 days before the transaction.')}}</div>
                    <div class="terms__title">5. {{__('Data security')}}</div>
                    <div class="terms__paragraph">5.1. {{__('The site administration takes all measures to protect user data from unauthorized access, in particular:')}}</div>
                    <div class="terms__paragraph">5.1.1. {{__('regular updating of services and systems for managing the site and its content;')}}</div>
                    <div class="terms__paragraph">5.1.2. {{__('encryption of archival copies of the resource;')}}</div>
                    <div class="terms__paragraph">5.1.3. {{__('regular checks for the presence of malicious codes;')}}</div>
                    <div class="terms__paragraph">5.1.4. {{__('using a virtual dedicated server to host the site.')}}</div>
                    <div class="terms__title">6. {{__('Changes')}}</div>
                    <div class="terms__paragraph">6.1. {{__('Privacy policy updates are posted on this page.')}}</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

