$('.follow-btn').hover(
    function () {
        $(this).html('Unfollow');
        $(this).removeClass('btn-primary');
        $(this).addClass('btn-danger');
    },
    function () {
        $('.follow-btn').html('Following');
        $(this).removeClass('btn-danger');
        $(this).addClass('btn-primary');
    }
);

