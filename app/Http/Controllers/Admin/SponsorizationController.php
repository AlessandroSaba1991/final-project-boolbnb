<?php

namespace App\Http\Controllers\Admin;

use App\Models\Sponsorization;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Apartment;
use Braintree;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class SponsorizationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Apartment $apartment)
    {
        $sponsorizations = Sponsorization::all();
        return view('admin.sponsorizations.index', compact('sponsorizations', 'apartment'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sponsorization  $sponsorization
     * @return \Illuminate\Http\Response
     */
    public function show(Apartment $apartment, Sponsorization $sponsorization)
    {
        return view('admin.sponsorizations.show', compact('sponsorization', 'apartment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sponsorization  $sponsorization
     * @return \Illuminate\Http\Response
     */
    public function edit(Sponsorization $sponsorization)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sponsorization  $sponsorization
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sponsorization $sponsorization)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sponsorization  $sponsorization
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sponsorization $sponsorization)
    {
        //
    }
    public function checkout(Request $request, Apartment $apartment, Sponsorization $sponsorization)
    {

        //dd($data);
        $status = Braintree\Customer::create([
            'paymentMethodNonce' => $request->nonce,
            'firstName' => $apartment->user->name,
            'lastName' => $apartment->user->surname,
            'email' => $apartment->user->email,
            'creditCard' => [
                'options' => [
                    'verifyCard' => true
                ]
            ]
        ]);
        if ($status->success) {
            if (empty($apartment->sponsorizations->all())) {
                $today = date_create(date("Y-m-d H:i:s",));
                $start = date_create(date("Y-m-d H:i:s"));
                $stop = date_add($today, date_interval_create_from_date_string("$sponsorization->duration Hours"));
                $apartment->sponsorizations()->attach($sponsorization->id, ['start_sponsorization' => $start, 'end_sponsorization' => $stop]);
            } else {
                $data = date("Y-m-d H:i:s");
                foreach ($apartment->sponsorizations as $item) {
                    if ($item->sponsor->end_sponsorization > $data) {
                        $data = $item->sponsor->end_sponsorization;
                    }
                    //array_push($data,$sponsorization->sponsor->end_sponsorization);
                }
                //rsort($data);
                $today = date_create($data);
                $start = date_create($data);
                $stop = date_add($today, date_interval_create_from_date_string("$sponsorization->duration Hours"));
                $apartment->sponsorizations()->attach($sponsorization->id, ['start_sponsorization' => $start, 'end_sponsorization' => $stop]);
            }
        } else {
            return redirect()->back()->with('error', $status->message);
        }
        return redirect()->route('admin.apartments.show', compact('apartment'))->with('message', 'Il pagamento e andato a buon fine. Il tuo annuncio verra sponsorizzato per ' . $sponsorization->duration . ' ore');
    }
}
