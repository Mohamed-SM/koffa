{{-- \resources\views\categories\index.blade.php --}}
@extends('layouts.app')

@section('title', '| categories')

@section('content')

<div class="col-lg-10 col-lg-offset-1">
    <h1><i class="fa fa-key"></i>Available categories

    <a href="{{ route('users.index') }}" class="btn btn-default pull-right">Users</a>
    <a href="{{ route('roles.index') }}" class="btn btn-default pull-right">Roles</a></h1>
    <hr>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">

            <thead>
                <tr>
                    <th>categories</th>
                    <th>Operation</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $categorie)
                <tr>
                    <td>{{ $categorie->title }}</td> 
                    <td>
                    <a href="{{ URL::to('categories/'.$categorie->id.'/edit') }}" class="btn btn-info pull-left" style="margin-right: 3px;">Edit</a>

                    {!! Form::open(['method' => 'DELETE', 'route' => ['categories.destroy', $categorie->id] ]) !!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                    {!! Form::close() !!}

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <a href="{{ URL::to('categories/create') }}" class="btn btn-success">Add categorie</a>

</div>

@endsection