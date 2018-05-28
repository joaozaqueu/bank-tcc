<div class="modal fade" id="edit-product">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <h4 class="text-center">Edição de Produto</h4>
                    <form method="PUT" id="edit-product" action="">
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
                            <button type="button" class="btn btn-primary pull-right crud-submit-edit" data-dismiss="modal">Salvar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>