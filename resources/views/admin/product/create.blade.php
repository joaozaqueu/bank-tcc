<div class="modal fade" id="create-product">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <h4 class="text-center">Novo Produto</h4>
                    <form method="POST" id="create-product" action="{{ route('product.store') }}">
                        {!! csrf_field() !!}

                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span>
                                    <input type="text" class="form-control" name="name" placeholder="Nome do Produto" value="">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-reorder"></i></span>
                                    <input type="text" class="form-control" name="description" placeholder="Descrição do Produto" value="">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-money"></i></span>
                                    <input type="text" class="form-control" name="price" placeholder="Preço do Produto" value="">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal" aria-label="Close">Fechar</button>
                            <button type="button" class="btn btn-primary crud-submit pull-right" data-dismiss="modal">Salvar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>