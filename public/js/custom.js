$(document).on('mouseover', '.follow-btn', function () {
    $(this).html('Unfollow');
    $(this).removeClass('btn-primary');
    $(this).addClass('btn-danger');
});
$(document).on('mouseout', '.follow-btn', function () {
    $(this).html('Following');
    $(this).removeClass('btn-danger');
    $(this).addClass('btn-primary');
});