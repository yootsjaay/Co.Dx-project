<?= $this->include('julio101290\boilerplate\Views\load\select2') ?>
<?= $this->include('julio101290\boilerplate\Views\load\datatables') ?>
<?= $this->include('julio101290\boilerplate\Views\load\nestable') ?>
<!-- Extend from layout index -->
<?= $this->extend('julio101290\boilerplate\Views\layout\index') ?>

<!-- Section content -->
<?= $this->section('content') ?>

<?= $this->include('modulesCustumers/modalCaptureCustumers') ?>

<!-- SELECT2 EXAMPLE -->
<div class="card card-default">
 <div class="card-header">
     <div class="float-right">
         <div class="btn-group">

             <button class="btn btn-primary btnAddCustumers" data-toggle="modal" data-target="#modalAddCustumers"><i class="fa fa-plus"></i>

                 <?= lang('custumers.add') ?>

             </button>

         </div>
     </div>
 </div>
 <div class="card-body">
     <div class="row">
         <div class="col-md-12">
             <div class="table-responsive">
                 <table id="tableCustumers" class="table table-striped table-hover va-middle tableCustumers">
                     <thead>
                         <tr>

                             <th>#</th>
                             <th><?= lang('custumers.fields.firstname') ?></th>
<th><?= lang('custumers.fields.lastname') ?></th>
<th><?= lang('custumers.fields.taxID') ?></th>
<th><?= lang('custumers.fields.email') ?></th>
<th><?= lang('custumers.fields.direction') ?></th>
<th><?= lang('custumers.fields.birthdate') ?></th>
<th><?= lang('custumers.fields.created_at') ?></th>
<th><?= lang('custumers.fields.updated_at') ?></th>
<th><?= lang('custumers.fields.deleted_at') ?></th>

                             <th><?= lang('custumers.fields.actions') ?> </th>

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

 var tableCustumers = $('#tableCustumers').DataTable({
     processing: true,
     serverSide: true,
     responsive: true,
     autoWidth: false,
     order: [[1, 'asc']],

     ajax: {
         url: '<?= base_url(route_to('admin/custumers')) ?>',
         method: 'GET',
         dataType: "json"
     },
     columnDefs: [{
             orderable: false,
             targets: [10],
             searchable: false,
             targets: [10]

         }],
     columns: [{
             'data': 'id'
         },
        
          
{
    'data': 'firstname'
},
 
{
    'data': 'lastname'
},
 
{
    'data': 'taxID'
},
 
{
    'data': 'email'
},
 
{
    'data': 'direction'
},
 
{
    'data': 'birthdate'
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
                             <button class="btn btn-warning btnEditCustumers" data-toggle="modal" idCustumers="${data.id}" data-target="#modalAddCustumers">  <i class=" fa fa-edit"></i></button>
                             <button class="btn btn-danger btn-delete" data-id="${data.id}"><i class="fas fa-trash"></i></button>
                         </div>
                         </td>`
             }
         }
     ]
 });



 $(document).on('click', '#btnSaveCustumers', function (e) {

     
var idCustumers = $("#idCustumers").val();
var firstname = $("#firstname").val();
var lastname = $("#lastname").val();
var taxID = $("#taxID").val();
var email = $("#email").val();
var direction = $("#direction").val();
var birthdate = $("#birthdate").val();

     $("#btnSaveCustumers").attr("disabled", true);

     var datos = new FormData();
datos.append("idCustumers", idCustumers);
datos.append("firstname", firstname);
datos.append("lastname", lastname);
datos.append("taxID", taxID);
datos.append("email", email);
datos.append("direction", direction);
datos.append("birthdate", birthdate);


     $.ajax({

         url: "<?= route_to('admin/custumers/save') ?>",
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

                 tableCustumers.ajax.reload();
                 $("#btnSaveCustumers").removeAttr("disabled");


                 $('#modalAddCustumers').modal('hide');
             } else {

                 Toast.fire({
                     icon: 'error',
                     title: respuesta
                 });

                 $("#btnSaveCustumers").removeAttr("disabled");
                

             }

         }

     }

     )

 });



 /**
  * Carga datos actualizar
  */


 /*=============================================
  EDITAR Custumers
  =============================================*/
 $(".tableCustumers").on("click", ".btnEditCustumers", function () {

     var idCustumers = $(this).attr("idCustumers");
        
     var datos = new FormData();
     datos.append("idCustumers", idCustumers);

     $.ajax({

         url: "<?= base_url(route_to('admin/custumers/getCustumers')) ?>",
         method: "POST",
         data: datos,
         cache: false,
         contentType: false,
         processData: false,
         dataType: "json",
         success: function (respuesta) {
             $("#idCustumers").val(respuesta["id"]);
             
             $("#firstname").val(respuesta["firstname"]);
$("#lastname").val(respuesta["lastname"]);
$("#taxID").val(respuesta["taxID"]);
$("#email").val(respuesta["email"]);
$("#direction").val(respuesta["direction"]);
$("#birthdate").val(respuesta["birthdate"]);


         }

     })

 })


 /*=============================================
  ELIMINAR custumers
  =============================================*/
 $(".tableCustumers").on("click", ".btn-delete", function () {

     var idCustumers = $(this).attr("data-id");

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
                         url: `<?= base_url(route_to('admin/custumers')) ?>/` + idCustumers,
                         method: 'DELETE',
                     }).done((data, textStatus, jqXHR) => {
                         Toast.fire({
                             icon: 'success',
                             title: jqXHR.statusText,
                         });


                         tableCustumers.ajax.reload();
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
    $("#modalAddCustumers").draggable();
    
});


</script>
<?= $this->endSection() ?>
        