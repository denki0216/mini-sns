<ul class="list-group">
    @foreach($posts as $post)
        <li class="list-group-item">
            <div class="row">
                <div class="col-md-2">
                    <img class="img-fluid avatar" src="{{ $post->user->avatar }}" alt="">
                </div>
                <div class="col-md-10">
                    <strong class="name">{{$post->user->name}}</strong> ·
                    <i class="email">{{$post->user->email}}</i> ·
                    <span class="time">{{\Carbon\Carbon::parse($post->updated_at)->diffForHumans()}}</span>
                    <p class="content">{{$post->content}}</p>

                </div>
            </div>
        </li>
    @endforeach
</ul>