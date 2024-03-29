@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Registrazione') }}</div>
                <div class="card-body">
                    <span class="text-capitalize">* campi obbligatori</span>
                    <hr>
                    <form id="formRegistration" method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="mb-3 row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nome *') }}</label>
                            <div class="col-md-6">
                                <input id="name" type="text"  class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required pattern="[a-zA-Z]+" minlength="3" autocomplete="name" autofocus>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="surname" class="col-md-4 col-form-label text-md-right">{{ __('Cognome *') }}</label>
                            <div class="col-md-6">
                                <input id="surname" type="text" class="form-control @error('surname') is-invalid @enderror" name="surname" value="{{ old('surname') }}" required pattern="[a-zA-Z]+" minlength="3" autocomplete="surname" autofocus>
                                @error('surname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="date_of_birth" class="form-label col-md-4 col-form-label text-md-right">Data di nascita *</label>
                            <div class="col-md-6">
                                <input type="date" class="form-control @error('date_of_birth') is-invalid @enderror" name="date_of_birth" id="date_of_birth" aria-describedby="helpId" value="{{ old('date_of_birth') }}" max="{{date('Y-m-d',strtotime('-18 years -1 days'))}}">
                                @error('date_of_birth')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail *') }}</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password *') }}</label>
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required minlength="8" autocomplete="new-password">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Conferma Password') }}</label>
                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required minlength="8" autocomplete="new-password" onkeyup="check()">
                            </div>
                            <span id='message'></span>
                            <!-- check message  -->
                        </div>
                        <div class="mb-3 row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button id="submitBtn" type="submit" class="btn btn-primary">
                                    {{ __('Registrati') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
