<ul class="list-group post-list">
    @foreach($posts as $post)
        <li class="list-group-item">
            <div class="row">
                <div class="col-md-2">
                    <a href="{{ '/user/'. $post->user->id . '/home' }}"><img class="img-fluid avatar"
                                                                             src="{{ $post->user->avatar }}" alt=""></a>
                </div>
                <div class="col-md-10">
                    <a href="{{ '/user/'. $post->user->id . '/home' }}"><strong
                                class="name">{{$post->user->name}}</strong></a> ·
                    <i class="email">{{$post->user->email}}</i> ·
                    <span class="time">{{\Carbon\Carbon::parse($post->updated_at)->diffForHumans()}}</span>
                    <p class="content">{{$post->content}}</p>
                    <div class="row">
                        <div class="tools col-md-8">
                            <a href=""><i class="far fa-comment-dots"></i> 999</a>
                            <a href=""><i class="fas fa-redo"></i> 999</a>
                            <a href=""><i class="far fa-heart"></i> 999</a>
                            <a href=""><i class="far fa-envelope"></i></a>
                        </div>
                        @if( Auth::id() === $post->user->id)
                            <div class="col-md-4 text-right tools-auth">
                                <a href="" id="edit" data-id="{{ $post->id }}" data-content="{{ $post->content }}"
                                   data-toggle="modal" data-target="#postEditModal">
                                    <i class="far fa-edit"></i>
                                </a>
                                <a href="" data-id="{{ $post->id }}" data-content="{{ $post->content }}"
                                   data-toggle="modal" data-target="#postDeleteModal">
                                    <i class="far fa-trash-alt"></i>
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </li>
    @endforeach
</ul>