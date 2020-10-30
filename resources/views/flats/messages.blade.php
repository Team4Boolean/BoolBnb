@extends('layouts.app')
@section('content')
  <div class="container">
    <div class="row row-mail">
      <div class="mail-col col-xs-12 col-lg-4">
       <div class="row title-mail border">
         <a id="back-btn" class="my-4" href="{{ url()->previous() }}"> <i class="fas fa-arrow-circle-left"></i> </a>
         <h3>Mail degli utenti</h3>
       </div>
       <div class="row contacts border">
         <ul id="mail-list">
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
     <div class="mail-col col-xs-12 col-lg-8">
       <div class="row row-messages border">
         <h3>Testo della Mail</h3>
       </div>
       <div class="row row-text border" id="mail-body">
         <div class="messages-received">
           <h6>Messaggio da: </h6>
           <span id="show-sender"></span>
         </div>
         <br>
         <div class="messages-date">
           <h6>Inviato alle: </h6>
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

      var hasChild = $('#mail-list').children().length > 0
      if ( !hasChild) {
          $('#mail-body').html(" ");
          $('#mail-body').append("<h2>Non hai ancora ricevuto nessun messaggio</h1> ");
      }

      var target = $('.mail').first();
      target.addClass('active');
      showMailData();
      clickMail();
    }

    $(document).ready(init);
  </script>

@endsection
