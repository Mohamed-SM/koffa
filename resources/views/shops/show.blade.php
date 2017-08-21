@extends('layouts.app')

@section('title', '| View Shop')

@section('content')
<div class="main-content">
    <div class="container-fluid">
        <div class="panel panel-profile" style="min-height: 520px">
            <div class="clearfix">
                <!-- LEFT COLUMN -->
                <div class="profile-left">
                    <!-- PROFILE HEADER -->
                    <div class="profile-header">
                        <div class="overlay"></div>
                        <div class="profile-main">
                            <img src="http://icons.iconarchive.com/icons/webalys/kameleon.pics/512/Shop-icon.png" height="100" class="img-circle" alt="Avatar">
                            <h3 class="name">{{ $shop->title }} </h3>
                            @if($shop->categorie)
                            <span class="online-status">{{ $shop->categorie->title }}</span>
                            @endif
                        </div>
                        <div class="profile-stat">
                            <div class="row">
                                <div class="col-md-4 stat-item">
                                    {{ count($shop->services) }}<span>koffas</span>
                                </div>
                                <div class="col-md-4 stat-item">
                                    {{ count($pasPrets) }}<span>koffas pas pret</span>
                                </div>
                                <div class="col-md-4 stat-item">
                                     {{ count($prets) }}<span>Koffa Pret</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END PROFILE HEADER -->
                    <!-- PROFILE DETAIL -->
                    <div class="profile-detail">
                        <div class="profile-info">
                            <h4 class="heading">Basic Info</h4>
                            <ul class="list-unstyled list-justify">
                                <li>Address <span>{{ $shop->address }}</span></li>
                                <li>Owner <span>{{ $shop->user->name.' '.$shop->user->last_name }}</span></li>
                                <li>Mobile <span>{{ $shop->user->phone }}</span></li>
                                <li>Email <span>{{ $shop->user->email }}</span></li>
                            </ul>
                        </div>
                        <div class="profile-info">
                            <h4 class="heading">About</h4>
                            <p>{{ $shop->description }}</p>
                        </div>
                        @if(Auth::user()->id == $shop->user->id or Auth::user()->hasRole('Admin'))
                        <div class="text-center">
                        {!! Form::open(['method' => 'DELETE', 'route' => ['shops.destroy', $shop->id] ]) !!}
                        @if(Auth::user())
                        @if(Auth::user()->hasRole('Admin') or (Auth::user()->id == $shop->user->id))
                        @can('Edit Shop')
                        <a href="{{ route('shops.edit', $shop->id) }}" class="btn btn-primary">Modifier shop</a>
                        <button type="button" class="btn btn-primary" onclick="openmodel()">Ajouté Koffa</button>
                        @endcan
                        @can('Delete Shop')
                        @endif
                        @endif
                        {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                        @endcan
                        {!! Form::close() !!}
                        </div>
                        @endif
                    </div>
                    <!-- END PROFILE DETAIL -->
                </div>
                <!-- END LEFT COLUMN -->
                <!-- RIGHT COLUMN -->
                <div class="profile-right">
                    <h4 class="heading">Sièges</h4>
                    <!-- MAP -->
                    <div class="text-center">
                        <div id="map" style="height: 300px;"></div>
                    </div>
                    <!-- END MAP -->
                    <!-- TABBED CONTENT -->
                    <div class="custom-tabs-line tabs-line-bottom left-aligned">
                        <ul class="nav" role="tablist">
                            <li class="active"><a href="#tab-bottom-left1" role="tab" data-toggle="tab">Koffas</a></li>
                        </ul>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade in active" id="tab-bottom-left1">
                            <ul class="list-unstyled activity-timeline" id="services">
                                @foreach($shop->services->reverse() as $service )
                                <li id="koffa{{$service->id}}">
                                    @if($service->status == "pas pret")
                                    <i class="fa fa-clock-o activity-icon"></i>
                                    @else
                                        @if($service->status == "pret")
                                        <i class="fa fa-star-o activity-icon"></i>
                                        @else
                                        <i class="fa fa-check-circle-o activity-icon"></i>
                                        @endif
                                    @endif
                                    <p>CODE {{$service->shop_id.'_'.$service->id}} : {{ $service->status }}
                                        <span class="timestamp">{{ $service->created_at->diffForHumans() }}</span>
                                        {{ $service->description }}<br>  
                                        @if((Auth::id() == $shop->user->id or Auth::user()->hasRole('Admin')) and $service->status != "delever")
                                            <button type="button"
                                                class="btn btn btn-success btn-xs"
                                                @if($service->status == "pret") 
                                                disabled="disabled"
                                                @endif
                                                onclick="pret({{$service->id}})"
                                                ><i class="fa fa-check-circle-o"></i> pret</button>
                                        @endif
                                        @if($service->status == "pret")
                                            @if(Auth::user()->hasRole('Member') or Auth::user()->hasRole('Admin'))
                                                <button type="button" class="btn btn-success btn-xs" onclick="delever({{$service->id}})"
                                                    @if($service->status == "delever") 
                                                    disabled="disabled"
                                                    @endif
                                                    ><i class="fa fa-hand-rock-o"></i> Delevré</button>
                                            @endif
                                        @endif
                                    </p>
                                </li>
                                <hr>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <!-- END TABBED CONTENT -->
                </div>
                <!-- END RIGHT COLUMN -->
            </div>
        </div>
    </div>
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
                <textarea id="koffa-desc" name="description" class="form-control" placeholder="..." ></textarea>
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
    @if($shop->lat)
    var map = new GMaps({
        el: '#map',
        lat: {{ $shop->lat }},
        lng: {{ $shop->lng }},
        zoom:14
    });
    map.addMarker({
        lat: {{ $shop->lat }},
        lng: {{ $shop->lng }},
        title: '{{ $shop->title }}',
        infoWindow: {
            content: '<div><p><span class="lnr lnr-map-marker"></span> <b>{{ $shop->title }}</b> : {{ $shop->address }}</p><p><span class="lnr lnr-user"></span> {{ $shop->user->name }} {{ $shop->user->last_name }}</p><p><span class="lnr lnr-phone-handset"></span> {{ $shop->user->phone }}</p><div class="text-center"><a href="{{ route('shops.show', $shop->id ) }}" class="btn btn-primary">Voir</a></div></div>'
        }
    });
    @else
    var map = new GMaps({
        el: '#map',
        lat: 35,
        lng: 0,
        zoom:12
    });
    @endif
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
    function delever(id) {
        $.post(" /delever/"+id,
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
          $('#myModal').modal('hide');   
          $.post("{{ route('services.store') }}",
          {
            "_token"  : $('#addService').find( 'input[name=_token]' ).val(),
            "shop_id" : {{ $shop->id }},
            "type" : "koffa",
            "description" : $('#koffa-desc').val(),
            "pic" : "no file",
          },
          function(data, status){
            console.log(data + status);
            if (data != '') {
                $("#services").prepend(data);
            }
          });
        return false;
      });
</script>
@endsection