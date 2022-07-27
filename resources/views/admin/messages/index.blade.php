@extends('layouts.admin')
@section('content')
<section class="bg_orange py-4 shadow">
    <div class="container">
        <h2 class="text-white mb-0">Messaggi per l'annuncio: {{$apartment->title}}</h2>
    </div>
</section>
    <div class="container py-5">
         <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 row-cols-xxl-4 g-3">
            @forelse($messages as $message)
                <div class="col">
                    
                    <div class="card h-100 shadow  border-dark mb-3">
                        <div class="card-header bg_orange border-dark text-white fs-6">
                            From: {{$message->fullname}} <br>
                            Email: {{$message->email}}
                        </div>
                            <div class="card-body">
                                <h5>Message:</h5>
                                <p class="card-text">{{$message->content}}</p>
                            </div>
                        <div class="card-footer bg_orange text-white border-dark">Received: {{(date('d/m/y H:i', strtotime($message->created_at)))}}</div>
                    </div>
        
                </div>
            @empty
               <div class="col mx-auto">
               <div class="shadow rounded bg_orange text-center py-3">
                <h5 class="text-uppercase text-white"> ancora nessun messaggio </h5>
                <a class="btn btn-primary bg-gradient" href="{{route('admin.apartments.index')}}">Dashboard</a>
               </div>
               </div>
            @endforelse  
        </div>
    </div>
@endsection