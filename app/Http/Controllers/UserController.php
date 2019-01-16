<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManagerStatic as Image;

class UserController extends Controller
{
    public function editProfile(User $user)
    {
        $user_profile = Auth::user();
        return view('user.edit', ['user_profile' => $user_profile]);
    }

    public function upload(Request $request)
    {
        if ($request->file('avatar')) {
            $file_key = 'avatar';
        } elseif ($request->file('banner')) {
            $file_key = 'banner';
        } else{
            return redirect("/user/" . Auth::id() . "/edit")->with('error', 'No file was selected.');
        }
        $size = $request->file($file_key)->getSize();
        $type = $request->file($file_key)->getMimeType();
        if ($type !== 'image/jpeg' && $type !== 'image/jpg' && $type !== 'image/gif' && $type !== 'image/png') {
            return redirect("/user/" . Auth::id() . "/edit")->with('error', 'Only jpg/jpeg/png/gif file is allowed to update.');
        }
        if ($size > 2097152) {
            return redirect("/user/" . Auth::id() . "/edit")->with('error', 'File size is over than 2MB.');
        }
        $path = $request->file($file_key)->store($file_key . 's', 'public');

        return redirect("/user/" . Auth::id() . "/edit")->with('path', '/storage/' . $path)->with('type', $file_key);
    }

    public function store(Request $request)
    {
        $path = $request->path;
        $full_path = public_path($path);
        $crop_width = $request->cropWidth;
        $crop_height = $request->cropHeight;
        $crop_x = $request->cropX;
        $crop_y = $request->cropY;
        $thumbnail_width = (int)$request->thumbnailWidth;
        $thumbnail_height = (int)$request->thumbnailHeight;

        $img = Image::make($full_path);

        $original_width = $img->width();
        $original_height = $img->height();

        $divisor_x = round($thumbnail_width / $original_width, 2);
        $divisor_y = round($thumbnail_height / $original_height, 2);

        $width = intval($crop_width / $divisor_x);
        $height = intval($crop_height / $divisor_y);
        $x = intval($crop_x / $divisor_x);
        $y = intval($crop_y / $divisor_y);

        if ($request->_method == 'patch') {
            $resizeWidth = 1920;
            $resizeHeight = 507;
            $dbCol = 'banner';
        } else {
            $resizeWidth = 165;
            $resizeHeight = 165;
            $dbCol = 'avatar';
        }

        $img->crop($width, $height, $x, $y)->resize($resizeWidth, $resizeHeight);
        $img->save();

        $user = User::find(Auth::id());
        $user->$dbCol = $path;
        $user->save();
        return redirect("/user/" . Auth::id() . "/edit")->with('success', 'change ' . $dbCol . ' success');
    }

}
