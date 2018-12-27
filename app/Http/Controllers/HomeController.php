<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;
use App\Post;
use App\User;
use App\Follow;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    private $user;
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $id)
    {
        $this->initData($id);

        $posts = $this->user->post()->orderBy('created_at', 'desc')->Paginate(10);

        if ($request->ajax()) {
            $view = view('post.index', ['posts'=> $posts])->render();
            return response()->json(['html'=>$view]);
        }

        return view('user.home',['posts' => $posts]);
    }

    public function following(Request $request,$id)
    {
        $this->initData($id);

        $users = User::find($id)->following()->orderBy('created_at', 'desc')->Paginate(12);

        if ($request->ajax()) {
            $view = view('partials.home.users', ['follow_users'=> $users])->render();
            return response()->json(['html'=>$view]);
        }

        return view('user.following', ['follow_users'=> $users]);
    }

    public function followed(Request $request,$id)
    {
        $this->initData($id);

        $users = User::find($id)->followers()->orderBy('created_at', 'desc')->Paginate(12);

        if ($request->ajax()) {
            $view = view('partials.home.users', ['follow_users'=> $users])->render();
            return response()->json(['html'=>$view]);
        }

        return view('user.followed', ['follow_users'=> $users]);
    }

    /**
     * @param $id
     * @return array
     */
    public function initData($id)
    {
        $this->user = User::find($id);

        $post_count = $this->user->post->count();
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
            'user' => $this->user,
            'post_count' => $post_count,
            'following_count'=> $following_count,
            'followed_count' => $followed_count,
            'relation' => $relation,
        ]);
    }
}
