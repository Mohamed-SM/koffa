@extends('layouts.app')

@section('title', '| Modifé profile')

@section('content')

<div class="main-content">
    <div class="container-fluid">
        <!-- INPUTS -->
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">Information de Profile</h3>
            </div>
            <div class="panel-body">
                {{ Form::model($user, array('route' => array('users.update', $user->id), 'method' => 'PUT' ,'class' => 'form-horizontal')) }}
                    <div class="form-group">
                        {{ Form::label('name', 'Nom' , array('class' => 'control-label col-sm-2') ) }}
                        <div class="col-sm-10">
                            {{ Form::text('name', null, array('class' => 'form-control')) }}
                        </div>
                    </div>

                    <div class="form-group">
                        {{ Form::label('last_name', 'prenom' , array('class' => 'control-label col-sm-2') ) }}
                        <div class="col-sm-10">
                            {{ Form::text('last_name', null, array('class' => 'form-control')) }}
                        </div>
                    </div>

                    <div class="form-group">
                        {{ Form::label('email', 'Email' , array('class' => 'control-label col-sm-2') ) }}
                        <div class="col-sm-10">
                            {{ Form::email('email', null, array('class' => 'form-control')) }}
                        </div>
                    </div>

                    <div class="form-group">
                        {{ Form::label('phone', 'Phone' , array('class' => 'control-label col-sm-2') ) }}
                        <div class="col-sm-10">
                            {{ Form::text('phone', null, array('class' => 'form-control')) }}
                        </div>
                    </div>

                    <div class='form-group'>
                        <div class="col-sm-offset-2" >
                        @foreach ($roles as $role)
                            {{ Form::checkbox('roles[]',  $role->id, $user->roles ) }}
                            {{ Form::label($role->name, ucfirst($role->name)) }}<br>
                        @endforeach
                        </div>
                    </div>

                    <hr>
                    <p class="col-sm-offset-2 col-sm-10 text-warning">
                    <i class="fa fa-exclamation-circle" aria-hidden="true"></i> Lesser les champ de mot de pass vide pour ne pas changé</p>
                    
                    <div class="form-group">
                        {{ Form::label('password', 'Password', array('class' => 'control-label col-sm-2') ) }}
                        <div class="col-sm-10">
                        {{ Form::password('password', array('class' => 'form-control')) }}
                        </div>
                    </div>
                    
                    <div class="form-group">
                        {{ Form::label('password', 'Confirm Password', array('class' => 'control-label col-sm-2') ) }}
                        <div class="col-sm-10">
                        {{ Form::password('password_confirmation', array('class' => 'form-control')) }}
                        </div>
                    </div>

                    <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                    {{ Form::submit('Enrg', array('class' => 'btn btn-primary')) }}
                    </div>
                    </div>
                {{ Form::close() }}
            </div>
        </div>
        <!-- END INPUTS -->
    </div>
</div>

@endsection