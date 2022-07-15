@extends('layouts.admin')
@section('content')
<h1>index</h1>
@foreach($apartments as $apartment)
<a href="{{route('admin.apartments.edit', $apartment->id)}}">Edit {{$apartment->name}}</a>
@endforeach
@endsection
