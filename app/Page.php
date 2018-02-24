<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $guarded = [];

    use Sluggable;

    public function sluggable()
    {
        return [
            'slug' => ['source' => 'title']
        ];
    }

    public function scopePublished(Builder $query)
    {
        return $query->where('published', true);
    }

    public function scopeIsPage(Builder $query)
    {
        return $query->where('type', 'page');
    }

    public static function getItemsForMenu()
    {
        return static::published()->isPage()->where('parent_id', null)->get();
    }

    public function getParent()
    {
        return static::find($this->parent_id);
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

    public function toggleStatus()
    {
        $this->published = ! $this->published;
        $this->save();
    }

    public function getElements()
    {
        return static::published()->where('parent_id', $this->id)->get();
    }
}
