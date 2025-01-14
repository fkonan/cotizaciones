@extends('layouts.app')

@section('content')
<div class="card">
   <div class="card-header">
      <div class="row">
         <div class="col">
            <h5 class="mb-0">Usuarios del Sistema</h5>
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
      <table id="table" class="table table-sm mt-1" data-search="true" data-toggle="table">
         <thead>
            <tr class="table-secondary">
               <th data-field="documento">Documento</th>
               <th data-field="name">Nombre del usuario</th>
               <th data-field="email">Correo electrónico</th>
               <th data-field="is_admin" data-formatter="validarCol">Es admin?</th>
               <th data-field="acciones" data-formatter="validarCol">Acciones</th>
            </tr>
         </thead>
      </table>
   </div>
</div>

{{-- <div class="modal fade" id="modal" role="dialog" aria-hidden="true">
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
</div> --}}

@section('js')

<script type="module">
   const doc = document;

   let frm = doc.getElementById('frm');
   // let modal = new bootstrap.Modal(doc.getElementById('modal'), {
   //    keyboard: false,
   //    backdrop: 'static'
   // });

   doc.addEventListener('DOMContentLoaded', function() {
      $('#table').bootstrapTable({

         url: '/auth/getAll',
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
               axios.delete(`/auth/${id}/delete`)
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
   });
</script>

<script>
   function validarCol(value, row, index, field) {
      if (field == 'acciones') {
         return `
            <button data-id="${row.id}" type="button" class="btn btn-sm btnEliminar btn-danger"">
               <i data-id="${row.id}" class="bi bi-trash"></i>
            </a>
         `;
      }

      if (field == 'is_admin') {
         return row.is_admin?`SI`:`NO`;
      }
   }
</script>
@endsection
@endsection
