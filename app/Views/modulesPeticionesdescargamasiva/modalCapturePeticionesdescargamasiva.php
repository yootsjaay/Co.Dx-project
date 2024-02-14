<!-- Modal Peticionesdescargamasiva -->
<div class="modal fade" id="modalAddPeticionesdescargamasiva" tabindex="-1" role="dialog" aria-labelledby="modalAddPeticionesdescargamasiva" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?= lang('peticionesdescargamasiva.createEdit') ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-peticionesdescargamasiva" class="form-horizontal">
                    <input type="hidden" id="idPeticionesdescargamasiva" name="idPeticionesdescargamasiva" value="0">



                    <div class="form-group row">
                        <label for="emitidoRecibido" class="col-sm-2 col-form-label">Empresa</label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
                                </div>

                                <select class="form-control" name="idEmpresa" id="idEmpresa" style = "width:80%;">
                                    <option value="0">Seleccione empresa</option>
                                    <?php
                                   // $empresas= $titulos["empresas"];
                                    foreach ($empresas as $key => $value) {

                                        echo "<option value='$value[id]'>$value[id] - $value[nombre] </option>  ";
                                    }
                                    ?>

                                </select>

                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="desdeFecha" class="col-sm-2 col-form-label">Desde Fecha</label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
                                </div>
                                <input type="datetime-local" name="desdeFecha" id="desdeFecha" class="form-control <?= session('error.desdeFecha') ? 'is-invalid' : '' ?>" value="<?= old('desdeFecha') ?>" placeholder="<?= lang('peticionesdescargamasiva.fields.desdeFecha') ?>" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="hastaFecha" class="col-sm-2 col-form-label">Hasta Fecha</label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
                                </div>
                                <input type="datetime-local" name="hastaFecha" id="hastaFecha" class="form-control <?= session('error.hastaFecha') ? 'is-invalid' : '' ?>" value="<?= old('hastaFecha') ?>" placeholder="<?= lang('peticionesdescargamasiva.fields.hastaFecha') ?>" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="emitidoRecibido" class="col-sm-2 col-form-label">Tipo</label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
                                </div>

                                <select class="form-control" name="emitidoRecibido" id="emitidoRecibido" style = "width:80%;">
                                    <option value="0">Seleccione opciòn</option>
                                    <option value="emitido">Emitido</option>
                                    <option value="recibido">Recibido</option>

                                </select>

                            </div>
                        </div>
                    </div>
                    <div class="form-group row" hidden>
                        <label for="tipoPeticion" class="col-sm-2 col-form-label">Tipo Petición</label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
                                </div>
                                <select class="form-control" id="tipoPeticion" name="tipoPeticion" style = "width:80%;">

                                    <option value="XML">XML</option>

                                    <option value="META DATA">META DATA</option>
                                </select>

                            </div>
                        </div>
                    </div>
                    <div class="form-group row" hidden>
                        <label for="uuidPeticion" class="col-sm-2 col-form-label"><?= lang('peticionesdescargamasiva.fields.uuidPeticion') ?></label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
                                </div>
                                <input type="text" name="uuidPeticion" id="uuidPeticion" class="form-control <?= session('error.uuidPeticion') ? 'is-invalid' : '' ?>" value="<?= old('uuidPeticion') ?>" placeholder="<?= lang('peticionesdescargamasiva.fields.uuidPeticion') ?>" autocomplete="off">
                            </div>
                        </div>
                    </div>




                    <div class="form-group row" hidden>
                        <label for="nombreArchivo" class="col-sm-2 col-form-label"><?= lang('peticionesdescargamasiva.fields.nombreArchivo') ?></label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
                                </div>
                                <input type="text" name="nombreArchivo" id="nombreArchivo" class="form-control <?= session('error.nombreArchivo') ? 'is-invalid' : '' ?>" value="<?= old('nombreArchivo') ?>" placeholder="<?= lang('peticionesdescargamasiva.fields.nombreArchivo') ?>" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row" hidden>
                        <label for="status" class="col-sm-2 col-form-label"><?= lang('peticionesdescargamasiva.fields.status') ?></label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
                                </div>
                                <input type="text" name="status" id="status" class="form-control <?= session('error.status') ? 'is-invalid' : '' ?>" value="<?= old('status') ?>" placeholder="<?= lang('peticionesdescargamasiva.fields.status') ?>" autocomplete="off">
                            </div>
                        </div>
                    </div>


                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal"><?= lang('boilerplate.global.close') ?></button>
                <button type="button" class="btn btn-primary btn-sm" id="btnSavePeticionesdescargamasiva"><?= lang('boilerplate.global.save') ?></button>
            </div>
        </div>
    </div>
</div>

<?= $this->section('js') ?>


<script>

    $("#emitidoRecibido").select2();
    $("#tipoPeticion").select2();

    $(document).on('click', '.btnAddPeticionesdescargamasiva', function (e) {


        $(".form-control").val("");

        $("#idPeticionesdescargamasiva").val("0");

        $("#btnSavePeticionesdescargamasiva").removeAttr("disabled");

        $("#desdeFecha").removeAttr("disabled");
        $("#hastaFecha").removeAttr("disabled");
        $("#emitidoRecibido").removeAttr("disabled");
        $("#idEmpresa").removeAttr("disabled");
        $("#emitidoRecibido").val("0");
        $("#emitidoRecibido").trigger("change");

        $("#idEmpresa").val("0");
        $("#idEmpresa").trigger("change");


    });

    /* 
     * AL hacer click al editar
     */



    $(document).on('click', '.btnEditPeticionesdescargamasiva', function (e) {


        var idPeticionesdescargamasiva = $(this).attr("idPeticionesdescargamasiva");

        //LIMPIAMOS CONTROLES
        $(".form-control").val("");

        $("#idPeticionesdescargamasiva").val(idPeticionesdescargamasiva);
        $("#btnGuardarPeticionesdescargamasiva").removeAttr("disabled");

    });
</script>


<?= $this->endSection() ?>