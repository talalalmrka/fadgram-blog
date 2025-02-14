<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory(1)->create([
            'name' => 'admin',
            'email' => 'talalminfo@gmail.com',
            'password' => bcrypt('1234'),
        ])->each(function (User $user) {
            $user->assignRole('admin');
        });
        User::factory(29)->create()->each(function (User $user) {
            $role = Role::inRandomOrder()->first()->name;
            $user->assignRole($role);
        });
    }
}
