@extends('layouts.app')
@section('content')
  @php
    echo asset('storage/biba1.png');
  @endphp
  <img src="{{asset('storage/biba1.png')}}" alt="">
@endsection
