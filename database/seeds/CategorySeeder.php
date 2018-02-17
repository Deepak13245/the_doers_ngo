<?php

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([ 'name' => 'NGO' ]);
        Category::create([ 'name' => 'Volunteers' ]);
        Category::create([ 'name' => 'Donors' ]);
        Category::create([ 'name' => 'Corporates' ]);
        Category::create([ 'name' => 'Social innovators' ]);
        Category::create([ 'name' => 'Investors' ]);
        Category::create([ 'name' => 'Mentors' ]);
        Category::create([ 'name' => 'Technology Experts' ]);
        Category::create([ 'name' => 'Government Agencies' ]);
    }
}
