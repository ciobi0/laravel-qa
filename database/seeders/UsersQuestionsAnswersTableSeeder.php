<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;
use App\Models\Question;
use App\Models\Answer;

class UsersQuestionsAnswersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \DB::table('users')->delete();
        \DB::table('questions')->delete();
        \DB::table('answers')->delete();
        
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
