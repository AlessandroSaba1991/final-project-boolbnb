@extends('layouts.admin')
@section('content')
<section class="bg_orange py-4 shadow">
    <div class="container">
        <h2 class="text-uppercase text-center mb-0">Stai modificando: {{ $apartment->title }}</h2>
    </div>
</section>
<div class="container py-5">
    @include('partials.error')
    <form action="{{ route('admin.apartments.update', $apartment->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-12">
                <div class="mb-3">
                    <label for="title" class="form-label">Titolo*</label>
                    <input type="title" class="form-control @error('title') is-invalid @enderror" name="title" id="title" placeholder="p. es. Villa Heraclea" aria-describedby="titlehelp" value="{{ old('title', $apartment->title) }}" required minlength="5">
                    <div id="titlehelp" class="form-text">Inserire il titolo dell' annuncio</div>
                </div>
                <!-- ./input title  -->
            </div>
            <div class="col-12 col-md-6">
                <div class="mb-3">
                    <label for="rooms" class="form-label">Numero camere*</label>
                    <input type="number" min="1" class="form-control @error('rooms') is-invalid @enderror" placeholder="p. es. 3" name="rooms" id="rooms" aria-describedby="roomshelp" value="{{ old('rooms', $apartment->rooms) }}" required pattern="1" max="100" oninput="this.value = Math.abs(this.value)">
                    <div id="roomshelp" class="form-text">Inserire il numero di camere</div>
                </div>
                <!-- ./input rooms  -->
            </div>
            <div class="col-12 col-md-6">
                <div class="mb-3">
                    <label for="beds" class="form-label">Posti letto*</label>
                    <input type="number" min="1" class="form-control @error('beds') is-invalid @enderror" name="beds" placeholder="p. es. 2" id="beds" aria-describedby="bedshelp" value="{{ old('beds', $apartment->beds) }}" required pattern="1" max="100" oninput="this.value = Math.abs(this.value)">
                    <div id="bedshelp" class="form-text">Inserire il numero di posti letto</div>
                </div>
                <!-- ./input beds  -->
            </div>
            <div class="col-12 col-md-6">
                <div class="mb-3">
                    <label for="bathrooms" class="form-label">Numero Bagni*</label>
                    <input type="number" min="1" class="form-control @error('bathrooms') is-invalid @enderror" placeholder="p. es. 1" name="bathrooms" id="bathrooms" aria-describedby="bathroomshelp" value="{{ old('bathrooms', $apartment->bathrooms) }}" required pattern="1" max="100" oninput="this.value = Math.abs(this.value)">
                    <div id="bathroomshelp" class="form-text">Inserire il numero di bagni</div>
                </div>
                <!-- ./input bathrooms  -->
            </div>
            <div class="col-12 col-md-6">
                <div class="mb-3">
                    <label for="square_meters" class="form-label">Metri Quadri*</label>
                    <input type="number" min="1" max="30000" class="form-control @error('square_meters') is-invalid @enderror" name="square_meters" placeholder="p. es. 120" id="square_meters" aria-describedby="square_metershelp" value="{{ old('square_meters', $apartment->square_meters) }}" oninput="this.value = Math.abs(this.value)" required>
                    <div id="square_metershelp" class="form-text">Inserire il numero di metri quadri</div>
                </div>
                <!-- ./input square_meters  -->
            </div>
            <div class="col-12">
                <div class="mb-3 position-relative">
                    <label for="address" class="form-label">Indirizzo*</label>
                    <input type="address" onkeyup="callAddress()" class="form-control @error('address') is-invalid @enderror" placeholder="p. es. corso Vittorio Emanuele, 335, 93012 Gela CL " name="address" id="address" aria-describedby="addresshelp" value="{{ old('address', $apartment->address) }}" required>
                    <div id="addresshelp" class="form-text">Inserire l'indirizzo</div>
                    <div hidden class="result w-100"></div>
                </div>
                <!-- ./input address  -->
                <input hidden type="number" min="-90" max="90" step="0.000001" class="form-control @error('latitude') is-invalid @enderror" name="latitude" id="latitude" aria-describedby="latitudehelp" value="{{ old('latitude', $apartment->latitude) }}">
                <!-- ./input latitude  -->
                <input hidden type="number" min="-180" max="180" step=".000001" class="form-control @error('longitude') is-invalid @enderror" name="longitude" id="longitude" aria-describedby="longitudehelp" value="{{ old('longitude', $apartment->longitude) }}">
                <!-- ./input longitude  -->
            </div>
            <div class="col-12">
                <div class="mb-4">
                    <p>Servizi*</p>
                    <div class="row">
                        @foreach ($services as $service)
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                            <input type="checkbox" id="service-{{$service->id}}" name="services[]" onclick="selectChecked()" value="{{ $service->id }}" {{ $apartment->services->contains($service->id) ? 'checked' : '' }}>
                            {{ $service->name }}</input>
                        </div>
                        @endforeach
                    </div>
                </div>
                <!--edit services selection -->
            </div>
            <div class="col-12 col-md-3 col-lg-2 align-self-center">
                <div class="old_img me-3 mb-3">
                    <img class="img-fluid ratio-16x9" src="{{ asset('storage/' . $apartment->cover_image) }}" alt="">
                </div>
            </div>
            <!-- ./input cover-image  -->
            <div class="col-12 col-md-7 col-lg-8 align-self-center">
                <div class="mb-3">
                    <label for="cover_image" class="form-label">Immagine</label>
                    <input type="file" class="form-control" name="cover_image" id="cover_image" aria-describedby="cover_imagehelp">
                    <div id="cover_imagehelp" class="form-text">Inserire Immagine dell'annuncio</div>
                </div>
            </div>
            <div class="col-12 col-md-2 align-self-center">
                <div class="mb-3">
                    <label for="visible" class="form-label">Visibile</label>
                    <select class="form-select" name="visible" id="visible">
                        <option value="1">Si</option>
                        <option value="0">No</option>
                    </select>
                    <div id="visible_imagehelp" class="form-text">Scegliere si o no</div>
                </div>
                <!-- ./input visible  -->
            </div>
            <div class="col-12">
                <div class="mb-3">
                    <label for="description" class="form-label">Descrizione</label>
                    <textarea rows="5" type="text" class="form-control @error('description') is-invalid @enderror" name="description" id="description" aria-describedby="descriptionhelp">{{ $apartment->description, old('description') }}</textarea>
                    <div id="descriptionhelp" class="form-text">Inserire la descrizione dell'immobile</div>
                </div>
                <!-- ./input description  -->
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Modifica Annuncio</button>
            </div>
        </div>
    </form>
</div>
@endsection

@push('check')
<script>
    const array = []
    window.addEventListener('load', () => {
        document.querySelectorAll('input[type=checkbox]').forEach(item => {
            if (item.hasAttribute('checked')) {
                array.push(item.value)
            }
        })
        console.log(array);
    })


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
