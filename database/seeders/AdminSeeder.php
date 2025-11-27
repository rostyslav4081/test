<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class AdminSeeder extends Seeder
{
    public function run()
    {
        User::updateOrCreate(
            ['email' => 'rostuslav9913@gmail.com'],
            [
                'name' => 'Rostyslav',
                'password' => bcrypt('rostuslav1234'),
            ]
        );
    }
}
