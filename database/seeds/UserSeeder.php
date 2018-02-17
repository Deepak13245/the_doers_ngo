<?php

use App\Models\Category;
use App\Models\Interest;
use App\User;
use Faker\Factory;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        $categories = Category::all();
        $interests = Interest::all();
        for ($i = 0; $i < 50; $i++) {
            $user = new User();
            $user->name = $faker->name;
            $user->email = $faker->unique()->email;
            $user->password = bcrypt($faker->password);
            $user->city = $faker->city;
            $user->address = $faker->address;
            $user->category_id = $categories->random()->id;
            $user->interest_id = $interests->random()->id;
            $user->phone = $faker->phoneNumber;
            $user->lat = $faker->latitude;
            $user->lng = $faker->longitude;
            $user->save();
        }
        $user = new User();
        $user->name = 'Deepak';
        $user->email = 'deepak.kumar13245@gmail.com';
        $user->password = bcrypt('deepak');
        $user->city = 'Bangalore';
        $user->address = 'Domlur';
        $user->category_id = $categories->random()->id;
        $user->interest_id = $interests->random()->id;
        $user->phone = '9740769613';
        $user->lat = $faker->latitude;
        $user->lng = $faker->longitude;
        $user->save();
        $user->assignRole('Admin');
    }
}
