@extends('layouts.app')
@section('content')
<div class="card">
   <div class="card-header">
      <div class="row">
         <div class="col">
            <h5 class="mb-0">Listado de Productos</h5>
         </div>
         <div class="col text-end">
            <button class="btn btn-primary btn-sm btnNuevo">Nuevo registro</button>
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
      <table id="table" class="table table-sm mt-1" data-search="true">
         <thead>
            <tr class="table-secondary">
               <th data-sortable="true" data-field="producto">Nombre del producto</th>
               <th data-sortable="true" data-field="valor">Valor</th>
               <th data-field="foto" data-formatter="validarCol">Foto</th>
               <th data-field="acciones" data-formatter="validarCol">Acciones</th>
            </tr>
         </thead>
      </table>
   </div>
</div>

<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title modalTitulo"></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body modalBody">
            <form id="frm" class="needs-validation" method="POST" novalidate enctype="multipart/form-data">
               @csrf
               <div class="row mb-2">
                  <div class="col-md-5">
                     <div class="form-group">
                        <label for="producto">Nombre del producto</label>
                        <div class="input-group">
                           <input name="producto" type="text" class="form-control border-gray-300"
                              placeholder="carpeta, lapiz" id="producto" autofocus required />
                           @error('producto')
                           <div class="invalid-feedback">{{ $message }}</div>
                           @enderror
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="form-group">
                        <label for="valor">Valor</label>
                        <div class="input-group">
                           <input name="valor" type="number" class="form-control border-gray-300"
                              placeholder="5000, 10000" id="valor" autofocus required />
                           @error('valor')
                           <div class="invalid-feedback">{{ $message }}</div>
                           @enderror
                        </div>
                     </div>
                  </div>
                  <div class="col-md-4">
                     <div class="form-group">
                        <label for="foto">Imagen del producto</label>
                        <div class="input-group">
                           <input name="foto" type="file" class="form-control border-gray-300" id="foto" autofocus
                              required />
                           @error('foto')
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

<div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="imageModalLabel">Foto del producto</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body text-center">
            <img id="modalImage" src="" alt="Imagen" class="img-fluid">
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">Cerrar</button>
         </div>
      </div>
   </div>
</div>

@section('js')

<script type="module">
   const doc = document;
   let frm = doc.getElementById('frm');

   doc.addEventListener('DOMContentLoaded', function () {
      $('#table').bootstrapTable({

         url: '/productos/getAll',
         method: 'GET',

         formatNoMatches: function () {
            return 'No se encontraron registros';
         },
         formatSearch: function () {
            return 'Buscar...';
         },
      })
   });

   doc.addEventListener('click', (e) => {
      if (e.target.matches('#btnRefresh') || e.target.closest('#btnRefresh')) {
         $('#table').bootstrapTable('refresh');
      }

      if (e.target.matches('.show-image') || e.target.closest('.show-image')) {
         let src = e.target.getAttribute('data-src');
         document.getElementById('modalImage').setAttribute('src', src);

         let modalLogo = new bootstrap.Modal(document.getElementById('imageModal'), {
            keyboard: false,
            backdrop: 'static'
         });
         modalLogo.show();
      }

      if (e.target.matches('.btnNuevo') || e.target.closest('.btnNuevo')) {
         let modal = new bootstrap.Modal(doc.getElementById('modal'), {
            keyboard: false,
            backdrop: 'static'
         });

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
               axios.delete(`/productos/${id}/delete`)
                  .then(function (response) {
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
                  .catch(function (error) {
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
            let fileInput = document.getElementById('foto');
            if (fileInput && fileInput.files.length > 0) {
               formData.append('foto', fileInput.files[0]);
            }
            let url = document.getElementById('id').value ? `/productos/${document.getElementById('id').value}/update` : '/productos';

            axios(
               {
                  method: 'post',
                  url: url,
                  data: formData,
                  headers: {
                     'Content-Type': 'multipart/form-data'
                  }
               }
            )
               .then(function (response) {
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
               .catch(function (error) {
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

      if (e.target.matches('.btnActualizar') || e.target.closest('.btnActualizar')) {
         let id = e.target.dataset.id;

         axios.get(`/productos/${id}/edit`)
            .then(function (response) {
               if (response.data.datos) {
                  modal.show();
                  doc.querySelector('.modalTitulo').textContent = 'Actualizar registro'
                  doc.querySelector('.btnGuardar').textContent = 'Actualizar'
                  doc.getElementById('id').value = response.data.datos.id;
                  doc.getElementById('producto').value = response.data.datos.producto;
                  doc.getElementById('valor').value = response.data.datos.valor;
                  doc.getElementById('foto').removeAttribute('required');
               } else {
                  Swal.fire({
                     icon: 'error',
                     title: 'Error',
                     confirmButtonText: 'Aceptar',
                     text: response.data.message,
                  });
                  modal.hdie();
               }
            })
            .catch(function (error) {
               console.error('Error en la solicitud:', error);
               Swal.fire({
                  icon: 'error',
                  title: 'Error',
                  text: 'Hubo un problema al procesar la solicitud',
                  confirmButtonText: 'Aceptar',
               });
            });
      }
   });

   doc.addEventListener('click', function (e) {
      if (e.target.matches('.btn-cerrar') || e.target.matches('#modal') || e.target.closest('.btn-cerrar')) {
         frm.reset();
         document.querySelector('.modalTitulo').textContent = 'Nuevo registro';
         document.querySelector('.btnGuardar').textContent = 'Guardar';
         frm.classList.remove('was-validated');
         document.getElementById('id').value = '';
         modal.hide();
      }
   });

   $('#modal').on('hidden.bs.modal', function () {
      frm.reset();
      document.querySelector('.modalTitulo').textContent = 'Nuevo registro';
      document.querySelector('.btnGuardar').textContent = 'Guardar';
      frm.classList.remove('was-validated');
      document.getElementById('id').value = '';
   });
</script>

<script>
   function validarCol(value, row, index, field) {
      let baseUrl = "{{ asset('images/productos/') }}";

      if (field == 'acciones') {
         return `<button data-id="${row.id}" type="button" class="btn btn-sm btn-warning btnActualizar">
               <i data-id="${row.id}" class="bi bi-pencil"></i>
            </button>
            <button data-id="${row.id}" type="button" class="btn btn-sm btnEliminar btn-danger"">
               <i data-id="${row.id}" class="bi bi-trash"></i>
            </button>`;
      }

      if (field == 'foto') {
         return '<button class="btn btn-primary btn-sm show-image text-center" data-src="' + baseUrl + '/' + value + '"><i data-src="' + baseUrl + '/' + value + '" class="bi bi-image"></i></button>';
      }
   }
</script>
@endsection
@endsection