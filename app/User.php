<?php

namespace App;

use App\Follow;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'avatar',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function post()
    {
        return $this->hasMany('App\Post');
    }

    public function following()
    {
        return $this->belongsToMany(
            self::class,
            'follows',
            'follower',
            'followed'
        )->withTimestamps();
    }

    public function followers()
    {
        return $this->belongsToMany(
            self::class,
            'follows',
            'followed',
            'follower'
        )->withTimestamps();
    }

    public function followThisUser($user)
    {
        return $this->following()->toggle($user);
    }

    public static function isFollowed($user_id)
    {
        $follow_count = Follow::where([
            'follower' => Auth::id(),
            'followed' => $user_id,
        ])->count();
        if ($follow_count == 0){
            return false;
        }else{
            return true;
        }
    }
}
