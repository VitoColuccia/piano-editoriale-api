<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = new Role();
        $role->name = "Editorial Design Manager";
        $role->description = "Editorial Design Manager";
        $role->key = Role::ROLE_EDITORIAL_DESIGN_MANAGER;
        $role->save();

        $role = new Role();
        $role->name = "Editorial Responsible";
        $role->description = "Editorial Responsible";
        $role->key = Role::ROLE_EDITORIAL_RESPONSIBLE;
        $role->save();

        $role = new Role();
        $role->name = "Editorial Director";
        $role->description = "Editorial Director";
        $role->key = Role::ROLE_EDITORIAL_DIRECTOR;
        $role->save();

        $role = new Role();
        $role->name = "Sales Director";
        $role->description = "Sales Director";
        $role->key = Role::ROLE_SALES_DIRECTOR;
        $role->save();

        $role = new Role();
        $role->name = "CEO";
        $role->description = "CEO";
        $role->key = Role::ROLE_CEO;
        $role->save();

        $role = new Role();
        $role->name = "ADMIN";
        $role->description = "ADMIN";
        $role->key = Role::ROLE_ADMIN;
        $role->save();
    }
}
