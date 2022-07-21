@extends('layouts.admin')
@section('css')
<link rel="stylesheet" href="{{asset('css/payment.css')}}">
@endsection
@section('content')
@if (session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif
<div class="container">
    <h2 class="text-center">Sponsorization for {{$apartment->title}}</h2>
    <div class="card">
        <div class="card-body">
            <h4>Piano: {{$sponsorization->name}}</h4>
            <p>Descrizione: Il tuo annuncio verra' sponsorizzato e messo in evidenza</p>
            <p><span>Prezzo: </span>{{$sponsorization->price}}</p>
            <p><span>Duration: </span>{{$sponsorization->duration}} ore</p>
        </div>
    </div>


    <div class="form-container">
        <div class="bg-illustration">
            <svg width="801" height="570" viewBox="0 0 801 570" xmlns="http://www.w3.org/2000/svg">
                <path d="M695.15 540.43c-20.954 6.55-43.243 8.226-64.932 4.89 26.065-11.507 55.1-15.426 83.328-12.16-6.065 2.907-12.257 5.35-18.397 7.27m-74.984-158.957c-21.38 10.4-43.668 18.945-66.534 25.507-10.876 3.124-21.884 5.796-32.982 8.01-9.54 1.897-19.777 4.24-29.407 1.474-3.74-1.074-7.995-3.277-9.628-7.045-1.683-3.892 5.25-9.335 7.905-12.03 7.204-7.305 15.39-13.605 24.186-18.898 17.312-10.42 36.777-16.946 56.58-20.74 29.96-5.74 61.745-5.98 91.927.11-13.534 8.686-27.587 16.578-42.047 23.61M500.756 239.7c-33.755 25.25-73.15 43.654-114.53 52.324-3.04.637-17.404 1.327-11.22-4.79 4.484-4.435 9.366-8.456 14.522-12.093 8.946-6.313 18.65-11.5 28.616-16.02 22.272-10.1 45.856-17.684 69.6-23.497 8.246-2.02 16.557-3.784 24.91-5.325-3.887 3.23-7.85 6.372-11.9 9.402M342.55 48.914c-6.185 9.275-13.586 17.906-21.198 26.05-29.246 31.28-66.41 55.228-107.156 68.748-9.036 2.998-18.98 6.006-28.552 3.737-3.216-.762-9.808-3.368-10.36-7.234-.303-2.117 2.287-5.23 3.342-6.96 1.356-2.23 2.805-4.4 4.337-6.514 12.736-17.588 30.818-30.666 49.696-41.077 34.208-18.862 71.874-31.495 110.664-37.96-.256.404-.51.81-.774 1.21m457.74 519.678c-22.864-19.48-51.17-31.804-80.733-36.312 9.67-5.095 18.695-11.365 26.732-18.812 14.05-13.024 24.878-30.252 26.41-49.644 1.64-20.754-7.21-41.398-19.804-57.542-20.985-26.902-53.498-42.06-86.39-49.197 2.876-1.887 5.738-3.798 8.565-5.757 17.06-11.824 34.41-25.288 44.125-44.053 8.667-16.737 10.507-38.63-.855-54.614-10.888-15.32-30.21-21.3-47.887-24.643-46.346-8.764-94.712-8.922-141.317-2.16-3.577.522-7.144 1.098-10.71 1.703 10.422-9.04 20.23-18.78 29.26-29.202 16.158-18.658 32.707-40.726 35.14-66.04 4.776-49.667-50.926-71.248-90.198-80.87-47.635-11.67-97.6-13.463-146.025-5.768 3.113-5.434 5.273-11.288 4.97-17.58-.47-9.854-7.347-18.123-15.74-22.784-11.377-6.32-25.098-5.845-37.625-4.418-23.028 2.626-45.735 8-67.582 15.672-43.49 15.276-83.362 39.604-118.428 69.25-36.16 30.574-67.404 66.832-93.41 106.278-6.348 9.625-12.37 19.457-18.1 29.46-.54.945.923 1.796 1.463.85 40.29-70.35 96.604-133.587 166.986-175.18C203.47 26.94 241.14 12.15 280.516 5.18c20.895-3.7 51.86-9.495 65.6 11.7 6.22 9.6 3.576 20.047-1.766 29.143-3.298.545-6.592 1.134-9.876 1.768-26.202 5.052-51.843 12.94-76.305 23.567-22.525 9.788-44.832 21.706-62.735 38.713-8.42 8-15.773 17.185-21.18 27.47-3.763 7.16 9.64 11.647 14.766 12.153 10.566 1.042 20.932-2.625 30.718-6.102 11.48-4.08 22.666-8.986 33.446-14.64 21.505-11.28 41.417-25.57 58.974-42.3 9.075-8.65 17.512-17.96 25.207-27.844 2.79-3.58 5.756-7.41 8.263-11.483 52.33-8.38 106.617-5.535 157.177 8.53 36.682 10.207 84.046 32.95 78.09 78.475-3.09 23.603-18.427 44.218-33.538 61.828-9.847 11.478-20.625 22.164-32.15 31.976-19.287 3.427-38.35 8.103-57.007 14.06-21.474 6.853-43.19 14.898-62.414 26.797-8.93 5.53-17.205 12.008-24.462 19.596-.195.202-.327.543-.22.82 3.423 8.837 16.933 4.033 23.404 2.455 11.922-2.908 23.653-6.584 35.105-10.975 22.774-8.73 44.46-20.26 64.415-34.24 7.58-5.31 14.908-10.972 21.96-16.955 39.06-6.903 79.05-8.58 118.555-4.88 21.537 2.018 45.684 4.04 65.153 14.28 9.745 5.127 18.006 12.924 21.967 23.337 3.86 10.146 3.67 21.456.824 31.83-6.102 22.25-24.29 38.393-42.392 51.46-5.212 3.767-10.53 7.39-15.925 10.896-1.224-.252-2.445-.517-3.667-.746-37.45-7.026-77.88-5.438-114.235 6.232-18.002 5.78-35.216 14.388-49.737 26.545-3.65 3.057-7.115 6.33-10.362 9.806-1.567 1.678-3.082 3.4-4.54 5.17-.875 1.064-2.49 2.35-2.57 3.775-.143 2.517 2.89 5.763 4.637 7.185 2.58 2.103 5.815 3.312 9.048 3.995 8.508 1.8 17.07.216 25.46-1.39 11.114-2.13 22.14-4.725 33.04-7.77 21.866-6.106 43.222-14.027 63.787-23.626 17.12-7.99 33.678-17.172 49.527-27.44 7.98 1.705 15.85 3.83 23.528 6.446 36.767 12.53 71.948 39.044 81.216 78.46 9.36 39.803-19.35 71.52-53.047 88.572-16.7-2.21-33.75-1.943-50.4.943-13.49 2.337-26.584 6.463-38.99 12.215-.637.294-.498 1.417.203 1.54 30.05 5.212 62.45.816 89.935-12.918 16.66 2.28 32.98 7.053 48.18 14.26 12.224 5.798 23.625 13.16 33.912 21.924.824.7 2.028-.486 1.197-1.193" fill="#FFF" fill-rule="evenodd" />
            </svg>

        </div>

        <header>
            <h1>Payment Method</h1>
        </header>

        <form id="my-sample-form" action="{{route('admin.sponsorizations.checkout',['apartment' => $apartment->id ,'sponsorization' => $sponsorization->id])}}" method="post" class="scale-down">
            @csrf
            <div class="cardinfo-card-number">
                <label class="cardinfo-label" for="card-number">Card Number</label>
                <div class='input-wrapper' id="card-number"></div>
                <div id="card-image"></div>
            </div>

            <div class="cardinfo-wrapper">
                <div class="cardinfo-exp-date">
                    <label class="cardinfo-label" for="expiration-date">Valid Thru</label>
                    <div class='input-wrapper' id="expiration-date"></div>
                </div>

                <div class="cardinfo-cvv">
                    <label class="cardinfo-label" for="cvv">CVV</label>
                    <div class='input-wrapper' id="cvv"></div>
                </div>
            </div>
            <input type="text" hidden id="nonce" name="nonce">
        </form>

        <input id="button-pay" type="submit" value="Continue" />
    </div>
</div>

@endsection

@push('payment')

<script src="https://js.braintreegateway.com/web/3.85.3/js/client.min.js"></script>
<script src="https://js.braintreegateway.com/web/3.85.3/js/hosted-fields.min.js"></script>
<script type="text/javascript">


    braintree.client.create({
        authorization: 'sandbox_8hmb9knq_f9nwxybxcq4328fb'
    }, function(err, clientInstance) {
        if (err) {
            console.error(err);
            return;
        }

        // Create input fields and add text styles
        braintree.hostedFields.create({
            client: clientInstance,
            styles: {
                'input': {
                    'color': '#282c37',
                    'font-size': '16px',
                    'transition': 'color 0.1s',
                    'line-height': '3'
                },
                // Style the text of an invalid input
                'input.invalid': {
                    'color': '#E53A40'
                },
                // placeholder styles need to be individually adjusted
                '::-webkit-input-placeholder': {
                    'color': 'rgba(0,0,0,0.6)'
                },
                ':-moz-placeholder': {
                    'color': 'rgba(0,0,0,0.6)'
                },
                '::-moz-placeholder': {
                    'color': 'rgba(0,0,0,0.6)'
                },
                ':-ms-input-placeholder': {
                    'color': 'rgba(0,0,0,0.6)'
                },
                // prevent IE 11 and Edge from
                // displaying the clear button
                // over the card brand icon
                'input::-ms-clear': {
                    opacity: '0'
                }
            },
            // Add information for individual fields
            fields: {
                number: {
                    selector: '#card-number',
                    placeholder: '1111 1111 1111 1111'
                },
                cvv: {
                    selector: '#cvv',
                    placeholder: '123'
                },
                expirationDate: {
                    selector: '#expiration-date',
                    placeholder: '10 / 2019'
                }
            }
        }, function(err, hostedFieldsInstance) {
            if (err) {
                console.error(err);
                return;
            }

            hostedFieldsInstance.on('validityChange', function(event) {
                // Check if all fields are valid, then show submit button
                const formValid = Object.keys(event.fields).every(function(key) {
                    return event.fields[key].isValid;
                });

                if (formValid) {
                    $('#button-pay').addClass('show-button');
                } else {
                    $('#button-pay').removeClass('show-button');
                }
            });

            hostedFieldsInstance.on('empty', function(event) {
                $('header').removeClass('header-slide');
                $('#card-image').removeClass();
                $('form').removeClass();
            });

            hostedFieldsInstance.on('cardTypeChange', function(event) {
                // Change card bg depending on card type
                if (event.cards.length === 1) {
                    $('form').removeClass().addClass(event.cards[0].type);
                    $('#card-image').removeClass().addClass(event.cards[0].type);
                    $('header').addClass('header-slide');

                    // Change the CVV length for AmericanExpress cards
                    if (event.cards[0].code.size === 4) {
                        hostedFieldsInstance.setAttribute({
                            field: 'cvv',
                            attribute: 'placeholder',
                            value: '1234'
                        });
                    }
                } else {
                    hostedFieldsInstance.setAttribute({
                        field: 'cvv',
                        attribute: 'placeholder',
                        value: '123'
                    });
                }
            });

            document.querySelector('#button-pay').addEventListener('click', function(event) {
                event.preventDefault();
                console.log('click');
                hostedFieldsInstance.tokenize(function(err, payload) {
                    if (err) {
                        console.error(err);
                        return;
                    }
                    document.getElementById('nonce').value=payload.nonce
                    // This is where you would submit payload.nonce to your server
                    document.getElementById('my-sample-form').submit()
                });
            });
        });
    });
</script>
@endpush
