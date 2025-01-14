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
         color: #010000;
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
         left: 30px;
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
         padding: 4px;
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

      .row {
         width: 100%;
         overflow: hidden;
         /* Asegura que los floats no se salgan del contenedor */
         margin-top: 20px;
      }

      .col {
         float: left;
         width: 30%;
         text-align: center;
         padding: 10px;
      }

      .content img {
         display: inline-block;
         margin-right: 10px;
         width: 40px;
         /* Ajusta el tamaño según sea necesario */
      }
   </style>

</head>

<body>
   <div class="header">
      {{-- <img src="{{ public_path('images/empresa/logo-header-es.svg') }}" alt="Logo" class="logo"> --}}
      <img
         src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/empresa/logo-header-es.svg'))) }}"
         alt="Logo">
   </div>
   <div class="footer">
      <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/empresa/footer.png'))) }}"
         alt="Logo" class="logo">
   </div>
   <br>

   <div class="content page-break" style="padding-left:30px;padding-right:30px;">
      <p>
         Bucaramanga, {{ \Carbon\Carbon::now()->locale('es')->isoFormat('D [de] MMMM [de] YYYY') }}
      </p>
      <br>
      <h4>Señores
         <br>
         {{ $cliente }}
      </h4>
      <p style="text-align:justify;">
         Cordial saludo, Pro Cleaner Service SAS identificado con NIT 900.539.922-5, tiene el gusto de presentarles la
         siguiente
         propuesta comercial, la cual consiste en la prestación de un servicio de higiene integral que contempla no solo
         los más
         altos estándares de calidad, sino también, una amplia familia de sistemas de higiene y una serie de acciones
         que van
         desde asesoramiento hasta la realización de las visitas de mantenimiento periódico, aportando valor para la
         imagen de su
         compañía y bienestar para colaboradores y clientes. Nos diferencia el mejor servicio de atención personalizada,
         brindado
         por nuestro equipo de ejecutivos de cuenta y de nuestros técnicos especializados, quienes se encargan de
         realizar todas
         las tareas de mantenimiento y control, garantizando el óptimo resultado de cada uno de nuestros sistemas, los
         365 días
         del año.
      </p>
      <h3>1. PROPUESTA COMERCIAL</h3>

      <table class="table" style="font-size:10px;margin-top:5px;">
         <thead>
            <tr>
               <th>Item</th>
               <th>Descripción</th>
               <th>Cantidad Unitaria</th>
               <th>Frecuencia Días</th>
               <th>Valor Unitario</th>
               <th>Valor Total Concepto</th>
            </tr>
         </thead>
         <tbody>
            @foreach($productos as $producto)
            <tr>
               <td><img src="{{ public_path('images/productos/' . $producto['producto_foto']) }}"
                     style="width: 100;height: 100px;"></td>
               <td>{{ $producto['producto_nombre'] }}</td>
               <td>{{ $producto['cantidad'] }}</td>
               <td>28</td>
               <td>$ {{ number_format($producto['valor'],2) }}</td>
               <td>$ {{ number_format($producto['subtotal'],2) }}</td>
            </tr>
            @endforeach
         </tbody>
         <tfoot>
            <tr>
               <td colspan="5">Factura mensual antes de IVA</td>
               <td style="text-align: center;">$ {{ number_format($total, 2) }}</td>
            </tr>
            <tr>
               <td colspan="5">IVA</td>
               <td style="text-align: center;">$ {{ number_format($iva, 2) }}</td>
            </tr>
            <tr>
               <td colspan="5">Factura mensual despues de IVA</td>
               <td style="text-align: center;">$ {{ number_format($total+$iva, 2) }}</td>
            </tr>
            <tr>
               <td colspan="5">Deposito</td>
               <td style="text-align: center;">$ {{ number_format($total+$iva, 2) }}</td>
            </tr>
         </tfoot>
      </table>

   <div style="justify-content: center;">

      <table width="100%" cellpadding="0" cellspacing="0" border="0" style="margin-left: 40px;">
         <tr>
            <td style="vertical-align:middle; border:none; padding:0; width:42px;">
               <img src="{{ public_path('images/empresa/ico-banios.png') }}" alt="" width="42" height="42"
                  style="vertical-align:middle;">
            </td>
            <td style="vertical-align:middle; border:none; padding-left: 10px;">
               <p style="font-size:12px;color:#002071; margin:0;">SOLUCIONES <br><b>PARA BAÑOS</b></p>
            </td>

            <td style="vertical-align:middle; border:none; padding:0; width:42px;">
               <img src="{{ public_path('images/empresa/ico-pisos.png') }}" alt="" width="42" height="42"
                  style="vertical-align:middle;">
            </td>
            <td style="vertical-align:middle; border:none; padding-left: 10px;">
               <p style="font-size:12px;color:#002071; margin:0;">SOLUCIONES <br><b>PARA AMBIENTES</b></p>
            </td>

            <td style="vertical-align:middle; border:none; padding:0; width:42px;">
               <img src="{{ public_path('images/empresa/ico-salas.png') }}" alt="" width="42" height="42"
                  style="vertical-align:middle;">
            </td>
            <td style="vertical-align:middle; border:none; padding-left: 10px;">
               <p style="font-size:12px;color:#002071; margin:0;">SOLUCIONES <br><b>PARA PISOS</b></p>
            </td>
         </tr>
      </table>
   </div>

   <div class="page-break"></div>

   <div class="content">
      <h2 style="color:#002071;">CONDICIONES COMERCIALES:</h2>
      <ul>
         <li>
            La instalación se realizará de <b style="color:#002071;">uno a cuatro días una vez confirmada la venta.</b>
         </li>
         <li>
            <b style="color:#002071;">La condición de pago:</b> Contado
         </li>
         <li>
            El pago de la <b style="color:#002071;">Factura es Mensual</b>, lo pueden realizar por transferencia
            Bancaria a la cuenta corriente de la
            empresa
            (CUENTA CORRIENTE 79341574625 PRO CLEANER SERVICE SAS identificado(a) con NIT 900539922)
         </li>
         <li>
            <b style="color:#002071;">El Depósito Garantía</b> que es un pago por el mismo valor de un servicio que se
            cancela una única, siendo un
            beneficio
            para ustedes, este depósito en garantía será redimible en un último servicio pasando la solicitud con un mes
            de
            anterioridad.
         </li>
      </ul>

      <h2 style="color:#002071;">COMPROMISOS PROHYGIENE:</h2>
      <ul>
         <li>
            <b style="color:#002071;">Provisión de productos de excelencia,</b> con los más altos estándares de calidad.
         </li>
         <li>
            Los Sistemas son <b style="color:#002071;">Instalados en Comodato,</b> por lo cual no tiene que invertir en
            la compra de los mismos. Todos
            los repuestos y demás insumos los dará la compañía con el fin de garantizar el servicio.
         </li>
         <li>
            El servicio de <b style="color:#002071;">Prohygiene es cada 28 días con el fin de garantizar una efectividad
               100% del insumo.</b>
         </li>
         <li>
            <b style="color:#002071;">El Servicio Personalizado:</b> Ofrece excelente calidad cubriendo siempre las
            necesidades eficientemente en un
            ambiente e imagen con las personas que circulan dentro de ella.
         </li>
      </ul>
   </div>

   <div class="content">
      <table width="100%" cellpadding="0" cellspacing="0" border="0">
         <tr>
            <td colspan="3" style="border:none;">
               <h3 style="text-align:center;">CONTAMOS CON UN SERVICIO INTEGRAL</h3>
            </td>
         </tr>
         <tr>
            <td style="width: 33.33%; background-color: #002071; color:#ffffff; text-align:center;">
               <h3>Asesoramos</h3>
               <p>Estudiamos las necesidades y planificamos una solución a medida.</p>
            </td>
            <td style="width: 33.33%; background-color: #A1A1B0; color:#ffffff; text-align:center;">
               <h3>Instalamos</h3>
               <p>Colocamos nuestros equipos y sistemas.</p>
            </td>
            <td style="width: 33.33%; background-color: #0085D0; color:#ffffff; text-align:center;">
               <h3>Garantizamos</h3>
               <p>Seguimiento continuo para el correcto funcionamiento.</p>
            </td>
         </tr>
      </table>
   </div>

   {{-- <div class="page-break"></div> --}}

   <table width="100%" cellpadding="10" cellspacing="0" border="0" style="margin: 0 auto;">
      <!-- Fila 1: Soluciones para baños -->
     <tr>
      <td style="vertical-align: middle; width: 15%; border:none;">
         <img src="{{ public_path('images/empresa/ico-banios.png') }}" alt="" style="vertical-align:middle;">
         <span style="font-size:22px;color:#002071;">SOLUCIONES <b>PARA BAÑOS</b></span>
      </td>
      <td style="vertical-align: middle; width: 85%; border:none;">
         <img src="{{ public_path('images/empresa/solucion_baños.png') }}" alt="" style="width: 300px;">
      </td>
   </tr>

      <!-- Fila 2: Soluciones para ambientes -->
      <tr>
         <td style="vertical-align: middle; width: 15%; border:none;">
            <img src="{{ public_path('images/empresa/solucion_ambientes.png') }}" alt="" style="width: 250px;">
         </td>
         <td style="vertical-align: middle; width: 85%; border:none;">
            <img src="{{ public_path('images/empresa/ico-pisos.png') }}" alt="" style="vertical-align:middle;">
            <span style="font-size:22px;color:#002071;">SOLUCIONES <b>PARA AMBIENTES</b></span>
         </td>
      </tr>

      <!-- Fila 3: Soluciones para pisos -->
      <tr>
         <td style="vertical-align: middle; width: 15%; border:none;">
            <img src="{{ public_path('images/empresa/ico-salas.png') }}" alt="" style="vertical-align:middle;">
            <span style="font-size:22px;color:#002071;">SOLUCIONES <b>PARA PISOS</b></span>
         </td>
         <td style="vertical-align: middle; width: 85%; border:none;">
            <img src="{{ public_path('images/empresa/solucion_pisos.png') }}" alt="" style="width: 300px;">
         </td>
      </tr>
   </table>

   <div class="page-break"></div>

   <div class="content">
      <br>
      <center>
         <h3>ALGUNOS DE NUESTROS CLIENTES QUE CORRESPONDEN A OTROS SECTORES</h3>
      </center>
      <div style="text-align: center;">
         <table width="100%" border="0" cellspacing="0" cellpadding="10">
            <tr>
               <td valign="top" width="50%">
                  <ul style=" list-style-type: none; padding-left: 0;font-size: 12px;">
                     <li>MEDICLINICOS</li>
                     <li>RUTAL DEL CACAO</li>
                     <li>IPS CABECERA</li>
                     <li>MEDICUC IPS LTDA</li>
                     <li>CLUB DEL COMERCIO</li>
                     <li>HOSPITAL PSIQUIATRICO SAN CAMILO</li>
                     <li>CENTRO COMERCIAL CACIQUE</li>
                     <li>CENTRO COMERCIAL PARQUE CARACOLI</li>
                     <li>CENTRO COMERCIAL PANAMA</li>
                     <li>CENTRO COMERCIAL EL PUENTE</li>
                     <li>CLINICA DE LA POLICIA</li>
                     <li>RESTAURANTE PAL CAMINITO S.A.S</li>
                     <li>CENTRO COMERCIAL LA FLORIDA</li>
                     <li>BOMBEROS</li>
                     <li>CENTRO COMERCIAL MEGAMALL</li>
                     <li>MISION CARISMATICA BARRANCABERMEJA</li>
                     <li>DE LA FE FUNERARIA BARRANCA</li>
                     <li>COLEGIO PRESENTACIÓN</li>
                     <li>NEOMUNDO</li>
                     <li>EMPAS</li>
                     <li>CENTRO COMERCIAL VIVA BARRANCABERMEJA</li>
                     <li>ESSA</li>
                     <li>CLINICA FOSUNAB</li>
                     <li>FUNDACION CARDIO VASCULAR DE COLOMBIA</li>
                     <li>ASOPORMEN</li>
                     <li>UISALUD</li>
                     <li>UNIVERSIDAD MANUELA BELTRAN</li>
                     <li>FUNERARIA LOS OLIVOS BUCARAMANGA</li>
                     <li>CAMPESTRE</li>
                     <li>HOTEL PUNTA DIAMANTE</li>
                     <li>COMERCIAL NUTRESA S.A.S</li>
                     <li>URBANAS</li>
                     <li>AVIDESA MAC POLLO S.A.</li>
                     <li>FENALCO</li>
                     <li>COPETRAN</li>
                  </ul>
               </td>
               <td valign="top" width="59%">
                  <ul style=" list-style-type: none; padding-left: 0;font-size: 12px;">
                     <li>CONJUNTO RESIDENCIAL CAMINOS DE PROVVIDENZA</li>
                     <li>HOSPITAL UNIVERSITARIO DE SANTANDER</li>
                     <li>HIGUERA ESCALANTE</li>
                     <li>CLUB CAMPESTRE</li>
                     <li>GRUPO MANEJAR GREEN GOLD</li>
                     <li>LOS COMUNEROS HOSPITAL UNIVERSITARIO</li>
                     <li>CLINICA FOSCAL INTERNACIONAL COMPLEJO</li>
                     <li>CENTRO COMERCIAL DE LA CUESTA</li>
                     <li>CENTRO COMERCIAL ACROPOLIS</li>
                     <li>COCA COLA</li>
                     <li>CENTRO MEDICO CARLOS ARDILA LULE</li>
                     <li>CENTRO COMERCIAL Y V ETAPA</li>
                     <li>HOSPITAL INTERNACIONAL DE COLOMBIA</li>
                     <li>COMANDO DE LA POLICIA DE BARRANCABER</li>
                     <li>EDIFICIO CENTRO MEDICO CLI NICA BUCARAM IGLESIA</li>
                     <li>CENTRO FAMILIAR DE ADORACION BARRANC CAPILLA</li>
                     <li>FUNERARIA LOS OLIVOS BARRANCA</li>
                     <li>COLEGIO PANAMERICANO</li>
                     <li>HIPINTO BARRANCABERMEJA</li>
                     <li>IGLESIA EMBAJADORES DE CRISTO</li>
                     <li>CACIQUE EL CENTRO COMERCIAL Y DE NEGOC</li>
                     <li>CAMARA DE COMERCIO</li>
                     <li>COMFENALCO</li>
                     <li>CENTRO MEDICA CARLOS ARDILA LULLE IPS</li>
                     <li>IPS CABECERA</li>
                     <li>CAJASAN</li>
                     <li>NORGAS</li>
                     <li>CENTRO COMERCIAL Y EMPRESARIAL SAN SIL CLUB</li>
                     <li>INCUBADORA DE SANTANDER</li>
                     <li>ITALCOL SA</li>
                     <li>HOTEL HOLIDAY INN</li>
                     <li>COCA COLA</li>
                     <li>MARVAL</li>
                     <li>DISTRAVES SAS</li>
                     <li>VIFENALCO</li>
                  </ul>
               </td>
            </tr>
         </table>
         <!-- <img src="{{ public_path('images/empresa/hoja2.png') }}" alt="Logo" class="logo"> -->
      </div>
   </div>

</body>

</html>
