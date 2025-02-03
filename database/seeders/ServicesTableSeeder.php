<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            [
                'name' => 'Plumbing Service',
                'type' => 'Plumbing',
                'image' => 'services/plumbing.jpg', 
                'user_id' => 2, 
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Electrical Service',
                'type' => 'Electrical',
                'image' => 'services/electrical.jpg', 
                'user_id' => 3, 
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Carpentry Service',
                'type' => 'Carpentry',
                'image' => 'services/carpentry.jpg', 
                'user_id' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Painting Service',
                'type' => 'Painting',
                'image' => 'services/painting.jpg', 
                'user_id' => 5, 
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Landscaping Service',
                'type' => 'Landscaping',
                'image' => 'services/landscaping.jpg', 
                'user_id' => 6,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        
        DB::table('services')->insert($services);
    }
}