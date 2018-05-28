var page = 1;
var current_page = 1;
var total_page = 0;
var is_ajax_fire = 0;

manageData();

function manageData() {
    $.ajax({
        dataType: 'json',
        url: url,
        data: {page:page}
    }).done(function(data) {
        total_page = data.last_page;
        current_page = data.current_page;
        $('#pagination').twbsPagination({
            totalPages: total_page,
            visiblePages: current_page,
            onPageClick: function (event, pageL) {
                page = pageL;
                if(is_ajax_fire != 0){
                    getPageData();
                }
            }
        });
        manageRow(data.data);
        is_ajax_fire = 1;
    });
}

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function getPageData() {
    $.ajax({
        dataType: 'json',
        url: url,
        data: {page:page}
    }).done(function(data) {
        manageRow(data.data);
    });
}

function manageRow(data) {
    var	rows = '';
    $.each( data, function( key, value ) {
        rows = rows + '<tr>';
        rows = rows + '<td>'+value.name+'</td>';
        rows = rows + '<td>'+value.description+'</td>';
        rows = rows + '<td>'+value.price+'</td>';
        rows = rows + '<td data-id="'+value.id+'">';
        rows = rows + '<div class="btn-group">';
        rows = rows + '<button data-toggle="modal" data-target="#edit-product" data-id="'+value.id+'" class="btn btn-primary edit-product"><i class="fa fa-pencil"> </i> Editar</button> ';
        rows = rows + '<button class="btn btn-danger remove-product" data-id="'+value.id+'" ><i class="fa fa-trash"> </i> Deletar</button>';
        rows = rows + '</div>';
        rows = rows + '</td>';
        rows = rows + '</tr>';
    });
    $("tbody").html(rows);
}

$(".crud-submit").click(function(e) {
    e.preventDefault();
    var form_action = $("#create-product").find("form").attr("action");
    var name = $("#create-product").find("input[name='name']").val();
    var description = $("#create-product").find("input[name='description']").val();
    var price = $("#create-product").find("input[name='price']").val();

    $.ajax({
        dataType: 'json',
        type:'POST',
        url: form_action,
        data:{name:name, description:description, price: price}
    }).done(function(data){
        getPageData();
        $(".modal").modal('hide');
        toastr.success('Um novo produto foi cadastrado.', 'Sucesso', {timeOut: 5000});
    });
});

$("body").on("click",".remove-product",function() {
    var id = $(this).data('id');
    var c_obj = $(this).parents("tr");

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
            dataType: 'json',
            type:'delete',
            url: url + '/' + id,
            complete: function (xhr) {
               swal.close();
                c_obj.remove();
                toastr.success('Produto deletado com sucesso.', 'Sucesso', {timeOut: 5000});
                getPageData();

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

$("body").on("click",".edit-product",function() {
    var id = $(this).data('id');
    var route = `/admin/product/${id}/edit`;

    $.ajax({
        dataType: 'json',
        url: route
    }).done(function(data) {
        $("#edit-product").find("input[name='name']").val(data.name);
        $("#edit-product").find("input[name='description']").val(data.description);
        $("#edit-product").find("input[name='price']").val(data.price);
        $("#edit-product").find("form").attr("action",url + '/' + data.id);
    });
});

$(".crud-submit-edit").click(function(e) {
    e.preventDefault();
    var form_action = $("#edit-product").find("form").attr("action");
    var name = $("#edit-product").find("input[name='name']").val();
    var description = $("#edit-product").find("input[name='description']").val();
    var price = $("#edit-product").find("input[name='price']").val();

    $.ajax({
        dataType: 'json',
        method:'PUT',
        url: form_action,
        data:{name:name, description:description, price:price}
    }).done(function(data){
        getPageData();
        $(".modal").modal('hide');
        toastr.success('Produto editado com sucesso.', 'Sucesso', {timeOut: 5000});
    });
});
