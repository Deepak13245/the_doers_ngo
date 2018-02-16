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
        Interest::create([ 'name' => 'Healthcare' ]);
        Interest::create([ 'name' => 'childeducation' ]);
        Interest::create([ 'name' => 'womenempowerment' ]);
        Interest::create([ 'name' => 'humanrights' ]);
        Interest::create([ 'name' => 'ruraldevelopment' ]);
    }
}
