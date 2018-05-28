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
        rows = rows + '<td>'+value.email+'</td>';
        rows = rows + '<td>'+value.phone+'</td>';
        rows = rows + '<td>'+value.document+'</td>';
        rows = rows + '<td data-id="'+value.id+'">';
        rows = rows + '<div class="btn-group">';
        rows = rows + '<button data-toggle="modal" data-target="#edit-client" data-id="'+value.id+'" class="btn btn-primary edit-client"><i class="fa fa-pencil"> </i> Editar</button> ';
        rows = rows + '<button class="btn btn-danger remove-client" data-id="'+value.id+'" ><i class="fa fa-trash"> </i> Deletar</button>';
        rows = rows + '</div>';
        rows = rows + '</td>';
        rows = rows + '</tr>';
    });
    $("tbody").html(rows);
}

$(".crud-submit").click(function(e) {
    e.preventDefault();
    var form_action = $("#create-client").find("form").attr("action");
    var name = $("#create-client").find("input[name='name']").val();
    var email = $("#create-client").find("input[name='email']").val();
    var phone = $("#create-client").find("input[name='phone']").val();
    var document = $("#create-client").find("input[name='document']").val();

    var data = {
        name:name,
        email:email,
        phone: phone,
        document: document
    }

    $.ajax({
        dataType: 'json',
        type:'POST',
        url: form_action,
        data: data
    }).done(function(data){
        getPageData();
        $(".modal").modal('hide');
        toastr.success('Cliente cadastrado com sucesso.', 'Sucesso', {timeOut: 5000});
    });
});

$("body").on("click",".remove-client",function() {
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
            method:'delete',
            url: url + '/' + id,
            complete: function (xhr) {
               swal.close();
                c_obj.remove();
                toastr.success('Cliente deletado com sucesso.', 'Sucesso', {timeOut: 5000});
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

$("body").on("click",".edit-client",function() {
    var id = $(this).data('id');
    var route = `/admin/client/${id}/edit`;

    $.ajax({
        dataType: 'json',
        url: route
    }).done(function(data) {
        $("#edit-client").find("input[name='name']").val(data.name);
        $("#edit-client").find("input[name='email']").val(data.email);
        $("#edit-client").find("input[name='phone']").val(data.phone);
        $("#edit-client").find("input[name='document']").val(data.document);
        $("#edit-client").find("form").attr("action",url + '/' + data.id);
    });
});

$(".crud-submit-edit").click(function(e) {
    e.preventDefault();
    var form_action = $("#edit-client").find("form").attr("action");
    var name = $("#edit-client").find("input[name='name']").val();
    var email = $("#edit-client").find("input[name='email']").val();
    var phone = $("#edit-client").find("input[name='phone']").val();
    var document = $("#edit-client").find("input[name='document']").val();

    var data = {
        name:name,
        email:email,
        phone: phone,
        document: document
    }

    $.ajax({
        dataType: 'json',
        method:'PUT',
        url: form_action,
        data: data
    }).done(function(data){
        getPageData();
        $(".modal").modal('hide');
        toastr.success('Produto editado com sucesso.', 'Sucesso', {timeOut: 5000});
    });
});
