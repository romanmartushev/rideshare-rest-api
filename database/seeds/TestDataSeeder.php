<?php

use Illuminate\Database\Seeder;

class TestDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        \App\User::create([
            'name' => 'Roman Martushev',
            'email' => 'martushev8@gmail.com',
            'password' => bcrypt('secret')
        ]);

        // Create 5 clients
        for($i = 0; $i < 5; $i++){
            \App\Client::create([
                'name' => $faker->name,
                'email' => $faker->email,
                'phone_number' => $faker->phoneNumber,
                'rating' => $faker->numberBetween(0,5),
                'password' => bcrypt('secret')
            ]);
        }

        // Create 5 drivers
        for($i = 0; $i < 5; $i++){
            \App\Driver::create([
                'name' => $faker->name,
                'email' => $faker->email,
                'phone_number' => $faker->phoneNumber,
                'rating' => $faker->numberBetween(0,5),
                'password' => bcrypt('secret')
            ]);
        }

        // Create 20 ServiceableRequests
        for($i = 0; $i < 20; $i++){
            \App\ServiceableRequests::create([
                'client_id' => $faker->numberBetween(1,5),
                'destination_address' => $faker->address,
                'pick_up_address' => $faker->address,
                'estimated_length' => $faker->numberBetween(1,5). ' hours',
                'time' => $faker->time('H:i'),
                'date' => $faker->date('m-d-Y')
            ]);
        }

        // Create 20 HistoryRequests
        for($i = 0; $i < 20; $i++){
            \App\History::create([
                'client_id' => $faker->numberBetween(1,5),
                'driver_id' => $faker->numberBetween(1,5),
                'destination_address' => $faker->address,
                'pick_up_address' => $faker->address,
                'estimated_length' => $faker->numberBetween(1,5). ' hours',
                'time' => $faker->time('H:i'),
                'date' => $faker->date('m-d-Y')
            ]);
        }
    }
}
