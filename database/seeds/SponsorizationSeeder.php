<?php

use App\Models\Sponsorization;
use Illuminate\Database\Seeder;

class SponsorizationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sponsorizations=config('db.sponsorizations');
        foreach ($sponsorizations as $sponsorization) {
            $new_spons = new Sponsorization();
            $new_spons->name = $sponsorization['name'];
            $new_spons->price = $sponsorization['price'];
            $new_spons->duration = $sponsorization['duration'];
            $new_spons->save();
        }
    }
}
