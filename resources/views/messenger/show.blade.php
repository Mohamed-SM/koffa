@extends('layouts.app')

@section('title', '| Messages')

@section('content')
<div class="main-content">
    <div class="container-fluid">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">{{ $thread->subject }}</h3>
            </div>
            <div class="panel-body">
              
              <div class="text-center">
                <button type="button" class="btn btn-box-tool" id="getall">
                <i class="fa fa-envelope-open" aria-hidden="true"></i> telecharger tout les messages
                </button>
              </div>
              <?php 
                $n_messages = count($thread->messages);
                $i = 0;
              ?>
              <ul class="list-unstyled activity-list" id="msglist">
              @foreach($thread->messages as $message)
                <?php 
                  $i++;
                  if ($i < $n_messages - 4) {
                    continue;
                   } 
                ?>
                  <?php $class ='';if(Auth::user() == $message->user) $class ='ltr'; ?>
                  <li class="{{ $class }}">
                      <img src="http://www.iconninja.com/ico/64/avatar-man-old-person-male-mature-user-15874.ico" alt="Avatar" class="img-circle pull-left avatar">
                      <p><b>{{ $message->user->name }}</b><br>{{ $message->body }}<span class="timestamp">{{ $message->created_at->diffForHumans() }}</span></p>
                  </li>
                  <br>                  
              @endforeach
              </ul>
          </div>
          <!-- /.box-body -->
          <div class="panel-footer">
            <form action="{{ route('messages.update', $thread->id) }}" method="post" id="respond">
              {{ method_field('put') }}
              {{ csrf_field() }}
              <div class="input-group" id="input-group">
                <input name="message" placeholder="Reponce ..." class="form-control" value="{{ old('message') }}" type="text">
                    <span class="input-group-btn">
                    <button type="submit" id="send" class="btn btn-primary btn-flat">Send</button>
                    </span>
              </div>
            </form>
          </div>
        </div>         
    </div>
</div>

  <script type="text/javascript">
  	var time = "{{ $thread->getLatestMessageAttribute()->created_at }}";

    // thisfunction is to scrolle down when the messages are loaded to see the last messages
    //TODO *** change the scrol value and make  calculable
  	function scrtolltolastmessage() {
  		$("msglist").scrollTop(100000000);  
    	console.log($("msglist").scrollTop());
  	}

    //this is to get new messages if ther is any new messages
    /*TODO **
        need more working on and study the get time to make it optimal
        or if possible make the server send the messages automaticly
        with out request that's the best solution
        need to work on it whene don
    */
    $(document).ready(function(){ 
      scrtolltolastmessage();

      window.setInterval(function(){
        console.log("louading evry 10s ...");
        $.post("{{ route('messages.newmessages') }}",
        {
          "_token": $('#respond').find( 'input[name=_token]' ).val(),
          "thread" : "{{ $thread->id }}",
          "time" : time,
        },
        function(data, status){
          console.log(data);
          if (data != '') {
            $("#msglist").append(data);
            scrtolltolastmessage();
          }
        });
      }, 5000);


      /*
      //<a id="get" class="btn btn-primary btn-flat">get</a>
      $("#get").click(function(){
      	console.log("louading ...");
        $.post("{{ route('messages.newmessages') }}",
        {
          "_token": $('#respond').find( 'input[name=_token]' ).val(),
          "thread" : "{{ $thread->id }}",
          "time" : time,
        },
        function(data, status){
          console.log(data);
          if (data != '') {
          	$("#messages-box").append(data);
          	scrtolltolastmessage();
          }
        });
      });

      */
        // to get all the messages if the user ask for it
        // TODO **** change get all to get more
      $("#getall").click(function(){
      	console.log("loading ...");
      	$('#loading').prepend('<div class="overlay" id="don-loading"><i class="fa fa-circle-o-notch fa-spin"></i></div>')
        $.post("{{ route('messages.allmessages') }}",
        {
          "_token": $('#respond').find( 'input[name=_token]' ).val(),
          "thread" : "{{ $thread->id }}",
        },
        function(data, status){
          console.log(data , status);
          if (data != '') {
          	$("#msglist").html(data);
          }
          $('#don-loading').remove();
        });
        $('#getall').remove();
      });

        //send the respande back
      $( '#respond' ).on( 'submit', function(){
        if($('#respond').find( 'input[name=message]' ).val() == ''){
          $('#input-group').addClass('has-error');
          console.log(" not louading ...");
        }
        else{
          $('#input-group').removeClass('has-error');
          console.log("louading ...");
          $.post("{{ route('messages.update', $thread->id) }}",
          {
            "_method" : "put",
            "_token"  : $('#respond').find( 'input[name=_token]' ).val(),
            "message" : $('#respond').find( 'input[name=message]' ).val(),
          },
          function(data, status){
            console.log(data);
            $('#respond').find( 'input[name=message]' ).val('');
            if (data != '') {
              $("#msglist").append(data);
              scrtolltolastmessage();
            }
          });
        }
        return false;
      });

    });
	</script>
@endsection
