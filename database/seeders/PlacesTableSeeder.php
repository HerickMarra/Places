<?php

namespace Database\Seeders;

use App\Models\Place;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlacesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
            $faker = Factory::create('pt_BR');
            $places = [];
            for ($i=0; $i < 500; $i++) {
                $createdAt = $faker->dateTimeBetween('-1 year', 'now');
                array_push($places,[
                    'name' => $faker->streetName,
                    'slug' => $faker->slug,
                    'city' => $faker->city,
                    'state' => $faker->state,
                    'created_at' => $createdAt,
                    'updated_at' => $faker->dateTimeBetween($createdAt, 'now'),
                ]);
            }
            Place::insert($places);
    }
}
