<?php

namespace App\Http\Controllers;

use View;
use App\Post;
use App\User;
use App\Follow;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $this->initData($id);

        return view('user.home');
    }

    public function following($id)
    {
        $this->initData($id);

        $users = User::find($id)->following;

        return view('user.following', ['follow_users'=> $users]);
    }

    public function followed($id)
    {
        $this->initData($id);

        $users = User::find($id)->followers;

        return view('user.followed', ['follow_users'=> $users]);
    }

    /**
     * @param $id
     * @return array
     */
    public function initData($id)
    {
        $user = User::find($id);

        $posts = $user->post()->orderBy('created_at', 'desc')->get();
        $post_count = $user->post->count();
        $following = Follow::where('follower', $id);
        $following_count = $following->count();
        $followed = Follow::where('followed', $id);
        $followed_count = $followed->count();
        $relation = 'unfollowed';
        if ($id == Auth::id()) {
            $relation = 'own';
        } elseif (Follow::where([
                'follower' => Auth::id(),
                'followed' => $id,
            ])->count() > 0) {
            $relation = 'followed';
        }

        View::share([
            'user' => $user,
            'posts' => $posts,
            'post_count' => $post_count,
            'following_count'=> $following_count,
            'followed_count' => $followed_count,
            'relation' => $relation,
        ]);
    }
}
