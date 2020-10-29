@extends('layouts.app')
@section('content')
  <div class="container">
    <div class="row row-mail">
      <div class="mail-col col-md-4 col-lg-3">
       <div class="row title-mail border">
         <h3>Mail degli utenti</h3>
       </div>
       <div class="row contacts border">
         <ul>
            @foreach ($messages as $message)
              <li>
                <div class="mail" created="{{$message -> created_at}}" >
                  <h6><strong>From: </strong> <span class="sender">{{$message -> email}}</span></h6>
                  <p><strong>Testo messaggio: </strong><span id="message">{{$message -> message}}</span></p>
                </div>
              </li>

            @endforeach

         </ul>
       </div>
     </div>
     <div class="mail-col col-md-8 col-lg-9">
       <div class="row row-messages border">
         <h3>Testo della Mail</h3>
       </div>
       <div class="row row-text border">
         <div class="">
           <h3>Messaggio da: </h3>
           <span id="show-sender"></span>
         </div>
         <br>
         <div class="">
           <h4>Inviato alle: </h4>
           <span id="show-date"></span>
         </div>
         <p id="show-message"></p>
       </div>
     </div>
   </div>
  </div>

  <script type="text/javascript">

    function clickMail() {

      $('.mail').click(function(){
        $('.mail').removeClass('active');
        $(this).addClass('active');

      showMailData();
      })
    }

    function showMailData() {

      var sender = $('.active').find('.sender');
      var senderText = sender.html();
      var target =  $('#show-sender');
      target.html('');
      target.append(senderText);

      var date = $('.active').attr('created');
      var target =  $('#show-date');
      target.html('');
      target.append(date);

      var message = $('.active').find('#message');
      var messageText = message.html();
      var target =  $('#show-message');
      target.html('');
      target.append(messageText);

    }

    function init(){

      var target = $('.mail').first();
      target.addClass('active');
      showMailData();

      clickMail();
    }

    $(document).ready(init);
  </script>

@endsection
