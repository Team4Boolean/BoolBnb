@extends('layouts.app')
@section('jumbo')
  <div class="jumbotron jumbotron-fluid" style="background-image: url('https://a0.muscache.com/pictures/18084f37-67e0-400f-bfd8-55eea0e89508.jpg')">
    <div class="container">
      <div class="text">
        <h1>Riscopri l'Italia</h1>
        <p>
          Cambia quadro. Scopri alloggi nelle vicinanze <br>
          tutti da vivere, per lavoro o svago.
        </p>
        <a class="btn btn-light" href="#">Esplora i dintorni</a>
      </div>
    </div>
  </div>
@endsection
@section('content')
  <div class="container">
  <div class="text">
    <h3>Appartamenti in evidenza</h3>
  </div>
  <div class="row homepage">
    <div class="col-xs-12 col-md-6 col-lg-4">
      <div class="card">
        <img src="https://cf.bstatic.com/images/hotel/max1024x768/153/153941057.jpg" class="card-img-top" alt="flat-img">
        <div class="card-body">
          <h5 class="card-title">Ad Title</h5>
          <p class="card-text text-muted">Some text to describe this flat. Some other text to make this paragraph long enough</p>
          <a href="#" class="btn btn-primary">Go somewhere</a>
        </div>
      </div>
    </div>
    <div class="col-xs-12 col-md-6 col-lg-4">
      <div class="card">
        <img src="https://assetstools.cosentino.com/api/v1/bynder/image/9A097A3D-0BA3-45B4-A93FE7B345B54EE9/apartment-34-kitchen.jpg?auto=compress%2Cformat&w=1960&h=920" class="card-img-top" alt="flat-img">
        <div class="card-body">
          <h5 class="card-title">Ad Title</h5>
          <p class="card-text text-muted">Some text to describe this flat. Some other text to make this paragraph long enough</p>
          <a href="#" class="btn btn-primary">Go somewhere</a>
        </div>
      </div>
    </div>
    <div class="col-xs-12 col-md-6 col-lg-4">
      <div class="card">
        <img src="https://cf.bstatic.com/images/hotel/max1024x768/173/173894281.jpg" class="card-img-top" alt="flat-img">
        <div class="card-body">
          <h5 class="card-title">Ad Title</h5>
          <p class="card-text text-muted">Some text to describe this flat. Some other text to make this paragraph long enough</p>
          <a href="#" class="btn btn-primary">Go somewhere</a>
        </div>
      </div>
    </div>
    <div class="col-xs-12 col-md-6 col-lg-4">
      <div class="card">
        <img src="https://static.budgetplaces.com/establishment/55/86/28655/1.jpg" class="card-img-top" alt="flat-img">
        <div class="card-body">
          <h5 class="card-title">Ad Title</h5>
          <p class="card-text text-muted">Some text to describe this flat. Some other text to make this paragraph long enough</p>
          <a href="#" class="btn btn-primary">Go somewhere</a>
        </div>
      </div>
    </div>
    <div class="col-xs-12 col-md-6 col-lg-4">
      <div class="card">
        <img src="https://www.heartmilanapartments.com/wp-content/uploads/as.jpg" class="card-img-top" alt="flat-img">
        <div class="card-body">
          <h5 class="card-title">Ad Title</h5>
          <p class="card-text text-muted">Some text to describe this flat. Some other text to make this paragraph long enough</p>
          <a href="#" class="btn btn-primary">Go somewhere</a>
        </div>
      </div>
    </div>
    <div class="col-xs-12 col-md-6 col-lg-4">
      <div class="card">
        <img src="https://fishhotels-api.derbyhotels.com/storage/grehd/5de65cb941c4a8ccfce487d1/m/aramunt-barcelona-apartment-8.jpg" class="card-img-top" alt="flat-img">
        <div class="card-body">
          <h5 class="card-title">Ad Title</h5>
          <p class="card-text text-muted">Some text to describe this flat. Some other text to make this paragraph long enough</p>
          <a href="#" class="btn btn-primary">Go somewhere</a>
        </div>
      </div>
    </div>
  </div>
  </div>
@endsection
