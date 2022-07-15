@extends('layouts.admin')
@section('content')
    <h1 class="text-center">Inserisci un nuovo annuncio</h1>
    <form class="container p-5" action="{{route('admin.apartments.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="title">Titolo annuncio</label>
            <input type="text" class="form-control" name="title" id="title" aria-describedby="TitleHelper"
                value="{{ old('title') }}" placeholder="titolo...">

        </div>

        <div class="mb-3">
            <label for="rooms">Numero camere</label>
            <input type="number" class="form-control" name="rooms" id="rooms" min="1"
                aria-describedby="roomsHelper" value="{{ old('rooms') }}" placeholder="inserisci il numero delle camere...">

        </div>

        <div class="mb-3">
            <label for="beds">Posti letto</label>
            <input type="number" class="form-control" name="beds" id="beds" min="1"
                aria-describedby="bedsHelper" value="{{ old('beds') }}"
                placeholder="inserisci il numero dei posti letto...">

        </div>

        <div class="mb-3">
            <label for="bathrooms">Numero bagni</label>
            <input type="number" class="form-control" name="bathrooms" id="bathrooms" min="1"
                aria-describedby="bathroomsHelper" value="{{ old('bathrooms') }}" placeholder="numero di bagni...">

        </div>

        <div class="mb-3">
            <label for="square_meters">Metri quadri</label>
            <input type="text" class="form-control" name="square_meters" id="square_meters"
                aria-describedby="square_metersHelper" value="{{ old('square_meters') }}"
                placeholder="inserisci la dimensione dell'immobile...">

        </div>

        <div class="mb-3">
            <label for="longitude">Indirizzo</label>
            <input type="text" class="form-control" name="longitude" id="longitude" aria-describedby="addressHelper"
                value="{{ old('address') }}" placeholder="inserisci l'indirizzo...">

        </div>

        <div class="mb-3">
            <label for="latitude">Latitudine</label>
            <input type="text" class="form-control" name="latitude" id="latitude" aria-describedby="latitudeHelper"
                value="{{ old('latitude') }}" placeholder="inserisci la latitudine...">
            
        </div>

        <div class="mb-3">
            <label for="longitude">Longitudine</label>
            <input type="text" class="form-control" name="longitude" id="longitude" aria-describedby="addressHelper"
                value="{{ old('longitude') }}" placeholder="inserisci la longitudine...">
            
        </div>

        <div class="mb-3">
            <label for="cover_image">Immagine</label>
            <input type="file" class="form-control" name="cover_image" id="cover_image"
                aria-describedby="cover_imageHelper" placeholder="seleziona un immagine">
            <small id="cove_imageHelper" class="text-muted">Inserisci un immagine della struttura</small>
        </div>

        <select class="form-select mb-3" id="visible" aria-label="Default select">
            <option selected>Visibilità annnuncio</option>
            <option value="1">Si</option>
            <option value="2">No</option>

        </select>

        <div class="mb-3">
            <label for="description">Descrivi l'immobile</label>
            <textarea class="form-control mb-2" name="" id="description" rows="4">{{ old('description') }}</textarea>
            <button type="submit" class="btn btn-primary">Aggiungi</button>
        </div>

    </form>
@endsection
