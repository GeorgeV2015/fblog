<?php

namespace App;

use \Storage;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable {

    use Notifiable;

    const NO_AVATAR = 'img/no-avatar.png';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public static function add($fields)
    {
        $user = new static;
        $user->fill($fields);
        $user->password = bcrypt($fields['password']);
        $user->save();

        return $user;
    }

    public function edit($fields)
    {
        $this->fill($fields);
        if ($fields['password'] !== null)
        {
            $this->password = bcrypt($fields['password']);
        }
        $this->save();
    }

    public function remove()
    {
        $this->removeAvatar();
        $this->delete();
    }

    public function uploadAvatar($avatar)
    {
        if ($avatar === null)
        {
            return;
        }
        $this->removeAvatar();
        //$filename = str_random(12) . $this->id . '.' . $avatar->extension();
        $filename = $avatar->store('/uploads/avatars');
        $this->avatar = $filename;
        $this->save();
    }

    public function getAvatarAttribute($value)
    {
        if ($value === null)
        {
            return static::NO_AVATAR;
        }

        return $value;
    }

    public function removeAvatar()
    {
        if ($this->avatar !== static::NO_AVATAR)
        {
            Storage::delete($this->avatar);
        }
    }

    public function setRole($value)
    {
        $this->is_admin = $value;
        $this->save();
    }

    public function setIsAdminAttribute($value)
    {
        $this->attributes['is_admin'] = (bool) $value;
    }

    public function setStatus($value)
    {
        $this->active = $value;
        $this->save();
    }

    public function setActiveAttribute($value)
    {
        $this->attributes['active'] = (bool) $value;
    }

    public function isBanned()
    {
        return !$this->active;
    }

    // Переключение статуса пользователя
    public function toggle()
    {
        $this->active = ! $this->active;
        $this->save();
    }

    // Переключение роли пользователя
    public function toggleRole()
    {
        $this->is_admin = ! $this->is_admin;
        $this->save();
    }

}
