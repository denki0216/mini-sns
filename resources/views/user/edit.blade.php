@extends('layouts.app')

@section('content')
    <div class="container user-edit">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <img class="card-img-top" src="" alt="">
                    <div class="card-body">
                        <h4 class="card-title">Edit my profile</h4>
                        <table class="table">
                            <tbody>
                            <tr>
                                <td scope="row" style="width: 100px;">User name</td>
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
                                            <img class="img-thumbnail avatar" src="{{ $user_profile->avatar }}" alt="">
                                        </div>
                                        <div class="col-md-3">
                                            <a class="btn btn-primary btn-block mt-2" href="#" role="button"
                                               data-toggle="modal" data-target="#uploadModal">Upload new avatar</a><br>
                                            @if(Session::has('path') && Session::get('type') == 'avatar')
                                                <form action="" method="post">
                                                    <input type="hidden" name="_method" value="put">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <input type="hidden" name="path" value="{{ Session::get('path') }}">
                                                    <input type="hidden" name="cropWidth" class="crop-width" value="">
                                                    <input type="hidden" name="cropHeight" class="crop-height" value="">
                                                    <input type="hidden" name="cropX" class="crop-x" value="">
                                                    <input type="hidden" name="cropY" class="crop-y" value="">
                                                    <input type="hidden" name="thumbnailWidth" class="thumbnail-width"
                                                           value="">
                                                    <input type="hidden" name="thumbnailHeight" class="thumbnail-height"
                                                           value="">
                                                    <button type="submit" class="btn btn-success btn-block mt-1"
                                                            id="crop-avatar" href="#">
                                                        {!! '<< Change this avatar' !!}
                                                    </button>
                                                </form>

                                            @endif
                                        </div>
                                        <div class="col-md-2">
                                            @if(Session::has('path') && Session::get('type') == 'avatar')
                                                <div id="preview"
                                                     style="width: 165px; height: 165px; overflow: hidden; border-radius: 50%;">
                                                    <img id="preview-img" src="{{ Session::get('path') }}">
                                                </div>
                                            @endif
                                        </div>
                                        <div class="col-md-5">
                                            @if(Session::has('path') && Session::get('type') == 'avatar')
                                                <img id="avatar" src="{{ Session::get('path') }}" alt=""
                                                     class="img-fluid">
                                                <div class="alert alert-warning alert-dismissible fade show mt-1"
                                                     role="alert">
                                                    Please crop this image.
                                                    <button type="button" class="close" data-dismiss="alert"
                                                            aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td scope="row">Banner</td>
                                <td>
                                    <div class="row">
                                        <div class="col-md-6">
                                            @if(Session::has('path') && Session::get('type') == 'banner')
                                                <div id="preview"
                                                     style="width: 517px; height: 86px; overflow: hidden">
                                                    <img id="preview-img" src="{{ Session::get('path') }}">
                                                </div>
                                                <form action="" method="post">
                                                    <input type="hidden" name="_method" value="patch">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <input type="hidden" name="path" value="{{ Session::get('path') }}">
                                                    <input type="hidden" name="cropWidth" class="crop-width" value="">
                                                    <input type="hidden" name="cropHeight" class="crop-height" value="">
                                                    <input type="hidden" name="cropX" class="crop-x" value="">
                                                    <input type="hidden" name="cropY" class="crop-y" value="">
                                                    <input type="hidden" name="thumbnailWidth" class="thumbnail-width"
                                                           value="">
                                                    <input type="hidden" name="thumbnailHeight" class="thumbnail-height"
                                                           value="">
                                                    <button type="submit" class="btn btn-success btn-block mt-3">Upload this banner</button>
                                                </form>
                                            @elseif($user_profile->banner != null)
                                                <form id="bannerForm" action="" method="post"
                                                      enctype="multipart/form-data">
                                                    <div class="banner-preview">
                                                        <span>Upload new banner</span>
                                                        <img class="img-fluid" src="{{ $user_profile->banner }}" alt="">
                                                        <label for="bannerFile" class="mask"></label>
                                                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                                                        <input type="file" id="bannerFile" name="banner"
                                                               onchange="autoSubmit()">
                                                    </div>
                                                </form>
                                            @else
                                                <form id="bannerForm" action="" method="post"
                                                      enctype="multipart/form-data">
                                                    <div class="banner-add">
                                                        <label for="bannerFile" class="mask">
                                                            <span>Upload new banner</span>
                                                        </label>
                                                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                                                        <input type="file" id="bannerFile" name="banner"
                                                               onchange="autoSubmit()">
                                                    </div>
                                                </form>
                                            @endif
                                        </div>
                                        <div class="col-md-6">
                                            @if(Session::has('path') && Session::get('type') == 'banner')
                                                <img id="banner" src="{{ Session::get('path') }}" alt=""
                                                     class="img-fluid">
                                                <div class="alert alert-warning alert-dismissible fade show mt-1"
                                                     role="alert">
                                                    Please crop this image.
                                                    <button type="button" class="close" data-dismiss="alert"
                                                            aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                            @endif
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
    @include('partials.upload_modal')
@stop

@section('script')
    <script>
        function showFileName(input) {
            var arrs = $(input).val().split('\\');
            var filename = arrs[arrs.length - 1];
            $(".custom-file-label").html(filename);
        }

        function autoSubmit() {
            $('#bannerForm').submit();
        }
    </script>
    <script src="{{ asset('js/crop_img.js') }}"></script>
@stop