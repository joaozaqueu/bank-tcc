@extends('adminlte::page')

@section('content')
    @include('admin.client.create')
    @include('admin.client.edit')

    <div class="box">
        <div class="box-header with-border">
          	<h3 class="box-title"><i class="fa fa-users"></i> Lista de Clientes</h3>
            <a href="" class="btn btn-primary pull-right" data-url="{{ route('client.create') }}"
               data-toggle="modal" data-target="#create-client">
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
                    <td width="12%">CPF</td>
                    <td width="18%">AÇÕES</td>
                </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
            <div class="col-md-12 text-center">
                <ul id="pagination" class="pagination pagination-sm no-margin"></ul>
            </div>
        </div>
    </div>

@stop

@section('js')
    <script type="text/javascript">
        var url = "{{ url('admin/client') }}";
    </script>
    <script src="{{ asset('js/helpers/clients.js') }}"></script>
@endsection