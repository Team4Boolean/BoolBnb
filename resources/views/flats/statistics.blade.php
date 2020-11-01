@extends('layouts.app')
@section('content')

  <div class="container">
      <div class="row justify-content-center">
          <div class="col-md-12">
              <div class="card">

                <div class="card-header">
                  <div class="row">
                    <div class="col-sm-12">
                      <a class="float-left" href="{{ url()->previous() }}"> <i class="fas fa-arrow-circle-left" style="font-size:40px"></i> </a>
                      {{-- Titolo pagina cardheader --}}
                      <h1>Statistiche {{ $flat -> title }}</h1>
                    </div>
                  </div>
                </div>

                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6" style="text-align:center">
                      <h3>Visualizzazioni totali:</h3>
                      <h2 id="totalViews"></h2>
                      <canvas id="viewsChart"></canvas>
                    </div>
                    <div class="col-md-6" style="text-align:center">
                      <h3>Messaggi totali:</h3>
                      <h2 id="totalMessages"></h2>
                      <canvas id="messagesChart"></canvas>
                    </div>
                  </div>
                </div>
                {{-- /card-body --}}
              </div>
              {{-- /card --}}

          </div>
      </div>

  </div>

  <script type="text/javascript">

    var visits = @json($visits);
    var messages = @json($messages);
    console.log('visits',visits);
    console.log('messages',messages);

    // STATISTICHE VISUALIZZAZIONI
    var daysVisits = [];
    var viewsVisits = [];
    var visitsData = [];

    for (var i = 0; i < visits.length; i++) {

      var visit = visits[i];

      daysVisits.push(visit['x']);
      viewsVisits.push(visit['y']);
    }

    var totalVisits = viewsVisits.reduce(function(a, b){
        return a + b;
    }, 0);
    $('#totalViews').append(totalVisits);

    var ctx = $("#viewsChart");
    var viewsChart = new Chart(ctx, {
      type: 'line',
      data:  {
        // passiamo l'array con i giorni
        labels: daysVisits,
        datasets: [{
          label: '# Visualizzazioni',
          // passiamo l'array con i dati x e y
          data: visits,
          backgroundColor: [
            'rgba(255, 99, 132, 0.2)',
          ],
          borderColor: [
            'rgba(255, 99, 132, 1)',
          ],
          borderWidth: 3
        }],
      },
      options:  {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }],
            xAxes: [{
                ticks: {
                    beginAtZero: false
                }
            }]
          },
        },
    });

    // STATISTICHE MESSAGGI
    var daysMessages = [];
    var numMessages = [];
    var messagesData = [];

    for (var i = 0; i < messages.length; i++) {

      var message = messages[i];

      daysMessages.push(message['x']);
      numMessages.push(message['y']);
    }

    var totalMessages = numMessages.reduce(function(a, b){
        return a + b;
    }, 0);
    $('#totalMessages').append(totalMessages);

    var ctx = $("#messagesChart");
    var messagesChart = new Chart(ctx, {
      type: 'line',
      data:  {
        // passiamo l'array con i giorni
        labels: daysMessages,
        datasets: [{
          label: '# Visualizzazioni',
          // passiamo l'array con i dati x e y
          data: messages,
          backgroundColor: [
            'rgba(255, 99, 132, 0.2)',
          ],
          borderColor: [
            'rgba(255, 99, 132, 1)',
          ],
          borderWidth: 3
        }],
      },
      options:  {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }],
            xAxes: [{
                ticks: {
                    beginAtZero: false
                }
            }]
          },
        },
    });

  </script>

@endsection
