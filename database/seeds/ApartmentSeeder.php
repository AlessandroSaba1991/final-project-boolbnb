<?php

use App\Models\Apartment;
use Illuminate\Database\Seeder;

class ApartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $apartments=config('db.apartments');

        foreach ($apartments as $apartment) {
            $new_apart = new Apartment();
            $new_apart->title = $apartment['title'];
            $new_apart->rooms = $apartment['rooms'];
            $new_apart->beds = $apartment['beds'];
            $new_apart->bathrooms = $apartment['bathrooms'];
            $new_apart->square_meters = $apartment['square_meters'];
            $new_apart->address = $apartment['address'];
            $new_apart->latitude = $apartment['latitude'];
            $new_apart->longitude = $apartment['longitude'];
            $new_apart->cover_image = $apartment['cover_image'];
            $new_apart->description = $apartment['description'];
            $new_apart->visible = $apartment['visible'];
            $new_apart->save();
        }
    }
}
