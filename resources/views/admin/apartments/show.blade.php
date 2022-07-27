@extends('layouts.admin')

@section('content')
@if (session('message'))
<div class="alert alert-success my-3 pop_up_message">
    {{ session('message') }}
</div>
@endif
<div class="container">
    <div class="card apartment my-5">
        <div class="badge_">
            @if($apartment->visible)
            <div class="visible green">
                <span>Visibile</span>
            </div>
            @else
            <div class="visible red">
                <span>Non Visibile</span>
            </div>
            @endif

            @if (count($apartment->sponsorizations) > 0)

            @foreach($apartment->sponsorizations as $sponsorization)
            @if($loop->first)
            @php
            $data = $sponsorization->sponsor->end_sponsorization;
            @endphp
            @endif
            @php
            if($sponsorization->sponsor->end_sponsorization>$data){
            $data = $sponsorization->sponsor->end_sponsorization;
            };
            @endphp
            @endforeach
            @php
            $diff=date_diff(date_create($data),date_create(date("Y-m-d H:i:s")));
            @endphp

            <div class="sponsor mt-2">
                @if($diff->d > 0)
                <span>{{$diff->format("Scadenza Sponsorizzazione: %d Giorni %H Ore")}}</span>
                @else
                <span>{{$diff->format("Scadenza Sponsorizzazione: %H Ore")}}</span>
                @endif
            </div>
            @endif
        </div>
        <div class="row g-0">
            <div class="col-6">
                <img class="h-100 w-100" src="{{asset('storage/' . $apartment->cover_image)}}" alt="{{$apartment->title}}">
            </div>
            <div class="col-6">
                <div class="card-body">
                    <h3>{{$apartment->title}}</h3>
                    <p>{{$apartment->description}}</p>
                    <div class="row">
                        <div class="col">
                            <p>
                                <span>Camere: </span>{{$apartment->rooms}}
                            </p>
                            <p>
                                <span>Letti: </span>{{$apartment->beds}}
                            </p>
                            <p>
                                <span>Bagni: </span>{{$apartment->bathrooms}}
                            </p>
                            <p>
                                <span>Metratura: </span>{{$apartment->square_meters}} m²
                            </p>
                        </div>
                        <div class="col">
                            <p>
                                <span>Indirizzo: </span>{{$apartment->address}}
                            </p>
                            <p>
                                <span>Latitudine: </span>{{$apartment->latitude}}
                            </p>
                            <p>
                                <span>Longitudine: </span>{{$apartment->longitude}}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <p>
                        <span>Servizi: </span>
                        @if (count($apartment->services) > 0)
                        @foreach($apartment->services as $service)
                        {{$service->name}}@if(!$loop->last),@else.@endif
                        @endforeach
                        @else
                        Nessun Servizio
                        @endif
                    </p>
                </div>

            </div>

        </div>
    </div>
</div>

@endsection

@section('views_stats')
@php
$db_data_week = [];
$db_data_one_month = [];
$db_data_six_months = [];
$db_data_one_year = [];


//setto l'itervallo di giorni richiesti
$interval_week = 7;
$interval_one_month = 30;
$interval_six_months = 6;
$interval_one_year = 12;


$today = date('y-m-d'); // prendo la data del giorno attuale
//dd($visualization->created_at);

//visualizzazioni per 1 anno --------- 1
for($i = 0; $i < $interval_one_year; $i++) {
    $views = 0;
    foreach($visualizations as $visualization) {
        //dd($visualization);
        if(date('m', strtotime('-' . $i .  'month')) == date("m", strtotime($visualization->created_at))) {
            $views += 1;
        }
    }
    $data = [
        'date' => date('Y-m-d', strtotime('-' . $i .  'month')),
        'appartment_views' => $views,
    ];
    array_push($db_data_one_year, $data);
}


//visualizzazioni per 6 mesi --------- 1
for($i = 0; $i < $interval_six_months; $i++) {
    $views = 0;
    foreach($visualizations as $visualization) {
        //dd($visualization);
        if(date('m', strtotime('-' . $i .  'month')) == date("m", strtotime($visualization->created_at))) {
            $views += 1;
        }
    }
    $data = [
        'date' => date('Y-m-d', strtotime('-' . $i .  'month')),
        'appartment_views' => $views,
    ];
    array_push($db_data_six_months, $data);
}



//visualizzazioni per 1 settimana --------- 1
for($i = 0; $i < $interval_week; $i++) {
    $views = 0;
    foreach($visualizations as $visualization) {
        //dd($visualization);
        if(date('Y-m-d', strtotime('-' . $i .  'days')) == date("Y-m-d", strtotime($visualization->created_at))) {
            $views += 1;
        }
    }
    $data = [
        'date' => date('Y-m-d', strtotime('-' . $i .  'days')),
        'appartment_views' => $views,
    ];
    array_push($db_data_week, $data);
}


//visualizzazioni per 1 mese -------------- 1
for($i = 0; $i < $interval_week; $i++) {
    $views = 0;
    foreach($visualizations as $visualization) {
        //dd($visualization);
        if(date('Y-m-d', strtotime('-' . $i .  'days')) == date("Y-m-d", strtotime($visualization->created_at))) {
            $views += 1;
        }
    }
    $data = [
        'date' => date('Y-m-d', strtotime('-' . $i .  'days')),
        'appartment_views' => $views,
    ];
    //dd($data);
    array_push($db_data_one_month, $data);
}

// giorno iniziale delle settimana ------ 2
$start_date_week = date('Y-m-d', strtotime('-' . $interval_week .  'days')); // prendo il giorno in cui inizia il grafico

// giorno iniziale del mese ------ 2
$start_date_one_month = date('Y-m-d', strtotime('-' . $interval_one_month .  'days')); // prendo il giorno in cui inizia il grafico

// primo mese dei 6 ------ 2
$start_date_six_months = date('Y-m-d', strtotime('-' . $interval_six_months .  'month')); // prendo il mese in cui inizia il grafico

// primo mese di 1 anno ------ 2
$start_date_one_year = date('Y-m-d', strtotime('-' . $interval_one_year .  'month')); // prendo il mese in cui inizia il grafico


// creare un array dei mesi nell'inervallo tra oggi e il primo mese del grafico per 1 anno --------- 3
$dates_interval_one_year = [];
for($i = 1; $i <= $interval_one_year; $i++) {
    array_push($dates_interval_one_year, date('Y-m-d', strtotime($start_date_one_year . '+' . $i . ' month'))); // salvo la data per ogni giorno dell'interval_one_month
}



$views_one_year = []; //creo un array per le views giornaliere

//riempo di zeri cosi non ho spazi vuoti
for($i = 0; $i < $interval_one_year; $i++) {
    array_push($views_one_year, 0);
}


//devo popolare le view esistenti nella giusta posizione dell'array

for($i = 0; $i < $interval_one_year; $i++) { //ciclo per ogni mese dell'interval_one_yearlo
    foreach($db_data_one_year as $db_item) { // per ogni mese ciclo nel db
        if(date('m', strtotime($db_item['date'])) == date('m', strtotime($dates_interval_one_year[$i]))){ // se la data dell'elemento del db coincide con la data in posizione 'i' dell'itervallo di date
            $views_one_year[$i] = $db_item['appartment_views']; // prendo la posizione 'i' dell'array delle views del grafico e ci salvo le views dell'appartamento in quel giorno
        }
    }
}



// creare un array dei mesi nell'inervallo tra oggi e il primo mese del grafico per 6 mesi --------- 3
$dates_interval_six_months = [];
for($i = 1; $i <= $interval_six_months; $i++) {
    array_push($dates_interval_six_months, date('Y-m-d', strtotime($start_date_six_months . '+' . $i . ' month'))); // salvo la data per ogni giorno dell'interval_one_month
}



$views_six_months = []; //creo un array per le views giornaliere

//riempo di zeri cosi non ho spazi vuoti
for($i = 0; $i < $interval_six_months; $i++) {
    array_push($views_six_months, 0);
}


//devo popolare le view esistenti nella giusta posizione dell'array

for($i = 0; $i < $interval_six_months; $i++) { //ciclo per ogni mese dell'interval_six_monthslo
    foreach($db_data_six_months as $db_item) { // per ogni mese ciclo nel db
        if(date('m', strtotime($db_item['date'])) == date('m', strtotime($dates_interval_six_months[$i]))){ // se la data dell'elemento del db coincide con la data in posizione 'i' dell'itervallo di date
            $views_six_months[$i] = $db_item['appartment_views']; // prendo la posizione 'i' dell'array delle views del grafico e ci salvo le views dell'appartamento in quel giorno
        }
    }
}


// creare un array delle date nell'inervallo tra oggi e il primo giorno del grafico per 1 settimana --------- 3
$dates_interval_week = [];
for($i = 1; $i <= $interval_week; $i++) {
    array_push($dates_interval_week, date('Y-m-d', strtotime($start_date_week . '+' . $i . ' days'))); // salvo la data per ogni giorno dell'interval_week
}


$views_week = []; //creo un array per le views giornaliere

//riempo di zeri cosi non ho spazi vuoti
for($i = 0; $i < $interval_week; $i++) {
    array_push($views_week, 0);
}



//devo popolare le view esistenti nella giusta posizione dell'array

for($i = 0; $i < $interval_week; $i++) { //ciclo per ogni giorno dell'interval_weeklo
    foreach($db_data_week as $db_item) { // per ogni giorno ciclo nel db
        if($db_item['date'] == $dates_interval_week[$i]){ // se la data dell'elemento del db coincide con la data in posizione 'i' dell'itervallo di date
            $views_week[$i] = $db_item['appartment_views']; // prendo la posizione 'i' dell'array delle views del grafico e ci salvo le views dell'appartamento in quel giorno
        }
    }
}


// creare un array delle date nell'inervallo tra oggi e il primo giorno del grafico per 1 mese --------- 3
$dates_interval_one_month = [];
for($i = 1; $i <= $interval_one_month; $i++) {
    array_push($dates_interval_one_month, date('Y-m-d', strtotime($start_date_one_month . '+' . $i . ' days'))); // salvo la data per ogni giorno dell'interval_one_month
}


$views_one_month = []; //creo un array per le views giornaliere

//riempo di zeri cosi non ho spazi vuoti
for($i = 0; $i < $interval_one_month; $i++) {
    array_push($views_one_month, 0);
}



//devo popolare le view esistenti nella giusta posizione dell'array

for($i = 0; $i < $interval_one_month; $i++) { //ciclo per ogni giorno dell'interval_one_monthlo
    foreach($db_data_one_month as $db_item) { // per ogni giorno ciclo nel db
        if($db_item['date'] == $dates_interval_one_month[$i]){ // se la data dell'elemento del db coincide con la data in posizione 'i' dell'itervallo di date
            $views_one_month[$i] = $db_item['appartment_views']; // prendo la posizione 'i' dell'array delle views del grafico e ci salvo le views dell'appartamento in quel giorno
        }
    }
}

//fa un array con i nomi dei giorni  ------ 4
$name_days_array_one_year = [];
for($i = 0; $i < $interval_one_year; $i++) {
    $name_day = date('F', strtotime($dates_interval_one_year[$i]));
    array_push($name_days_array_one_year, $name_day);
}


//fa un array con i nomi dei giorni  ------ 4
$name_days_array_six_months = [];
for($i = 0; $i < $interval_six_months; $i++) {
    $name_day = date('F', strtotime($dates_interval_six_months[$i]));
    array_push($name_days_array_six_months, $name_day);
}


//fa un array con i nomi dei giorni  ------ 4
$name_days_array_week = [];
for($i = 0; $i < $interval_week; $i++) {
    $name_day = date('l', strtotime($dates_interval_week[$i]));
    array_push($name_days_array_week, $name_day);
}


//fa un array con i nomi dei giorni ----- 4
$name_days_array_one_month = [];
for($i = 0; $i < $interval_one_month; $i++) {
    $name_day = date('l', strtotime($dates_interval_one_month[$i]));
    array_push($name_days_array_one_month, $name_day);
}


//voglio creare i labels ----- 5
$labels_one_year = [];
for($i = 0; $i < $interval_one_year; $i++) {
    array_push($labels_one_year, $name_days_array_one_year[$i] . ' ' . date('y', strtotime($dates_interval_one_year[$i])));
}


//voglio creare i labels ----- 5
$labels_six_months = [];
for($i = 0; $i < $interval_six_months; $i++) {
    array_push($labels_six_months, $name_days_array_six_months[$i] . ' ' . date('y', strtotime($dates_interval_six_months[$i])));
}


//voglio creare i labels ----- 5
$labels_week = [];
for($i = 0; $i < $interval_week; $i++) {
    array_push($labels_week, $name_days_array_week[$i] . ' ' . date('d/m', strtotime($dates_interval_week[$i])));
}



//voglio creare i labels ----- 5
$labels_one_month = [];
for($i = 0; $i < $interval_one_month; $i++) {
    array_push($labels_one_month, $name_days_array_one_month[$i] . ' ' . date('d/m', strtotime($dates_interval_one_month[$i])));
}


@endphp
<div class="container py-5">
    <div class="row pb-5">
        <div class="col-4">
            <h3 >Statistiche Annuncio:</h3>
            <div class="mb-3 w-50 py-3">
                <label for="stats" class="form-label">Cambia Periodo:</label>
                <select class="form-control" name="stats" id="stats">
                    <option value="7">Settimana</option>
                    <option value="30">Mese</option>
                    <option value="6">6 Mesi</option>
                    <option value="12">Anno</option>
                </select>
            </div>
        </div>
        <div class="col-8 pt-4">
             <canvas id="myChart"></canvas>
        </div>
    </div>
</div>
@endsection

@push('views')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const selectInput = document.getElementById('stats');
    const selectInputValue = selectInput.value;

    const data_week = {
                labels: <?php echo json_encode($labels_week) ?>,
                datasets: [{
                label: 'Visite all\' Annuncio',
                backgroundColor: '#0d6efd',
                borderColor: 'orange',
                data: <?php echo json_encode($views_week) ?>,
                }]
            };
    const config_week = {
                type: 'line',
                data: data_week,
                options: {

                    scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                    // forces step size to be 50 units
                    stepSize: 1
                    },
                    suggestedMax: 5
                },
                },

            pointBackgroundColor: "blue",
            pointBorderColor: "blue",
            pointBorderWidth: 10,

                }
            };

            const data_month = {
                labels: <?php echo json_encode($labels_one_month) ?>,
                datasets: [{
                label: 'Statistiche dell\' Appartmento',
                backgroundColor: 'blue',
                borderColor: 'orange',
                data: <?php echo json_encode($views_one_month) ?>,
                }]
            };
    const config_month = {
                type: 'line',
                data: data_month,
                options: {

                    scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                    // forces step size to be 50 units
                    stepSize: 1
                    },
                    suggestedMax: 5
                },
                },

            pointBackgroundColor: "blue",
            pointBorderColor: "blue",
            pointBorderWidth: 10,

                }
            };

            const data_six_months = {
                labels: <?php echo json_encode($labels_six_months) ?>,
                datasets: [{
                label: 'Visite all\' Annuncio',
                backgroundColor: 'blue',
                borderColor: 'orange',
                data: <?php echo json_encode($views_six_months) ?>,
                }]
            };
    const config_six_months = {
                type: 'line',
                data: data_six_months,
                options: {

                    scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                    // forces step size to be 50 units
                    stepSize: 1
                    },
                    suggestedMax: 5
                },
                },

            pointBackgroundColor: "blue",
            pointBorderColor: "blue",
            pointBorderWidth: 10,

                }
            };

            const data_one_year = {
                labels: <?php echo json_encode($labels_one_year) ?>,
                datasets: [{
                label: 'Visite all\' Annuncio',
                backgroundColor: 'blue',
                borderColor: 'orange',
                data: <?php echo json_encode($views_one_year) ?>,
                }]
            };
    const config_one_year = {
                type: 'line',
                data: data_one_year,
                options: {

                    scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                    // forces step size to be 50 units
                    stepSize: 1
                    },
                    suggestedMax: 5
                },
                },

            pointBackgroundColor: "blue",
            pointBorderColor: "blue",
            pointBorderWidth: 10,

                }
            };


            let myChart = new Chart(
                document.getElementById('myChart'),
                config_week,
            );

    selectInput.addEventListener('change', function(event){
        event.preventDefault()
            if(this.value == 7) {
                myChart.destroy();
                myChart = new Chart(
                    document.getElementById('myChart'),
                    config_week,
                );
            } else if(this.value == 30) {
                myChart.destroy();
                myChart = new Chart(
                    document.getElementById('myChart'),
                    config_month,
                );
            } else if (this.value == 6) {
                myChart.destroy();
                myChart = new Chart(
                    document.getElementById('myChart'),
                    config_six_months,
                );
            } else if (this.value == 12) {
                myChart.destroy();
                myChart = new Chart(
                    document.getElementById('myChart'),
                    config_one_year,
                );
            }

    });
</script>


@endpush
