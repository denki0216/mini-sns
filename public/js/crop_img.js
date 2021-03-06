function preview(img, selection){
    if (!selection.width || !selection.height)
        return;
    var perview_width = $('#preview').width();
    var perview_height = $('#preview').height();
    var scaleX = perview_width / selection.width;
    var scaleY = perview_height / selection.height;
    var width = $(img).width();
    var height = $(img).height();

    $('#preview img').css({
        width: Math.round(scaleX * width),
        height: Math.round(scaleY * height),
        marginLeft: -Math.round(scaleX * selection.x1),
        marginTop: -Math.round(scaleY * selection.y1)
    });

    $('#x1').val(selection.x1);
    $('#y1').val(selection.y1);
    $('#x2').val(selection.x2);
    $('#y2').val(selection.y2);
    $('#w').val(selection.width);
    $('#h').val(selection.height);
}

$(document).ready(function () {
    var width = $('#avatar').width() - 1;
    var height = $('#avatar').height() - 1;
    var banner_width = $('#banner').width() - 1;

    if (width <= height){
        var selectWidth = width;
        var selectHeight = width;
    } else{
        var selectWidth = height;
        var selectHeight = height;
    }

    $('#avatar').imgAreaSelect({
        x1: 0,
        y1: 0,
        x2: selectWidth,
        y2: selectHeight,
        aspectRatio: '1:1',
        handles: true,
        onInit: preview,
        onSelectChange: preview,
        onSelectEnd: function (img, selection) {
            var cropWidth =selection.width;
            var cropHeight = selection.height;
            var cropX = selection.x1;
            var cropY = selection.y1;

            var thumbnailWidth = $('#avatar').width();
            var thumbnailHeight = $('#avatar').height();

            $('.crop-width').attr('value', cropWidth);
            $('.crop-height').attr('value', cropHeight);
            $('.crop-x').attr('value', cropX);
            $('.crop-y').attr('value', cropY);
            $('.thumbnail-width').attr('value', thumbnailWidth);
            $('.thumbnail-height').attr('value', thumbnailHeight);
        }
    });

    $('#banner').imgAreaSelect({
        x1: 0,
        y1: 0,
        x2: banner_width,
        y2: banner_width / 15 * 4,
        aspectRatio: '15:4',
        handles: true,
        onInit: preview,
        onSelectChange: preview,
        onSelectEnd: function (img, selection) {
            var cropWidth =selection.width;
            var cropHeight = selection.height;
            var cropX = selection.x1;
            var cropY = selection.y1;

            var thumbnailWidth = $('#banner').width();
            var thumbnailHeight = $('#banner').height();

            $('.crop-width').attr('value', cropWidth);
            $('.crop-height').attr('value', cropHeight);
            $('.crop-x').attr('value', cropX);
            $('.crop-y').attr('value', cropY);
            $('.thumbnail-width').attr('value', thumbnailWidth);
            $('.thumbnail-height').attr('value', thumbnailHeight);
        }
    });
});