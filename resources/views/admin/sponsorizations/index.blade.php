@extends('layouts.admin')
@section('content')
<div class="bg_orange py-4 shadow mb-5">
    <div class="container">
        <h2 class="text-center filter_text mb-0">Sponsorizzazione for {{$apartment->title}}</h2>
    </div>
</div>
<div class="container">
    <div class="row row-cols-3 g-3">
        @foreach($sponsorizations as $sponsorization)
        <div class="col">
            <div class="card shadow">
                <div class="card-header bg_orange">
                    <h4 class="mb-0 filter_text py-2 px-1">Piano: {{$sponsorization->name}}</h4>
                </div>
                <div class="card-body">
                    <p><strong>Descrizione: </strong>Il tuo annuncio verra' sponsorizzato e messo in evidenza</p>
                    <p><strong>Prezzo: </strong>{{$sponsorization->price}} €</p>
                    <p class="mb-0"><strong>Durata: </strong>{{$sponsorization->duration}} ore</p>
                </div>
                <div class="card-footer bg_orange text-center">
                    <a class="btn btn-primary" href="{{route('admin.sponsorizations.show',['apartment' => $apartment->id ,'sponsorization' => $sponsorization->id])}}">Acquista</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

@endsection
