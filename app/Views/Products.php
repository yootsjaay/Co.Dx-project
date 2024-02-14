<?= $this->include('julio101290\boilerplate\Views\load\select2') ?>
<?= $this->include('julio101290\boilerplate\Views\load\datatables') ?>
<?= $this->include('julio101290\boilerplate\Views\load\nestable') ?>
<!-- Extend from layout index -->
<?= $this->extend('julio101290\boilerplate\Views\layout\index') ?>

<!-- Section content -->
<?= $this->section('content') ?>

<?= $this->include('modulesProducts/modalCaptureProducts') ?>

<!-- SELECT2 EXAMPLE -->
<div class="card card-default">
 <div class="card-header">
     <div class="float-right">
         <div class="btn-group">

             <button class="btn btn-primary btnAddProducts" data-toggle="modal" data-target="#modalAddProducts"><i class="fa fa-plus"></i>

                 <?= lang('products.add') ?>

             </button>

         </div>
     </div>
 </div>
 <div class="card-body">
     <div class="row">
         <div class="col-md-12">
             <div class="table-responsive">
                 <table id="tableProducts" class="table table-striped table-hover va-middle tableProducts">
                     <thead>
                         <tr>

                             <th>#</th>
                             <th><?= lang('products.fields.idEmpresa') ?></th>
<th><?= lang('products.fields.idCategory') ?></th>
<th><?= lang('products.fields.code') ?></th>
<th><?= lang('products.fields.barcode') ?></th>
<th><?= lang('products.fields.unidad') ?></th>
<th><?= lang('products.fields.description') ?></th>
<th><?= lang('products.fields.stock') ?></th>
<th><?= lang('products.fields.validateStock') ?></th>
<th><?= lang('products.fields.inventarioRiguroso') ?></th>
<th><?= lang('products.fields.buyPrice') ?></th>
<th><?= lang('products.fields.salePrice') ?></th>
<th><?= lang('products.fields.porcentSale') ?></th>
<th><?= lang('products.fields.porcentTax') ?></th>
<th><?= lang('products.fields.unidadSAT') ?></th>
<th><?= lang('products.fields.claveProductoSAT') ?></th>
<th><?= lang('products.fields.nombreUnidadSAT') ?></th>
<th><?= lang('products.fields.nombreClaveProducto') ?></th>
<th><?= lang('products.fields.porcentIVARetenido') ?></th>
<th><?= lang('products.fields.porcentISRRetenido') ?></th>
<th><?= lang('products.fields.routeImage') ?></th>
<th><?= lang('products.fields.created_at') ?></th>
<th><?= lang('products.fields.updated_at') ?></th>
<th><?= lang('products.fields.deleted_at') ?></th>

                             <th><?= lang('products.fields.actions') ?> </th>

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

 var tableProducts = $('#tableProducts').DataTable({
     processing: true,
     serverSide: true,
     responsive: true,
     autoWidth: false,
     order: [[1, 'asc']],

     ajax: {
         url: '<?= base_url(route_to('admin/products')) ?>',
         method: 'GET',
         dataType: "json"
     },
     columnDefs: [{
             orderable: false,
             targets: [24],
             searchable: false,
             targets: [24]

         }],
     columns: [{
             'data': 'id'
         },
        
          
{
    'data': 'idEmpresa'
},
 
{
    'data': 'idCategory'
},
 
{
    'data': 'code'
},
 
{
    'data': 'barcode'
},
 
{
    'data': 'unidad'
},
 
{
    'data': 'description'
},
 
{
    'data': 'stock'
},
 
{
    'data': 'validateStock'
},
 
{
    'data': 'inventarioRiguroso'
},
 
{
    'data': 'buyPrice'
},
 
{
    'data': 'salePrice'
},
 
{
    'data': 'porcentSale'
},
 
{
    'data': 'porcentTax'
},
 
{
    'data': 'unidadSAT'
},
 
{
    'data': 'claveProductoSAT'
},
 
{
    'data': 'nombreUnidadSAT'
},
 
{
    'data': 'nombreClaveProducto'
},
 
{
    'data': 'porcentIVARetenido'
},
 
{
    'data': 'porcentISRRetenido'
},
 
{
    'data': 'routeImage'
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
             "data": function (data) {
                 return `<td class="text-right py-0 align-middle">
                         <div class="btn-group btn-group-sm">
                             <button class="btn btn-warning btnEditProducts" data-toggle="modal" idProducts="${data.id}" data-target="#modalAddProducts">  <i class=" fa fa-edit"></i></button>
                             <button class="btn btn-danger btn-delete" data-id="${data.id}"><i class="fas fa-trash"></i></button>
                         </div>
                         </td>`
             }
         }
     ]
 });



 $(document).on('click', '#btnSaveProducts', function (e) {

     
var idProducts = $("#idProducts").val();
var idEmpresa = $("#idEmpresa").val();
var idCategory = $("#idCategory").val();
var code = $("#code").val();
var barcode = $("#barcode").val();
var unidad = $("#unidad").val();
var description = $("#description").val();
var stock = $("#stock").val();
var validateStock = $("#validateStock").val();
var inventarioRiguroso = $("#inventarioRiguroso").val();
var buyPrice = $("#buyPrice").val();
var salePrice = $("#salePrice").val();
var porcentSale = $("#porcentSale").val();
var porcentTax = $("#porcentTax").val();
var unidadSAT = $("#unidadSAT").val();
var claveProductoSAT = $("#claveProductoSAT").val();
var nombreUnidadSAT = $("#nombreUnidadSAT").val();
var nombreClaveProducto = $("#nombreClaveProducto").val();
var porcentIVARetenido = $("#porcentIVARetenido").val();
var porcentISRRetenido = $("#porcentISRRetenido").val();
var routeImage = $("#routeImage").val();

     $("#btnSaveProducts").attr("disabled", true);

     var datos = new FormData();
datos.append("idProducts", idProducts);
datos.append("idEmpresa", idEmpresa);
datos.append("idCategory", idCategory);
datos.append("code", code);
datos.append("barcode", barcode);
datos.append("unidad", unidad);
datos.append("description", description);
datos.append("stock", stock);
datos.append("validateStock", validateStock);
datos.append("inventarioRiguroso", inventarioRiguroso);
datos.append("buyPrice", buyPrice);
datos.append("salePrice", salePrice);
datos.append("porcentSale", porcentSale);
datos.append("porcentTax", porcentTax);
datos.append("unidadSAT", unidadSAT);
datos.append("claveProductoSAT", claveProductoSAT);
datos.append("nombreUnidadSAT", nombreUnidadSAT);
datos.append("nombreClaveProducto", nombreClaveProducto);
datos.append("porcentIVARetenido", porcentIVARetenido);
datos.append("porcentISRRetenido", porcentISRRetenido);
datos.append("routeImage", routeImage);


     $.ajax({

         url: "<?= route_to('admin/products/save') ?>",
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

                 tableProducts.ajax.reload();
                 $("#btnSaveProducts").removeAttr("disabled");


                 $('#modalAddProducts').modal('hide');
             } else {

                 Toast.fire({
                     icon: 'error',
                     title: respuesta
                 });

                 $("#btnSaveProducts").removeAttr("disabled");
                

             }

         }

     }

     )

 });



 /**
  * Carga datos actualizar
  */


 /*=============================================
  EDITAR Products
  =============================================*/
 $(".tableProducts").on("click", ".btnEditProducts", function () {

     var idProducts = $(this).attr("idProducts");
        
     var datos = new FormData();
     datos.append("idProducts", idProducts);

     $.ajax({

         url: "<?= base_url(route_to('admin/products/getProducts')) ?>",
         method: "POST",
         data: datos,
         cache: false,
         contentType: false,
         processData: false,
         dataType: "json",
         success: function (respuesta) {
             $("#idProducts").val(respuesta["id"]);
             
             $("#idEmpresa").val(respuesta["idEmpresa"]);
$("#idCategory").val(respuesta["idCategory"]);
$("#code").val(respuesta["code"]);
$("#barcode").val(respuesta["barcode"]);
$("#unidad").val(respuesta["unidad"]);
$("#description").val(respuesta["description"]);
$("#stock").val(respuesta["stock"]);
$("#validateStock").val(respuesta["validateStock"]);
$("#inventarioRiguroso").val(respuesta["inventarioRiguroso"]);
$("#buyPrice").val(respuesta["buyPrice"]);
$("#salePrice").val(respuesta["salePrice"]);
$("#porcentSale").val(respuesta["porcentSale"]);
$("#porcentTax").val(respuesta["porcentTax"]);
$("#unidadSAT").val(respuesta["unidadSAT"]);
$("#claveProductoSAT").val(respuesta["claveProductoSAT"]);
$("#nombreUnidadSAT").val(respuesta["nombreUnidadSAT"]);
$("#nombreClaveProducto").val(respuesta["nombreClaveProducto"]);
$("#porcentIVARetenido").val(respuesta["porcentIVARetenido"]);
$("#porcentISRRetenido").val(respuesta["porcentISRRetenido"]);
$("#routeImage").val(respuesta["routeImage"]);


         }

     })

 })


 /*=============================================
  ELIMINAR products
  =============================================*/
 $(".tableProducts").on("click", ".btn-delete", function () {

     var idProducts = $(this).attr("data-id");

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
                         url: `<?= base_url(route_to('admin/products')) ?>/` + idProducts,
                         method: 'DELETE',
                     }).done((data, textStatus, jqXHR) => {
                         Toast.fire({
                             icon: 'success',
                             title: jqXHR.statusText,
                         });


                         tableProducts.ajax.reload();
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
    $("#modalAddProducts").draggable();
    
});


</script>
<?= $this->endSection() ?>
        