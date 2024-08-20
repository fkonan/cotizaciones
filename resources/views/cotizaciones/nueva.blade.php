@extends('layouts.app')

@section('content')

<div class="card">
   <div class="card-header">
      <div class="row mb-2">
         <div class="col">
            <h5 class="mb-0">Nueva cotización</h5>
         </div>
      </div>
   </div>
   <form id="frm" class="needs-validation" method="POST" novalidate>
      @csrf
      <div class="card-body">
         <div class="row mb-2">
            <div class="col-md-2">
               <div class="form-group">
                  <label for="fecha">Fecha de la cotización</label>
                  <div class="input-group">
                     <input name="fecha" type="text" class="form-control" placeholder="01/01/2024" id="fecha" autofocus
                        required value="{{date('d/m/Y')}}" readonly />
                     @error('fecha')
                     <div class="invalid-feedback">{{ $message }}</div>
                     @enderror
                  </div>
               </div>
            </div>
            <div class="col-md-6">
               <div class="form-group">
                  <label for="cliente_id">Cliente</label>
                  <div class="input-group">
                     <select name="cliente_id" class="form-select" id="cliente_id" required>
                        <option value="">Seleccione...</option>
                        @foreach ($clientes as $cliente)
                        <option value="{{ $cliente->id }}" data-correo="{{$cliente->correo}}">{{ $cliente->documento }}
                           - {{ $cliente->nombres }} {{
                           $cliente->apellidos }}</option>
                        @endforeach
                     </select>
                     @error('cliente_id')
                     <div class="invalid-feedback">{{ $message }}</div>
                     @enderror
                  </div>
               </div>
            </div>
            <div class="col-md-4">
               <div class="form-group">
                  <label for="producto_id">Producto</label>
                  <div class="input-group">
                     <select name="producto_id" class="form-select" id="producto_id" required>
                        <option value="">Seleccione...</option>
                        @foreach ($productos as $item)
                        <option data-valor="{{ $item->valor }}" value="{{ $item->id }}">{{ $item->producto }}</option>
                        @endforeach
                     </select>
                     @error('producto_id')
                     <div class="invalid-feedback">{{ $message }}</div>
                     @enderror
                  </div>
               </div>
            </div>
         </div>
         <div class="row mb-2">
            <div class="col-md-2">
               <div class="form-group">
                  <label for="valor">Valor</label>
                  <div class="input-group">
                     <input name="valor" type="number" class="form-control" placeholder="1000" id="valor" required />
                     @error('valor')
                     <div class="invalid-feedback">{{ $message }}</div>
                     @enderror
                  </div>
               </div>
            </div>
            <div class="col-md-1">
               <div class="form-group">
                  <label for="cantidad">Cantidad</label>
                  <div class="input-group">
                     <input name="cantidad" type="number" class="form-control" id="cantidad" autofocus required />
                     @error('cantidad')
                     <div class="invalid-feedback">{{ $message }}</div>
                     @enderror
                  </div>
               </div>
            </div>
            <div class="col-md-2">
               <div class="form-group">
                  <label for="subtotal">Subtotal</label>
                  <div class="input-group">
                     <input name="subtotal" type="number" class="form-control" id="subtotal" required readonly />
                     @error('subtotal')
                     <div class="invalid-feedback">{{ $message }}</div>
                     @enderror
                  </div>
               </div>
            </div>
            <div class="col-md-2">
               <div class="form-group">
                  <label for="descuento">Descuento(%)</label>
                  <div class="input-group">
                     <input name="descuento" type="number" class="form-control" id="descuento" min="0" max="99"
                        maxlength="2"
                        oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" />
                     @error('descuento')
                     <div class="invalid-feedback">{{ $message }}</div>
                     @enderror
                  </div>
               </div>
            </div>
            <div class="col-md-2">
               <div class="form-group">
                  <label for="total">Total</label>
                  <div class="input-group">
                     <input name="total" type="number" class="form-control" id="total" readonly />
                     @error('total')
                     <div class="invalid-feedback">{{ $message }}</div>
                     @enderror
                  </div>
               </div>
            </div>
            <div class="col-md-1 d-flex align-self-end">
               <button class="btn btn-warning" type="button" id="btnAgregar">Agregar</button>
            </div>
         </div>
         <hr>
         <div class="row mb-2">
            <div class="col-md-12">
               <table class="table table-centered table-nowrap mb-0 rounded table-sm" id="tabla_productos"
                  data-toggle="table">
                  <thead class="thead-light">
                     <tr>
                        <th class="border-0 rounded-start">#</th>
                        <th class="border-0">Producto</th>
                        <th class="border-0">Cantidad</th>
                        <th class="border-0">Valor</th>
                        <th class="border-0">SubTotal</th>
                        <th class="border-0">Descuento</th>
                        <th class="border-0">Total</th>
                        <th class="border-0">Acciones</th>
                     </tr>
                  </thead>
                  <tbody id="tbody">
                  </tbody>
               </table>
            </div>
         </div>
         <hr>
         <div class="row mb-2">
            <div class="col-md-6">
               <div class="row">
                  <div class="col-md-12 mb-2">
                     <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="enviar_correo" name="enviar_correo">
                        <label class="form-check-label" for="enviar_correo">
                           Enviar cotización por correo electrónico?
                        </label>
                     </div>
                  </div>
                  <div class="col-md-12">
                     <div class="form-group">
                        <label for="correo">Correo electrónico del cliente</label>
                        <div class="input-group">
                           <input name="correo" type="text" class="form-control border-gray-300" id="correo" />
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-md-6 text-end mt-2">
               <div class="form-group">
                  <label for="total_pagar">
                     <h3>Total a Pagar:</h3>
                     <input name="total_pagar" type="text" class="border-0 text-end display-6" id="total_pagar"
                        readonly>
                  </label>
               </div>
            </div>
         </div>
         <div class="row mb-2">

         </div>
         <div class="d-grid float-right">
            <input type="hidden" name="id" id="id" />
            <button type="submit" class="btn btn-primary btnGuardar" id="btn_guardar">Guardar cotización</button>
         </div>
      </div>
   </form>
</div>
@endsection
@section('js')
<script>
   const doc = document;
   const PRODUCTOS_VENTA = [];

   let cantidad = doc.getElementById('cantidad');
   let descuento = doc.getElementById('descuento');

   doc.addEventListener('DOMContentLoaded', function () {

      $('#tabla_productos').bootstrapTable({

         formatNoMatches: function () {
            return 'No se encontraron registros';
         },
      })

      doc.addEventListener('click', (e) => {

         if (e.target.matches('#btnAgregar') || e.target.closest('#btnAgregar')) {

            if (doc.getElementById('producto_id').value.length > 0) {
               let producto = doc.getElementById('producto_id').options[doc.getElementById('producto_id').selectedIndex].text;

               const nuevoProducto = {
                  id: PRODUCTOS_VENTA.length + 1,
                  producto_id: doc.getElementById('producto_id').value,
                  producto_nombre: producto,
                  valor: doc.getElementById('valor').value,
                  cantidad: cantidad.value,
                  subtotal: doc.getElementById('subtotal').value,
                  descuento: descuento.value,
                  total: doc.getElementById('total').value,
                  neto_pagar: parseFloat(doc.getElementById('total').value),
               };

               PRODUCTOS_VENTA.push(nuevoProducto);
               actualizarTabla();
               doc.getElementById('producto_id').selectedIndex = 0;
               doc.getElementById('cantidad').value = 0;
               doc.getElementById('descuento').value = 0;
               let event = new Event('change', { bubbles: true });
               doc.getElementById('producto_id').dispatchEvent(event);
               return PRODUCTOS_VENTA;
            }
         }

      });

      doc.addEventListener('change', (e) => {
         if (e.target.matches('#producto_id')) {
            let producto_id = e.target.value;
            let producto = e.target.options[e.target.selectedIndex].text;
            let opcion = e.target.options[e.target.selectedIndex];
            let valor = opcion.dataset.valor ? opcion.dataset.valor : 0;
            doc.getElementById('valor').value = valor;

            calcularSubtotal(valor, cantidad.value ? cantidad.value : 0, descuento.value ? descuento.value : 0);
         }

         if (e.target.matches('#cantidad') || e.target.matches('#descuento')) {
            let valor = doc.getElementById('valor').value

            calcularSubtotal(valor, cantidad.value ? cantidad.value : 0, descuento.value ? descuento.value : 0);
         }

         if (e.target.matches('#cliente_id')) {
            let opcion = e.target.options[e.target.selectedIndex];
            let correo = opcion.dataset.correo ? opcion.dataset.correo : 'SIN CORREO';
            doc.getElementById('correo').value = correo;
         }
      });

      let frm = doc.getElementById('frm');
      frm.addEventListener('submit', (e) => {
         e.preventDefault();

         if (PRODUCTOS_VENTA.length === 0) {
            Swal.fire({
               icon: 'error',
               title: 'Error',
               confirmButtonText: 'Aceptar',
               text: 'Debe agregar productos a la cotización',
            });
            return;
         }
         let formData = new FormData(frm);
         let url = '/cotizaciones';

         Swal.fire({
            title: "¿Esta seguro de realizar esta transaccion?",
            text: "Se guardara la cotización",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Si, confirmar!",
            cancelButtonText: "Cancelar",
         }).then((result) => {
            if (result.isConfirmed) {
               doc.getElementById('btn_guardar').disabled = true;
               loading();
               document.getElementById('btn_guardar').disabled = true;
               let datos = Object.fromEntries(formData);
               let insert = {
                  "cliente_id": datos.cliente_id,
                  "fecha": datos.fecha,
                  "productos": PRODUCTOS_VENTA
               };

               axios(
                  {
                     method: 'post',
                     url: url,
                     data: insert,
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
                              document.getElementById('btn_guardar').disabled = false;
                           }
                        });

                     } else {
                        Swal.fire({
                           icon: 'error',
                           title: 'Error',
                           confirmButtonText: 'Aceptar',
                           text: response.data.message,
                        });
                        document.getElementById('btn_guardar').disabled = false;
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

                     document.getElementById('btn_guardar').disabled = false;
                  });

            }
         });


      });
   });
</script>
<script>
   function loading(estado = true) {
      if (estado)
         Swal.fire({
            title: "Procesando...",
            text: "Por favor, espere.",
            allowOutsideClick: false,
            onBeforeOpen: () => {
               Swal.showLoading();
            },
         });
      else
         Swal.close();
   }

   function calcularSubtotal(valor, cantidad, descuento) {
      let subtotal = cantidad * valor;
      let total = subtotal - (subtotal * (descuento / 100));
      //let total = subtotal - descuento;
      doc.getElementById('subtotal').value = subtotal;
      doc.getElementById('total').value = total;
   }

   function actualizarTabla() {
      let tbody = document.getElementById('tbody');
      let neto_pagar = 0;
      tbody.innerHTML = '';
      PRODUCTOS_VENTA.forEach((producto, index) => {
         let fila = `
      <tr>
         <td>${producto.id}</td>
         <td>${producto.producto_nombre}</td>
         <td>${producto.cantidad}</td>
         <td>${moneyFormat(producto.valor)}</td>
         <td>${moneyFormat(producto.subtotal)}</td>
         <td>${(producto.descuento)}%</td>
         <td>${moneyFormat(producto.total)}</td>
         <td>
            <button type="button" class="btn btn-danger d-inline-flex align-items-center btnEliminar"
               data-id="${producto.id}">
               <svg data-id="${producto.id}" width="16" height="16" viewBox="0 0 24 24">
                     <path fill="currentColor"
                        d="M9 3v1H4v2h1v13a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V6h1V4h-5V3H9M7 6h10v13H7V6m2 2v9h2V8H9m4 0v9h2V8h-2Z" />
               </svg>
            </button>
         </td>
      </tr>`;
         tbody.innerHTML += fila;
         neto_pagar += parseFloat(producto.total);
      });

      PRODUCTOS_VENTA.neto_pagar = neto_pagar;
      let btnEliminar = document.querySelectorAll('.btnEliminar');
      doc.getElementById('total_pagar').value = `${moneyFormat(PRODUCTOS_VENTA.neto_pagar)}`;

      btnEliminar.forEach(btn => {
         btn.addEventListener('click', eliminarProducto);
      });
   }

   function eliminarProducto(e) {
      const id = parseInt(e.target.dataset.id);
      const idEliminar = PRODUCTOS_VENTA.findIndex(producto => producto.id === id);
      if (idEliminar !== -1) {
         PRODUCTOS_VENTA.splice(idEliminar, 1);
         actualizarTabla();
      }
      doc.getElementById('producto_id').selectedIndex = 0;
      doc.getElementById('cantidad').value = 0;
      doc.getElementById('descuento').value = 0;
      let event = new Event('change', { bubbles: true });
      doc.getElementById('producto_id').dispatchEvent(event);
   }

   function moneyFormat(value) {
      let valueConversion = new Intl.NumberFormat("es-CO", { style: "currency", currency: 'COP', minimumFractionDigits: 0 }).format(value);
      return valueConversion;
   }
</script>
@endsection
