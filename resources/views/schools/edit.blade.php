@extends('layouts.app')

@section('title', '| Edit School')

@section('content')
<div class="main-content">
    <div class="container-fluid">
        <!-- INPUTS -->
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">Information de Shop</h3>
            </div>
            <div class="panel-body">
                {{ Form::model($school, array('route' => array('schools.update', $school->id), 'method' => 'PUT','class' => 'form-horizontal')) }}
                    <div class="form-group">
                        {{ Form::label('title', 'Title' , array('class' => 'control-label col-sm-2') ) }}
                        <div class="col-sm-10">
                            {{ Form::text('title', null, array('class' => 'form-control')) }}
                        </div>
                    </div>

                    <div class="form-group">
                        {{ Form::label('speciality', 'Speciality' , array('class' => 'control-label col-sm-2') ) }}
                        <div class="col-sm-10">
                            {{ Form::text('speciality', null, array('class' => 'form-control')) }}
                        </div>
                    </div>                    

                    <div class="form-group">
                        {{ Form::label('address', 'Address' , array('class' => 'control-label col-sm-2') ) }}
                        <div class="col-sm-10">
                            {{ Form::text('address', null, array('class' => 'form-control')) }}
                        </div>
                    </div>

                    <div class="form-group">
                        {{ Form::label('description', 'description' , array('class' => 'control-label col-sm-2') ) }}
                        <div class="col-sm-10">
                            {{ Form::textarea('description', null, array('class' => 'form-control')) }}
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        {{ Form::label('lat', 'Cordoneées' , array('class' => 'control-label col-sm-2') ) }}
                        <div class="col-sm-5">
                            {{ Form::text('lat', null, array('class' => 'form-control')) }}
                        </div>
                        <div class="col-sm-5">
                            {{ Form::text('lng', null, array('class' => 'form-control' , 'id' => 'lng')) }}
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <div id="map" style="height: 400px;"></div>
                    </div>
                    </div>
                    <hr>
                    <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                    {{ Form::submit('Enrg', array('class' => 'btn btn-primary')) }}
                    </div>
                    </div>
                {{ Form::close() }}
            </div>
        </div>
        <!-- END INPUTS -->
    </div>
</div>
<script type="text/javascript">
    @if($school->lat == null); //if the cords are null
    var map = new GMaps({
      el: '#map',
      lat: 35.0,
      lng: 0.0,
      zoom:8
    });
    @else
    var map = new GMaps({
      el: '#map',
      lat: {{ $school->lat }},
      lng: {{ $school->lng }},
      zoom:14
    });
    map.addMarker({
                lat: {{ $school->lat }},
                lng: {{ $school->lng }},
                title: '{{ $school->title }}'
            });
    @endif
    map.setContextMenu({
      control: 'map',
      options: [{
        title: 'Add marker',
        name: 'add_marker',
        action: function(e) {
            this.removeMarkers();
            $("#lat").val(e.latLng.lat());
            $("#lng").val(e.latLng.lng());
            this.addMarker({
                lat: e.latLng.lat(),
                lng: e.latLng.lng(),
                title: '{{ $school->title }}'
            });
        }
      }]
    });
</script>
@endsection