<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ApartmentController extends Controller
{
    public function index(Request $request)
    {
        $beds=$request->query('beds');
        $rooms=$request->query('rooms');
        $services=$request->query('services');
        $lat = $request->query('lat');
        $lon = $request->query('lon');
        $radius = $request->query('radius');
        $geometry = [
            [
                "type" => "CIRCLE",
                "position" => " $lat, $lon",
                "radius" => $radius
            ],
        ];
        $geometry_json = json_encode($geometry);
        $poi_list = [];
        $apartments = Apartment::all();
        foreach ($apartments as $apartment) {
            $single_poi = [
                'id' => $apartment->id,
                "position" => [
                    "lat" => $apartment->latitude,
                    "lon" => $apartment->longitude
                ]
            ];
            array_push($poi_list, $single_poi);
        }
        $poi_list_json = json_encode($poi_list);
        $response = Http::get("https://api.tomtom.com/search/2/geometryFilter.json?key=MtC8XS7dGHVqDy6SPK1zWiLfRmG28cBF&geometryList=$geometry_json&poiList=$poi_list_json");
        $results = $response->object()->results;
        $complete=[];
        foreach ($apartments as $apart) {
            foreach ($results as $item) {
                if ($item->id == $apart->id) {
                    array_push($complete,$apart);
                }
            }
        };

        return $complete;

        //return Apartment::with(['services'])->orderByDesc('id')->paginate(8);
    }
    public function show($id)
    {
        $apartment = Apartment::with(['services'])->where('id', $id)->first();
        if ($apartment) {
            return $apartment;
        } else {
            return response()->json(
                [
                    'status_code' => 404,
                    'status_message' => 'Page Not Found'
                ]
            );
        }
    }
}
