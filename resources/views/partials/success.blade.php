@if (Session::has('success'))
    <div class="alert alert-success">
        <button class="close" type="button" data-dismiss="alert">×</button>
        {{ Session::get('success') }}
    </div>
@endif