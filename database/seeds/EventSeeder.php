<?php

use App\Models\Category;
use App\Models\Event as GEvent;
use App\Models\Interest;
use App\User;
use Faker\Factory;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
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
            $event = new GEvent();
            $event->user_id = $users->random()->id;
            $event->category_id = $categories->random()->id;
            $event->interest_id = $interests->random()->id;
            $event->description = $faker->paragraph(10);
            $event->title = $faker->sentence;
            $event->lat = $faker->latitude;
            $event->lng = $faker->longitude;
            $event->address = $faker->address;
            $event->start = $faker->dateTime();
            $event->end = $faker->dateTime();
            $event->save();
        }
    }
}
