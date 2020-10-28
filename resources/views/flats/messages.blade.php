@extends('layouts.app')
@section('content')
  <div class="row row-mail">
    <div class="mail-col col-md-4 col-lg-3">
     <div class="row title-mail border">
       <h3>Mail degli utenti</h3>
     </div>
     <div class="row contacts border">
       <div class="user">
         <span>Nome</span> <br>
         <span>Cognome</span>
       </div>
     </div>
   </div>
   <div class="mail-col col-md-8 col-lg-9">
     <div class="row row-messages border">
       <h3>Testo della Mail</h3>
     </div>
     <div class="row row-text border">
     </div>
   </div>
 </div>
@endsection
