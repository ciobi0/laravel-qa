<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;
use App\Models\Question;

class FavoritesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \DB::table('favorites')->delete();
        
        User::all()->each(function ($user) {
            $user->favorites()->saveMany(Question::all()->random(rand(1, 5)));
        });
    }
}
