@extends('layouts.admin')
@section('content')
    <div class="container py-5">
        <h3>Stai modificando: {{ $apartment->title }}</h3>
        @include('partials.error')
        <form action="{{ route('admin.apartments.update', $apartment->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="title" class="form-label">Titolo</label>
                <input type="title" class="form-control @error('title') is-invalid @enderror" name="title" id="title"
                    aria-describedby="titlehelp" value="{{ old('title', $apartment->title) }}" required>
                <div id="titlehelp" class="form-text">Inserire il titolo dell' annuncio</div>
            </div>
            <!-- ./input title  -->
            <div class="mb-3">
                <label for="rooms" class="form-label">Numero camere</label>
                <input type="number" min="1" class="form-control @error('rooms') is-invalid @enderror"
                    name="rooms" id="rooms" aria-describedby="roomshelp" value="{{ old('rooms', $apartment->rooms) }}"
                    required pattern="1" oninput="this.value = Math.abs(this.value)">
                <div id="roomshelp" class="form-text">Inserire il numero di camere</div>
            </div>
            <!-- ./input rooms  -->
            <div class="mb-3">
                <label for="beds" class="form-label">Posti letto</label>
                <input type="number" min="1" class="form-control @error('beds') is-invalid @enderror" name="beds"
                    id="beds" aria-describedby="bedshelp" value="{{ old('beds', $apartment->beds) }}" required
                    pattern="1" oninput="this.value = Math.abs(this.value)">
                <div id="bedshelp" class="form-text">Inserire il numero di posti letto</div>
            </div>
            <!-- ./input beds  -->
            <div class="mb-3">
                <label for="bathrooms" class="form-label">Numero Bagni</label>
                <input type="number" min="1" class="form-control @error('bathrooms') is-invalid @enderror"
                    name="bathrooms" id="bathrooms" aria-describedby="bathroomshelp"
                    value="{{ old('bathrooms', $apartment->bathrooms) }}" required pattern="1"
                    oninput="this.value = Math.abs(this.value)">
                <div id="bathroomshelp" class="form-text">Inserire il numero di bagni</div>
            </div>
            <!-- ./input bathrooms  -->
            <div class="mb-3">
                <label for="square_meters" class="form-label">Metri Quadri</label>
                <input type="number" min="1" class="form-control @error('square_meters') is-invalid @enderror"
                    name="square_meters" id="square_meters" aria-describedby="square_metershelp"
                    value="{{ old('square_meters', $apartment->square_meters) }}"
                    oninput="this.value = Math.abs(this.value)">
                <div id="square_metershelp" class="form-text">Inserire il numero di metri quadri</div>
            </div>
            <!-- ./input square_meters  -->
            <div class="mb-3">
                <label for="address" class="form-label">Indirizzo</label>
                <input type="address" class="form-control @error('address') is-invalid @enderror" name="address"
                    id="address" aria-describedby="addresshelp" value="{{ old('address', $apartment->address) }}"
                     oninput="this.value = Math.abs(this.value)">
                <div id="addresshelp" class="form-text">Inserire l'indirizzo</div>
                <div hidden class="result"></div>
            </div>
            <!-- ./input address  -->

                <input hidden type="number" min="-90" max="90" step="0.000001"
                    class="form-control @error('latitude') is-invalid @enderror" name="latitude" id="latitude"
                    aria-describedby="latitudehelp" value="{{ old('latitude', $apartment->latitude) }}" 
                    oninput="this.value = Math.abs(this.value)">

            <!-- ./input latitude  -->

                <input hidden type="number" min="-180" max="180" step=".000001"
                    class="form-control @error('longitude') is-invalid @enderror" name="longitude" id="longitude"
                    aria-describedby="longitudehelp" value="{{ old('longitude', $apartment->longitude) }}">

            <!-- ./input longitude  -->
            <div class="d-flex align-items-center mb-3">
                <div class="old_img me-3">
                    <img width="120" src="{{ asset('storage/' . $apartment->cover_image) }}" alt="">
                </div>
                <div>
                    <label for="cover_image" class="form-label">Immagine</label>
                    <input type="file" class="form-control" name="cover_image" id="cover_image"
                        aria-describedby="cover_imagehelp">
                    <div id="cover_imagehelp" class="form-text">Inserire Immagine dell'annuncio</div>
                </div>
            </div>
            <!-- ./input cover-image  -->
            <div class="mb-3">
                <label for="visible" class="form-label">Visibile</label>
                <select class="form-select" name="visible" id="visible" style="width: 90px">
                    <option value="1">Si</option>
                    <option value="0">No</option>
                </select>
            </div>
            <!-- ./input visible  -->

            <!--edit services selection -->

            <div class="mb-3">
                <label for="services" class="form-label">Servizi</label>
                <select multiple class="form-select" name="services[]" id="services" aria-label="Service">
                    <option value="" disabled>Seleziona un servizio</option>
                    @foreach ($services as $service)
                        <option value="{{ $service->id }}"
                            {{ is_array(old('services')) && in_array($service->id, old('services')) ? 'selected' : '' }}>
                            {{ $service->name }}</option>
                    @endforeach
                </select>
            </div>



            <div class="mb-3">
                <label for="description" class="form-label">Descrizione</label>
                <textarea rows="5" type="text" class="form-control @error('description') is-invalid @enderror"
                    name="description" id="description" aria-describedby="descriptionhelp">{{ $apartment->description, old('description') }}</textarea>
                <div id="descriptionhelp" class="form-text">Inserire la descrizione dell'immobile</div>
            </div>
            <!-- ./input description  -->
            <button type="submit" class="btn btn-primary">Modifica Annuncio</button>
        </form>
    </div>
@endsection
