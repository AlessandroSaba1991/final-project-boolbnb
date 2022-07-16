<?php

namespace App\Http\Controllers\Admin;

use App\Models\Apartment;
use App\Http\Controllers\Controller;
use App\Http\Requests\ApartmentRequest;


class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $apartments=Apartment::all()->sortDesc();
        return view('admin.apartments.index',compact('apartments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.apartments.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ApartmentRequest $request)
    {
        dd($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function show(Apartment $apartment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function edit(Apartment $apartment)
    {
        return view('admin.apartments.edit',compact('apartment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function update(ApartmentRequest $request, Apartment $apartment)
    {
        //dd($request->all());
        $validated_data = $request->validated();

        //validazione, aggiunta path nuova immagine, e cancello la vecchia immagine
        if($request->hasFile('cover_image')) {
            $request->validate([
                'cover_image' => 'nullable|image|mimes:jpeg,png,jpg'
            ]);
            Storage::delete($apartment->cover_image);
            $path_img = Storage::put('apartment_images', $request->cover_image);
            $validated_data['cover_image'] = $path_img;
        }

        //aggiorno i campi con i dati validati
        $apartment->update($validated_data);

        //reindirizzo la pagina
        return redirect()->route('admin.apartments.index')->with('message', 'Annuncio modificato correttamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Apartment $apartment)
    {
       //
    }
}
