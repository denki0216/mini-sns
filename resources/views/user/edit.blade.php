@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <img class="card-img-top" src="" alt="">
                    <div class="card-body">
                        <h4 class="card-title">Edit my profile</h4>
                        <table class="table">
                            <tbody>
                            <tr>
                                <td scope="row">User name</td>
                                <td>{{ $user_profile->name }}</td>
                            </tr>
                            <tr>
                                <td scope="row">Email</td>
                                <td>{{ $user_profile->email }}</td>
                            </tr>
                            <tr>
                                <td scope="row">Avatar</td>
                                <td>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <img class="img-fluid" src="{{ $user_profile->avatar }}" alt="">
                                        </div>
                                        <div class="col-md-10">
                                            <a name="" id="" class="btn btn-primary" href="#" role="button"
                                               data-toggle="modal" data-target="#uploadModal">Upload new avatar</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        @include('partials.success')
                        @include('partials.errors')
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('modal')
    @include('partials.modal')
@stop

@section('script')
    <script>
        $('#uploadModal').on('shown.bs.modal')
    </script>
    <script>
        function showFileName (input) {
            var arrs = $(input).val().split('\\');
            var filename = arrs[arrs.length-1];
            $(".custom-file-label").html(filename);
        }
    </script>
@stop