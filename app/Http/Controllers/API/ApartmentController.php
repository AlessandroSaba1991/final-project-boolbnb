<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ApartmentController extends Controller
{
    public function index(Request $request)
    {
        $beds = $request->query('beds');
        $rooms = $request->query('rooms');
        $servicesSelect = $request->query('services');
        if($servicesSelect==null){
            $servicesSelect=[];
        }
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
        $apartments = Apartment::with('services')->whereHas("services", function ($query) use ($servicesSelect) {
            $query->whereIn("id", $servicesSelect);
        }, "=", count($servicesSelect))->where('beds', '>=', $beds)->where('rooms', '>=', $rooms)->get();

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
        $complete = [];
        foreach ($apartments as $apart) {
            foreach ($results as $item) {
                if ($item->id == $apart->id) {
                    array_push($complete, $apart);
                }
            }
        };

        return $complete;
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
    public function saveMessage(Request $request) {

        $apartment_id = $request->query('apartment_id');
        $fullname = $request->query('fullname');
        $email = $request->query('email');
        $content = $request->query('content');
      
       $newMessage = new Message;

       $newMessage->apartment_id = $apartment_id;
       $newMessage->fullname = $fullname;
       $newMessage->email = $email;
       $newMessage->content = $content;
        $newMessage->save();
        return 'Messaggio inviato correttamente'; 
    }
}
