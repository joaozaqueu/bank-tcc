@extends('adminlte::page')

@section('content')

    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Default Modal</h4>
                </div>
                <div class="modal-body">
                    <div class="col-md-12" id="client-form">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="save-client" data-dismiss="modal">Salvar</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <div class="box">
        <div class="box-header with-border">
          	<h3 class="box-title">Lista de Clientes</h3>
            <a href="" class="btn btn-default pull-right" data-url="{{ route('clients.create') }}" data-toggle="modal" data-target="#modal-default">
                <i class="fa fa-plus"></i> Novo Cliente
            </a>
        </div>
        <div class="box-body">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <td width="33%">NOME</td>
                    <td width="22%">E-MAIL</td>
                    <td width="15%">TELEFONE</td>
                    <td width="15%">CPF</td>
                    <td width="15%">AÇÕES</td>
                </tr>
                </thead>

                <tbody>
                @foreach ($clients as $client)
                    <tr>
                        <td>{{ $client->name }}</td>
                        <td>{{ $client->email }}</td>
                        <td>{{ $client->phone }}</td>
                        <td>{{ $client->document }}</td>
                        <td>
                            <div class="btn-group">
                                <a href="" class="btn btn-primary" data-url="{{ route('clients.edit', $client->id) }}" data-toggle="modal" data-target="#modal-default"><i class="fa fa-pencil"></i></a>
                                <a href="#" class="btn btn-info"><i class="fa fa-eye"></i></a>
                                {{--<a href="{{ route('clients.destroy', $client->id) }}" class="btn btn-danger" data-token="{{ csrf_token() }}"
                                   data-method="delete" data-confirm="Are you sure?"><i class="fa fa-trash"></i></a>--}}
                                <a href="#" data-delete="{{ route('clients.destroy', $client->id) }}" class="btn btn-danger">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="col-md-12 text-center">
                {{ $clients->links() }}
            </div>
        </div>
    </div>

@stop

@section('js')
    <script>
    @if(Session::has('message'))
        var type = "{{ Session::get('alert-type', 'info') }}";
        switch(type){
            case 'info':
                toastr.info("{{ Session::get('message') }}");
                break;

            case 'warning':
                toastr.warning("{{ Session::get('message') }}");
                break;

            case 'success':
                toastr.success("{{ Session::get('message') }}");
                break;

            case 'error':
                toastr.error("{{ Session::get('message') }}");
                break;
        }
    @endif


        $('[data-target="#modal-default"]').on('click', function () {
            var url = $(this).data('url');

            $('#e_modal_client').on('show.bs.modal');
            $.ajax({
                url: url,
                method: 'get',
                complete: function (data) {
                    $("#client-form").html(data.responseText);
                }
            });
        });

        $('#save-client').on('click', function () {
            $('#client-save').trigger('click');
        });

        $(function () {

            var dataDelete = $('[data-delete]');
            if(dataDelete.length){
                dataDelete.on('click', function () {
                    var url = $(this).data('delete');
                    swal({
                        title: "Confirma a exclusão deste registro?",
                        text: null,
                        type: "info",
                        showCancelButton: true,
                        cancelButtonText: "Cancelar",
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Confirmar",
                        closeOnConfirm: false
                    }, function () {
                        $.ajax({
                            url: url,
                            method: 'post',
                            data: {_method:'delete'},
                            complete: function (xhr) {
                                if (200 == xhr.status) {
                                    swal("", xhr.responseJSON['message'], "success");
                                    window.setTimeout(function(){
                                        location.reload();
                                        swal.close();
                                    }, 1000);
                                } else {
                                    swal("Oops!", xhr.responseJSON['message'], "error");
                                }
                            },
                            beforeSend: function () {
                                swal({
                                    title: "Excluindo...",
                                    text: "Aguarde",
                                    type: "info",
                                    showConfirmButton: false
                                });
                            }
                        });
                    });
                });
            }
        });
    </script>
@endsection