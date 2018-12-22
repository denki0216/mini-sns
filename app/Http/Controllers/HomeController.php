<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $user = User::find($id);

        $posts = $user->post()->orderBy('created_at', 'desc')->get();

        $post_count = $user->post->count();
        return view('user.home',  ['user'=>$user, 'posts'=>$posts, 'post_count'=>$post_count]);
    }
}
