@extends('layouts.app')

@section('title', '| Edit Shop')

@section('content')
<div class="row">

    <div class="col-md-8 col-md-offset-2">

        <h1>Edit Shop</h1>
        <hr>
            {{ Form::model($shop, array('route' => array('shops.update', $shop->id), 'method' => 'PUT')) }}
            <div class="form-group">
            {{ Form::label('title', 'Title') }}
            {{ Form::text('title', null, array('class' => 'form-control')) }}<br>

            <div class="form-group">
            {{ Form::label('categorie', 'Categorie') }}
            {{ Form::select('categorie', $categories, null, ['id'=> 'categorie', 'placeholder' => 'Categories ...' , 'class' => 'form-control']) }}
            </div>

            {{ Form::label('address', 'Address') }}
            {{ Form::text('address', null, array('class' => 'form-control')) }}<br>

            {{ Form::label('description', 'Description') }}
            {{ Form::textarea('description', null, array('class' => 'form-control')) }}<br>
            <hr>
            {{ Form::label('lat', 'Altitud') }}
            {{ Form::text('lat', null, array('class' => 'form-control')) }}<br>
            {{ Form::label('lng', 'Longitud') }}
            {{ Form::text('lng', null, array('class' => 'form-control')) }}<br>
            <hr>
            <div id="map"></div>
            <hr>
            {{ Form::submit('Save', array('class' => 'btn btn-primary')) }}

            {{ Form::close() }}
    </div>
    </div>
</div>
<script type="text/javascript">
    @if($shop->lat == null); //if the cords are null
    var map = new GMaps({
      el: '#map',
      lat: 35.0,
      lng: 0.0,
      zoom:8
    });
    @else
    var map = new GMaps({
      el: '#map',
      lat: {{ $shop->lat }},
      lng: {{ $shop->lng }},
      zoom:12
    });
    map.addMarker({
                lat: {{ $shop->lat }},
                lng: {{ $shop->lng }},
                title: '{{ $shop->title }}'
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
                title: '{{ $shop->title }}'
            });
        }
      }]
    });
</script>
@endsection