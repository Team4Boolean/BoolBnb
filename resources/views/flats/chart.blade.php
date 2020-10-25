@extends('layouts.app')
@section('content')

  <div class="container">
      <div class="row justify-content-center">
          <div class="col-md-8">
              <div class="card">
                  <div class="card-header">
                    {{-- Titolo pagina cardheader --}}
                    <h1>Statistiche di visualizzazione</h1>
                  </div>
                  <div class="card-body">
                    <h2>{{$flat -> title}}</h2>
                    <canvas id="viewsChart"></canvas>

                      {{$views}}

                  </div>
              </div>
          </div>
      </div>
  </div>

  <script type="text/javascript">

    var ctx = $("#viewsChart");

    var viewsChart = new Chart(ctx, {
      type: 'line',
      data:  {
        labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
        datasets: [{
          label: '# Visualizzazioni',
          // data:

          backgroundColor: [
            'rgba(255, 99, 132, 0.2)',
            'rgba(54, 162, 235, 0.2)',
            'rgba(255, 206, 86, 0.2)',
            'rgba(75, 192, 192, 0.2)',
            'rgba(153, 102, 255, 0.2)',
            'rgba(255, 159, 64, 0.2)'
          ],
          borderColor: [
            'rgba(255, 99, 132, 1)',
            'rgba(54, 162, 235, 1)',
            'rgba(255, 206, 86, 1)',
            'rgba(75, 192, 192, 1)',
            'rgba(153, 102, 255, 1)',
            'rgba(255, 159, 64, 1)'
          ],
          borderWidth: 1
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
