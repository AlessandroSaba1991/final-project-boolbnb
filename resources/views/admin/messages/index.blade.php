@extends('layouts.admin')

@section('content')

    
    <div class="container">
        <h2>Ecco i tuoi messaggi per l'annuncio: {{$apartmentName}}</h2>
        <table class="table table-striped table-inverse table-responsive">
        <thead class="thead-inverse">
            <th>ID</th>
            <th>FullName</th>
            <th>Email</th>
            <th>Message</th>
            <th>When</th>
        </thead>
        <tbody>
            @forelse($messages as $message)
            <tr>
                <td scope="row">{{$message->id}}</td>
                <td>{{$message->fullname}}</td>
                <td>{{$message->email}}</td>
                <td>{{$message->content}}</td>
                <td>{{$message->created_at}}</td>
            </tr>
            @empty
                <h2 class="terxt-center terxt-uppercase"> nessun messaggio </h2>
            @endforelse  
        </tbody>
        </table>
    </div>



    


@endsection