{{-- \resources\views\categoriess\create.blade.php --}}
@extends('layouts.app')

@section('title', '| Create categories')

@section('content')

<div class='col-lg-4 col-lg-offset-4'>

    <h1><i class='fa fa-key'></i> Add categories</h1>
    <br>

    {{ Form::open(array('url' => 'categories')) }}

    <div class="form-group">
        {{ Form::label('title', 'Categorie') }}
        {{ Form::text('title', '', array('class' => 'form-control')) }}
        <br>

        {{ Form::label('description', 'shop description') }}
        {{ Form::textarea('description', null, array('class' => 'form-control')) }}
        <br>
    </div>
    
    <br>
    {{ Form::submit('Add', array('class' => 'btn btn-primary')) }}

    {{ Form::close() }}

</div>

@endsection