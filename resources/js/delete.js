$(document).ready(function () {
    $('.delete').click(function (e) {
        var id = $(this).attr('data-id');
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "DELETE",
            url: "/comment/delete/" + id,
            data: {id: id},
            success: function () {
                $("#comment-" + id).remove();
            }
        });
    });

    $('.delete-reply').click(function (e) {
        var id = $(this).attr('data-id');
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "DELETE",
            url: "/reply/delete/" + id,
            data: {id: id},
            success: function () {
                $("#comment-reply-" + id).remove();
            }
        });
    });
});
