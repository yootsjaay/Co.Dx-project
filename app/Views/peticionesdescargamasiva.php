<?= $this->include('julio101290\boilerplate\Views\load\select2') ?>
<?= $this->include('julio101290\boilerplate\Views\load\datatables') ?>
<?= $this->include('julio101290\boilerplate\Views\load\nestable') ?>
<!-- Extend from layout index -->
<?= $this->extend('julio101290\boilerplate\Views\layout\index') ?>

<!-- Section content -->
<?= $this->section('content') ?>

<?= $this->include('modulesPeticionesdescargamasiva/modalCapturePeticionesdescargamasiva') ?>

<!-- SELECT2 EXAMPLE -->
<div class="card card-default">
    <div class="card-header">
        <div class="float-right">
            <div class="btn-group">

                <button class="btn btn-primary btnAddPeticionesdescargamasiva" data-toggle="modal"
                    data-target="#modalAddPeticionesdescargamasiva"><i class="fa fa-plus"></i>

                    <?= lang('peticionesdescargamasiva.add') ?>

                </button>

            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table id="tablePeticionesdescargamasiva"
                        class="table table-striped table-hover va-middle tablePeticionesdescargamasiva">
                        <thead>
                            <tr>

                                <th>#</th>
                                <th>
                                    <?= lang('DesdeFecha') ?>
                                </th>
                                <th>
                                    <?= lang('HastaFecha') ?>
                                </th>
                                <th>
                                    <?= lang('EmitidoRecibido') ?>
                                </th>
                                <th>
                                    <?= lang('TipoPeticion') ?>
                                </th>
                                <th>
                                    <?= lang('uuidPeticion') ?>
                                </th>
                                <th>
                                    <?= lang('created_at') ?>
                                </th>
                                <th>
                                    <?= lang('updated_at') ?>
                                </th>
                                <th>
                                    <?= lang('deleted_at') ?>
                                </th>
                                <th>
                                    <?= lang('nombreArchivo') ?>
                                </th>
                                <th>
                                    <?= lang('status') ?>
                                </th>

                                <th>
                                    <?= lang('actions') ?>
                                </th>

                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.card -->

<?= $this->endSection() ?>


<?= $this->section('js') ?>
<script>

    /**
     * Cargamos la tabla
     */

    var tablePeticionesdescargamasiva = $('#tablePeticionesdescargamasiva').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        autoWidth: false,
        order: [[1, 'desc']],

        ajax: {
            url: '<?= base_url('admin/peticionesdescargamasiva') ?>',
            method: 'GET',
            dataType: "json"
        },
        columnDefs: [{
            orderable: false,
            targets: [11],
            searchable: false,
            targets: [11]

        }],
        columns: [{
            'data': 'id'
        },


        {
            'data': 'desdeFecha'
        },

        {
            'data': 'hastaFecha'
        },

        {
            'data': 'emitidoRecibido'
        },

        {
            'data': 'tipoPeticion'
        },

        {
            'data': 'uuidPeticion'
        },

        {
            'data': 'created_at'
        },

        {
            'data': 'updated_at'
        },

        {
            'data': 'deleted_at'
        },

        {
            'data': 'nombreArchivo'
        },

        {
            'data': 'status'
        },

        {
            "data": function (data) {
                return `<td class="text-right py-0 align-middle">
                         <div class="btn-group btn-group-sm">
                             <button class="btn btn-warning btnEditPeticionesdescargamasiva" data-toggle="modal" idPeticionesdescargamasiva="${data.id}" data-target="#modalAddPeticionesdescargamasiva">  <i class=" fa fa-edit"></i></button>
                             <button class="btn btn-success" data-id="${data.id}"> <a href="<?= base_url() ?>${data.nombreArchivo}" download><i class="far fa-arrow-alt-circle-down"></i></a></button>
                         </div>
                         </td>`
            }
        }
        ]
    });



    $(document).on('click', '#btnSavePeticionesdescargamasiva', function (e) {


        var idPeticionesdescargamasiva = $("#idPeticionesdescargamasiva").val();
        var desdeFecha = $("#desdeFecha").val();
        var hastaFecha = $("#hastaFecha").val();
        var emitidoRecibido = $("#emitidoRecibido").val();
        var tipoPeticion = $("#tipoPeticion").val();
        var uuidPeticion = $("#uuidPeticion").val();
        var nombreArchivo = $("#nombreArchivo").val();
        var status = $("#status").val();
        var idEmpresa = $("#idEmpresa").val();

        $("#btnSavePeticionesdescargamasiva").attr("disabled", true);

        var datos = new FormData();
        datos.append("idPeticionesdescargamasiva", idPeticionesdescargamasiva);
        datos.append("desdeFecha", desdeFecha);
        datos.append("hastaFecha", hastaFecha);
        datos.append("emitidoRecibido", emitidoRecibido);
        datos.append("tipoPeticion", tipoPeticion);
        datos.append("uuidPeticion", uuidPeticion);
        datos.append("nombreArchivo", nombreArchivo);
        datos.append("status", status);
        datos.append("idEmpresa", idEmpresa);


        $.ajax({

            url: "<?= base_url('admin/peticionesdescargamasiva/save') ?>",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            success: function (respuesta) {
                if (respuesta.match(/Correctamente.*/)) {

                    Toast.fire({
                        icon: 'success',
                        title: "Guardado Correctamente"
                    });

                    tablePeticionesdescargamasiva.ajax.reload();
                    $("#btnSavePeticionesdescargamasiva").removeAttr("disabled");


                    $('#modalAddPeticionesdescargamasiva').modal('hide');
                } else {

                    Toast.fire({
                        icon: 'error',
                        title: respuesta
                    });

                    $("#btnSavePeticionesdescargamasiva").removeAttr("disabled");


                }

            }

        }

        )

    });



    /**
     * Carga datos actualizar
     */


    /*=============================================
     EDITAR Peticionesdescargamasiva
     =============================================*/
    $(".tablePeticionesdescargamasiva").on("click", ".btnEditPeticionesdescargamasiva", function () {

        var idPeticionesdescargamasiva = $(this).attr("idPeticionesdescargamasiva");

        var datos = new FormData();
        datos.append("idPeticionesdescargamasiva", idPeticionesdescargamasiva);

        $.ajax({

            url: "<?= base_url('admin/peticionesdescargamasiva/getPeticionesdescargamasiva') ?>",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function (respuesta) {
                $("#idPeticionesdescargamasiva").val(respuesta["id"]);

                $("#desdeFecha").val(respuesta["desdeFecha"]);
                $("#hastaFecha").val(respuesta["hastaFecha"]);
                $("#emitidoRecibido").val(respuesta["emitidoRecibido"]);
                $("#emitidoRecibido").trigger("change");
                $("#tipoPeticion").val(respuesta["tipoPeticion"]);
                $("#uuidPeticion").val(respuesta["uuidPeticion"]);
                $("#nombreArchivo").val(respuesta["nombreArchivo"]);
                $("#status").val(respuesta["status"]);
                $("#idEmpresa").val(respuesta["idEmpresa"]);
                $("#idEmpresa").trigger("change");

                $("#desdeFecha").attr("disabled",true);
                $("#hastaFecha").attr("disabled",true);
                $("#emitidoRecibido").attr("disabled",true);
                $("#idEmpresa").attr("disabled",true);


            }

        })

    })


    /*=============================================
     ELIMINAR peticionesdescargamasiva
     =============================================*/
    $(".tablePeticionesdescargamasiva").on("click", ".btn-delete", function () {

        var idPeticionesdescargamasiva = $(this).attr("data-id");

        Swal.fire({
            title: '<?= lang('boilerplate.global.sweet.title') ?>',
            text: "<?= lang('boilerplate.global.sweet.text') ?>",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '<?= lang('boilerplate.global.sweet.confirm_delete') ?>'
        })
            .then((result) => {
                if (result.value) {
                    $.ajax({
                        url: `<?= base_url('admin/peticionesdescargamasiva') ?>/` + idPeticionesdescargamasiva,
                        method: 'DELETE',
                    }).done((data, textStatus, jqXHR) => {
                        Toast.fire({
                            icon: 'success',
                            title: jqXHR.statusText,
                        });


                        tablePeticionesdescargamasiva.ajax.reload();
                    }).fail((error) => {
                        Toast.fire({
                            icon: 'error',
                            title: error.responseJSON.messages.error,
                        });
                    })
                }
            })
    })

    $(function () {
        $("#modalAddPeticionesdescargamasiva").draggable();

    });


</script>
<?= $this->endSection() ?>