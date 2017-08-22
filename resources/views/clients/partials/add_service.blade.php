<li>
<i class="fa fa-user-circle-o activity-icon"></i>
<p>{{$client->name.'_'.$client->last_name}} : {{ $client->birthe }}
<span class="timestamp">{{ $client->created_at->diffForHumans() }}</span>
<br>  
<button type="button" class="btn btn btn-success btn-xs" data-toggle="modal" data-target="#client{{ $client->id }}">
<i class="fa fa-search"></i> Ditail</button>
</p>
</li>

<div id="client{{ $client->id }}" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><b>Malade : </b>{{$client->name.'_'.$client->last_name}} : {{ $client->birthe }}</h4>
      </div>
      <div class="modal-body">
        <p>{{ $client->birthe }}</p>
        @if($client->sex == 'H')
        <p>Homme</p>
        @else
        <p>Femme</p>
        @endif
        <p>{{ $client->address }}</p>
        <p>{{ $client->phone }}</p>
        <p>{{ $client->description }}</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>