@extends('layouts.app')

@section('content')
    <div class="home">
        @include('partials.home.header')
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    @include('partials.home.profile')
                </div>
                <div class="col-md-6">
                    @include('partials.success')
                    @include('partials.errors')
                    @include('post.index')
                </div>
                <div class="col-md-3">
                    @include('partials/who_to_follow')
                </div>
            </div>
        </div>
    </div>
@endsection