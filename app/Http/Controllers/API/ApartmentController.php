<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use Illuminate\Http\Request;

class ApartmentController extends Controller
{
    public function index()
    {
        return Apartment::with(['services'])->orderByDesc('id')->paginate(8);
    }
    public function show($id)
    {
        $apartment = Apartment::where('id', $id)->first();
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
