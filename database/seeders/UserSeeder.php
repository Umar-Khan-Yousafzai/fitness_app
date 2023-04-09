<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;

use Faker\Factory as FakerFactory;
class UserSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();
        $faker = FakerFactory::create();

        for ($i = 0; $i < 10; $i++) {
            User::create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => bcrypt('12345678'),
            ]);
        }
        // \App\Models\User::factory()->create([
        //     'name' => 'test user',
        //     'email' => 'test@example.com',
        //     'password' => Hash::make('12345678'),
        // ]);
    }
}
