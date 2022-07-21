@extends('layouts.admin')
@section('content')
<div class="container">
    <h2 class="text-center">Sponsorization for {{$apartment->title}}</h2>
    <div class="row">
        @foreach($sponsorizations as $sponsorization)
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h4>Piano: {{$sponsorization->name}}</h4>
                    <p>Descrizione: Il tuo annuncio verra' sponsorizzato e messo in evidenza</p>
                    <p><span>Prezzo: </span>{{$sponsorization->price}}</p>
                    <p><span>Duration: </span>{{$sponsorization->duration}} ore</p>
                </div>
                <div class="card-footer">
                    <a class="btn btn-primary" href="{{route('admin.sponsorizations.show',['apartment' => $apartment->id ,'sponsorization' => $sponsorization->id])}}">Compra</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

@endsection
