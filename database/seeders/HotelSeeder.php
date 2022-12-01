<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Hotel;

class HotelSeeder extends Seeder
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
            	'user_id' => "3",
                'listing_id' => "2",
                'name' => "dev hotel",
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Delectus odio dolores cupiditate eaque excepturi aliquam totam deleniti voluptas accusantium. Neque sapiente fugiat vitae! Iure nihil aut eveniet perspiciatis laudantium rerum!',
                'total_room' => '5',
                'guest' => '5',
                'bedrooms' => "3",
                'bathrooms' => "2",
                'beds' => "3",
                'price' => "250",
                'address' => " Delectus odio dolores cupiditate eaque excepturi aliquam totam deleniti voluptas"
            ],
	        [
            	'user_id' => "3",
                'listing_id' => "2",
                'name' => "aliquam",
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Delectus odio dolores cupiditate eaque excepturi aliquam totam deleniti voluptas accusantium. Neque sapiente fugiat vitae! Iure nihil aut eveniet perspiciatis laudantium rerum!',
                'total_room' => '2',
                'guest' => '2',
                'bedrooms' => "1",
                'bathrooms' => "1",
                'beds' => "1",
                'price' => "150",
                'address' => " Delectus odio dolores cupiditate eaque excepturi aliquam totam deleniti voluptas"
            ],
            [
            	'user_id' => "4",
                'listing_id' => "5",
                'name' => "laudantium rerum",
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Delectus odio dolores cupiditate eaque excepturi aliquam totam deleniti voluptas accusantium. Neque sapiente fugiat vitae! Iure nihil aut eveniet perspiciatis laudantium rerum!',
                'total_room' => '8',
                'guest' => '3',
                'bedrooms' => "6",
                'bathrooms' => "3",
                'beds' => "2",
                'price' => "300",
                'address' => " Delectus odio dolores cupiditate eaque excepturi aliquam totam deleniti voluptas"
            ],
	        [
            	'user_id' => "4",
                'listing_id' => "2",
                'name' => "Neque sapiente",
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Delectus odio dolores cupiditate eaque excepturi aliquam totam deleniti voluptas accusantium. Neque sapiente fugiat vitae! Iure nihil aut eveniet perspiciatis laudantium rerum!',
                'total_room' => '6',
                'guest' => '2',
                'bedrooms' => "2",
                'bathrooms' => "1",
                'beds' => "3",
                'price' => "200",
                'address' => " Delectus odio dolores cupiditate eaque excepturi aliquam totam deleniti voluptas"
            ],
        ];

        foreach ($data as $item) {
            Hotel::updateOrCreate($item);
        }
    }
}
