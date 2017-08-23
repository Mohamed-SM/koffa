<?php $class = $thread->isUnread(Auth::id()) ? 'alert-info' : ''; ?>

<li>
    <img src="http://www.iconninja.com/ico/64/avatar-man-old-person-male-mature-user-15874.ico" alt="Avatar" class="img-circle pull-left avatar">
    <p><a href="{{ route('messages.show', $thread->id) }}"><b>{{ $thread->latestMessage->user->name }}</b> : {{ $thread->subject }}</a><br>{{ $thread->latestMessage->body }}<span class="timestamp">{{ $thread->latestMessage->created_at->diffForHumans() }}</span></p>
</li>