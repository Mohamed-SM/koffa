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
    <div id="map"></div>
    <hr>
    {!! Form::open(['method' => 'DELETE', 'route' => ['shops.destroy', $shop->id] ]) !!}
    <a href="{{ url()->previous() }}" class="btn btn-primary">Back</a>
    @if(Auth::user()->hasRole('Admin') or (Auth::user()->id == $shop->user->id))
    @can('Edit Shop')
    <a href="{{ route('shops.edit', $shop->id) }}" class="btn btn-info" role="button">Edit</a>
    @endcan
    @can('Delete Shop')
    @endif
    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
    @endcan
    {!! Form::close() !!}

</div>

<script type="text/javascript">
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
</script>

@endsection