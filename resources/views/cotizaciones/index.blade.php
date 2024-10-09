@extends('layouts.app')

@section('content')
<div class="card">
   <div class="card-header">
      <div class="row">
         <div class="col">
            <h5 class="mb-0">Mis contizaciones</h5>
         </div>
      </div>
   </div>
   <div class="card-body">
      <div class="row">
         <div class="col-md-1" id="divRefresh">
            <button id="btnRefresh" type="button" class="btn btn-sm btn-info" title="Actualizar">
               <svg width="24" height="24" viewBox="0 0 32 32">
                  <path fill="currentColor"
                     d="M24 31a7 7 0 1 1 7-7a7.008 7.008 0 0 1-7 7m0-12a5 5 0 1 0 5 5a5.006 5.006 0 0 0-5-5m-8 9A12.013 12.013 0 0 1 4 16H2a14.016 14.016 0 0 0 14 14zM12 8H7.078A11.984 11.984 0 0 1 28 16h2A13.978 13.978 0 0 0 6 6.234V2H4v8h8z" />
               </svg>
            </button>
         </div>
      </div>
      <table id="table" class="table table-sm mt-1" data-search="true" data-toggle="table" data-detail-view="true"
         data-detail-view-by-click="true" data-detail-formatter="productos">
         <thead>
            <tr class="table-secondary">
               <th data-field="cliente" data-formatter="validarCol">Cliente</th>
               <th data-field="fecha">Fecha de la cotización</th>
               <th data-field="subtotal" data-formatter="validarCol">Sub-total</th>
               <th data-field="descuento" data-formatter="validarCol">Descuento (%)</th>
               <th data-field="total" data-formatter="validarCol">Total</th>
               <th data-field="pdf" data-formatter="validarCol">Archivo pdf</th>
               <th data-field="acciones" data-formatter="validarCol">Acciones</th>
            </tr>
         </thead>
      </table>
   </div>
</div>

<div class="modal fade" id="modal" role="dialog" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title modalTitulo"></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body modalBody">
            <form id="frm" class="needs-validation" method="POST" novalidate>
               @csrf
               <div class="row mb-2">
                  <div class="col-md-3">
                     <div class="form-group">
                        <label for="documento">Documento</label>
                        <div class="input-group">
                           <input name="documento" type="text" class="form-control border-gray-300"
                              placeholder="900818901" id="documento" autofocus required />
                           @error('documento')
                           <div class="invalid-feedback">{{ $message }}</div>
                           @enderror
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="form-group">
                        <label for="nombres">Nombres</label>
                        <div class="input-group">
                           <input name="nombres" type="text" class="form-control border-gray-300"
                              placeholder="Jorde Armando" id="nombres" autofocus required />
                           @error('nombres')
                           <div class="invalid-feedback">{{ $message }}</div>
                           @enderror
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="form-group">
                        <label for="apellidos">Apellidos</label>
                        <div class="input-group">
                           <input name="apellidos" type="text" class="form-control border-gray-300" placeholder="Perez"
                              id="apellidos" autofocus required />
                           @error('apellidos')
                           <div class="invalid-feedback">{{ $message }}</div>
                           @enderror
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="form-group">
                        <label for="telefono">Teléfono</label>
                        <div class="input-group">
                           <input name="telefono" type="text" class="form-control border-gray-300"
                              placeholder="3125187874" id="telefono" autofocus required />
                           @error('telefono')
                           <div class="invalid-feedback">{{ $message }}</div>
                           @enderror
                        </div>
                     </div>
                  </div>
               </div>
               <div class="row mb-2">
                  <div class="col-md-6">
                     <div class="form-group">
                        <label for="correo">Correo electrónico</label>
                        <div class="input-group">
                           <input name="correo" type="email" class="form-control border-gray-300"
                              placeholder="Perez@gmail.com" id="correo" autofocus required />
                           @error('correo')
                           <div class="invalid-feedback">{{ $message }}</div>
                           @enderror
                        </div>
                     </div>
                  </div>

                  <div class="col-md-6">
                     <div class="form-group">
                        <label for="direccion">Dirección</label>
                        <div class="input-group">
                           <input name="direccion" type="text" class="form-control border-gray-300"
                              placeholder="3125187874" id="direccion" autofocus />
                           @error('direccion')
                           <div class="invalid-feedback">{{ $message }}</div>
                           @enderror
                        </div>
                     </div>
                  </div>
               </div>
               <div class="d-grid float-right">
                  <input type="hidden" name="id" id="id" />
                  <button type="submit" class="btn btn-primary btnGuardar"></button>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>

@section('js')

<script type="module">
   const doc = document;

   let frm = doc.getElementById('frm');
   let modal = new bootstrap.Modal(doc.getElementById('modal'), {
      keyboard: false,
      backdrop: 'static'
   });

   doc.addEventListener('DOMContentLoaded', function() {
      $('#table').bootstrapTable({

         url: '/cotizaciones/getAll',
         method: 'GET',

         formatNoMatches: function() {
            return 'No se encontraron registros';
         },
         formatSearch: function() {
            return 'Buscar...';
         },
      })
   });

   doc.addEventListener('click', (e) => {
      if (e.target.matches('#btnRefresh') || e.target.closest('#btnRefresh')) {
         $('#table').bootstrapTable('refresh');
      }

      if (e.target.matches('.btnNuevo') || e.target.closest('.btnNuevo')) {
         modal.show();
         document.querySelector('.modalTitulo').textContent = 'Nuevo registro'
         document.querySelector('.btnGuardar').textContent = 'Guardar'
         document.getElementById('id').value = ''
      }

      if (e.target.matches('.btnEliminar') || e.target.closest('.btnEliminar')) {
         let id = e.target.dataset.id;

         Swal.fire({
            title: '¿Desea eliminar este registro?',
            text: 'Esta acción no se puede revertir',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Sí, eliminar'
         }).then((result) => {
            if (result.value) {
               axios.delete(`/cotizaciones/${id}/delete`)
                  .then(function(response) {
                     if (response.data.success) {
                        Swal.fire({
                           icon: 'success',
                           title: 'Registro eliminado exitosamente',
                           confirmButtonText: 'Aceptar',
                        });
                     } else {
                        Swal.fire({
                           icon: 'error',
                           title: 'Error',
                           confirmButtonText: 'Aceptar',
                           text: response.data.message,
                        });
                     }
                  })
                  .catch(function(error) {
                     console.error('Error en la solicitud:', error);
                     Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Hubo un problema al procesar la solicitud',
                        confirmButtonText: 'Aceptar',
                     });
                  });
               $('#table').bootstrapTable('refresh');
            }
         })
      }

      if (e.target.matches('.btnGuardar') || e.target.closest('.btnGuardar')) {
         if ($('#frm')[0].checkValidity()) {
            e.preventDefault();

            let formData = new FormData(frm);
            let url = document.getElementById('id').value ? `/clientes/${document.getElementById('id').value}/update` : '/clientes';

            axios({
                  method: 'post',
                  url: url,
                  data: formData,
               })
               .then(function(response) {
                  if (response.data.success) {
                     Swal.fire({
                        icon: 'success',
                        title: 'Registro creado exitosamente',
                        confirmButtonText: 'Aceptar',
                        text: response.data.message,
                     });

                  } else {
                     Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        confirmButtonText: 'Aceptar',
                        text: response.data.message,
                     });
                  }
               })
               .catch(function(error) {
                  console.error('Error en la solicitud:', error);
                  Swal.fire({
                     icon: 'error',
                     title: 'Error',
                     text: 'Hubo un problema al procesar la solicitud',
                     confirmButtonText: 'Aceptar',

                  });
               });
            modal.hide();
            $('#table').bootstrapTable('refresh');
         }
      }
   });


</script>

<script>
   function validarCol(value, row, index, field) {
      if (field == 'acciones') {
         return `
            <a data-id="${row.id}" href="/cotizaciones/${row.id}/edit" type="button" class="btn btn-sm btnActualizar btn-warning"">
               <i data-id=" ${row.id}" class="bi bi-pencil"></i>
            </a>
            <button data-id="${row.id}" type="button" class="btn btn-sm btnEliminar btn-danger"">
               <i data-id="${row.id}" class="bi bi-trash"></i>
            </a>
            `;
      }

      if (field == 'cliente') {
         return `${row.cliente.nombres} ${row.cliente.apellidos}`;
      }

      if (field == 'subtotal' || field == 'total' ) {
         return `${moneyFormat(value)}`;
      }

      if (field == 'descuento') {
         return `${value}%`;
      }

      if (field == 'pdf') {
         return `
            <a href="storage/${value}" target="_blank" class="btn btn-sm btn-link">
               <i class="bi bi-pdf"></i>Descargar
            </a>`;
      }
   }

   function moneyFormat(value) {
      let valueConversion = new Intl.NumberFormat("es-CO", { style: "currency", currency: 'COP', minimumFractionDigits: 0 }).format(value);
      return valueConversion;
   }

   function productos(index, row) {
      let html = `<table class="table table-sm">
         <thead>
            <tr>
               <th>Producto</th>
               <th>Cantidad</th>
               <th>Valor</th>
               <th>Sub-total</th>
               <th>Descuento (%)</th>
               <th>Total</th>
            </tr>
         </thead>
         <tbody>`;

      row.cotizacion_detalles.forEach(item => {
         html += `<tr>
            <td>${item.producto.producto}</td>
            <td>${item.cantidad}</td>
            <td>${moneyFormat(item.valor)}</td>
            <td>${moneyFormat(item.subtotal)}</td>
            <td>${item.descuento}%</td>
            <td>${moneyFormat(item.total)}</td>
         </tr>`;
      });

      html += `</tbody>
      </table>`;

      return html;
   }
</script>
@endsection
@endsection