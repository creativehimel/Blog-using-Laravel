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
            'email' => 'himel.phy160@gmail.com',
            'password' => bcrypt('123456')
        ];
        Admin::create($admin);
    }
}
