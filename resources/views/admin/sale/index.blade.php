@extends('adminlte::page')

@section('content')
    <div class="col-md-6">
        <div class="box">
            <div class="box-body">
                <div class="form-group col-md-8">
                    <label for="product_select">Produto</label>
                    <select class="form-control select2" id="product_select" name="product_select[]" style="width: 100%;"></select>
                </div>
                <div class="form-group col-md-4">
                    <label for="quantity_product">Quantidade</label>
                    <input id="quantity_product" type="text" value="" name="quantity_product">
                </div>
                <div class="form-group col-md-12">
                    <button type="button" class="btn btn-block btn-primary" id="add_product">Adicionar produto</button>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="box">
            <div class="box-header">
                <h4>Lista de Produtos</h4>
            </div>
            <div class="box-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="width: 10px">Nº</th>
                            <th>Nome</th>
                            <th>Custo Uni.</th>
                            <th>Qtd.</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody id="list_products_sale">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('js')
<script>

    $('#add_product').on('click', function (event) {
        event.preventDefault();

        var url = '{{ route('admin.include-product') }}';
        var sale = '{{ $sale->id }}';
        var product = $('#product_select').val()
        var quantity = $('#quantity_product').val()

        $.ajax({
            url: url,
            method: 'post',
            data: { sale: sale, product: product, quantity: quantity },
            complete: function (data) {
                saleHandler.listProducts()
            }
        })
    })

    $("input[name='quantity_product']").TouchSpin();

    $('#product_select').select2({
        placeholder: "Pesquisar Produto",
        minimumInputLength: 2,
        ajax: {
            url: '{{ route('admin.product-for-sale') }}',
            dataType: 'json',
            data: function (params) {
                console.log(params);
                var r = {
                    q: $.trim(params.term)
                };

                console.log(r);
                return r
            },
            processResults: function (data) {
                return {
                    results: data
                };
            },
            cache: true
        }
    });

    saleHandler = {
        list: $('#list_products_sale'),
        listProducts: function () {
            var url = '{{ route('admin.list-products-sale', $sale->id) }}';

            $.ajax({
                dataType: 'json',
                url: url,
            }).done(function(data) {
                var	rows = '';

                $.each( data, function( key, value ) {
                    rows = rows + '<tr>';
                    rows = rows + '<td>'+'</td>';
                    rows = rows + '<td>'+value.name+'</td>';
                    rows = rows + '<td>'+value.price+'</td>';
                    rows = rows + '<td>'+value.quantity+'</td>';
                    rows = rows + '<td>'+value.total+'</td>';
                    rows = rows + '</tr>';
                });
                $('#list_products_sale').html(rows);
            });
        },
        init: function () {
            this.listProducts()
        }
    }

    saleHandler.init()
</script>
@endsection
