@extends('layouts.app')

@section('title', '| Clinics')

@section('content')
<div class="main-content">
    <div class="container-fluid">
        <div class="panel">
            <div class="panel-body">
                <div class="panel-heading">
                    Clinics
                </div>  
                <div class="custom-tabs-line tabs-line-bottom left-aligned">
                    <ul class="nav" role="tablist">
                        <li class="active"><a href="#tab-bottom-left1" role="tab" data-toggle="tab">Clinics Mape</a></li>
                        <li><a href="#tab-bottom-left2" role="tab" data-toggle="tab">Clinics List</a></li>
                    </ul>
                    @if(Auth::user()->hasRole('Admin') or Auth::user()->hasRole('Medecin'))
                    <a href="{{ route('clinics.create') }}" class="btn btn-primary pull-right" >Nouvelle Clinic</a>
                    @endif
                </div>
                <div class="tab-content">
                    <div class="tab-pane fade in active" id="tab-bottom-left1">
                        <div id="map" style="height: 500px;"></div>                        
                    </div>
                    <div class="tab-pane fade" id="tab-bottom-left2">
                        <div>
                            Page {{ $clinics->currentPage() }} of {{ $clinics->lastPage() }}
                        </div>
                        @foreach ($clinics as $clinic)
                        <div class="panel-body">
                            <li style="list-style-type:disc">
                                <a href="{{ route('clinics.show', $clinic->id ) }}">
                                    <b>{{ $clinic->title }}</b> 
                                    : {{ $clinic->address }} <br>
                                    <p class="teaser">
                                       {{  str_limit($clinic->speciality, 100) }} {{-- Limit teaser to 100 characters --}}
                                    </p>
                                </a>
                            </li>
                        </div>
                        @endforeach
                        <div class="margin-top-30 text-center">
                            {!! $clinics->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>       
    </div>
</div>
<script type="text/javascript">
    @if(count($map_clinics))
    var map = new GMaps({
        el: '#map',
        lat: {{ $map_clinics[0]->lat }},
        lng: {{ $map_clinics[0]->lng }},
        zoom:14
    });
    @else
    var map = new GMaps({
        el: '#map',
        lat: 35,
        lng: 0,
        zoom:9
    });
    @endif
    @foreach($map_clinics as $clinic)
    map.addMarker({
        lat: {{ $clinic->lat }},
        lng: {{ $clinic->lng }},
        title: '{{ $clinic->title }}',
        infoWindow: {
            content: '<div><p><span class="lnr lnr-map-marker"></span> <b>{{ $clinic->title }}</b> : {{ $clinic->address }}</p><p><span class="lnr lnr-user"></span> {{ $clinic->user->name }} {{ $clinic->user->last_name }}</p><p><span class="lnr lnr-phone-handset"></span> {{ $clinic->user->phone }}</p><div class="text-center"><a href="{{ route('clinics.show', $clinic->id ) }}" class="btn btn-primary">Voir</a></div></div>'
        }
    });
    @endforeach
</script>
@endsection