<?php

use Illuminate\Database\Seeder;
use App\Models\Client;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->createClients();
    }

    private function createClients()
    {
        
        for($i=0; $i < 50; $i++):
            $this->createClient($i);
        endfor;
    }

    private function createClient($index)
    {
        return Client::create([
            'name'      => 'Cliente'.$index,
            'email'     => 'Cliente'.$index.'@gmail.com',
            'phone'     => rand(1, 50),
            'document'  => rand(1, 50)
        ]);
    }

}
