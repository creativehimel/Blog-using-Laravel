<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $admin = [
            'name' => 'Md. Himel Ali',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('123456789')
        ];
        Admin::create($admin);
    }
}
