<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostCreateRequest;
use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Follow;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Post $post)
    {
        $following_count = Follow::where('follower', Auth::id())->count();
        $followed_count = Follow::where('followed', Auth::id())->count();
        $posts = $post->whereIn('user_id', $request->user()->following()
                                    ->pluck('users.id')
                                    ->push($request->user()->id))
                                    ->orderBy('created_at', 'desc')
                                    ->Paginate(10);

        if ($request->ajax()) {
            $view = view('post.index', compact('posts'))->render();
            return response()->json(['html'=>$view]);
        }


        $post_count = Auth::user()->post->count();
        return view('welcome', [
            'posts'=> $posts,
            // 'users'=>$users,
            'post_count'=>$post_count,
            'following_count'=>$following_count,
            'followed_count'=>$followed_count,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostCreateRequest $request)
    {
        $post = new Post;
        $post->content = $request->get('content');
        $post->user_id = Auth::id();
        $post->save();

        return redirect('/')->with('success', 'post success!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = Post::find($id);
        $post->content = $request->get('content');
        $post->save();
        return redirect('/')->with('success', 'Edit success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();
        return redirect('/')->with('success', 'Delete success');
    }

    public function showAll(Request $request)
    {
        $posts = Post::orderBy('created_at', 'desc')->Paginate(10);

        if ($request->ajax()) {
            $view = view('post.index', compact('posts'))->render();
            return response()->json(['html'=>$view]);
        }

        return view('post.all', [
            'posts'=> $posts,
        ]);
    }
}
