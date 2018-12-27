@extends('layouts.app')

@section('js')
    <script src="{{ asset('js/custom.js') }}" defer></script>
@stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3 sidebar-left">
                TODO
            </div>
            <div class="col-md-6 main-center">

                @include('partials.success')
                @include('partials.errors')

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