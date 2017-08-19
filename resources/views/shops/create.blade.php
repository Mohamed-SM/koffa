@extends('layouts.app')

@section('title', '| Create New Shop')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

        <h1>Create New Shop</h1>
        <hr>

    {{-- Using the Laravel HTML Form Collective to create our form --}}
        {{ Form::open(array('route' => 'shops.store')) }}

            <div class="form-group">
            {{ Form::label('title', 'Title') }}
            {{ Form::text('title', null, array('class' => 'form-control')) }}
            <br>

            <div class="form-group">
            {{ Form::label('categorie', 'Categorie') }}
            {{ Form::select('categorie', $categories, null, ['id'=> 'categorie', 'placeholder' => 'Categories ...' , 'class' => 'form-control']) }}
            </div>

            {{ Form::label('address', 'Address') }}
            {{ Form::text('address', null, array('class' => 'form-control')) }}
            <br>

            {{ Form::label('description', 'shop description') }}
            {{ Form::textarea('description', null, array('class' => 'form-control')) }}
            <br>
            {{ Form::label('lat', 'Altitud') }}
            {{ Form::text('lat', null, array('class' => 'form-control')) }}<br>
            {{ Form::label('lng', 'Longitud') }}
            {{ Form::text('lng', null, array('class' => 'form-control')) }}<br>
            <hr>
            <div id="map"></div>
            <hr>
            {{ Form::submit('Create shop', array('class' => 'btn btn-success btn-lg btn-block')) }}
            {{ Form::close() }}
        </div>
        </div>
    </div>
<script type="text/javascript">
    var map = new GMaps({
      el: '#map',
      lat: 35.0,
      lng: 0.0,
      zoom:8
    });
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
                title: $("title").text(),
            });
        }
      }]
    });
</script>
@endsection