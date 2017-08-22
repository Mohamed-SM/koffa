@extends('layouts.app')

@section('title', '| View Clinic')

@section('content')
<div class="main-content">
    <div class="container-fluid">
        <div class="panel panel-profile" style="min-height: 550px">
            <div class="clearfix">
                <!-- LEFT COLUMN -->
                <div class="profile-left">
                    <!-- PROFILE HEADER -->
                    <div class="profile-header">
                        <div class="overlay"></div>
                        <div class="profile-main">
                            <img src="http://icons.iconarchive.com/icons/webalys/kameleon.pics/512/Shop-icon.png" height="100" class="img-circle" alt="Avatar">
                            <h3 class="name">{{ $clinic->title }} </h3>
                            <span class="online-status">{{ $clinic->speciality }}</span>
                        </div>
                        <div class="profile-stat">
                            <div class="row">
                                <div class="col-md-4 stat-item">
                                    {{ count($clinic->clients) }}<span>Malad trité</span>
                                </div>
                                <div class="col-md-4 stat-item">
                                    0<span>koffas pas pret</span>
                                </div>
                                <div class="col-md-4 stat-item">
                                    0<span>Koffa Pret</span>
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
                                <li>Address <span>{{ $clinic->address }}</span></li>
                                <li>Owner <span>{{ $clinic->user->name.' '.$clinic->user->last_name }}</span></li>
                                <li>Mobile <span>{{ $clinic->user->phone }}</span></li>
                                <li>Email <span>{{ $clinic->user->email }}</span></li>
                            </ul>
                        </div>
                        @if(Auth::user()->id == $clinic->user->id or Auth::user()->hasRole('Admin'))
                            <div class="text-center">
                                {!! Form::open(['method' => 'DELETE', 'route' => ['clinics.destroy', $clinic->id] ]) !!}
                                @if(Auth::user())
                                    @if(Auth::user()->hasRole('Admin') or (Auth::user()->id == $clinic->user->id))
                                        @if(Auth::user()->hasRole('Medecin'))
                                        <a href="{{ route('clinics.edit', $clinic->id) }}" class="btn btn-primary">Modifier clinic</a>
                                        <button type="button" class="btn btn-primary" onclick="openmodel()">Ajouté Koffa</button>
                                        @endif
                                    @endif
                                @endif
                                @if(Auth::user()->hasRole('Medecin'))
                                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                                @endif
                                {!! Form::close() !!}
                            </div>
                        @endif
                    </div>
                    <!-- END PROFILE DETAIL -->
                </div>
                <!-- END LEFT COLUMN -->
                <!-- RIGHT COLUMN -->
                <div class="profile-right">
                    <h4 class="heading">Siège</h4>
                    <!-- MAP -->
                    <div class="text-center">
                        <div id="map" style="height: 300px;"></div>
                    </div>
                    <!-- END MAP -->
                    <!-- TABBED CONTENT -->
                    <div class="custom-tabs-line tabs-line-bottom left-aligned">
                        <ul class="nav" role="tablist">
                            <li class="active"><a href="#tab-bottom-left1" role="tab" data-toggle="tab">Clients</a></li>
                            <li><a href="#tab-bottom-left2" role="tab" data-toggle="tab">About</a></li>
                        </ul>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade in active" id="tab-bottom-left1">
                            <ul class="list-unstyled activity-timeline" id="clients">
                                @foreach($clinic->clients->reverse() as $client)
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
                                @endforeach
                            </ul>
                        </div>
                        <div class="tab-pane fade in" id="tab-bottom-left2">
                            <div class="profile-info">
                                <p>{{ $clinic->description }}</p>
                            </div>
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
        <h4 class="modal-title">Information de malade</h4>
      </div>
        <div class="modal-body">
            {{ Form::open(array('route' => 'clients.store','id'=> 'addmalade','class' => 'form-horizontal')) }} 
            <div class="form-group">
                <div class="col-sm-6">
                    {{ Form::text('name', null, array('class' => 'form-control','placeholder'=>'Nom *')) }}
                </div>
                <div class="col-sm-6">
                    {{ Form::text('last_name', null, array('class' => 'form-control','placeholder'=>'prenom *')) }}
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-6">
                    {{ Form::text('birthe', null, array('class' => 'form-control','placeholder'=>'Date de naissance')) }}
                </div>
                <div class="col-sm-6">
                    <select class="form-control" id="sex" name="sex">
                        <option value="H">Homme</option>
                        <option value="F">Femme</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-6">
                    {{ Form::date('address', null, array('class' => 'form-control','placeholder'=>'Address')) }}
                </div>
                <div class="col-sm-6">
                    {{ Form::date('phone', null, array('class' => 'form-control','placeholder'=>'Telephone')) }}
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-12">
                    {{ Form::textarea('description', null, array('class' => 'form-control','placeholder'=>'Description')) }}
                </div>
            </div>
            {{ Form::close() }}
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button class="btn btn-primary btn-flat" onclick="addmalade()">add</button>
        </div>
    </div>

  </div>
</div>


<script type="text/javascript">
    @if($clinic->lat)
    var map = new GMaps({
        el: '#map',
        lat: {{ $clinic->lat }},
        lng: {{ $clinic->lng }},
        zoom:14
    });
    map.addMarker({
        lat: {{ $clinic->lat }},
        lng: {{ $clinic->lng }},
        title: '{{ $clinic->title }}',
        infoWindow: {
            content: '<div><p><span class="lnr lnr-map-marker"></span> <b>{{ $clinic->title }}</b> : {{ $clinic->address }}</p><p><span class="lnr lnr-user"></span> {{ $clinic->user->name }} {{ $clinic->user->last_name }}</p><p><span class="lnr lnr-phone-handset"></span> {{ $clinic->user->phone }}</p><div class="text-center"><a href="{{ route('clinics.show', $clinic->id ) }}" class="btn btn-primary">Voir</a></div></div>'
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
    function addmalade(){
            console.log("louading ...");
            $('#myModal').modal('hide');
            $.post("{{ route('clients.store') }}",
            {
                "_token"        : $('#addmalade').find( 'input[name=_token]' ).val(),
                "clinic_id"     : {{ $clinic->id }},
                "name"          : $('#addmalade').find( 'input[name=name]' ).val(),
                "last_name"     : $('#addmalade').find( 'input[name=last_name]' ).val(),
                "sex"           : $('#sex').val(),
                "birthe"        : $('#addmalade').find( 'input[name=birthe]' ).val(),
                "address"       : $('#addmalade').find( 'input[name=address]' ).val(),
                "phone"         : $('#addmalade').find( 'input[name=phone]' ).val(),
                "description"   : $('#addmalade').find( 'textarea[name=description]' ).val(),
                "pic"           : "no file",
            },
            function(data, status){
                console.log(data + status);
                if (data != '') {
                    $("#clients").prepend(data);
                }
            });
        return false;
    };
</script>
@endsection