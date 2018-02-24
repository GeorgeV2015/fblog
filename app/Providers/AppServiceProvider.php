<?php

namespace App\Providers;

use App\Category;
use App\Comment;
use App\User;
use GuzzleHttp\Client;
use App\Page;
use App\Post;
use App\Tag;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \Schema::defaultStringLength(191);
        // Компоненты для форм
        \Form::component('inputTextField', 'components.form.text', ['name', 'label', 'value' => null]);
        \Form::component('inputPassField', 'components.form.password', ['name', 'label']);
        \Form::component('selectField', 'components.form.select', ['name', 'label', 'data', 'selected' => null, 'attributes' => []]);
        \Form::component('textareaField', 'components.form.textarea', ['name', 'label', 'value', 'attributes' => []]);
        \Form::component('checkboxField', 'components.form.checkbox', ['name', 'label', 'value', 'checked' => false, 'attributes' => []]);
        \Form::component('deleteButton', 'components.form.deletebutton', ['route', 'id']);
        // Привязка данных к меню и сайдбару
        view()->composer('admin.includes.navbar', function($view) {
            $view->with('unpublishedComments', Comment::where('published', false)->count());
        });
        view()->composer('partials.sidebar', function($view) {
            $view->with('popularPosts', Post::getPopularPosts(5));
            $view->with('featuredPosts', Post::getFeaturedPosts());
            $view->with('recentPosts', Post::getRecentPosts(5));
            $view->with('categories', Category::with('posts')->published()->get());
            $view->with('tags', Tag::published()->get());
            $view->with('archives', Post::getArchives());
        });
        view()->composer('partials.navbar', function($view) {
            $view->with('categories', Category::published()->get());
            $view->with('pages', Page::getItemsForMenu());
        });
        // Правило валидации для ReCaptcha
        Validator::extend('recaptcha', function($attribute, $value, $parameters, $validator) {
            $client = new Client();
            $response = $client->post(
                'https://www.google.com/recaptcha/api/siteverify',
                ['form_params' =>
                     [
                         'secret'   => env('RECAPTCHA_SECRET'),
                         'response' => $value
                     ]
                ]
            );
            $body = json_decode((string) $response->getBody());

            return $body->success;
        });
        Validator::extend('banned', function($attribute, $value, $parameters, $validator) {
            $user = User::where('email', $value)->first();

            return $user->isNotBanned();
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
