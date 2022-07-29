@extends('layouts.admin')
@section('css')
<link rel="stylesheet" href="{{ asset('css/admin_cards.css') }}">
@endsection
@section('content')
<section class="bg_orange py-4 shadow">
    <div class="container">
        <h2 class="text-uppercase text-center mb-0">i tuoi annunci</h2>
    </div>
</section>
@if (count($apartments) > 0)
    <div class="d-flex justify-content-center my-5">
        <a href="{{ route('admin.apartments.create') }}" class="btn btn-success text-white text-uppercase">crea nuovo <span class="fs-4">+</span></a>
    </div>
@endif
    <div class="container py-5">
        @include('partials.message')
        <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 gx-3 gy-5">
            @forelse ($apartments as $apartment)
                <div class="col">
                    <div class="card position-realtive rounded-3 h-100 shadow bg-body">
                        @if($apartment->cover_image)
                        <img src="{{ asset('storage/' . $apartment->cover_image) }}" class="dashboard_card_img img-fluid card-img-top ratio ratio-16x9"
                            alt="...">
                        @else
                        <img src="{{ asset('storage/apartment_images/image-not-found.png') }}" class="dashboard_card_img img-fluid card-img-top ratio ratio-16x9"
                            alt="...">
                        @endif
                        <div class="badge position-absolute">
                            @if ($apartment->visible)
                                <span class="bg-success rounded bg-gradient me-2 p-3 fs-6">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                    <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                                    <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
                                    </svg>
                                </span>
                            @else
                                <span class="bg-danger rounded bg-gradient p-3 me-2 fs-6">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-eye-slash" viewBox="0 0 16 16">
                                    <path d="M13.359 11.238C15.06 9.72 16 8 16 8s-3-5.5-8-5.5a7.028 7.028 0 0 0-2.79.588l.77.771A5.944 5.944 0 0 1 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.134 13.134 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755-.165.165-.337.328-.517.486l.708.709z"/>
                                    <path d="M11.297 9.176a3.5 3.5 0 0 0-4.474-4.474l.823.823a2.5 2.5 0 0 1 2.829 2.829l.822.822zm-2.943 1.299.822.822a3.5 3.5 0 0 1-4.474-4.474l.823.823a2.5 2.5 0 0 0 2.829 2.829z"/>
                                    <path d="M3.35 5.47c-.18.16-.353.322-.518.487A13.134 13.134 0 0 0 1.172 8l.195.288c.335.48.83 1.12 1.465 1.755C4.121 11.332 5.881 12.5 8 12.5c.716 0 1.39-.133 2.02-.36l.77.772A7.029 7.029 0 0 1 8 13.5C3 13.5 0 8 0 8s.939-1.721 2.641-3.238l.708.709zm10.296 8.884-12-12 .708-.708 12 12-.708.708z"/>
                                    </svg>
                                </span>
                            @endif

                            @php
                            $control_sponsorization = false;
                            @endphp
                            @foreach($apartment->sponsorizations as $sponsorization)
                                @php
                                    $data = date('Y-m-d H:i:s');
                                    if($sponsorization->sponsor->end_sponsorization>$data){
                                    $control_sponsorization = true;
                                    };
                                @endphp
                            @endforeach


                            @if ($control_sponsorization)
                                <span class="bg-success rounded bg-gradient p-3 fs-6">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-cash-coin" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M11 15a4 4 0 1 0 0-8 4 4 0 0 0 0 8zm5-4a5 5 0 1 1-10 0 5 5 0 0 1 10 0z"/>
                                    <path d="M9.438 11.944c.047.596.518 1.06 1.363 1.116v.44h.375v-.443c.875-.061 1.386-.529 1.386-1.207 0-.618-.39-.936-1.09-1.1l-.296-.07v-1.2c.376.043.614.248.671.532h.658c-.047-.575-.54-1.024-1.329-1.073V8.5h-.375v.45c-.747.073-1.255.522-1.255 1.158 0 .562.378.92 1.007 1.066l.248.061v1.272c-.384-.058-.639-.27-.696-.563h-.668zm1.36-1.354c-.369-.085-.569-.26-.569-.522 0-.294.216-.514.572-.578v1.1h-.003zm.432.746c.449.104.655.272.655.569 0 .339-.257.571-.709.614v-1.195l.054.012z"/>
                                    <path d="M1 0a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h4.083c.058-.344.145-.678.258-1H3a2 2 0 0 0-2-2V3a2 2 0 0 0 2-2h10a2 2 0 0 0 2 2v3.528c.38.34.717.728 1 1.154V1a1 1 0 0 0-1-1H1z"/>
                                    <path d="M9.998 5.083 10 5a2 2 0 1 0-3.132 1.65 5.982 5.982 0 0 1 3.13-1.567z"/>
                                    </svg>
                                </span>
                            @endif
                        </div>
                        <div class="card-body d-flex flex-column justify-content-between p-0 pt-3">
                            <div class="data_apartment px-2">
                                <h3 class="card-title text-uppercase">{{ $apartment->title }}</h3>
                                <div class="text-uppercase fs-6">Numero camere: {{ $apartment->rooms }}
                                </div>
                                <div class="text-uppercase fs-6">Posti letto: {{ $apartment->beds }}
                                </div>
                                <div class="text-uppercase fs-6">Numero Bagni: {{ $apartment->bathrooms }}</div>
                                <div class="text-uppercase fs-6">Metri quadri: {{ $apartment->square_meters }}m²</div>
                                <div class="text-uppercase fs-6">Indirizzo: {{ $apartment->address }}</div>
                            </div>

                            <div class="d-flex justify-content-between flex-wrap align-items-center mt-2 p-2 rounded-bottom fs-6">
                            <a class="btn btn-primary bg-gradient btn-lg" href="{{ route('admin.apartments.show', $apartment->id) }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                        <path
                                            d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                        <path
                                            d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                                    </svg>
                                </a>
                                <a class="btn btn-secondary bg-gradient btn-lg"
                                    href="{{ route('admin.apartments.edit', $apartment->id) }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                        <path
                                            d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                        <path fill-rule="evenodd"
                                            d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                    </svg>
                                </a>
                                <a class="btn btn-success bg-gradient btn-lg" href="{{ route('admin.messages.index', $apartment->id) }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-envelope-fill" viewBox="0 0 16 16">
                                    <path d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414.05 3.555ZM0 4.697v7.104l5.803-3.558L0 4.697ZM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586l-1.239-.757Zm3.436-.586L16 11.801V4.697l-5.803 3.546Z"/>
                                    </svg>
                                </a>
                                <a class="btn btn-warning text-white bg-gradient btn-lg" href="{{ route('admin.sponsorizations.index', $apartment->id) }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-credit-card-fill" viewBox="0 0 16 16">
                                    <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v1H0V4zm0 3v5a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7H0zm3 2h1a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1v-1a1 1 0 0 1 1-1z"/>
                                    </svg>
                                </a>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-danger bg-gradient btn-lg" data-bs-toggle="modal"
                                    data-bs-target="#modelApartment{{ $apartment->id }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                        <path
                                            d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                                    </svg>
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="modelApartment{{ $apartment->id }}" tabindex="-1"
                                    role="dialog" aria-labelledby="modelApartmentId" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Eliminazione: "{{ $apartment->title }}"</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Sei sicuro di voler cancellare questo annuncio: "{{ $apartment->title }}" <br>
                                                (OPERAZIONE IRREVERSIBILE)
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Annulla</button>
                                                <form action="{{ route('admin.apartments.destroy', $apartment->id) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Cancella</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col mx-auto">
                    <h2 class="text-center mb-3">Non hai ancora inserito un annuncio, fallo subito!</h2>
                    <div class="d-flex justify-content-center">
                        <a class="button_glow text-uppercase" href="{{ route('admin.apartments.create') }}">Clicca
                            qui</a>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
@endsection
