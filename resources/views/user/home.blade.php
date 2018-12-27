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
                    <ul class="list-group post-list" id="post-data">
                        @include('post.index')
                    </ul>
                    @include('partials.loading')
                </div>
                <div class="col-md-3">
                    @include('partials/who_to_follow')
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('js/custom.js') }}"></script>
    <script src="{{ asset('js/ajax.js') }}"></script>
@stop