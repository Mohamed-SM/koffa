@extends('layouts.app')

@section('title', '| View Shop')

@section('content')

<div class="container">

    <h1>{{ $shop->title }}</h1>
    <br>
    @if($shop->categorie)
    <p>{{ $shop->categorie->title }}</p>
    @endif
    <h3>Owner : {{ $shop->user->name.' '. $shop->user->last_name }}</h3>
    <p>{{ $shop->user->phone }}</p>
    <p>Adress : {{ $shop->address }}</p>
    <p>Cordonnée : {{ $shop->lat.",".$shop->lng }}</p>
    <hr>
    <p class="lead">{{ $shop->description }} </p>
    <hr>
    <h1>koffas</h1>
    <p>total number : <span id="n" >{{ count($shop->services) }}</span></p>
    <div id="services" >
    @foreach($shop->services->reverse()->slice(0, 5) as $service )
    <p id="koffa{{$service->id}}" >{{ $service->id .' '.$service->status }} 
    <button
    @if($service->status == "pret")
    disabled="disabled"
    @endif
    onclick="pret({{$service->id}})" >pert</button> </p>
    @endforeach
    </div>
    <button type="button" class="btn btn-info" onclick="openmodel()">Add</button>
    <hr>
    <div id="map"></div>
    <hr>
    {!! Form::open(['method' => 'DELETE', 'route' => ['shops.destroy', $shop->id] ]) !!}
    <a href="{{ url()->previous() }}" class="btn btn-primary">Back</a>
    @if(Auth::user())
    @if(Auth::user()->hasRole('Admin') or (Auth::user()->id == $shop->user->id))
    @can('Edit Shop')
    <a href="{{ route('shops.edit', $shop->id) }}" class="btn btn-info" role="button">Edit</a>
    @endcan
    @can('Delete Shop')
    @endif
    @endif
    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
    @endcan
    {!! Form::close() !!}

</div>

<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modal Header</h4>
      </div>
        {{ Form::open(array('route' => 'shops.store','id'=> 'addService')) }}
        <div class="modal-body"> 
            <div class="input-group" id="input-group">
                <textarea name="description" class="form-control" placeholder="..." ></textarea>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" id="add" class="btn btn-primary btn-flat">add</button>
        </div>
        {{ Form::close() }}
    </div>

  </div>
</div>

<script type="text/javascript">
    var n = {{ count($shop->services) }}
    var map = new GMaps({
      el: '#map',
      lat: {{ $shop->lat }},
      lng: {{ $shop->lng }},
      zoom:17
    });
    map.addMarker({
        lat: {{ $shop->lat }},
        lng: {{ $shop->lng }},
        title: '{{ $shop->title }}',
        infoWindow: {
          content: '<p>{{ $shop->address }}</p>'
        }
      });
    function openmodel(){
        $('#myModal').modal('show');
    }

    function pret(id) {
        $.post(" /services/"+id,
          {
            "_token"  : $('#addService').find( 'input[name=_token]' ).val(),
            "_method" : "put"
          },
          function(data, status){
            console.log(data + status);
            if (data != '') {
                $("#koffa"+id).html(data);
            }
          });
    }
    $( '#addService' ).on( 'submit', function(){
          console.log("louading ...");
          $.post("{{ route('services.store') }}",
          {
            "_token"  : $('#addService').find( 'input[name=_token]' ).val(),
            "shop_id" : {{ $shop->id }},
            "type" : "koffa",
            "description" : $('#addService').find( 'input[name=description]' ).val(),
            "pic" : "no file",
          },
          function(data, status){
            console.log(data + status);
            if (data != '') {
                $("#services").prepend(data);
                $("#n").text(n + 1);
                n++;
            }
          });
        return false;
      });
</script>

@endsection