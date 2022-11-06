<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
            	'first_name' => "Dahlia",
                'last_name' => "Gunter",
                'email' => "dev@admin.com",
                'mobile_number' => "9182836565",
                'password' => Hash::make('secret')
            ],
	        [
	        	'first_name' => "Ferdinand",
                'last_name' => "Kline",
                'email' => "admin@mailinator.com",
                'mobile_number' => "9165696362",
                'password' => Hash::make('secret')
	        ],
        ];

        foreach ($data as $item) {
            User::updateOrCreate([
            	'first_name' => $item['first_name'],
	            'last_name' => $item['last_name'],
	            'email' => $item['email'],
	            'mobile_number' => $item['mobile_number'],
	            'password'=> $item['password']
            ], $item);
        }
    }
}

