@extends('layouts.app')

@section('content')
    <div class="home">
        <div class="row">
            <div class="col-md-12">
                <div class="banner">
                    banner
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 toolbar">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3">
                            <img src="{{ $user->avatar }}" alt="" class="avatar img-thumbnail">
                        </div>
                        <div class="col-md-6">
                            <nav class="nav justify-content-left">
                                <a class="nav-link active" href="#">
                                    Post<br>
                                    <span>20</span>
                                </a>
                                <a class="nav-link" href="#">
                                    Followed<br>
                                    <span>20</span>
                                </a>
                                <a class="nav-link" href="#">
                                    Follower<br>
                                    <span>20</span>
                                </a>
                                <a class="nav-link" href="#">
                                    Like<br>
                                    <span>20</span>
                                </a>
                            </nav>
                        </div>
                        <div class="col-md-3">
                            <button class="btn btn-success">Follow</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-3 profile">
                    <div class="name">{{ $user->name }}</div>
                    <div class="email">{{ $user->email }}</div>
                    <p class="introduce">I am the guitarist Joe Satriani. Order "What Happens Next" & G3 Concert tix
                        today
                        at http://SATRIANI.COM or http://lnk.to/WHN </p>
                    <div class="createTime">Register
                        at: {{ \Carbon\Carbon::parse($user->created_at)->toDateString() }}</div>
                    <button class="btn btn-block btn-primary">Post {!! '@' !!} {{ $user->name }}</button>
                </div>
                <div class="col-md-6 postList">
                    @include('post.index')
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Title</h4>
                            <p class="card-text">Text</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
