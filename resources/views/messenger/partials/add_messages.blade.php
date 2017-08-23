                  <?php $class ='';if(Auth::user() == $message->user) $class ='ltr'; ?>
                  <li class="{{ $class }}">
                      <img src="http://www.iconninja.com/ico/64/avatar-man-old-person-male-mature-user-15874.ico" alt="Avatar" class="img-circle pull-left avatar">
                      <p><b>{{ $message->user->name }}</b><br>{{ $message->body }}<span class="timestamp">{{ $message->created_at->diffForHumans() }}</span></p>
                  </li>
                  <br>