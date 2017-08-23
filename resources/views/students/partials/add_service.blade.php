<li>
<i class="fa fa-user-circle-o activity-icon"></i>
<p>{{$student->name.'_'.$student->last_name}} : {{ $student->birthe }}
<span class="timestamp">{{ $student->created_at->diffForHumans() }}</span>
<br>  
<button type="button" class="btn btn btn-success btn-xs" data-toggle="modal" data-target="#student{{ $student->id }}">
<i class="fa fa-search"></i> Ditail</button>
</p>
</li>

<div id="student{{ $student->id }}" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><b>Malade : </b>{{$student->name.'_'.$student->last_name}} : {{ $student->birthe }}</h4>
      </div>
      <div class="modal-body">
        <p>{{ $student->birthe }}</p>
        @if($student->sex == 'H')
        <p>Homme</p>
        @else
        <p>Femme</p>
        @endif
        <p>{{ $student->address }}</p>
        <p>{{ $student->phone }}</p>
        <p>{{ $student->description }}</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>