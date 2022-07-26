<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Visualization;
use Illuminate\Http\Request;

class VisualizationController extends Controller
{
     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $userIP = $request->query('ip');
        $apartmentID = $request->query('apartment_id');
        $today = date("Y-m-d");
        $today_visualizations = Visualization::where('ip', $userIP)->where('apartment_id', $apartmentID)->whereRaw('DATE(created_at) = ?', [$today])->get();
        if(count($today_visualizations) <= 0){
            Visualization::create($request->all());
        }
    }
}
