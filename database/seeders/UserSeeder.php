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
                'gender' => 'male',
                'role' => '1',
                'password' => Hash::make('secret')
            ],
	        [
	        	'first_name' => "Ferdinand",
                'last_name' => "Kline",
                'email' => "Kline@mailinator.com",
                'mobile_number' => "9165596362",
                'gender' => 'male',
                'role' => '2',
                'password' => Hash::make('secret')
	        ],
            [
            	'first_name' => "shyam",
                'last_name' => "Gunter",
                'email' => "shyam@mailinator.com",
                'mobile_number' => "917856895655",
                'gender' => 'male',
                'role' => '3',
                'password' => Hash::make('secret')
            ],
	        [
	        	'first_name' => "sarthak",
                'last_name' => "Kline",
                'email' => "sarthak@mailinator.com",
                'mobile_number' => "9185235685",
                'gender' => 'male',
                'role' => '3',
                'password' => Hash::make('secret')
	        ],
        ];

        foreach ($data as $item) {
            User::updateOrCreate($item);
        }
    }
}

