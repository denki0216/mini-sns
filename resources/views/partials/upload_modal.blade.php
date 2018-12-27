<!-- Modal -->
<div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Upload image</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="custom-file">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <input type="file" class="custom-file" id="customFile" name="avatar" onchange= "showFileName(this)" >
                        <label for="customFile" class="custom-file-label">Choose file</label>
                    </div>
                    <div class="photo-view" style="display: none;">
                        <img src="" alt="">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Upload</button>
                </div>
            </form>
        </div>
    </div>
</div>