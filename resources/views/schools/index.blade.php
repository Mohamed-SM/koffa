@extends('layouts.app')

@section('title', '| Schools')

@section('content')
<div class="main-content">
    <div class="container-fluid">
        <div class="panel">
            <div class="panel-body">
                <div class="panel-heading">
                    Schools
                </div>  
                <div class="custom-tabs-line tabs-line-bottom left-aligned">
                    <ul class="nav" role="tablist">
                        <li class="active"><a href="#tab-bottom-left1" role="tab" data-toggle="tab">Schools Mape</a></li>
                        <li><a href="#tab-bottom-left2" role="tab" data-toggle="tab">Schools List</a></li>
                    </ul>
                    @if(Auth::user()->hasRole('Admin') or Auth::user()->hasRole('Prof'))
                    <a href="{{ route('schools.create') }}" class="btn btn-primary pull-right" >Nouvelle School</a>
                    @endif
                </div>
                <div class="tab-content">
                    <div class="tab-pane fade in active" id="tab-bottom-left1">
                        <div id="map" style="height: 500px;"></div>                        
                    </div>
                    <div class="tab-pane fade" id="tab-bottom-left2">
                        <div>
                            Page {{ $schools->currentPage() }} of {{ $schools->lastPage() }}
                        </div>
                        @foreach ($schools as $school)
                        <div class="panel-body">
                            <li style="list-style-type:disc">
                                <a href="{{ route('schools.show', $school->id ) }}">
                                    <b>{{ $school->title }}</b> 
                                    : {{ $school->address }} <br>
                                    <p class="teaser">
                                       {{  str_limit($school->speciality, 100) }} {{-- Limit teaser to 100 characters --}}
                                    </p>
                                </a>
                            </li>
                        </div>
                        @endforeach
                        <div class="margin-top-30 text-center">
                            {!! $schools->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>       
    </div>
</div>
<script type="text/javascript">
    @if(count($map_schools))
    var map = new GMaps({
        el: '#map',
        lat: {{ $map_schools[0]->lat }},
        lng: {{ $map_schools[0]->lng }},
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
    @foreach($map_schools as $school)
    map.addMarker({
        lat: {{ $school->lat }},
        lng: {{ $school->lng }},
        title: '{{ $school->title }}',
        infoWindow: {
            content: '<div><p><span class="lnr lnr-map-marker"></span> <b>{{ $school->title }}</b> : {{ $school->address }}</p><p><span class="lnr lnr-user"></span> {{ $school->user->name }} {{ $school->user->last_name }}</p><p><span class="lnr lnr-phone-handset"></span> {{ $school->user->phone }}</p><div class="text-center"><a href="{{ route('schools.show', $school->id ) }}" class="btn btn-primary">Voir</a></div></div>'
        }
    });
    @endforeach
</script>
@endsection