@extends('layouts.app')

@section('title', '| Messages')

@section('content')
<div class="main-content">
    <div class="container-fluid">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">Messages recents</h3>
                <div class="right">
                    <a href="{{ route('messages.create') }}" class="btn btn-primary">Nouvelle message</a>
                </div>
            </div>
            <div class="panel-body">
            	<hr>
                <ul class="list-unstyled activity-list">
                    @each('messenger.partials.thread', $threads, 'thread', 'messenger.partials.no-threads')
                </ul>
                <button type="button" class="btn btn-primary btn-bottom center-block">Load More</button>
            </div>
        </div>         
    </div>
</div>
@endsection