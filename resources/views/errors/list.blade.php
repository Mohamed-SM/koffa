@if (count($errors) > 0)
    @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        <script type="text/javascript">
        $.notify({
            message: '{!! session('flash_message') !!}'
        },{
            type: 'danger',
            offset.y: 100
        });
    </script>
    @endforeach
@endif