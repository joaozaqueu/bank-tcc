<?php

use Illuminate\Database\Seeder;
use App\Models\Client;

class ClientTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Client::create([
        	'name' 		=> str_random(10),
            'email' 	=> str_random(10).'@gmail.com',
            'phone' 	=> rand(1, 11),
            'document'	=> rand(1, 11)
        ]);
    }
}
