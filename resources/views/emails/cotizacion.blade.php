<!DOCTYPE html>
<html lang="es">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Cotización Generada</title>
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
      <img src="{{ $logo }}" alt="Logo" style="width: 150px; height: auto;">
   </div>
   Estimado/a:<h1> {{ ($cotizacion->cliente->tipo_doc=='CC')?$cotizacion->cliente->nombres ."
      ".$cotizacion->cliente->apellidos:$cotizacion->cliente->razon_social}}</h1>
   <p>Adjunto encontrará la cotización generada para su solicitud.</p>
   <p>Si tiene alguna pregunta, no dude en ponerse en contacto con nosotros.</p>
   <p>¡Gracias por confiar en nosotros!</p>
</body>

</html>
