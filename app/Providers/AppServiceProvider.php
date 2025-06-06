<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Question;
use App\Models\Answer;
use App\Policies\AnswerPolicy;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Gate;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Route::bind('slug', function ($slug) {
            return Question::with(['user', 'answers.user'])->where('slug', $slug)->first() ?? abort(404);
        });

        Gate::define('update-question', function ($user,$question) {
           return $user->id === $question->user_id;
        });

        Gate::define('delete-question', function ($user,$question) {
           return $user->id === $question->user_id;
        });
    }
}
