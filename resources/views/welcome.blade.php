@extends('layouts.app')

@section('js')
    <script src="{{ asset('js/custom.js') }}" defer></script>
@stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3 sidebar-left">
                <div class="card">
                    <div class="card-header banner-sm"></div>
                    <div class="card-body user-panel">
                        <div class="row">
                            <div class="col-md-4 p-0">
                                <div class="dropdown show">
                                    <a href="#" id="dropdownAvatar" data-toggle="dropdown" aria-haspopup="true"
                                       aria-expanded="false">
                                        <img class="img-thumbnail avatar" src="{{ Auth::user()->avatar }}" alt="">
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="dropdownAvatar">
                                        <a href="{{ url('/user/'.Auth::id().'/edit') }}" class="dropdown-item">Edit
                                            Avatar</a>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-8">
                                <h5><a href="{{ '/user/'. Auth::id() . '/home' }}">{{ Auth::user()->name }}</a></h5>
                                <i>{{ Auth::user()->email }}</i>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <nav class="nav justify-content-left">
                                    <a class="nav-item mr-5 text-center" href="{{ url('/user/'.Auth::id().'/home') }}">
                                        Post<br>
                                        <b class="count">{{ $post_count }}</b>
                                    </a>
                                    <a class="nav-item mr-5 text-center"
                                       href="{{ url('/user/'.Auth::id().'/following') }}">
                                        Following<br>
                                        <b class="count">{{ $following_count }}</b>
                                    </a>
                                    <a class="nav-item text-center" href="{{ url('/user/'.Auth::id().'/followed') }}">
                                        Followers<br>
                                        <b class="count">{{ $followed_count }}</b>
                                    </a>
                                </nav>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 main-center">

                @include('partials.success')
                @include('partials.errors')

                <div class="card mb-2">
                    <card class="card-body">
                        <div class="row">
                            <div class="col-md-1 avatar-col">
                                <img class="img-thumbnail avatar-post" src="{{ Auth::user()->avatar }}" alt="">
                            </div>
                            <div class="col-md-11">
                                <form action="" method="post">
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <div class="form-group">
                                        <textarea class="form-control" name="content" cols="30"
                                                  placeholder="Say something"></textarea>
                                    </div>
                                    <div class="form-group text-right">
                                        <button class="btn btn-success post-btn" type="submit">Post</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </card>
                </div>
                <ul class="list-group post-list" id="post-data">
                @include('post.index')
                </ul>
                @include('partials.loading')
            </div>
            <div class="col-md-3 sidebar-right">
                @include('partials.who_to_follow')
                @include('partials.copy_right')
            </div>
        </div>
    </div>
@stop

@section('modal')
    @include('partials.post_edit_modal')
    @include('partials.postDeleteModal')
@stop

@section('script')
    <script src="{{ asset('js/edit_and_del_modal.js') }}"></script>
    <script src="{{ asset('js/ajax.js') }}"></script>
@stop