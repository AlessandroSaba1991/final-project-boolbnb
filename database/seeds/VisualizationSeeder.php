<?php

use App\Models\Visualization;
use Illuminate\Database\Seeder;

class VisualizationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $visualizations=config('db.visualizations');
        foreach ($visualizations as $visualization) {
            $new_vis = new Visualization();
            $new_vis->ip = $visualization['ip'];
            $new_vis->save();
        }
    }
}
