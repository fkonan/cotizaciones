<!DOCTYPE html>
<html lang="es">

<head>
   <meta charset="UTF-8">
   <title>Cotización</title>
   <style>
      @page {
         margin: 100px 25px;
      }

      body {
         font-family: Arial, sans-serif;
         line-height: 1.6;
         color: #333;
      }

      .header {
         position: fixed;
         top: -60px;
         left: 0px;
         right: 0px;
         height: 50px;
         text-align: left;
         line-height: 35px;
      }

      .header img {
         height: 50px;
         width: auto;
      }

      .footer {
         position: fixed;
         bottom: -30px;
         left: 0px;
         right: 0px;
         height: 30px;
         text-align: center;
         line-height: 35px;
      }

      .page-break {
         page-break-after: always;
      }

      table {
         width: 100%;
         border-collapse: collapse;
         margin-bottom: 20px;
      }

      th,
      td {
         border: 1px solid #ddd;
         padding: 8px;
         text-align: left;
      }

      th {
         background-color: #f2f2f2;
         color: #333;
         font-weight: bold;
      }

      tr:nth-child(even) {
         background-color: #f9f9f9;
      }

      .total-row {
         font-weight: bold;
         background-color: #e8e8e8;
      }
   </style>

</head>

<body>
   <div class="header">
      <img src="{{ public_path('images/empresa/66b53d8a7647f.png') }}" alt="Logo" class="logo">
   </div>
   <div class="footer">
      <img src="{{ public_path('images/empresa/footer.png') }}" alt="Logo" class="logo">
   </div>
   <br>
   <br>

   <div class="content">
      <p>
         Bucaramanga, {{now()->format('d \d\e F \d\e\l Y')}}
      </p>

      <h5>Señores
         <br>
         {{ $cliente }}
      </h5>
      <br>
      <br>
      <p>
         Cordial saludo, tengo el gusto de presentarles la siguiente propuesta comercial, la cual consiste en la
         prestación
         de un
         servicio de higiene integral que contempla no solo los más altos estándares de calidad, sino también, una
         amplia
         familia
         de sistemas de higiene y una serie de acciones que van desde asesoramiento hasta la realización de las visitas
         de
         mantenimiento periódico, aportando valor para la imagen de su compañía y bienestar para colaboradores y
         clientes.
      </p>
      <h3>Cotización</h3>
      <br>
      <br>

      <table class="table">
         <thead>
            <tr>
               <th>Producto</th>
               <th>Cantidad</th>
               <th>Valor</th>
               <th>Subtotal</th>
               <th>Descuento</th>
               <th>Total</th>
            </tr>
         </thead>
         <tbody>
            @foreach($productos as $producto)
            <tr>
               <td>{{ $producto['producto_nombre'] }}</td>
               <td>{{ $producto['cantidad'] }}</td>
               <td>{{ $producto['valor'] }}</td>
               <td>{{ $producto['subtotal'] }}</td>
               <td>{{ $producto['descuento'] }}</td>
               <td>{{ $producto['total'] }}</td>
            </tr>
            @endforeach
         </tbody>
         <tfoot>
            <tr class="total-row">
               <td colspan="3">Totales</td>
               <td>{{ number_format($subtotal, 2) }}</td>
               <td>{{ number_format($descuento, 2) }}</td>
               <td>{{ number_format($total, 2) }}</td>
            </tr>
         </tfoot>
      </table>
   </div>

   <div class="page-break"></div>

   <div class="content">
      <h2>CONDICIONES COMERCIALES:</h2>

      <ul>
         <li>
            Tiempo mínimo en la Compañía es de 6 meses
         </li>
         <li>
            La instalación se realizará de uno a cuatro días una vez confirmada la venta
         </li>
         <li>
            La condición de pago: Contado
         </li>
         <li>
            El pago de la Factura es Mensual, lo pueden realizar por transferencia Bancaria a la cuenta corriente de la
            empresa (CUENTA CORRIENTE 79341574625 PRO CLEANER SERVICE SAS identificado(a) con NIT 900539922)
         </li>
         <li>
            El Depósito Garantía que es un pago por el mismo valor de un servicio que se cancela una única, siendo un
            beneficio para ustedes, este depósito en garantía será redimible en un último servicio pasando la solicitud
            con un mes de anterioridad.
         </li>
      </ul>

      <h2>COMPROMISOS PROHYGIENE:</h2>
      <ul>
         <li>
            Provisión de productos de excelencia, con los más altos estándares de calidad.
         </li>
         <li>
            Los Sistemas son Instalados en Comodato, por lo cual no tiene que invertir en la compra de los mismos. Todos
            los repuestos y demás insumos los dará la compañía con el fin de garantizar el servicio.
         </li>
         <li>
            El servicio de Prohygiene es cada 28 días con el fin de garantizar una efectividad 100% del insumo.
         </li>
         <li>
            El Servicio Personalizado: Ofrece excelente calidad cubriendo siempre las necesidades eficientemente en un
            ambiente e imagen con las personas que circulan dentro de ella.
         </li>
      </ul>
   </div>
   <div class="page-break"></div>

   <div class="content">
      <br>
      <div style="text-align: center">
         <img src="{{ public_path('images/empresa/hoja2.png') }}" alt="Logo" class="logo">
      </div>
   </div>

   <div class="page-break"></div>

   <div class="content">
      <br>
      <div style="text-align: center">
         <img src="{{ public_path('images/empresa/hoja3.png') }}" alt="Logo" class="logo">
      </div>
   </div>
</body>

</html>
