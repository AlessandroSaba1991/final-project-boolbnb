@extends('layouts.admin')

@section('content')
<h1 class="text-center">Inserisci un nuovo annuncio</h1>
@include('partials.error')
<form class="container p-5" action="{{ route('admin.apartments.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label for="title">Titolo*</label>
        <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title" aria-describedby="TitleHelper" value="{{ old('title') }}" placeholder="p. es. Villa Heraclea" required minlength="5">
        <small id="titleHelper" class="text-muted">Inserisci un titolo</small>
    </div>
    <div class="mb-3">
        <label for="rooms">Numero camere*</label>
        <input type="number" min="1" class="form-control @error('rooms') is-invalid @enderror" name="rooms" id="rooms" min="1" aria-describedby="roomsHelper" value="{{ old('rooms') }}" placeholder="p. es. 3" required pattern="1" max="100" oninput="this.value = Math.abs(this.value)">
        <small id="roomsHelper" class="text-muted">Inserisci il numero di camere</small>
    </div>
    <div class="mb-3">
        <label for="beds">Posti letto*</label>
        <input type="number" class="form-control" name="beds" id="beds" min="1" aria-describedby="bedsHelper" value="{{ old('beds') }}" placeholder="p. es. 2" required pattern="1" max="100" oninput="this.value = Math.abs(this.value)">
        <small id="bedsHelper" class="text-muted">Inserisci il numero di posti letto</small>
    </div>
    <div class="mb-3">
        <label for="bathrooms">Numero bagni*</label>
        <input type="number" class="form-control @error('bathrooms') is-invalid @enderror" name="bathrooms" id="bathrooms" min="1" aria-describedby="bathroomsHelper" value="{{ old('bathrooms') }}" placeholder="p. es. 1" required pattern="1" max="100" oninput="this.value = Math.abs(this.value)">
        <small id="bathroomsHelper" class="text-muted">Inserisci il numero di bagni</small>
    </div>
    <div class="mb-3">
        <label for="square_meters">Metri quadri*</label>
        <input type="number" class="form-control @error('square_meters') is-invalid @enderror" min="1" max="30000" name="square_meters" id="square_meters" aria-describedby="square_metersHelper" value="{{ old('square_meters') }}" placeholder="p. es. 120" oninput="this.value = Math.abs(this.value)" required>
        <small id="square_metersHelper" class="text-muted">Inserisci i metri quadri</small>
    </div>
    <div class="mb-3">
        <label for="address">Indirizzo*</label>
        <input type="text" onkeyup="callAddress()" class="form-control @error('address') is-invalid @enderror" name="address" id="address" aria-describedby="addressHelper" value="{{ old('address') }}" placeholder="p. es. corso Vittorio Emanuele, 335, 93012 Gela CL " required>
        <small id="addressHelper" class="text-muted">Inserisci l'indirizzo</small>
        <div class="result" hidden></div>
    </div>

    <input hidden type="number" min="-90" max="90" step="0.000001" class="form-control @error('latitude') is-invalid @enderror" name="latitude" id="latitude" aria-describedby="latitudeHelper" value="{{ old('latitude') }}" placeholder="inserisci la latitudine...">


    <input hidden type="number" min="-180" max="180" step=".000001" class="form-control @error('longitude') is-invalid @enderror" name="longitude" id="longitude" aria-describedby="longitudeHelper" value="{{ old('longitude') }}" placeholder="inserisci la longitudine...">

    <div class="mb-3">
        <label for="cover_image">Immagine</label>
        <input type="file" class="form-control" name="cover_image" id="cover_image" aria-describedby="cover_imageHelper" placeholder="seleziona un immagine">
        <small id="cover_imageHelper" class="text-muted">Inserisci un immagine della struttura</small>
    </div>
    <div class="mb-3">
        <label for="visible" class="form-label">Visibile*</label>
        <select class="form-select mb-3" id="visible" name="visible" aria-label="Default select" style="width: 90px">
            <option value="1">Si</option>
            <option value="0">No</option>
        </select>
    </div>

    <!--chechbox services-->
    <div class="mb-3">
        <p>Servizi*</p>
        <div class="row">
            @foreach ($services as $service)
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <input type="checkbox" id="service-{{$service->id}}" name="services[]" onclick="selectChecked()" required value="{{ $service->id }}" {{ is_array(old('services')) && in_array($service->id, old('services')) ? 'checked' : '' }}>
                {{ $service->name }}</input>
            </div>
            @endforeach
        </div>
    </div>




    <div class="mb-3">
        <label for="description">Descrivi l'immobile</label>
        <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" rows="5">{{ old('description') }}</textarea>
        <small id="descriptionHelper" class="text-muted">Inserisci una descrizione</small>
    </div>
    <button type="submit" class="btn btn-primary">Aggiungi Annuncio</button>
</form>
@endsection

@push('check')
<script>
    const array = []

    function selectChecked() {
        const input = event.target
        input.setAttribute('checked', 'checked')
        if (array.includes(input.value)) {
            const index = array.indexOf(input.value)
            array.splice(index, 1)
            input.removeAttribute('checked')
        } else {
            array.push(input.value)
        }
        if (array.length > 0) {
            document.querySelectorAll('input[type=checkbox]').forEach(item => {
                item.removeAttribute('required')
            })
        } else {
            document.querySelectorAll('input[type=checkbox]').forEach(item => {
                item.setAttribute('required', 'required')
            })
        }
    }
</script>
@endpush
@push('tom-tom')
<script>
    function callAddress() {
        window.axios.defaults.headers.common = {
            'Accept': 'application/json',
            'Content-Type': 'application/json',
        };
        const address = document.getElementById('address').value
        const resultElement = document.querySelector('.result')
        resultElement.innerHTML = ''
        const link = `https://kr-api.tomtom.com/search/2/geocode/${address}.json?key=MtC8XS7dGHVqDy6SPK1zWiLfRmG28cBF&typeahead=true`
        if (address.length > 2) {
            axios.get(link).then(response => {
                const attempts = response.data.results.slice(0, 3)
                console.log(attempts);
                document.getElementById('latitude').value = attempts[0].position.lat
                document.getElementById('longitude').value = attempts[0].position.lon
                attempts.forEach(item => {
                    const divElement = document.createElement('div')
                    divElement.classList.add('list-result')
                    const markup = `<span>${item.address.freeformAddress}</span>`
                    divElement.insertAdjacentHTML('beforeend', markup)
                    divElement.addEventListener('click', function() {
                        document.getElementById('address').value = item.address.freeformAddress
                        document.getElementById('latitude').value = item.position.lat
                        document.getElementById('longitude').value = item.position.lon
                        resultElement.innerHTML = ''
                        resultElement.setAttribute('hidden', 'true')
                    })
                    resultElement.append(divElement)
                    resultElement.removeAttribute('hidden')
                });
            })
        }
    }
</script>
@endpush
