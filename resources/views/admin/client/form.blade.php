@if( isset($client) )
<form method="POST" id="form-create-client" action="{{ route('clients.update', $client->id) }}">
    {{ method_field('PUT') }}
@else
<form method="POST" id="form-create-client" action="{{ route('clients.store') }}">
@endif
    {!! csrf_field() !!}

    <div class="col-md-12">
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user-circle"></i></span>
                <input type="text" class="form-control" name="name" placeholder="Name" value="{{$client->name or old('name')}}">
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                <input type="text" class="form-control" name="email" placeholder="Email" value="{{$client->email or old('email')}}">
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-phone-square"></i></span>
                <input type="text" class="form-control" name="phone" placeholder="Telefone" value="{{$client->phone or old('phone')}}">
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-id-card"></i></span>
                <input type="text" class="form-control" name="document" placeholder="CPF" value="{{$client->document or old('document')}}">
            </div>
        </div>
    </div>

    {{--<div class="hidden">--}}
    <button type="submit" id="client-save" class="btn btn-success">save</button>
    {{--</div>--}}
</form>

<script>
    formAddClient = $('#form-create-client');

    formAddClient.on('submit', function (event) {
        event.preventDefault();

        var url = $(this).attr('action');
        var method = $(this).attr('method');
        var data = $(this).serialize();

        console.log(data);
        $.ajax({
            url: url,
            method: method,
            data: data,
            complete: function (xhr) {

            }
        });
    });
</script>