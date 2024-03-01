<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::updateOrcreate(
            [
                'email' => 'maeda.diego@gmail.com',
            ],
            [
                'name' => 'Diego Maeda',
                'password' => bcrypt('123123'),
                'email_verified_at' => '2024-02-10 13:55:02',
            ]
        );

        $user->language()->create([
            'language' => 'en',
        ]);
    }
}
