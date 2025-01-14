@extends('layouts.app')
@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
   .ttip-grid {
      background: #00206f;
      border: 2px solid #00206f;
      color: white;
      top: -8px;
      border-radius: 6px;
      padding: 2px;
      position: relative;
      z-index: 1;
      font-size: 13px;
   }
</style>
@endsection
@section('content')

<div class="card">
   <div class="card-header">
      <div class="row mb-2">
         <div class="col">
            <h5 class="mb-0">Editar cotización</h5>
         </div>
      </div>
   </div>
   <form id="frm" class="needs-validation" method="POST" novalidate>
      @csrf
      <input type="hidden" class="form-control" name="id" id="id" value="{{$datos->id}}">
      <div class="card-body">
         <div class="row mb-2">
            <div class="col-md-3">
               <div class="form-group">
                  <label for="fecha">Fecha de la cotización</label>
                  <div class="input-group">
                     <input name="fecha" type="text" class="form-control" placeholder="01/01/2024" id="fecha" autofocus
                        required value="{{$datos->fecha}}" readonly />
                     @error('fecha')
                     <div class="invalid-feedback">{{ $message }}</div>
                     @enderror
                  </div>
               </div>
            </div>
            <div class="col-md-9">
               <div class="form-group">
                  <label for="cliente_id">Cliente</label>
                  <div class="input-group">
                     <select name="cliente_id" class="form-select" id="cliente_id" required>
                        <option value="">Seleccione...</option>
                        @foreach ($clientes as $cliente)
                        <option {{$cliente->id==$datos->cliente_id?"selected":""}} value="{{ $cliente->id }}"
                           data-correo="{{$cliente->correo}}">{{ $cliente->documento }}
                           - {{ $cliente->tipo_doc == 'NIT' ? $cliente->razon_social : ($cliente->nombres . ' ' .
                           $cliente->apellidos) }}
                        </option>
                        @endforeach
                     </select>
                     @error('cliente_id')
                     <div class="invalid-feedback">{{ $message }}</div>
                     @enderror
                  </div>
               </div>
            </div>

         </div>
         <div class="row mb-2">
            <div class="col-md-4">
               <div class="form-group">
                  <label for="producto_id">Producto</label>
                  <div class="input-group">
                     <select name="producto_id" class="form-select" id="producto_id" required>
                        <option value="">Seleccione...</option>
                        @foreach ($productos as $item)
                        <option data-valor="{{ $item->valor }}" data-foto="{{$item->foto}}" data-frecuencia="{{$item->frecuencia_dias}}" value="{{ $item->id }}">{{
                           $item->producto }}</option>
                        @endforeach
                     </select>
                     @error('producto_id')
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
                  <label for="valor">Precio</label>
                  <span id="tip_valor" style="float: right; visibility: hidden;" class="ttip-grid">500,000</span>
                  <div class="input-group">
                     <input name="valor" type="number" class="form-control" placeholder="1000" id="valor" required />
                     @error('valor')
                     <div class="invalid-feedback">{{ $message }}</div>
                     @enderror
                  </div>
               </div>
            </div>
            <div class="col-md-2">
               <div class="form-group">
                  <label for="total">Total</label>
                  <div class="input-group">
                     <input name="total" type="text" class="form-control" id="total" readonly />
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
                        <th class="border-0">Precio</th>
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
                  <label for="subtotal" style="display: flex;justify-content:end;">
                     <h3>SubTotal: </h3>
                     <input name="subtotal" type="text" class="border-0 text-end display-6 w-50" id="subtotal" readonly>
                  </label>
                  <label for="descuento" class="mt-2" style="display: flex;justify-content:end;">
                     <h3>Dcto (%):</h3>
                     <input name="descuento" type="number" min="0" max="100" class="border-0 text-end display-6 w-50"
                        id="descuento">
                  </label>
                  <label for="subtotal2" class="mt-2" style="display: flex;justify-content:end;">
                     <h3>Subtotal:</h3>
                     <input name="subtotal2" type="text" class="border-0 text-end display-6 w-50" id="subtotal2"
                        readonly>
                  </label>
                  <label for="iva" class="mt-2" style="display: flex;justify-content:end;">
                     <h3>Iva (19%):</h3>
                     <input name="iva" type="text" class="border-0 text-end display-6 w-50" id="iva" readonly>
                  </label>
                  <label for="total" class="mt-2" style="display: flex;justify-content:end;">
                     <h3>Total a pagar:</h3>
                     <input name="total_pagar" type="text" class="border-0 text-end display-6 w-50" id="total_pagar"
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

   const datos=@php echo json_encode($datos); @endphp;
   let cantidad = doc.getElementById('cantidad');
   let descuento = doc.getElementById('descuento');

   doc.addEventListener('DOMContentLoaded', function () {

      datos.cotizacion_detalles.forEach((item, index) => {
         const nuevoProducto = {
            id: index + 1,
            producto_id: item.producto_id,
            producto_nombre: item.producto.producto,
            producto_foto: item.producto.foto,
            producto_frecuencia: item.producto.frecuencia_dias,
            valor: item.valor,
            cantidad: item.cantidad,
            total:item.subtotal,
            neto_pagar: item.total,
         };

         PRODUCTOS_VENTA.push(nuevoProducto);
         descuento.value=datos.descuento;
      });

      actualizarTabla();

      $('#cliente_id').select2();

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
                  producto_foto: doc.getElementById('producto_id').options[doc.getElementById('producto_id').selectedIndex].dataset.foto,
                  producto_frecuencia: doc.getElementById('producto_id').options[doc.getElementById('producto_id').selectedIndex].dataset.frecuencia,
                  valor: doc.getElementById('valor').value,
                  cantidad: cantidad.value,
                  total: doc.getElementById('total').value.replace(/\$|\.|,/g, '').trim(),
                  neto_pagar: parseFloat(doc.getElementById('total').value),
               };

               PRODUCTOS_VENTA.push(nuevoProducto);
               actualizarTabla();

               doc.getElementById('producto_id').selectedIndex = 0;
               doc.getElementById('cantidad').value = 0;
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
            let tipValor=opcion.dataset.valor ? opcion.dataset.valor : 0;
            if(valor>0){
            $("#tip_valor").text(numberFormat(valor));
            $("#tip_valor").css("visibility" , "visible");
            }else{
            $("#tip_valor").css("visibility" , "hidden");
            }
            doc.getElementById('valor').value = valor;

            calcularSubtotal(valor, cantidad.value ? cantidad.value : 0, descuento.value ? descuento.value : 0);
         }

         if (e.target.matches('#cantidad') || e.target.matches('#valor')) {
         let valor = doc.getElementById('valor').value
         calcularSubtotal(valor, cantidad.value ? cantidad.value : 0, descuento.value ? descuento.value : 0);
         let tipValor=valor;
         if(valor>0){
         $("#tip_valor").text(numberFormat(valor));
         $("#tip_valor").css("visibility" , "visible");
         }else{
         $("#tip_valor").css("visibility" , "hidden");
         }
         }


         if (e.target.matches('#cantidad') || e.target.matches('#valor')) {
            let valor = doc.getElementById('valor').value
            calcularSubtotal(valor, cantidad.value ? cantidad.value : 0, descuento.value ? descuento.value : 0);
         }

         if (e.target.matches('#descuento')) {
            calcularTotal(PRODUCTOS_VENTA.neto_pagar);
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
         let url = '/cotizaciones/update';

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
                  "id": doc.getElementById('id').value,
                  "cliente_id": datos.cliente_id,
                  "enviar_correo": datos.enviar_correo,
                  "correo": datos.correo,
                  "fecha": datos.fecha,
                  "subtotal": datos.subtotal.replace(/\$|\.|,/g, '').trim(),
                  "descuento": datos.descuento.replace(/\$|\.|,/g, '').trim(),
                  "subtotal2": datos.subtotal2.replace(/\$|\.|,/g, '').trim(),
                  "iva": datos.iva.replace(/\$|\.|,/g, '').trim(),
                  "total_pagar": datos.total_pagar.replace(/\$|\.|,/g, '').trim(),
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
                           // confirmButtonText: 'Aceptar',
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

   doc.getElementById('tbody').addEventListener('click', function(e) {
      if (e.target.closest('.btnEliminar')) {
         eliminarProducto(e);
      }
   });

</script>
<script>
   function numberFormat(nStr) {
   nStr += '';
   var x = nStr.split('.');
   var x1 = new String(x[0]);
   var x2 = x.length > 1 ? '.' + x[1] : '';
   var rgx = /(\d+)(\d{3})/;
   while (rgx.test(x1)) {
   x1 = x1.replace(rgx, '$1' + ',' + '$2');
   }

   return '$'+x1 + x2;
   };

   function loading(estado = true) {
      if (estado)
         Swal.fire({
            title: "Procesando...",
            text: "Por favor, espere.",
            allowOutsideClick: false,
            showCancelButton: false,
            showConfirmButton: false,
            onBeforeOpen: () => {
               Swal.showLoading();
            },
         });
      else
         Swal.close();
   }

   function calcularSubtotal(valor, cantidad, descuento) {
      let subtotal = cantidad * valor;
      doc.getElementById('total').value = `${moneyFormat(parseFloat(subtotal))}`;
   }

   function calcularTotal(neto_pagar) {
      let subtotal = doc.getElementById('subtotal').value ? doc.getElementById('subtotal').value.replace(/\$|\.|,/g, '').trim() : neto_pagar;
      let descuento = doc.getElementById('descuento').value ? doc.getElementById('descuento').value : 0;
      let subtotal2 = subtotal - (subtotal * (descuento / 100));
      let iva = subtotal2 * 0.19;
      let total_pagar = subtotal2 + iva;


      doc.getElementById('subtotal').value = `${moneyFormat(parseFloat(subtotal))}`;
      doc.getElementById('subtotal2').value = `${moneyFormat(parseFloat(subtotal2))}`;
      doc.getElementById('iva').value = `${moneyFormat(parseFloat(iva))}`;
      doc.getElementById('total_pagar').value = `${moneyFormat(parseFloat(total_pagar))}`;
      PRODUCTOS_VENTA.neto_pagar = parseFloat(total_pagar);
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

      doc.getElementById('subtotal').value = neto_pagar;
      calcularTotal(neto_pagar);
   }

   function eliminarProducto(e) {
      const id = parseInt(e.target.closest('.btnEliminar').dataset.id);
      const idEliminar = PRODUCTOS_VENTA.findIndex(producto => producto.id === id);

      if (idEliminar !== -1) {
         PRODUCTOS_VENTA.splice(idEliminar, 1);
         actualizarTabla();
      }
      doc.getElementById('producto_id').selectedIndex = 0;
      doc.getElementById('cantidad').value = 0;
      let event = new Event('change', { bubbles: true });
      doc.getElementById('producto_id').dispatchEvent(event);
   }

 function moneyFormat(value) {
let valueConversion = new Intl.NumberFormat("es-CO", { style: "currency", currency: 'COP', minimumFractionDigits: 0
}).format(value);
return valueConversion.replace(' ', '');
}
</script>
@endsection
