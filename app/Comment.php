<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Comment extends Model {

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function allow()
    {
        $this->published = true;
        $this->save();
    }

    public function disallow()
    {
        $this->published = false;
        $this->save();
    }

    public function toggleStatus()
    {
        $this->published = ! $this->published;
        $this->save();
    }

    public function scopePublished(Builder $query)
    {
        return $query->where('published', true);
    }
}
