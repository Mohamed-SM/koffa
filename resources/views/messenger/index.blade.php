@extends('layouts.app')

@section('title', '| Messages')

@section('content')
<style type="text/css">
  .bg-gray{
    background-color: #F0F0F0;
  }
</style>
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
                <h3 class="box-title"><i class="fa fa-envelope-o"></i> {{ Auth::user()->newThreadsCount() }} messages non lu</h3>
                <hr>
                <ul class="list-unstyled activity-list">
                    @if(count($threads))
                    @foreach($threads as $thread)
                    <?php $class = $thread->isUnread(Auth::id()) ? 'bg-gray' : ''; ?>
                    <li class="{{ $class }}">
                        <img src="http://www.iconninja.com/ico/64/avatar-man-old-person-male-mature-user-15874.ico" alt="Avatar" class="img-circle pull-left avatar">
                        <p><a href="{{ route('messages.show', $thread->id) }}"><b>{{ $thread->latestMessage->user->name }}</b> : {{ $thread->subject }}</a><br>{{ $thread->latestMessage->body }}<span class="timestamp">{{ $thread->latestMessage->created_at->diffForHumans() }}</span></p>
                    </li>
                    @endforeach
                    @else
                    aucun messages
                    @endif
                </ul>
                <button type="button" class="btn btn-primary btn-bottom center-block">Load More</button>
            </div>
        </div>         
    </div>
</div>
@endsection
