@extends('layouts.admin')
@section('content')
<div class="container">
    <div class="card apartment my-5">
        @if($apartment->visible)
        <div class="badge_ green">
            <span>Visibile</span>
        </div>
        @else
        <div class="badge_ red">
            <span>Non Visibile</span>
        </div>
        @endif
        <div class="row g-0">
            <div class="col-6">
                <img class="h-100 w-100" src="{{asset('storage/' . $apartment->cover_image)}}" alt="{{$apartment->title}}">
            </div>
            <div class="col-6">
                <div class="card-body">
                    <h3>{{$apartment->title}}</h3>
                    <p>{{$apartment->description}}</p>
                    <div class="row">
                        <div class="col">
                            <p>
                                <span>Camere: </span>{{$apartment->rooms}}
                            </p>
                            <p>
                                <span>Letti: </span>{{$apartment->beds}}
                            </p>
                            <p>
                                <span>Bagni: </span>{{$apartment->bathrooms}}
                            </p>
                            <p>
                                <span>Metratura: </span>{{$apartment->square_meters}} m²
                            </p>
                        </div>
                        <div class="col">
                            <p>
                                <span>Indirizzo: </span>{{$apartment->address}}
                            </p>
                            <p>
                                <span>Latitudine: </span>{{$apartment->latitude}}
                            </p>
                            <p>
                                <span>Longitudine: </span>{{$apartment->longitude}}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <p>
                        <span>Servizi: </span>
                        @if (count($apartment->services) > 0)
                        @foreach($apartment->services as $service)
                        {{$service->name}}@if(!$loop->last),@else.@endif
                        @endforeach
                        @else
                        Nessun Servizio
                        @endif
                    </p>
                </div>

            </div>
        </div>

    </div>
</div>

@endsection
