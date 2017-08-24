@extends('layouts.app')

@section('title', '| Users')

@section('content')


<div class="main-content">
    <div class="container-fluid">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">Tout les utilisateurs</h3>
                @if(Auth::user()->hasRole('Admin'))
                <a href="{{ route('users.create') }}" class="btn btn-primary pull-right" >Nouvelle Clinic</a>
                @endif
            </div>
            <div class="panel-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone number</th>
                            <th>User Roles</th>
                            <th>Operations</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr>

                            <td>{{ $user->name .' '.$user->last_name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->phone }}</td>
                            <td>{{ $user->roles()->pluck('name')->implode(' ') }}</td>
                            {{-- Retrieve array of roles associated to a user and convert to string --}}
                            <td>
                            {!! Form::open(['method' => 'DELETE', 'route' => ['users.destroy', $user->id] ]) !!}
                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-info pull-left" style="margin-right: 3px;">Edit</a>
                            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}

                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            </div>
        </div>       
    </div>
</div>
@endsection
