<!-- Modal Products -->
  <div class="modal fade" id="modalAddProducts" tabindex="-1" role="dialog" aria-labelledby="modalAddProducts" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title"><?= lang('products.createEdit') ?></h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <form id="form-products" class="form-horizontal">
                      <input type="hidden" id="idProducts" name="idProducts" value="0">

                      <div class="form-group row">
    <label for="idEmpresa" class="col-sm-2 col-form-label"><?= lang('products.fields.idEmpresa') ?></label>
    <div class="col-sm-10">
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
            </div>
            <input type="text" name="idEmpresa" id="idEmpresa" class="form-control <?= session('error.idEmpresa') ? 'is-invalid' : '' ?>" value="<?= old('idEmpresa') ?>" placeholder="<?= lang('products.fields.idEmpresa') ?>" autocomplete="off">
        </div>
    </div>
</div>
<div class="form-group row">
    <label for="idCategory" class="col-sm-2 col-form-label"><?= lang('products.fields.idCategory') ?></label>
    <div class="col-sm-10">
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
            </div>
            <input type="text" name="idCategory" id="idCategory" class="form-control <?= session('error.idCategory') ? 'is-invalid' : '' ?>" value="<?= old('idCategory') ?>" placeholder="<?= lang('products.fields.idCategory') ?>" autocomplete="off">
        </div>
    </div>
</div>
<div class="form-group row">
    <label for="code" class="col-sm-2 col-form-label"><?= lang('products.fields.code') ?></label>
    <div class="col-sm-10">
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
            </div>
            <input type="text" name="code" id="code" class="form-control <?= session('error.code') ? 'is-invalid' : '' ?>" value="<?= old('code') ?>" placeholder="<?= lang('products.fields.code') ?>" autocomplete="off">
        </div>
    </div>
</div>
<div class="form-group row">
    <label for="barcode" class="col-sm-2 col-form-label"><?= lang('products.fields.barcode') ?></label>
    <div class="col-sm-10">
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
            </div>
            <input type="text" name="barcode" id="barcode" class="form-control <?= session('error.barcode') ? 'is-invalid' : '' ?>" value="<?= old('barcode') ?>" placeholder="<?= lang('products.fields.barcode') ?>" autocomplete="off">
        </div>
    </div>
</div>
<div class="form-group row">
    <label for="unidad" class="col-sm-2 col-form-label"><?= lang('products.fields.unidad') ?></label>
    <div class="col-sm-10">
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
            </div>
            <input type="text" name="unidad" id="unidad" class="form-control <?= session('error.unidad') ? 'is-invalid' : '' ?>" value="<?= old('unidad') ?>" placeholder="<?= lang('products.fields.unidad') ?>" autocomplete="off">
        </div>
    </div>
</div>
<div class="form-group row">
    <label for="description" class="col-sm-2 col-form-label"><?= lang('products.fields.description') ?></label>
    <div class="col-sm-10">
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
            </div>
            <input type="text" name="description" id="description" class="form-control <?= session('error.description') ? 'is-invalid' : '' ?>" value="<?= old('description') ?>" placeholder="<?= lang('products.fields.description') ?>" autocomplete="off">
        </div>
    </div>
</div>
<div class="form-group row">
    <label for="stock" class="col-sm-2 col-form-label"><?= lang('products.fields.stock') ?></label>
    <div class="col-sm-10">
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
            </div>
            <input type="text" name="stock" id="stock" class="form-control <?= session('error.stock') ? 'is-invalid' : '' ?>" value="<?= old('stock') ?>" placeholder="<?= lang('products.fields.stock') ?>" autocomplete="off">
        </div>
    </div>
</div>
<div class="form-group row">
    <label for="validateStock" class="col-sm-2 col-form-label"><?= lang('products.fields.validateStock') ?></label>
    <div class="col-sm-10">
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
            </div>
            <input type="text" name="validateStock" id="validateStock" class="form-control <?= session('error.validateStock') ? 'is-invalid' : '' ?>" value="<?= old('validateStock') ?>" placeholder="<?= lang('products.fields.validateStock') ?>" autocomplete="off">
        </div>
    </div>
</div>
<div class="form-group row">
    <label for="inventarioRiguroso" class="col-sm-2 col-form-label"><?= lang('products.fields.inventarioRiguroso') ?></label>
    <div class="col-sm-10">
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
            </div>
            <input type="text" name="inventarioRiguroso" id="inventarioRiguroso" class="form-control <?= session('error.inventarioRiguroso') ? 'is-invalid' : '' ?>" value="<?= old('inventarioRiguroso') ?>" placeholder="<?= lang('products.fields.inventarioRiguroso') ?>" autocomplete="off">
        </div>
    </div>
</div>
<div class="form-group row">
    <label for="buyPrice" class="col-sm-2 col-form-label"><?= lang('products.fields.buyPrice') ?></label>
    <div class="col-sm-10">
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
            </div>
            <input type="text" name="buyPrice" id="buyPrice" class="form-control <?= session('error.buyPrice') ? 'is-invalid' : '' ?>" value="<?= old('buyPrice') ?>" placeholder="<?= lang('products.fields.buyPrice') ?>" autocomplete="off">
        </div>
    </div>
</div>
<div class="form-group row">
    <label for="salePrice" class="col-sm-2 col-form-label"><?= lang('products.fields.salePrice') ?></label>
    <div class="col-sm-10">
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
            </div>
            <input type="text" name="salePrice" id="salePrice" class="form-control <?= session('error.salePrice') ? 'is-invalid' : '' ?>" value="<?= old('salePrice') ?>" placeholder="<?= lang('products.fields.salePrice') ?>" autocomplete="off">
        </div>
    </div>
</div>
<div class="form-group row">
    <label for="porcentSale" class="col-sm-2 col-form-label"><?= lang('products.fields.porcentSale') ?></label>
    <div class="col-sm-10">
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
            </div>
            <input type="text" name="porcentSale" id="porcentSale" class="form-control <?= session('error.porcentSale') ? 'is-invalid' : '' ?>" value="<?= old('porcentSale') ?>" placeholder="<?= lang('products.fields.porcentSale') ?>" autocomplete="off">
        </div>
    </div>
</div>
<div class="form-group row">
    <label for="porcentTax" class="col-sm-2 col-form-label"><?= lang('products.fields.porcentTax') ?></label>
    <div class="col-sm-10">
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
            </div>
            <input type="text" name="porcentTax" id="porcentTax" class="form-control <?= session('error.porcentTax') ? 'is-invalid' : '' ?>" value="<?= old('porcentTax') ?>" placeholder="<?= lang('products.fields.porcentTax') ?>" autocomplete="off">
        </div>
    </div>
</div>
<div class="form-group row">
    <label for="unidadSAT" class="col-sm-2 col-form-label"><?= lang('products.fields.unidadSAT') ?></label>
    <div class="col-sm-10">
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
            </div>
            <input type="text" name="unidadSAT" id="unidadSAT" class="form-control <?= session('error.unidadSAT') ? 'is-invalid' : '' ?>" value="<?= old('unidadSAT') ?>" placeholder="<?= lang('products.fields.unidadSAT') ?>" autocomplete="off">
        </div>
    </div>
</div>
<div class="form-group row">
    <label for="claveProductoSAT" class="col-sm-2 col-form-label"><?= lang('products.fields.claveProductoSAT') ?></label>
    <div class="col-sm-10">
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
            </div>
            <input type="text" name="claveProductoSAT" id="claveProductoSAT" class="form-control <?= session('error.claveProductoSAT') ? 'is-invalid' : '' ?>" value="<?= old('claveProductoSAT') ?>" placeholder="<?= lang('products.fields.claveProductoSAT') ?>" autocomplete="off">
        </div>
    </div>
</div>
<div class="form-group row">
    <label for="nombreUnidadSAT" class="col-sm-2 col-form-label"><?= lang('products.fields.nombreUnidadSAT') ?></label>
    <div class="col-sm-10">
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
            </div>
            <input type="text" name="nombreUnidadSAT" id="nombreUnidadSAT" class="form-control <?= session('error.nombreUnidadSAT') ? 'is-invalid' : '' ?>" value="<?= old('nombreUnidadSAT') ?>" placeholder="<?= lang('products.fields.nombreUnidadSAT') ?>" autocomplete="off">
        </div>
    </div>
</div>
<div class="form-group row">
    <label for="nombreClaveProducto" class="col-sm-2 col-form-label"><?= lang('products.fields.nombreClaveProducto') ?></label>
    <div class="col-sm-10">
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
            </div>
            <input type="text" name="nombreClaveProducto" id="nombreClaveProducto" class="form-control <?= session('error.nombreClaveProducto') ? 'is-invalid' : '' ?>" value="<?= old('nombreClaveProducto') ?>" placeholder="<?= lang('products.fields.nombreClaveProducto') ?>" autocomplete="off">
        </div>
    </div>
</div>
<div class="form-group row">
    <label for="porcentIVARetenido" class="col-sm-2 col-form-label"><?= lang('products.fields.porcentIVARetenido') ?></label>
    <div class="col-sm-10">
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
            </div>
            <input type="text" name="porcentIVARetenido" id="porcentIVARetenido" class="form-control <?= session('error.porcentIVARetenido') ? 'is-invalid' : '' ?>" value="<?= old('porcentIVARetenido') ?>" placeholder="<?= lang('products.fields.porcentIVARetenido') ?>" autocomplete="off">
        </div>
    </div>
</div>
<div class="form-group row">
    <label for="porcentISRRetenido" class="col-sm-2 col-form-label"><?= lang('products.fields.porcentISRRetenido') ?></label>
    <div class="col-sm-10">
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
            </div>
            <input type="text" name="porcentISRRetenido" id="porcentISRRetenido" class="form-control <?= session('error.porcentISRRetenido') ? 'is-invalid' : '' ?>" value="<?= old('porcentISRRetenido') ?>" placeholder="<?= lang('products.fields.porcentISRRetenido') ?>" autocomplete="off">
        </div>
    </div>
</div>
<div class="form-group row">
    <label for="routeImage" class="col-sm-2 col-form-label"><?= lang('products.fields.routeImage') ?></label>
    <div class="col-sm-10">
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
            </div>
            <input type="text" name="routeImage" id="routeImage" class="form-control <?= session('error.routeImage') ? 'is-invalid' : '' ?>" value="<?= old('routeImage') ?>" placeholder="<?= lang('products.fields.routeImage') ?>" autocomplete="off">
        </div>
    </div>
</div>

        
                  </form>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal"><?= lang('boilerplate.global.close') ?></button>
                  <button type="button" class="btn btn-primary btn-sm" id="btnSaveProducts"><?= lang('boilerplate.global.save') ?></button>
              </div>
          </div>
      </div>
  </div>

  <?= $this->section('js') ?>


  <script>

      $(document).on('click', '.btnAddProducts', function (e) {


          $(".form-control").val("");

          $("#idProducts").val("0");

          $("#btnSaveProducts").removeAttr("disabled");

      });

      /* 
       * AL hacer click al editar
       */



      $(document).on('click', '.btnEditProducts', function (e) {


          var idProducts = $(this).attr("idProducts");

          //LIMPIAMOS CONTROLES
          $(".form-control").val("");

          $("#idProducts").val(idProducts);
          $("#btnGuardarProducts").removeAttr("disabled");

      });




  </script>


  <?= $this->endSection() ?>
        