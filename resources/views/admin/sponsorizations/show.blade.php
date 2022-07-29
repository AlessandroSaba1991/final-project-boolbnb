@extends('layouts.admin')
@section('css')
<link rel="stylesheet" href="{{asset('css/payment.css')}}">
@endsection
@section('content')
<div class="bg_orange py-4 shadow mb-5">
    <div class="container">
        <h2 class="text-uppercase text-center mb-0">Pagamento Sponsorizzazione</h2>
    </div>
</div>
@if (session('error'))
<div class="alert alert-danger pop_up_message my-3">
    {{ session('error') }}
</div>
@endif
<div class="container">
    <div class="row row-cols-1 row-cols-md-2">
        <div class="col">
            <div class="card h-100 shadow">
                <div class="card-header bg_orange">
                    <h4 class="mb-0 py-2 px-1">Riepilogo</h4>
                </div>
                <div class="card-body">
                    <p><strong>Piano: </strong>{{$sponsorization->name}}</p>
                    <p><strong>Durata: </strong>{{$sponsorization->duration}}</p>
                    <p><strong>Prezzo: </strong>{{$sponsorization->price}} €</p>
                    <p class="mb-0"><strong>Appartamento scelto: </strong>{{$apartment->title}}</p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card bg-transparent border-0">
                <div class="card-header bg_orange">
                    <header>
                        <h1 class="mb-0 py-2 px-1">Metodo di Pagamento</h1>
                    </header>
                </div>
                <div class="card-body p-0">
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
                    <div class="text-center">
                        <input id="button-pay" type="submit" value="Continue" />
                    </div>
                </div>



            </div>

        </div>
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
                    document.getElementById('nonce').value = payload.nonce
                    // This is where you would submit payload.nonce to your server
                    document.getElementById('my-sample-form').submit()
                });
            });
        });
    });
</script>
@endpush
