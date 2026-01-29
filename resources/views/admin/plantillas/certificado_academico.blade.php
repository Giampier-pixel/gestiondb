<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Certificado</title>
    <style>
    @page {
        margin: 0;
        padding: 0;
        size: 1400px 992px;
    }
    body {
        margin: 0;
        padding: 0;
        width: 1400px;
        height: 992px;
        position: relative;
        overflow: hidden;
    }
    .Certificado_base {
        position: fixed;
        top: 0;
        left: 0;
        width: 1400px;
        height: 992px;
        z-index: 1;
        object-fit: cover;
    }
    .contenido_certificado {
        position: relative;
        z-index: 2;
        padding-left: 230px;
        padding-right: 230px;
        padding-top: 310px;
        width: 940px;
    }
    * {
        font-family: 'Arial', sans-serif;
        box-sizing: border-box;
    }
    .p1 {
        width: 100%;
        text-align: left;
        font-size: 24px;
        font-style: italic;
        margin-bottom: 10px;
        margin-top: 0;
    }
    .p2 {
        width: 100%;
        text-align: center;
        font-size: 40px;
        font-weight: bold;
        margin: 20px 0;
    }
    .p3 {
        text-align: justify;
        font-size: 24px;
        line-height: 1.5;
        margin-bottom: 20px;
    }
    .p4 {
        text-align: right;
        font-size: 24px;
        margin-top: 30px;
    }
    
    /* Estilos para impresión */
    @media print {
        body {
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .Certificado_base {
            position: absolute;
        }
    }
    </style>
</head>
<body>
    <img src="{{ $base64 }}" class="Certificado_base" alt="Certificado base">
    <div class="contenido_certificado">
        <p class="p1">
            Otorgado a:
        </p>
        <p class="p2">
            {{ $user->paternal_surname }} {{ $user->maternal_surname }} {{ $user->name }}
        </p>
        <p class="p3">
            Por su destacada participación en calidad de {{ $tipo->tipo }} en el evento de {{ $evento->nombre }} 
            llevado a cabo el {{ $dia }} de {{ $mes[$fecha->month] }} del {{ $fecha->year }} por
            la facultad de Ingeniería de Sistemas de la Universidad Nacional del Centro del Perú.
        </p>
        <p class="p4">
            Huancayo, {{ $dia }} de {{ $mes[$fecha->month] }} del {{ $fecha->year }}
        </p>
    </div>
</body>
</html>