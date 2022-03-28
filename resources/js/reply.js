$(document).ready(function (){
    $('.reply').click(function (e){
        let id = $(this).attr('data-id');
        $('.reply-commentform').css('display', 'none');
        $('#reply-commentform-' + id).css('display', 'block');
    });
});
