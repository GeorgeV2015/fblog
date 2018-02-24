<?php

namespace App;

use Carbon\Carbon;
use Intervention\Image\ImageManagerStatic as Image;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Post extends Model {

    use Sluggable;

    const NO_IMAGE = 'img/no-image.png';

    protected $fillable = ['title', 'content', 'description', 'publishDate'];

    // Связь с таблицей категорий
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Связь с таблицей юзеров
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Связь с таблицей комментариев
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    // Связь с таблицей тегов
    public function tags()
    {
        return $this->belongsToMany(
            Tag::class,
            'post_tags',
            'post_id',
            'tag_id'
        );
    }

    // создание слагов
    public function sluggable()
    {
        return [
            'slug' => ['source' => 'title']
        ];
    }

    // добавление нового поста
    public static function add($fields)
    {
        $post = new static();
        $post->fill($fields);
        $post->user_id = \Auth::id();
        $post->save();

        return $post;
    }

    // апдейт поста
    public function edit($fields)
    {
        $this->fill($fields);
        $this->save();
    }

    // удаление поста
    public function remove()
    {
        $this->removeImage();
        $this->delete();
    }

    // загрузка картинки поста
    public function uploadImage($image)
    {
        if ($image === null)
        {
            return;
        }
        $this->removeImage();
        //$filename = str_random(12) . $this->id . '.' . $image->extension();
        $filename = $image->store('/uploads/posts');

        $minImage = Image::make($filename)->widen(150, function ($constraint) {
            $constraint->upsize();
        });

        $minImage->save('uploads/posts/' . $minImage->filename . '-min.' . $minImage->extension);

        $this->image = $filename;
        $this->save();
    }

    // получение имени файла картинки поста (возвращает массив с именами файлов нормального и уменьшенного изображения)
    public function getImageAttribute($value)
    {
        if ($value === null)
        {
            return array(
                'normal' => static::NO_IMAGE,
                'min' => static::NO_IMAGE
            );
        }

        return array(
            'normal' => $value,
            'min' => implode('-min.', explode('.', $value))
        );
    }

    // удаление картинки поста
    public function removeImage()
    {
        if ($this->image['normal'] !== static::NO_IMAGE)
        {
            Storage::delete($this->image['normal']);
            Storage::delete($this->image['min']);
        }
    }

    // установка категории поста
    public function setCategory($id)
    {
        $this->category_id = $id;
        $this->save();
    }

    // установка связанных тегов
    public function setTags($ids)
    {
        if ($ids === null)
        {
            return;
        }
        $this->tags()->sync($ids);
    }

    // получить статус поста
    public function setStatus($value)
    {
        $this->published = $value;
        $this->save();
    }

    // установка статуса поста
    public function setPublishedAttribute($value)
    {
        $this->attributes['published'] = (bool) $value;
    }

    // Переключение статуса поста
    public function toggleStatus()
    {
        $this->published = ! $this->published;
        $this->save();
    }

    // установка статуса featured
    public function setFeatured($value)
    {
        $this->is_featured = $value;
        $this->save();
    }

    // Получение статуса featured
    public function setIsFeaturedAttribute($value)
    {
        $this->attributes['is_featured'] = (bool) $value;
    }

    // Переключение is_Featured статуса поста
    public function toggleFeatured()
    {
        $this->is_featured = ! $this->is_featured;
        $this->save();
    }

    // выборка опубликованных постов
    public function scopePublished(Builder $query)
    {
        return $query->where('published', true);
    }

    public function scopeOrdered(Builder $query)
    {
        return $query->orderByDesc('publishDate');
    }

    // выборка featured постов
    public function scopeFeatured(Builder $query)
    {
        return $query->where('is_featured', true);
    }

    // получение даты публикации поста в формате 'месяц день, год'
    public function getPublishDate()
    {
        return Carbon::createFromFormat('Y-m-d', $this->publishDate)->format('F d, Y');
    }

    // получение описания поста
    public function getDescriptionAttribute($value)
    {
        if ($value === null)
        {
            return '<p>' . substr($this->content, 0, 200) . '...</p>';
        } else
        {
            return $value;
        }
    }

    // проверка на наличие предыдущего поста
    public function hasPrevious()
    {
        return self::published()->where('category_id', $this->category->id)->where('id', '<', $this->id)->max('id');
    }

    // получение предыдущего поста
    public function getPrevious()
    {
        $previousPostId = $this->hasPrevious();
        if ($previousPostId) {
            return static::with('category')->where('id', $previousPostId)->first();
        }

        return null;
    }

    // проверка на наличие следующего поста
    public function hasNext()
    {
        return self::published()->where('category_id', $this->category->id)->where('id', '>', $this->id)->min('id');
    }

    // получение следующего поста
    public function getNext()
    {
        $nextPostId = $this->hasNext();
        if ($nextPostId) {
            return static::with('category')->where('id', $nextPostId)->first();
        }

        return null;
    }

    public function scopeWithCategory(Builder $query)
    {
        return $query->where('category_id', '<>', null);
    }

    // получение популярных постов
    public static function getPopularPosts($num)
    {
        return static::with('category')->published()->withCategory()->orderBy('views', 'desc')->take($num)->get();
    }

    // получение featured постов
    public static function getFeaturedPosts()
    {
        return static::with('category')->published()->withCategory()->featured()->get();
    }

    // получение последних постов
    public static function getRecentPosts($num)
    {
        return static::with('category')->published()->withCategory()->orderByDesc('publishDate')->take($num)->get();
    }

    // получение даты публикации поста в формате *** time ago
    public function getHumanDate()
    {
        return Carbon::createFromFormat('Y-m-d', $this->publishDate)->diffForHumans();
    }

    // инкремент количества просмотров
    public function addView()
    {
        $this->views++;
        $this->save();
    }

    // получение данных для архива за 12 мес
    public static function getArchives()
    {
        $archives = Post::selectRaw('year(publishDate) year, monthname(publishDate) month, count(*) published')
            ->published()
            ->withCategory()
            ->groupBy('year', 'month')
            ->orderByRaw('min(publishDate) desc')
            ->limit(12)
            ->get();

        return $archives;
    }

    // фильтр постов по месяцу и году
    public function scopeDataFilter($query, $filters)
    {
        if ($month = $filters['month'])
        {
            $query->whereMonth('publishDate', Carbon::parse($month)->month);
        }
        if ($year = $filters['year'])
        {
            $query->whereYear('publishDate', $year);
        }

        return $query;
    }

    public function scopeSearchFilter($query, $filter)
    {
        if ($filter !== null)
        {
            $query->where('title', 'like', "%{$filter}%")
                ->orWhere('content', 'like', "%{$filter}%")
                ->orWhere('description', 'like', "%{$filter}%");
        }

        return $query;
    }
}
