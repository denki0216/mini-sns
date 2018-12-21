<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function editProfile(User $user)
    {
        $user_profile = Auth::user();
        return view('user.edit', ['user_profile' => $user_profile]);
    }

    public function upload(Request $request)
    {
        if (!$request->file('avatar')){
            return redirect("/user/" . Auth::id() . "/edit")->with('error', 'No file was selected.');
        }
        $size = $request->file('avatar')->getSize();
        $type = $request->file('avatar')->getMimeType();
        if ($type !== 'image/jpeg' && $type !== 'image/jpg' && $type !== 'image/gif' && $type !== 'image/png') {
            return redirect("/user/" . Auth::id() . "/edit")->with('error', 'Only jpg/jpeg/png/gif file is allowed to update.');
        }
        if ($size > 2097152) {
            return redirect("/user/" . Auth::id() . "/edit")->with('error', 'File size is over than 2MB.');
        }
        $path = $request->file('avatar')->store('avatars', 'public');
        $user = User::find(Auth::id());
        $user->avatar = '/storage/' . $path;
        $user->save();
        return redirect("/user/" . Auth::id() . "/edit")->with('success', 'change avatar success');
    }

}
