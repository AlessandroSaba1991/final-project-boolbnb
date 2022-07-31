<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class ApartmentController extends Controller
{
    public function index(Request $request)
    {
        function getDistanceBetweenPointsNew($latitude1, $longitude1, $latitude2, $longitude2, $unit = 'kilometers') {
            $theta = $longitude1 - $longitude2;
            $distance = (sin(deg2rad($latitude1)) * sin(deg2rad($latitude2))) + (cos(deg2rad($latitude1)) * cos(deg2rad($latitude2)) * cos(deg2rad($theta)));
            $distance = acos($distance);
            $distance = rad2deg($distance);
            $distance = $distance * 60 * 1.1515;
            switch($unit) {
              case 'miles':
                break;
              case 'kilometers' :
                $distance = $distance * 1.609344;
            }
            return (round($distance,2));
          };
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
        $idOrderDistance = [];
        foreach($results as $record){
            $distance = getDistanceBetweenPointsNew($lat, $lon, $record->position->lat, $record->position->lon);
            $data= [
                'id'=> $record->id,
                'distance'=> $distance,
            ];
            array_push($idOrderDistance,$data);
        }
        $sortby= array_column($idOrderDistance,'distance');
        array_multisort($sortby,SORT_ASC,$idOrderDistance);
        $idOrder=[];
        foreach ($idOrderDistance as $item) {
            array_push($idOrder,$item['id']);
        };

        $implodedIds = implode(',', $idOrder);
        //return $complete;
        return Apartment::with('services', 'sponsorizations')->whereIn('id', $idOrder)->orderByRaw(DB::raw("FIELD(id, $implodedIds)"))->paginate(6);
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

    public function sponsoredApartments() {
        $apartments = Apartment::with('sponsorizations')->get();
        $sponsoredApartments = [];
        foreach($apartments as $apartment) {
            if(count($apartment->sponsorizations) > 0) {
                foreach($apartment->sponsorizations as $sponsorization) {
                    if(date('Y-m-d H:i:s') < date('Y-m-d H:i:s', strtotime($sponsorization->sponsor->end_sponsorization))) {
                        if(!in_array($sponsorization->sponsor->apartment_id, $sponsoredApartments)) {
                            array_push($sponsoredApartments, $sponsorization->sponsor->apartment_id);
                        }
                    }
                }
            }
        }
        return Apartment::with('services', 'sponsorizations')->whereIn('id', $sponsoredApartments)->paginate(6);
    }

}
