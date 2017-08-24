@extends('layouts.app')

@section('content')
<div class="main-content">
                <div class="container-fluid">
                    <!-- OVERVIEW -->
                    <div class="panel panel-headline">
                        <div class="panel-heading">
                            <h3 class="panel-title">Aperçu total</h3>
                            <p class="panel-subtitle">{{Carbon\Carbon::now()->format('d M Y')}}</p>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="metric">
                                        <span class="icon"><i class="fa fa-shopping-basket"></i></span>
                                        <p>
                                            <span class="number">{{ count($koffas)}} </span>
                                            <span class="title">Koffa</span>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="metric">
                                        <span class="icon"><i class="fa fa-graduation-cap"></i></span>
                                        <p>
                                            <span class="number">203</span>
                                            <span class="title">Eleve</span>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="metric">
                                        <span class="icon"><i class="fa fa-stethoscope"></i></span>
                                        <p>
                                            <span class="number">{{ count($malads) }}</span>
                                            <span class="title">Malad trité</span>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="metric">
                                        <span class="icon"><i class="fa fa-users"></i></span>
                                        <p>
                                            <span class="number">{{count($users)}} </span>
                                            <span class="title">Utilisateurs</span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-9">
                                    <div id="map" style="height: 400px;"></div>
                                </div>
                                <div class="col-md-3">
                                    <div class="weekly-summary text-right">
                                        <span class="number">2,315</span> <span class="percentage"><i class="fa fa-caret-up text-success"></i> 12%</span>
                                        <span class="info-label">Total Sales</span>
                                    </div>
                                    <div class="weekly-summary text-right">
                                        <span class="number">$5,758</span> <span class="percentage"><i class="fa fa-caret-up text-success"></i> 23%</span>
                                        <span class="info-label">Monthly Income</span>
                                    </div>
                                    <div class="weekly-summary text-right">
                                        <span class="number">$65,938</span> <span class="percentage"><i class="fa fa-caret-down text-danger"></i> 8%</span>
                                        <span class="info-label">Total Income</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END OVERVIEW -->
                </div>
            </div>

            <script type="text/javascript">
                @if (count($shops))
                var map = new GMaps({
                    el: '#map',
                    lat: {{ $shops[2]->lat }},
                    lng: {{ $shops[2]->lng }},
                    zoom:16
                });
                @foreach($shops as $shop)
                map.addMarker({
                    lat: {{ $shop->lat }},
                    lng: {{ $shop->lng }},
                    icon : "{{ asset('/map_pins/shop.png')}}",
                    title: '{{ $shop->title }}',
                    infoWindow: {
                        content: '<div><p><span class="lnr lnr-map-marker"></span> <b>{{ $shop->title }}</b> : {{ $shop->address }}</p><p><span class="lnr lnr-user"></span> {{ $shop->user->name }} {{ $shop->user->last_name }}</p><p><span class="lnr lnr-phone-handset"></span> {{ $shop->user->phone }}</p><div class="text-center"><a href="{{ route('shops.show', $shop->id ) }}" class="btn btn-primary">Voir</a></div></div>'
                    }
                });
                @endforeach
                @foreach($clinics as $clinic)
                map.addMarker({
                    lat: {{ $clinic->lat }},
                    lng: {{ $clinic->lng }},
                    icon : "{{ asset('/map_pins/clinic.png')}}",
                    title: '{{ $clinic->title }}',
                    infoWindow: {
                        content: '<div><p><span class="lnr lnr-map-marker"></span> <b>{{ $clinic->title }}</b> : {{ $clinic->address }}</p><p><span class="lnr lnr-user"></span> Dr. {{ $clinic->user->name }} {{ $clinic->user->last_name }}</p><p><span class="lnr lnr-phone-handset"></span> {{ $clinic->user->phone }}</p><div class="text-center"><a href="{{ route('shops.show', $clinic->id ) }}" class="btn btn-primary">Voir</a></div></div>'
                    }
                });
                @endforeach
                @else
                var map = new GMaps({
                    el: '#map',
                    lat: 35,
                    lng: 0,
                    zoom:9
                });
                @endif
            </script>
@endsection
