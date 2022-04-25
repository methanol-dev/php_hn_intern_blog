import Pusher from "pusher-js";
import trans from "./trans"

$(document).ready(function () {
    var pusher = new Pusher(process.env.MIX_PUSHER_APP_KEY, {
        encrypted: true,
        cluster: "ap1",
    });
    var channel = pusher.subscribe("my-channel-" + window.user);
    channel.bind("my-event", async function (data) {
        let pending = parseInt($("#notification").find(".pending").html());
        if (Number.isNaN(pending)) {
            $("#notification").append(
                '<span class="pending badge bg-primary badge-number">1</span>'
            );
        } else {
            $("#notification")
                .find(".pending")
                .html(pending + 1);
        }

        var status = '';

        switch (data.message.status) {
            case '2':
                status = 'Approved';
                break;
            case '3':
                status = 'Rejected';
                break;
        }

        let notificationBox = `
        <a href="/post/show/${data.message.id}">
            <li class="notification-box box-noti bg-gray" data-id="${data.message.notification_id}">
                <div class="row">
                    <div class="col-lg-12 col-sm-12 col-12">
                        <div class="box">
                            ${trans('me.post') + ' ' + data.message.title + ' ' + trans('me.has_been') + ' ' + status}
                        </div>
                        <small class="text-warning box">${trans('me.recent')}</small>
                    </div>
                </div>
            </li>
        </a>`;
        $("#show-notification").prepend(notificationBox);
    });

    $(document).on('click', '.notification-box', function (e) {
        let id = $(this).attr('data-id');
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "PUT",
            url: "/notification/read/" + id,
            success: function () {
                let pending = parseInt($("#notification").find(".pending").html());
                $("#notification")
                    .find(".pending")
                    .html(pending - 1);
            }
        });
    });

    $(document).on('click', '#readall', function (e) {
        e.preventDefault();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "PUT",
            url: "/notification/readall",
            success: function () {
                window.location.reload();
            }
        });
    });
});
