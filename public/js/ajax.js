var page = 1;
var isbool = true;
$(window).scroll(function () {
    if ($(window).scrollTop() + $(window).height() + 1 >= $(document).height() && isbool == true) {
        page++;
        isbool = false;
        loadMoreData(page);

    }
});

function loadMoreData(page) {
    $.ajax({
        url: window.location.pathname,
        type: "GET",
        data: {'page': page},
        beforeSend: function () {
            $('.ajax-load').show();
        }
    })
        .done(function (data) {
            if (data.html == "") {
                $('.ajax-load').html('No more...');
                return;
            }

            $('.ajax-load').hide();
            $('#post-data').append(data.html);
            isbool = true;
        })
    // .fail(function (jqXHR, ajaxOptions, thrownError) {
    //     alert('error');
    // });
}
