<?php

use App\Models\Category;
use App\Models\Interest;
use App\Models\Post;
use App\User;
use Faker\Factory;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();
        $faker = Factory::create();
        $categories = Category::all();
        $interests = Interest::all();
        for ($i = 0; $i < 50; $i++) {
            $post = new Post();
            $post->user_id = $users->random()->id;
            $post->category_id = $categories->random()->id;
            $post->interest_id = $interests->random()->id;
            $post->description = $faker->paragraph(10);
            $post->title = $faker->sentence;
            $post->save();
        }
    }
}
