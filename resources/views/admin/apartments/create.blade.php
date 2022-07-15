@extends('layouts.admin')
@section('content')
    <h1 class="text-center">Inserisci un nuovo annuncio</h1>
    <form class="container p-5" action="{{route('admin.apartments.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="title">Titolo</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title" aria-describedby="TitleHelper"
                value="{{ old('title') }}" placeholder="titolo...">
                <small id="titleHelper" class="text-muted">Inserisci un titolo</small>
        </div>

        <div class="mb-3">
            <label for="rooms">Numero camere</label>
            <input type="number" min="1" class="form-control @error('rooms') is-invalid @enderror"  name="rooms" id="rooms" min="1"
                aria-describedby="roomsHelper" value="{{ old('rooms') }}" placeholder="inserisci il numero delle camere...">
                <small id="roomsHelper" class="text-muted">Inserisci il numero di camere</small>
        </div>

        <div class="mb-3">
            <label for="beds">Posti letto</label>
            <input type="number" class="form-control" name="beds" id="beds" min="1"
                aria-describedby="bedsHelper" value="{{ old('beds') }}"
                placeholder="inserisci il numero dei posti letto...">
                <small id="bedsHelper" class="text-muted">Inserisci il numero di posti letto</small>
        </div>

        <div class="mb-3">
            <label for="bathrooms">Numero bagni</label>
            <input type="number" class="form-control @error('bathrooms') is-invalid @enderror" name="bathrooms" id="bathrooms" min="1"
                aria-describedby="bathroomsHelper" value="{{ old('bathrooms') }}" placeholder="numero di bagni...">
                <small id="bathroomsHelper" class="text-muted">Inserisci il numero di bagni</small>
        </div>

        <div class="mb-3">
            <label for="square_meters">Metri quadri</label>
            <input type="number" class="form-control" name="square_meters" id="square_meters"
                aria-describedby="square_metersHelper" value="{{ old('square_meters') }}"
                placeholder="inserisci la dimensione dell'immobile...">
                <small id="square_metersHelper" class="text-muted">Inserisci i metri quadri</small>
        </div>

        <div class="mb-3">
            <label for="address">Indirizzo</label>
            <input type="text" class="form-control" name="address" id="address" aria-describedby="addressHelper"
                value="{{ old('address') }}" placeholder="inserisci l'indirizzo...">
                <small id="addressHelper" class="text-muted">Inserisci l'indirizzo</small>
        </div>

        <div class="mb-3">
            <label for="latitude">Latitudine</label>
            <input type="text" class="form-control" name="latitude" id="latitude" aria-describedby="latitudeHelper"
                value="{{ old('latitude') }}" placeholder="inserisci la latitudine...">
                <small id="latitudeHelper" class="text-muted">Inserisci la latitudine</small>
        </div>

        <div class="mb-3">
            <label for="longitude">Longitudine</label>
            <input type="text" class="form-control" name="longitude" id="longitude" aria-describedby="addressHelper"
                value="{{ old('longitude') }}" placeholder="inserisci la longitudine...">
                <small id="longitudeHelper" class="text-muted">Inserisci la longitudine</small>
        </div>

        <div class="mb-3">
            <label for="cover_image">Immagine</label>
            <input type="file" class="form-control" name="cover_image" id="cover_image"
                aria-describedby="cover_imageHelper" placeholder="seleziona un immagine">
            <small id="cover_imageHelper" class="text-muted">Inserisci un immagine della struttura</small>
        </div>

        <select class="form-select mb-3" id="visible" name="visible" aria-label="Default select" style="width: 90px">
            <option selected>Visibilità annuncio</option>
            <option value="true">Si</option>
            <option value="false">No</option>

        </select>

        <div class="mb-3">
            <label for="description">Descrivi l'immobile</label>
            <textarea class="form-control" name="description" id="description" rows="4">{{ old('description') }}</textarea>
            <small id="descriptionHelper" class="text-muted">Inserisci una descrizione</small>
        </div>
        <button type="submit" class="btn btn-primary">Aggiungi</button>

    </form>
@endsection
