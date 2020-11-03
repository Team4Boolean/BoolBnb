@extends('layouts.app')
@section('content')




  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header ">
            <a style="font-size: 40px" href="{{ url()->previous() }}"><i class="fas fa-arrow-circle-left"></i></a>
            <h2 >Mail "{{ $flat -> title }}"</h2>
          </div>
          <div class="card-body">
            <div class="container-mail container">
              <div class="row row-mail">
                <div class="mail-col  col-lg-4 ">
                  <div class="row title-mail border">

                    <h3>MAIL RICEVUTE</h3>
                  </div>
                  <div class="row contacts ">
                    <ul id="mail-list">
                      @foreach ($messages as $message)
                        <li>
                          <div class="mail" created="{{$message -> created_at}}" >
                            <h6><strong>Inviato da: </strong> <span class="sender">{{$message -> email}}</span></h6>

                            <p class="clamp-line"><strong>Testo messaggio: </strong><span class="message">{{$message -> message}}</span></p>
                          </div>
                        </li>

                      @endforeach

                    </ul>
                  </div>
                </div>
                <div class="mail-right-side mail-col  col-lg-8 ">
                  <div class="row row-messages border">
                    <h3><T>TESTO DELLA MAIL</T></h3>
                  </div>
                  <div class="row row-text border" id="mail-body">
                    <div class="messages-received ">
                      <h6>Messaggio da: </h6>
                      <span id="show-sender"></span>
                      <h6>Inviato alle:</h6>
                      <span id="show-date"></span>
                    </div>
                    <br>
                    <p id="show-message"></p>
                  </div>
                </div>
              </div>
            </div>

          </div>
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

      var message = $('.active').find('.message');
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
