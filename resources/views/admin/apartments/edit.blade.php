@extends('layouts.admin')
@section('content')

<div class="container py-5">
  <h3>Stai modificando: {{$apartment->title}}</h3>

<form action="{{route('admin.apartments.update', $apartment->id)}}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PUT')

  <div class="mb-3">
    <label for="title" class="form-label">Titolo</label>
    <input type="title" class="form-control @error('title') is-invalid @enderror" name="title" id="title" aria-describedby="titlehelp" value="{{old('title', $apartment->title)}}">
    <div id="titlehelp" class="form-text">Inserire il titolo dell' annuncio</div>
  </div>
  <!-- ./input title  -->

  <div class="mb-3">
    <label for="rooms" class="form-label">Posti Letto</label>
    <input type="number" min="0" class="form-control @error('rooms') is-invalid @enderror" name="rooms" id="rooms" aria-describedby="roomshelp" value="{{old('rooms', $apartment->rooms)}}">
    <div id="roomshelp" class="form-text">Inserire il numero di posti letto</div>
  </div>
  <!-- ./input rooms  -->

  <div class="mb-3">
    <label for="beds" class="form-label">Stanze</label>
    <input type="number" min="0" class="form-control @error('beds') is-invalid @enderror" name="beds" id="beds" aria-describedby="bedshelp" value="{{old('beds', $apartment->beds)}}">
    <div id="bedshelp" class="form-text">Inserire il numero di stanze</div>
  </div>
  <!-- ./input beds  -->

  <div class="mb-3">
    <label for="bathrooms" class="form-label">Bagni</label>
    <input type="number" min="0" class="form-control @error('bathrooms') is-invalid @enderror" name="bathrooms" id="bathrooms" aria-describedby="bathroomshelp" value="{{old('bathrooms', $apartment->bathrooms)}}">
    <div id="bathroomshelp" class="form-text">Inserire il numero di bagni</div>
  </div>
  <!-- ./input bathrooms  -->

  <div class="mb-3">
    <label for="square_meters" class="form-label">Metri Quadri</label>
    <input type="number" min="0" class="form-control @error('square_meters') is-invalid @enderror" name="square_meters" id="square_meters" aria-describedby="square_metershelp" value="{{old('square_meters', $apartment->square_meters)}}">
    <div id="square_metershelp" class="form-text">Inserire il numero di metri quadri</div>
  </div>
  <!-- ./input square_meters  -->

  <div class="mb-3">
    <label for="address" class="form-label">Indirizzo</label>
    <input type="address" class="form-control @error('address') is-invalid @enderror" name="address" id="address" aria-describedby="addresshelp" value="{{old('address', $apartment->address)}}">
    <div id="addresshelp" class="form-text">Inserire l'indirizzo</div>
  </div>
  <!-- ./input address  -->

  <div class="mb-3">
    <label for="latitude" class="form-label">Latitudine</label>
    <input type="number" min="-90" max="90" step=".00000001" class="form-control @error('latitude') is-invalid @enderror" name="latitude" id="latitude" aria-describedby="latitudehelp" value="{{old('latitude', $apartment->latitude)}}">
    <div id="latitudehelp" class="form-text">Inserire la latitudine</div>
  </div>
  <!-- ./input latitude  -->

  <div class="mb-3">
    <label for="longitude" class="form-label">Longitudine</label>
    <input type="number" min="-180" max="180" step=".00000001" class="form-control @error('longitude') is-invalid @enderror" name="longitude" id="longitude" aria-describedby="longitudehelp" value="{{old('longitude', $apartment->longitude)}}">
    <div id="longitudehelp" class="form-text">Inserire la longitudine</div>
  </div>
  <!-- ./input longitude  -->

  <div class="mb-3">
    <label for="description" class="form-label">Descrizione</label>
    <textarea rows="5" type="text" class="form-control" name="description" id="description" aria-describedby="descriptionhelp">{{$apartment->description , old('description') }}</textarea>
    <div id="descriptionhelp" class="form-text">Inserire la descrizione dell'immobile</div>
  </div>
  <!-- ./input description  -->

  <div class="mb-3">
    <label for="visible" class="form-label">Visibile</label>
    <select class="form-select" name="visible" id="visible" style="width: 90px">
      <option value="true">Si</option>
      <option value="false">No</option>
    </select>
  </div>
  <!-- ./input visible  -->


 
    <div class="d-flex align-items-center mb-3">
        <div class="old_img me-3">
            <img width="120" src="{{asset('storage/' . $apartment->cover_image)}}" alt="">
        </div>
        <div>
            <label for="cover_image" class="form-label">Immagine</label>
            <input type="file" class="form-control" name="cover_image" id="cover_image" aria-describedby="cover_imagehelp">
            <div id="cover_imagehelp" class="form-text">Inserire Immagine dell'annuncio</div>
        </div>
    </div>
    <!-- ./input cover-image  -->


  <button type="submit" class="btn btn-primary">Modifica</button>
</form>
</div>




@endsection
