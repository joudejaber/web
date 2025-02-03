<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(['role' => 'homeOwner']);
        Role::create(['role' => 'serviceProvider']);
        Role::create(['role' => 'government']);
        Role::create(['role' => 'admin']);
    }
}
