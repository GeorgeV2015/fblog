<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model {

    use Sluggable;

    protected $fillable = ['title'];

    public function posts()
    {
        return $this->belongsToMany(
            Post::class,
            'post_tags',
            'tag_id',
            'post_id'
        );
    }

    public function setStatus($value)
    {
        $this->published = $value;
        $this->save();
    }

    public function setPublishedAttribute($value)
    {
        $this->attributes['published'] = (bool) $value;
    }

    public function scopePublished(Builder $query)
    {
        return $query->where('published', true);
    }

    public function scopeOrdered(Builder $query)
    {
        return $query->orderByDesc('publishDate');
    }

    public function sluggable()
    {
        return [
            'slug' => ['source' => 'title']
        ];
    }

    public function toggleStatus()
    {
        $this->published = ! $this->published;
        $this->save();
    }
}
