@extends('layouts.app')

@section('title', '| Shops')

@section('content')
<div class="main-content">
    <div class="container-fluid">
        <div class="panel">
            <div class="panel-body">
                <div class="panel-heading">
                    Page {{ $shops->currentPage() }} of {{ $shops->lastPage() }}
                </div>
                
                <div class="custom-tabs-line tabs-line-bottom left-aligned">
                    <ul class="nav" role="tablist">
                        <li class="active"><a href="#tab-bottom-left1" role="tab" data-toggle="tab">Shops Mape</a></li>
                        <li><a href="#tab-bottom-left2" role="tab" data-toggle="tab">Shops List</a></li>
                    </ul>
                </div>
                <div class="tab-content">
                    <div class="tab-pane fade in active" id="tab-bottom-left1">
                        <div id="map" style="height: 500px;"></div>                        
                    </div>
                    <div class="tab-pane fade" id="tab-bottom-left2">
                        @foreach ($shops as $shop)
                        <div class="panel-body">
                            <li style="list-style-type:disc">
                                <a href="{{ route('shops.show', $shop->id ) }}">
                                    <b>{{ $shop->title }}</b> 
                                    : {{ $shop->address }} <br>
                                    <p class="teaser">
                                       {{  str_limit($shop->description, 100) }} {{-- Limit teaser to 100 characters --}}
                                    </p>
                                </a>
                            </li>
                        </div>
                        @endforeach
                        <div class="margin-top-30 text-center">
                            {!! $shops->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>       
    </div>
</div>
<script type="text/javascript">
    var map = new GMaps({
        el: '#map',
        lat: {{ $map_shops[0]->lat }},
        lng: {{ $map_shops[0]->lng }},
        zoom:14
    });
    @foreach($map_shops as $shop)
    map.addMarker({
        lat: {{ $shop->lat }},
        lng: {{ $shop->lng }},
        title: '{{ $shop->title }}',
        infoWindow: {
            content: '<div><p><span class="lnr lnr-map-marker"></span> <b>{{ $shop->title }}</b> : {{ $shop->address }}</p><p><span class="lnr lnr-user"></span> {{ $shop->user->name }} {{ $shop->user->last_name }}</p><p><span class="lnr lnr-phone-handset"></span> {{ $shop->user->phone }}</p><div class="text-center"><a href="{{ route('shops.show', $shop->id ) }}" class="btn btn-primary">Voir</a></div></div>'
        }
    });
    @endforeach
</script>
@endsection