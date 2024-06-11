<div class="notifications">

    <div class="notifications__top">
        <h4>{{ __('Notification')}}</h4>
    </div>

    <div class="notifications__header">

        <ul class="notifications__header__tabs tab-list text-white d-flex gap-2">
            <li class="styled-tab-notifications my-tab1" data-tab-target1="notificationUser">
                <p>{{ __('Profile')}}</p>
                 <!-- <span class="badge__notifications">4</span> -->
            </li>
            <li class="styled-tab-notifications my-tab1" data-tab-target1="notificationPlatform">
                <p>{{ __('System')}}</p>
                <div class="count_system_notif"></div>
            </li>
        </ul>

    </div>

    <div class="notifications__body">

        <div class="my-tab-content1 tab__styled__notifications" id="notificationUser">
            <div class="notifications__body__scroller">
                <div class="notifications__cards notif_card_profile">

                    {{-- if user has no notifications --}}
                    <div class="notifications__cards---no-content text-center mt-5">
                        <img class="mt-5" src="https://cdn.29bet.com/assets/img/no-content.svg" alt="https://cdn.29bet.com/assets/img/no-content.svg">
                    </div>
                    <!-- <div class="notifications__cards__item">
                        <div class="notifications__cards__item__header">
                            <p class="notifications__cards__item__header--date"><span class="date__post">20/03/2022</span>, <span class="hours__post">12:23 AM</span></p>
                        </div>
                        <div class="notifications__cards__item__body">
                            <h3 class="notifications__cards__item__body--title">Max Bet & Payout em jogos internos são atualizados!</h3>
                            <img class="notifications__cards__item__body--img" src="https://cdn.29bet.com/assets/img/esport.webp" alt="https://cdn.29bet.com/assets/img/esport.webp">
                            <p class="notifications__cards__item__body--paragraphy">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corporis voluptatibus, possimus dignissimos asperiores dolore amet.</p>
                        </div>
                        <div class="notifications__cards__item__footer">
                            <a href="#" class="notifications__cards__item__footer__link"><p>Ver Agora</p> <span><i class="fas fa-chevron-right"></i></span></a>
                        </div>
                    </div>

                    <div class="notifications__cards__item">
                        <div class="notifications__cards__item__header">
                            <p class="notifications__cards__item__header--date"><span class="date__post">20/03/2022</span>, <span class="hours__post">12:23 AM</span></p>
                        </div>
                        <div class="notifications__cards__item__body">
                            <h3 class="notifications__cards__item__body--title">Max Bet & Payout em jogos internos são atualizados!</h3>
                            <img class="notifications__cards__item__body--img" src="https://cdn.29bet.com/assets/img/esport1.jpg" alt="https://cdn.29bet.com/assets/img/esport1.jpg">
                            <p class="notifications__cards__item__body--paragraphy">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corporis voluptatibus, possimus dignissimos asperiores dolore amet.</p>
                        </div>
                        <div class="notifications__cards__item__footer">
                            <a href="#" class="notifications__cards__item__footer__link"><p>Ver Agora</p> <span><i class="fas fa-chevron-right"></i></span></a>
                        </div>
                    </div>

                    <div class="notifications__cards__item">
                        <div class="notifications__cards__item__header">
                            <p class="notifications__cards__item__header--date"><span class="date__post">20/03/2022</span>, <span class="hours__post">12:23 AM</span></p>
                        </div>
                        <div class="notifications__cards__item__body">https://cdn.29bet.com/assets/img/esport1.jpg
                            <h3 class="notifications__cards__item__body--title">Max Bet & Payout em jogos internos são atualizados!</h3>
                            <img class="notifications__cards__item__body--img" src="https://cdn.29bet.com/assets/img/esport.webp" alt="https://cdn.29bet.com/assets/img/esport.webp">
                            <p class="notifications__cards__item__body--paragraphy">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corporis voluptatibus, possimus dignissimos asperiores dolore amet.</p>
                        </div>
                        <div class="notifications__cards__item__footer">
                            <a href="#" class="notifications__cards__item__footer__link"><p>Ver Agora</p> <span><i class="fas fa-chevron-right"></i></span></a>
                        </div>
                    </div>

                    <div class="notifications__cards__item">
                        <div class="notifications__cards__item__header">
                            <p class="notifications__cards__item__header--date"><span class="date__post">20/03/2022</span>, <span class="hours__post">12:23 AM</span></p>
                        </div>
                        <div class="notifications__cards__item__body">
                            <h3 class="notifications__cards__item__body--title">Max Bet & Payout em jogos internos são atualizados!</h3>
                            <img class="notifications__cards__item__body--img" src="https://cdn.29bet.com/assets/img/esport1.jpg" alt="https://cdn.29bet.com/assets/img/esport1.jpg">
                            <p class="notifications__cards__item__body--paragraphy">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corporis voluptatibus, possimus dignissimos asperiores dolore amet.</p>
                        </div>
                        <div class="notifications__cards__item__footer">
                            <a href="#" class="notifications__cards__item__footer__link"><p>Ver Agora</p> <span><i class="fas fa-chevron-right"></i></span></a>
                        </div>
                    </div> -->

                </div>
            </div>
        </div>

        <div class="my-tab-content1 tab__styled__notifications" id="notificationPlatform">
            <div class="notifications__body__scroller">
                <div class="notifications__cards notif_card_system">

                {{-- if user has no notifications --}}
                    <!-- For testing of Modal Notification -->
                   <!-- <div class="notifications__cards__item notification_list--1000">
                        <div class="notifications__cards__item__header d-flex justify-content-between align-items-center">
                            <p class="notifications__cards__item__header--date"><span class="date__post">2023/07/31</span>, <span class="hours__post">09:17 PM</span></p>
                            <button type="button" class="clear_notification_system notifications__cards__item__header--btn-clear" data-id="1000" ><i class="fas fa-trash"></i></button>
                        </div>
                        <div class="notifications__cards__item__body">
                            <h5 class="notifications__cards__item__body--title">Sample Title Notification</h5>
                            <p class="notifications__cards__item__body--paragraphy">Sample Message Notification</p>
                        </div>
                        <div class="notifications__cards__item__footer">
                            <button class="notifications__cards__item__footer__link see_more" data-date="2023/07/31" data-time="09:17 PM"
                            data-title="Sample Title Notification" data-sub-title="Sample Sub Title Notification"
                            data-message="Sample Message Notification" data-sub-message="Sample Sub Message Notification">
                            <p>See more</p> <span><i class="fas fa-chevron-right"></i></span></button>
                        </div>
                    </div> -->

                </div>
            </div>
        </div>

    </div>

    <button type="button" id="clear_all_notification">
        <div class="notifications__footer">
            <div class="notifications__footer__content">
                <h4>{{ __('Mark all as read')}}</h4>
            </div>
        </div>
    </button>

</div>

<script>

    $(document).ready(function() {

        function FetchNotifications(){
            $.ajax({
                url: '{{route("FetchNotification")}}',
                type: 'GET',
                dataType: 'json',
                success: function (response) {


                    var header_count = 0
                    //Make for fetching of profile in this ajax request too.

                    //Notification System Fetch
                    if (response.system_notification && response.system_notif_count > 0) {

                        header_count += response.system_notif_count;

                        $('.count_system_notif span.badge__notifications').remove();
                        var count_system_notif = `<span class="badge__notifications">${response.system_notif_count}</span>`;
                        $('.count_system_notif').append(count_system_notif);

                        var count_notif_header = `<span class="badge__notifications">${header_count}</span>`;
                        $('#header_notif_badge').append(count_notif_header);

                        $.each(response.system_notification, function (index, notification) {
                            
                            var newNotificationHtml = `
                                <div class="notifications__cards__item notification_list--${notification.id}">
                                    <div class="notifications__cards__item__header d-flex justify-content-between align-items-center">
                                        <p class="notifications__cards__item__header--date">
                                            <span class="date__post">${notification.date}</span>,
                                            <span class="hours__post">${notification.time}</span>
                                        </p>
                                        <button type="button" class="clear_notification_system notifications__cards__item__header--btn-clear" data-id="${notification.id}">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                    <div class="notifications__cards__item__body">
                                        <h5 class="notifications__cards__item__body--title">${notification.title}</h5>
                                        <p class="notifications__cards__item__body--paragraphy">${notification.message}</p>
                                    </div>
                                    <div class="notifications__cards__item__footer">
                                        <button class="notifications__cards__item__footer__link see_more" data-date="${notification.date}" data-time="${notification.time}"
                                            data-title="${notification.title}" data-sub-title="${notification.sub_title}"
                                            data-message="${notification.message}" data-sub-message="${notification.sub_message}">
                                            <p>{{ __('See more')}}</p>
                                            <span><i class="fas fa-chevron-right"></i></span>
                                        </button>
                                    </div>
                                </div>
                            `;

                            $('.notif_card_system').append(newNotificationHtml);

                        });


                    }else{

                        const notif_image_blank =   `<div class="notifications__cards---no-content text-center mt-5">
                        <img class="mt-5" src="https://cdn.29bet.com/assets/img/no-content.svg" alt="https://cdn.29bet.com/assets/img/no-content.svg">
                    </div>`;

                        $('.notif_card_system').append(notif_image_blank);

                    }

                },
                error: function (xhr, status, error) {

                    console.log(error);

                }

            });

        }

        @if(auth()->check())
            var ScriptRun = false;
            if (!ScriptRun) {
                
                FetchNotifications();
                app.cbc();
                ScriptRun = true;
                
            }
        @endif
        
        $(document).on('click', '.clear_notification_system', function(){

            $('.clear_notification_system').prop('disabled', true);
            var activeTab = $('.styled-tab-notifications.active').data('tab-target');
            id = $(this).data('id');

            $.ajax({

                url: '{{route("ClearNotification")}}',
                method: 'POST',
                data: {
                    '_token': $('meta[name=csrf-token]').attr('content'),
                    id: id
                },
                success: function(response){

                    var count_system_notif = $('.count_system_notif span.badge__notifications').text();
                    count_system_notif -= 1;
                    $('.clear_notification_system').closest('.notification_list--'+id).remove();

                    var header_count = $('#header_notif_badge span.badge__notifications').text();
                    header_count -= 1;

                    if (count_system_notif == 0) {
                        
                        $('.count_system_notif span.badge__notifications').remove();
                        const notif_image_blank =   `<div class="notifications__cards---no-content text-center mt-5">
                        <img class="mt-5" src="https://cdn.29bet.com/assets/img/no-content.svg" alt="https://cdn.29bet.com/assets/img/no-content.svg">
                    </div>`;

                        $('.notif_card_system').append(notif_image_blank);

                    }else{

                        $('.count_system_notif span.badge__notifications').text(count_system_notif);

                    }

                    if (header_count == 0) {
                        
                        $('#header_notif_badge span.badge__notifications').remove();

                    }else{

                        $('#header_notif_badge span.badge__notifications').text(header_count);

                    }

                    $('.clear_notification_system').prop('disabled', false);
                    
                },
                error: function(xhr, status, error){

                    //This is only to show that sample notification is removing. Delete after notification design is done. Thanks.
                    $('.clear_notification_system').closest('.notification_list--'+id).remove();
                    console.log(error);

                }

            });

        });

        $('#clear_all_notification').on('click', function(e){

            e.preventDefault;
            var activeTab = $('.styled-tab-notifications.active').data('tab-target1');

            $.ajax({

                url: '{{route("ClearAllNotification")}}',
                method: 'POST',
                data: {
                    '_token': $('meta[name=csrf-token]').attr('content'),
                    activeTab: activeTab
                },
                success: function(response){

                    if (response.active_tab == 'notificationUser') {

                        $('.notif_card_profile').remove();


                    }else if(response.active_tab == 'notificationPlatform'){

                        $('.notif_card_system').empty();
                        $('.count_system_notif').remove();

                        if (response.count > 0) {

                            var count_notif_header = `<span class="badge__notifications">${response.count}</span>`;
                            $('#header_notif_badge').append(count_notif_header);

                            const notif_image_blank =   `<div class="notifications__cards---no-content text-center mt-5">
                        <img class="mt-5" src="https://cdn.29bet.com/assets/img/no-content.svg" alt="https://cdn.29bet.com/assets/img/no-content.svg">
                    </div>`;

                            $('.notif_card_system').append(notif_image_blank);

                        }else{

                            $('#header_notif_badge').remove();
                            const notif_image_blank =   `<div class="notifications__cards---no-content text-center mt-5">
                        <img class="mt-5" src="https://cdn.29bet.com/assets/img/no-content.svg" alt="https://cdn.29bet.com/assets/img/no-content.svg">
                    </div>`;

                            $('.notif_card_system').append(notif_image_blank);

                        }

                    }

                },
                error: function(xhr, status, error){

                    console.log(error);

                }

            });


        });



        // $('#notifications').click(function () {
		// 	document.getElementById("sidemenumobile").classList.toggle("close");
        //     // $('#masksidebar').addClass('overlay-sidebar-active');
        //     $('#masksidebar').toggle('overlay-sidebar-active');
		// 	document.getElementById("masksidebar").classList.toggle("overlay-sidebar-active");

		// 	// document.getElementById("masksidebar").classList.toggle("overlay-sidebar-active");
		// 	// document.getElementById("masksidebar").classList.toggle("overlay-sidebar-active");

        // })
    });

</script>
