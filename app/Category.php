<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Category extends Model {

    protected $fillable = ['title', 'description'];

    use Sluggable;

    // Связь с таблицей постов один ко многим
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    // Создание категории
    public static function add($fields)
    {
        $category = new static();
        $category->fill($fields);
        $category->save();

        return $category;
    }

    // Редактирование категории
    public function edit($fields)
    {
        $this->update($fields);
    }

    // Установка статуса категории (published)
    public function setStatus($value)
    {
        $this->published = $value;
        $this->save();
    }

    // Переключение статуса категории
    public function toggleStatus()
    {
        $this->published = ! $this->published;
        $this->save();
    }

    // Перевод полученного с чекбокса значения статуса в bool при установке категории
    public function setPublishedAttribute($value)
    {
        $this->attributes['published'] = (bool) $value;
    }

    // Выборка опубликованных категорий
    public function scopePublished(Builder $query)
    {
        return $query->where('published', true);
    }

    // Создание слага категории
    public function sluggable()
    {
        return [
            'slug' => ['source' => 'title']
        ];
    }

    // Получение описания категории (при null возвращает title). Наверное нигде не используется...
    public function getDescriptionAttribute($value)
    {
        if ($value === null) {
            return $this->title;
        } else {
            return $value;
        }
    }
}
