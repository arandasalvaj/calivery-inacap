<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role as ModelsRole;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $role1 = ModelsRole::create(['name' => 'Customer']);
        $role2 = ModelsRole::create(['name' => 'Seller']);
        $role3 = ModelsRole::create(['name' => 'Store']);
        $role4 = ModelsRole::create(['name' => 'Delivery']);
        /*
        $rol = new Role();
        $rol ->name="Customer";
        $rol->label="CT";
        $rol->save();

        $rol1 = new Role();
        $rol1 ->name="Seller";
        $rol1->label="SL";
        $rol1->save();

        $rol2 = new Role();
        $rol2 ->name="Store";
        $rol2->label="ST";
        $rol2->save();

        $rol3 = new Role();
        $rol3 ->name="Delivery";
        $rol3->label="DL";
        $rol3->save();
        */
    }
}
