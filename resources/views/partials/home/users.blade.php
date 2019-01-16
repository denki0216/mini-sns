@foreach($follow_users as $user)
    <div class="col-md-4 user-list">
        <div class="card mb-3">
            <div class="card-header banner-xs">
                <img class="img-fluid" src="{{ $user->banner }}" alt="">
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <a href="{{ url('/user/'.$user->id.'/home') }}">
                            <img class="img-thumbnail avatar" src="{{ $user->avatar }}" alt="">
                        </a>
                    </div>
                    <div class="col-md-8 text-right info-bar">
                        @if ($user->id == Auth::id())


                        @elseif($isFollowed=\App\User::isFollowed($user->id))
                            <form action="/follow/{{ $user->id }}/cancel" method="post">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <button class="btn btn-primary btn-sm follow-btn">Following</button>
                            </form>
                        @else
                            <form action="/follow/{{ $user->id }}" method="post">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <button type="submit" class="btn btn-outline-success btn-sm">Follow</button>
                            </form>
                        @endif
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12">
                        <div class="info">
                            <a class="name" href="{{ url('/user/'.$user->id.'/home') }}">{{ $user->name }}</a>
                            <br>
                            <i class="email">{{ $user->email }}</i>
                        </div>
                        <div class="introduce">introduce</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach
