$(document).ready(function (){
    $('.reply').click(function (e){
        let id = $(this).attr('data-id');
        $('.reply-commentform').css('display', 'none');
        $('#reply-commentform-' + id).css('display', 'block');
    });

    $('.delete').click(function (e) {
        let id = $(this).attr('data-id');
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
                $("#children-" + id).remove();
            }
        });
    });

    $('.edit').click(function (e) {
        let id = $(this).attr('data-id');
        $("#parent-comment-" + id ).remove();
        $('.eidt-parent-comment').css('display', 'none');
        $("#edit-parent-comment-" + id).css('display', 'block');
    });

    $('.edit-reply').click(function (e) {
        let id_chil = $(this).attr('data-id');

        $("#children-comment-" + id_chil ).remove();
        $('.eidt-children-comment').css('display', 'none');
        $("#eidt-children-comment-" + id_chil).css('display', 'block');
    });
});

