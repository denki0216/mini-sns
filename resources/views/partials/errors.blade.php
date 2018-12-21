@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input. <br><br>
        <ul>
            @foreach ($errors as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@if (Session::has('error'))
    <div class="alert alert-danger">
        <button class="close" type="button" data-dismiss="alert">×</button>
        {{ Session::get('error') }}
    </div>
@endif
