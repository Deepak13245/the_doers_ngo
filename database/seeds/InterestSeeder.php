<?php

use App\Models\Interest;
use Illuminate\Database\Seeder;

class InterestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Interest::create([ 'name' => 'Health Care' ]);
        Interest::create([ 'name' => 'Child Education' ]);
        Interest::create([ 'name' => 'Women Empowerment' ]);
        Interest::create([ 'name' => 'Human Rights' ]);
        Interest::create([ 'name' => 'Rural Development' ]);
    }
}
