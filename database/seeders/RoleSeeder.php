<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['name'=>'admin','status'=>1],
            ['name'=>'customer','status'=>1],
            ['name'=>'hotel','status'=>1],
        ];

        foreach ($data as $item) {
            Role::updateOrCreate(['name' => $item['name']], $item);
        }
    }
}
