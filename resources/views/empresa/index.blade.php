@extends('layouts.app')
@section('content')
<div class="card">
   <div class="card-header">
      <div class="row">
         <div class="col">
            <h5 class="mb-0">Datos de la empresa</h5>
         </div>
         {{-- <div class="col text-end">
            <button class="btn btn-primary btn-sm btnNuevo">Nuevo registro</button>
         </div> --}}
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
      <table id="table" class="table table-sm mt-1">
         <thead>
            <tr class="table-secondary">
               <th data-field="nit">Nit</th>
               <th data-field="razon_social">Razón social</th>
               <th data-field="representante">Representante legal</th>
               <th data-field="direccion">Dirección</th>
               <th data-field="ciudad">Ciudad</th>
               <th data-field="telefono">teléfono</th>
               <th data-field="correo">Correo electrónico</th>
               <th data-field="web">Página web</th>
               <th data-field="logo" data-formatter="validarCol">Logo</th>
               <th data-field="acciones" data-formatter="validarCol">Acciones</th>
            </tr>
         </thead>
      </table>
   </div>
</div>

<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title modalTitulo"></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body modalBody">
            <form id="frm" class="needs-validation" method="POST" novalidate enctype="multipart/form-data">
               @csrf
               <div class="row mb-2">
                  <div class="col-md-2">
                     <div class="form-group">
                        <label for="nit">Nit</label>
                        <div class="input-group">
                           <input name="nit" type="text" class="form-control border-gray-300"
                              placeholder="9001237456789" id="nit" autofocus required />
                           @error('nit')
                           <div class="invalid-feedback">{{ $message }}</div>
                           @enderror
                        </div>
                     </div>
                  </div>
                  <div class="col-md-5">
                     <div class="form-group">
                        <label for="razon_social">Razón social</label>
                        <div class="input-group">
                           <input name="razon_social" type="text" class="form-control border-gray-300"
                              placeholder="empresa de...." id="razon_social" autofocus required />
                           @error('razon_social')
                           <div class="invalid-feedback">{{ $message }}</div>
                           @enderror
                        </div>
                     </div>
                  </div>
                  <div class="col-md-5">
                     <div class="form-group">
                        <label for="representante">Representante legal</label>
                        <div class="input-group">
                           <input name="representante" type="text" class="form-control border-gray-300"
                              placeholder="Jose Perez" id="representante" autofocus required />
                           @error('representante')
                           <div class="invalid-feedback">{{ $message }}</div>
                           @enderror
                        </div>
                     </div>
                  </div>
               </div>
               <div class="row mb-2">
                  <div class="col-md-5">
                     <div class="form-group">
                        <label for="direccion">Dirección</label>
                        <div class="input-group">
                           <input name="direccion" type="text" class="form-control border-gray-300"
                              placeholder="calle 23 # 23" id="direccion" autofocus required />
                           @error('direccion')
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
                              placeholder="3205496879" id="telefono" autofocus required />
                           @error('telefono')
                           <div class="invalid-feedback">{{ $message }}</div>
                           @enderror
                        </div>
                     </div>
                  </div>
                  <div class="col-md-4">
                     <div class="form-group">
                        <label for="correo">Correo eletrónico</label>
                        <div class="input-group">
                           <input name="correo" type="text" class="form-control border-gray-300"
                              placeholder="empresa@domino.com" id="correo" autofocus required />
                           @error('correo')
                           <div class="invalid-feedback">{{ $message }}</div>
                           @enderror
                        </div>
                     </div>
                  </div>
               </div>
               <div class="row mb-2">
                  <div class="col-md-2">
                     <div class="form-group">
                        <label for="ciudad">Ciudad</label>
                        <div class="input-group">
                           <input name="ciudad" type="text" class="form-control border-gray-300"
                              placeholder="bucaramanga" id="ciudad" autofocus />
                           @error('ciudad')
                           <div class="invalid-feedback">{{ $message }}</div>
                           @enderror
                        </div>
                     </div>
                  </div>
                  <div class="col-md-5">
                     <div class="form-group">
                        <label for="web">Página web</label>
                        <div class="input-group">
                           <input name="web" type="text" class="form-control border-gray-300"
                              placeholder="www.empresa.com" id="web" autofocus />
                           @error('web')
                           <div class="invalid-feedback">{{ $message }}</div>
                           @enderror
                        </div>
                     </div>
                  </div>
                  <div class="col-md-5">
                     <div class="form-group">
                        <label for="logo">Logo de la empresa</label>
                        <div class="input-group">
                           <input name="logo" type="file" class="form-control border-gray-300" id="logo" autofocus
                              required />
                           @error('logo')
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
            <h5 class="modal-title" id="imageModalLabel">Logo de la empresa</h5>
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

   let modal = new bootstrap.Modal(doc.getElementById('modal'), {
      keyboard: false,
      backdrop: 'static'
   });

   doc.addEventListener('DOMContentLoaded', function () {
      $('#table').bootstrapTable({

         url: '/empresa/getAll',
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
         modal.show();
         document.querySelector('.modalTitulo').textContent = 'Nuevo registro'
         document.querySelector('.btnGuardar').textContent = 'Guardar'
         document.getElementById('id').value = ''
      }

      if (e.target.matches('.btnGuardar') || e.target.closest('.btnGuardar')) {
         if ($('#frm')[0].checkValidity()) {
            e.preventDefault();

            let formData = new FormData(frm);
            let fileInput = document.getElementById('logo');
            if (fileInput && fileInput.files.length > 0) {
               formData.append('logo', fileInput.files[0]);
            }
            let url = document.getElementById('id').value ? `/empresa/${document.getElementById('id').value}/update` : '/empresa';

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
                     }).then((result) => {
                        if (result.isConfirmed) {
                           window.location.reload();
                        }
                     });

                  } else {
                     Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        confirmButtonText: 'Aceptar',
                        text: response.data.message,
                     })
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
      }

      if (e.target.matches('.btnActualizar') || e.target.closest('.btnActualizar')) {
         let id = e.target.dataset.id;

         axios.get(`/empresa/${id}/edit`)
            .then(function (response) {
               if (response.data.datos) {
                  let modal = new bootstrap.Modal(doc.getElementById('modal'), {
                     keyboard: false,
                     backdrop: 'static'
                  });
                  modal.show();
                  doc.querySelector('.modalTitulo').textContent = 'Actualizar registro'
                  doc.querySelector('.btnGuardar').textContent = 'Actualizar'
                  doc.getElementById('id').value = response.data.datos.id;
                  doc.getElementById('nit').value = response.data.datos.nit;
                  doc.getElementById('razon_social').value = response.data.datos.razon_social;
                  doc.getElementById('representante').value = response.data.datos.representante;
                  doc.getElementById('direccion').value = response.data.datos.direccion;
                  doc.getElementById('ciudad').value = response.data.datos.ciudad?response.data.datos.ciudad:'';
                  doc.getElementById('telefono').value = response.data.datos.telefono;
                  doc.getElementById('web').value = response.data.datos.web?response.data.datos.web:'';
                  doc.getElementById('correo').value = response.data.datos.correo;
                  doc.getElementById('logo').removeAttribute('required');

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
      let baseUrl = "{{ asset('images/empresa/') }}";

      if (field == 'acciones') {
         return `<button data-id="${row.id}" type="button" class="btn btn-sm btn-warning btnActualizar">
               <i data-id="${row.id}" class="bi bi-pencil"></i>
            </button>`;
      }

      if (field == 'logo') {
         return '<button class="btn btn-primary btn-sm show-image text-center" data-src="' + baseUrl + '/' + value + '"><i data-src="' + baseUrl + '/' + value + '" class="bi bi-image"></i></button>';
      }
   }
</script>
@endsection
@endsection