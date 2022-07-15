<?php

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $services = config('db.services');
        foreach ($services as $service) {
            $new_serv = new Service();
            $new_serv->name = $service;
            $new_serv->save();
        }
    }
}
