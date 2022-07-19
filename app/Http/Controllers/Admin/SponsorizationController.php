<?php

namespace App\Http\Controllers\Admin;

use App\Models\Sponsorization;
use Illuminate\Http\Request;
USE App\Http\Controllers\Controller;
use App\Models\Apartment;

class SponsorizationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Apartment $apartment)
    {
        return view('admin.sponsorizations.index');
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
    public function show(Sponsorization $sponsorization)
    {
        //
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
}
