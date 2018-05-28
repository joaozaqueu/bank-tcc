@extends('adminlte::page')

@section('content')

    @include('admin.product.create')
    @include('admin.product.edit')

    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-product-hunt"></i> Lista de Produtos</h3>
            <a href="#" class="btn btn-primary pull-right" data-toggle="modal" data-target="#create-product">
                <i class="fa fa-plus"></i> Novo Produto
            </a>
        </div>
        <div class="box-body">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <td width="33%">NOME</td>
                    <td width="37%">DESCRIÇÃO</td>
                    <td width="12%">PREÇO</td>
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
@endsection

@section('js')
    <script type="text/javascript">
        var url = "{{ url('admin/product') }}";
    </script>
    <script src="{{ asset('js/helpers/products.js') }}"></script>
@endsection