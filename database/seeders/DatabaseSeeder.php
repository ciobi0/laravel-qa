<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Question;
use App\Models\Answer;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(3)->create()->each(function ($user) {
            $user
                ->questions()
                ->saveMany(Question::factory(rand(1, 5))->make())
                ->each(function ($question) {
                    $question->answers()->saveMany(Answer::factory(rand(1, 5))->make());
                });
        });
    }
}
