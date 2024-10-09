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

      .row {
         width: 100%;
         overflow: hidden;
         /* Asegura que los floats no se salgan del contenedor */
         margin-top: 20px;
      }

      .col {
         float: left;
         /* Usa float en lugar de flexbox */
         width: 30%;
         |
         /* Asegura que las tres columnas ocupen el 100% en total */
         text-align: center;
         padding: 10px;
         box-sizing: border-box;
         /* Para mantener el padding dentro de las columnas */
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
      <img src="{{ public_path('images/empresa/logo-header-es.svg') }}" alt="Logo" class="logo">
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
      <br>

      <table class="table" style="font-size:10px;">
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
                     style="width: 150;height: 150px;"></td>
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
   </div>
   <div class="row">
      <div class="col">
         <div class="content" style="display:flex;align-items: center;line-height:1.2;width:200px;">
            <img src="{{ public_path('images/empresa/ico-banios.png')}}" alt=""><span
               style="font-size:22px;color:#002071;">SOLUCIONES <b>PARA BAÑOS</b></span>
         </div>
      </div>
      <div class="col">
         <div class="content" style="display:flex;align-items: center;line-height:1.2;width:250px;">
            <img src="{{ public_path('images/empresa/ico-pisos.png' ) }}" alt=""><span
               style="font-size:22px;color:#002071;">SOLUCIONES <b>PARA AMBIENTES</b></span>
         </div>
      </div>
      <div class="col">
         <div class="content" style="display:flex;align-items: center;line-height:1.2;width:200px;">
            <img src="{{ public_path('images/empresa/ico-salas.png') }}" alt=""><span
               style="font-size:22px;color:#002071;">SOLUCIONES <b>PARA PISOS</b></span>
         </div>
      </div>
   </div>
   <table class="table" style="border-style:none;">
      <tbody>
         <tr>
            <td style="border-style:none;padding:0px 0px 0px 0px;margin:0px 0px 0px 0px;">
               <img src="{{ public_path('images/empresa/ico-banios.png')}}" alt=""
                  style="width: 36px;height: 36px;padding:0px 0px 0px 0px;">
            </td>

            <td style="border-style:none;font-size:13px;">Soluciones para baños</td>

            <td style="border-style:none;padding:0px 0px 0px 0px;margin:0px 0px 0px 0px;">
               <img src="{{ public_path('images/empresa/ico-pisos.png') }}" alt=""
                  style="width: 36px;height: 36px;padding:0px 0px 0px 0px;">
            </td>

            <td style="border-style:none;font-size:13px;padding:0px 0px 0px 0px;margin:0px 0px 0px 0px;">Soluciones para
               ambientes</td>

            <td style="border-style:none;padding:0px 0px 0px 0px;margin:0px 0px 0px 0px;">
               <img src="{{ public_path('images/empresa/ico-salas.png') }}" alt=""
                  style="width: 36px;height: 36px;padding:0px 0px 0px 0px;">
            </td>

            <td style="border-style:none;font-size:13pxpadding:0px 0px 0px 0px;margin:0px 0px 0px 0px;">Soluciones para
               pisos</td>
         </tr>
      </tbody>
   </table>

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
   <section>
      <h3>CONTAMOS CON UN SERVICIO INTEGRAL</h3>
      <div class="row">
         <div class="col" style="height:150px; background-color: #002071;color:#ffffff;">
            <h3>Asesoramos</h3>
            <p>Estudiamos las necesidades y planificamos una solución a medida.</p>
         </div>
         <div class="col" style="height:150px; background-color: #A1A1B0;color:#ffffff;">
            <h3>Instalamos</h3>
            <p>Colocamos nuestros equipos y sistemas.</p>
         </div>
         <div class="col" style="height:150px; background-color: #0085D0;color:#ffffff;">
            <h3>Garantizamos</h3>
            <p>Seguimiento continuo para el correcto funcionamiento.</p>
         </div>
      </div>
   </section>

   <div class="page-break"></div>

   <section>
      <h3>TE PRESENTAMOS NUESTRAS SOLUCIONES DE HIGIENE Y BIENESTAR</h3>
      <div class="row">
         <div class="col" style="width: 15%;">
            <div class="content" style="display:flex;align-items: center;line-height:1.2;width:200px;">
               <img src="{{ public_path('images/empresa/ico-banios.png')}}" alt=""><span
                  style="font-size:22px;color:#002071;">SOLUCIONES <b>PARA BAÑOS</b></span>
            </div>
         </div>
         <div class="col">
            <img src="{{ public_path('images/empresa/solucion_baños.png' ) }}" alt="" style="width: 300px;">
         </div>
      </div>
      <div class="row">
         <div class="col" style="width: 15%;">
            <img src="{{ public_path('images/empresa/solucion_ambientes.png' ) }}" alt="" style="width: 250px;">
         </div>
         <div class="col">
            <div class="content" style="display:flex;align-items: center;line-height:1.2;width:250px;">
               <img src="{{ public_path('images/empresa/ico-pisos.png' ) }}" alt=""><span
                  style="font-size:22px;color:#002071;">SOLUCIONES <b>PARA AMBIENTES</b></span>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col" style="width: 15%;">
            <div class="content" style="display:flex;align-items: center;line-height:1.2;width:200px;">
               <img src="{{ public_path('images/empresa/ico-salas.png') }}" alt=""><span
                  style="font-size:22px;color:#002071;">SOLUCIONES
                  <b>PARA PISOS</b></span>
            </div>
         </div>
         <div class="col">
            <img src="{{ public_path('images/empresa/solucion_pisos.png' ) }}" alt="" style="width: 250px;">
         </div>
      </div>
   </section>

   <div class="content">
      <br>
      <center>
         <h3>ALGUNOS DE NUESTROS CLIENTES QUE CORRESPONDEN A OTROS SECTORES</h3>
      </center>
      <div style="text-align: center;">
         <table width="100%" border="0" cellspacing="0" cellpadding="10">
            <tr>
               <td valign="top" width="50%">
                  <ul style=" list-style-type: none; padding-left: 0;">
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
                  <ul style=" list-style-type: none; padding-left: 0;">
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

   <div class="page-break"></div>

   <div class="content">
      <br>
      <div style="text-align: center">
         <img src="{{ public_path('images/empresa/hoja3.png') }}" alt="Logo" class="logo">
      </div>
   </div>
</body>

</html>
