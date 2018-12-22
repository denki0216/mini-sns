@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-5">
                                <img class="img-fluid" src="{{ Auth::user()->avatar }}" alt="">
                            </div>
                            <div class="col-md-7">
                                <h5>{{ Auth::user()->name }}</h5>
                                <i>{{ Auth::user()->email }}</i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">

                @include('partials.success')
                @include('partials.errors')

                <div class="card">
                    <card class="card-body">
                        <div class="row">
                            <div class="col-md-2">
                                <img class="img-fluid" src="{{ Auth::user()->avatar }}" alt="">
                            </div>
                            <div class="col-md-10">
                                <form action="" method="post">
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <div class="form-group">
                                        <textarea class="form-control" name="content" cols="30" placeholder="Say something"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-success" type="submit">Post it</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        
                    </card>
                </div>

                @include('post.index')
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        rightside
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('modal')
    @include('partials.post_edit_modal')
    @include('partials.postDeleteModal')
@stop

@section('script')
    <script>
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
    </script>
    @stop