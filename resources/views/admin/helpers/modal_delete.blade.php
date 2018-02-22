<style>

</style>

<div class="modal fade" id="modal-delete">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <form action="{{ route('clients.destroy', $client->id) }}" id="form_delete" method="post">
                    <input type="hidden" name="_method" value="delete">
                    <div class="hidden">{{ csrf_token() }}</div>
                    <button type="button" data-dismiss="modal" class="btn btn-default">NÃO</button>
                    <button type="submit" class="btn btn-danger">SIM</button>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<script>
    var form_delete = $('#form_delete');

    $('#modal-delete').on('show.bs.modal', function (el) {
        var target = $(el.relatedTarget);
        var action = target.data('url');

        form_delete.attr('action', action);
    })

</script>