$('#postEditModal').on('show.bs.modal', function (e) {
    content = $(e.relatedTarget).attr('data-content');
    id = $(e.relatedTarget).attr('data-id');
    $('#modalContent').html(content);
    $('#modalForm').attr('action', '/post/' + id + '/edit');
});
$('#postDeleteModal').on('show.bs.modal', function (e) {
    content = $(e.relatedTarget).attr('data-content');
    id = $(e.relatedTarget).attr('data-id');
    $('#modalContent2').html(content);
    $('#modalForm2').attr('action', '/post/' + id);
});