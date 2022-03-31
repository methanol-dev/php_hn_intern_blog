$(document).ready(function () {
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
