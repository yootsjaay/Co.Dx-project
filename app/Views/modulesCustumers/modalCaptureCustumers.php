<!-- Modal Custumers -->
  <div class="modal fade" id="modalAddCustumers" tabindex="-1" role="dialog" aria-labelledby="modalAddCustumers" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title"><?= lang('custumers.createEdit') ?></h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <form id="form-custumers" class="form-horizontal">
                      <input type="hidden" id="idCustumers" name="idCustumers" value="0">

                      <div class="form-group row">
    <label for="firstname" class="col-sm-2 col-form-label"><?= lang('custumers.fields.firstname') ?></label>
    <div class="col-sm-10">
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
            </div>
            <input type="text" name="firstname" id="firstname" class="form-control <?= session('error.firstname') ? 'is-invalid' : '' ?>" value="<?= old('firstname') ?>" placeholder="<?= lang('custumers.fields.firstname') ?>" autocomplete="off">
        </div>
    </div>
</div>
<div class="form-group row">
    <label for="lastname" class="col-sm-2 col-form-label"><?= lang('custumers.fields.lastname') ?></label>
    <div class="col-sm-10">
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
            </div>
            <input type="text" name="lastname" id="lastname" class="form-control <?= session('error.lastname') ? 'is-invalid' : '' ?>" value="<?= old('lastname') ?>" placeholder="<?= lang('custumers.fields.lastname') ?>" autocomplete="off">
        </div>
    </div>
</div>
<div class="form-group row">
    <label for="taxID" class="col-sm-2 col-form-label"><?= lang('custumers.fields.taxID') ?></label>
    <div class="col-sm-10">
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
            </div>
            <input type="text" name="taxID" id="taxID" class="form-control <?= session('error.taxID') ? 'is-invalid' : '' ?>" value="<?= old('taxID') ?>" placeholder="<?= lang('custumers.fields.taxID') ?>" autocomplete="off">
        </div>
    </div>
</div>
<div class="form-group row">
    <label for="email" class="col-sm-2 col-form-label"><?= lang('custumers.fields.email') ?></label>
    <div class="col-sm-10">
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
            </div>
            <input type="text" name="email" id="email" class="form-control <?= session('error.email') ? 'is-invalid' : '' ?>" value="<?= old('email') ?>" placeholder="<?= lang('custumers.fields.email') ?>" autocomplete="off">
        </div>
    </div>
</div>
<div class="form-group row">
    <label for="direction" class="col-sm-2 col-form-label"><?= lang('custumers.fields.direction') ?></label>
    <div class="col-sm-10">
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
            </div>
            <input type="text" name="direction" id="direction" class="form-control <?= session('error.direction') ? 'is-invalid' : '' ?>" value="<?= old('direction') ?>" placeholder="<?= lang('custumers.fields.direction') ?>" autocomplete="off">
        </div>
    </div>
</div>
<div class="form-group row">
    <label for="birthdate" class="col-sm-2 col-form-label"><?= lang('custumers.fields.birthdate') ?></label>
    <div class="col-sm-10">
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
            </div>
            <input type="datetime-local" name="birthdate" id="birthdate" class="form-control <?= session('error.birthdate') ? 'is-invalid' : '' ?>" value="<?= $fecha ?>" placeholder="<?= lang('customers.fields.birthdate') ?>" autocomplete="off">
        </div>
    </div>
</div>

        
                  </form>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal"><?= lang('boilerplate.global.close') ?></button>
                  <button type="button" class="btn btn-primary btn-sm" id="btnSaveCustumers"><?= lang('boilerplate.global.save') ?></button>
              </div>
          </div>
      </div>
  </div>

  <?= $this->section('js') ?>


  <script>

      $(document).on('click', '.btnAddCustumers', function (e) {


         // $(".form-control").val("");

          $("#idCustumers").val("0");

          $("#btnSaveCustumers").removeAttr("disabled");

      });

      /* 
       * AL hacer click al editar
       */



      $(document).on('click', '.btnEditCustumers', function (e) {


          var idCustumers = $(this).attr("idCustumers");

          //LIMPIAMOS CONTROLES
          $(".form-control").val("");

          $("#idCustumers").val(idCustumers);
          $("#btnGuardarCustumers").removeAttr("disabled");

      });




  </script>


  <?= $this->endSection() ?>
        