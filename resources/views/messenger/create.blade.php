@extends('layouts.app')

@section('title', '| Nouvel message')

@section('plugin')
<!-- Bootstrap Multiselect -->
<link rel="stylesheet" href="{{ asset('vendor/bootstrap-multiselect/bootstrap-multiselect.css') }}">    
<script src="{{ asset('vendor/bootstrap-multiselect/bootstrap-multiselect.js') }}"></script>
@endsection

@section('content')
<div class="main-content">
    <div class="container-fluid">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">Nouvel message</h3>
            </div>
            <div class="panel-body">
                {{ Form::open(array('url' => route('messages.store') , 'class' => 'form-horizontal')) }}

        <div class="box-body">
        <div class="form-group">
          {{ Form::label('subject', 'Sujet' , array('class' => 'col-sm-2 control-label')) }}
          <div class="col-sm-10">
            {{ Form::text('subject', '', array('class' => 'form-control')) }}
          </div>
        </div>

        <div class="form-group">
          <label for="message" class="col-sm-2 control-label">paerticipants</label>
          <div class="col-sm-10">
                  <select id="recipients" name="recipients[]" multiple="multiple">
                    @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name.' '.$user->last_name }}</option>
                    @endforeach
                </select>
            </div>
        </div>


    <script type="text/javascript">
        $(document).ready(function() {
            $('#recipients').multiselect({
                buttonWidth: '100%',
                buttonClass: 'btn btn-block',
                maxHeight: 200,
                enableFiltering: true,
                includeSelectAllOption: true,
                nonSelectedText: 'Selectioner les participants',
                numberDisplayed: 5
            });
            $('.multiselect-container').css({'width':'100%'});
        });
    </script>
        <div class="form-group">
          {{ Form::label('message', 'Message' , array('class' => 'col-sm-2 control-label')) }}
          <div class="col-sm-10">
            {{ Form::textarea('message', '', array('class' => 'form-control')) }}
          </div>
        </div>
        

      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        {{ Form::submit('Envoyer', array('class' => 'btn col-sm-offset-2 btn-primary')) }}
        <a href="{{ config('app.url') }}/messages" class="btn btn-link">Cancel</a>
      </div>
        
      <!-- /.box-footer -->
      {{ Form::close() }}
            </div>
        </div>         
    </div>
</div>
@endsection