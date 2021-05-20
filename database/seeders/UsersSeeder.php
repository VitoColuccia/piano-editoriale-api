<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Database\Factories\UserFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //User::factory()->count(50)->create();

        $user = new User();
        $user->name = 'Admin';
        $user->email = 'admin@admin.it';
        $user->password = Hash::make('password');
        $user->save();

        $role = Role::where('key', Role::ROLE_ADMIN)->first();
        $user->roles()->attach($role);

        User::factory()->count(50)->create();
    }
}
