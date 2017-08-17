@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading"><h3>Shops</h3></div>
                    <div class="panel-heading">Page {{ $shops->currentPage() }} of {{ $shops->lastPage() }}</div>
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
                    </div>
                    <div class="text-center">
                        {!! $shops->links() !!}
                    </div>
                </div>
            </div>
        </div>
@endsection