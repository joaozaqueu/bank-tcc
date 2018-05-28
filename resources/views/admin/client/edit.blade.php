<div class="modal fade" id="edit-client">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <h4 class="text-center">Novo Cliente</h4>
                    <form method="POST" id="edit-client" action="#">
                        {!! csrf_field() !!}

                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input type="text" class="form-control" name="name" placeholder="Nome do Cliente" value="">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                    <input type="text" class="form-control" name="email" placeholder="E-mail do Cliente" value="">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                    <input type="text" class="form-control" name="phone" placeholder="Telefone do Cliente" value="">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-id-card"></i></span>
                                    <input type="text" class="form-control" name="document" placeholder="CPF do Cliente" value="">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal" aria-label="Close">Fechar</button>
                            <button type="button" class="btn btn-primary crud-submit-edit pull-right" data-dismiss="modal">Salvar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>