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
                  <div style="text-align:center">
                    <h3>Visualizzazioni totali:</h3>
                    <h2 id="totalViews"></h2>
                  </div>
                  <canvas id="viewsChart"></canvas>
                </div>
              </div>

          </div>
      </div>

  </div>

  <script type="text/javascript">

    // prendiamo le views sotto forma di raw data tramite inviato dal controller
    var views = "{{$views}}";
    // ricaviamo la sezione della stringa interessata
    var array = views.split(",");
    var currentDate = new Date();
    var currentYear = currentDate.getFullYear();

      // mettiamo in array i dati ripuliti con format YYYY/MM/DD
      for(var i = 0; i < array.length; i++){

          var index = array[i].indexOf(currentYear);
          var index2 = array[i].indexOf(' ');
          array[i] = array[i].substring(index, index2);
      }

    // creiamo un oggetto raggruppando i giorni e sommando le visualizzazioni per ciascun giorno
    // l'oggetto avrà quindi chiave: data e value: visualizzazioniTotaliInQuelGiorno
    var count = {};

    array.forEach(function(i) {
     count[i] = (count[i]||0) + 1;
    });

    // formiamo un array dei giorni
    var arrayX = Object.keys(count);
    // e un array delle visualizzazioni
    var arrayY = Object.values(count);

    // (somma visualizzazioni totali)
    var sum = arrayY.reduce(function(a, b){
        return a + b;
    }, 0);

    $('#totalViews').append(sum);

    // array da passare alla chart contenente ogni giorno suddiviso in oggetto con X e Y
    var viewsData = [];

    for (var i = 0; i < arrayX.length; i++){

      // creo un oggetto contenente chiavi x e y (dove x: giorno e y: numVisualizzazioni) e lo mando all'array
      var object = {x: arrayX[i], y: arrayY[i]};
      viewsData.push(object);
    }

    var ctx = $("#viewsChart");

    var viewsChart = new Chart(ctx, {
      type: 'line',
      data:  {
        // passiamo l'array con i giorni
        labels: arrayX,
        datasets: [{
          label: '# Visualizzazioni',
          // passiamo l'array con i dati x e y
          data: viewsData,
          backgroundColor: [
            'rgba(255, 99, 132, 0.2)',
          ],
          borderColor: [
            'rgba(255, 99, 132, 1)',
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
