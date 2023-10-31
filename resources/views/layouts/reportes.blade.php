<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Medify Labs | @yield('titulo')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        .salto-pagina {
            page-break-after: always;
        }

        .text-header {
            color: #0179bd;
        }

        @font-face {
            font-family: 'Roboto';
            font-style: normal;
            font-weight: 300;
            src: local('Roboto Light'), local('Roboto-Light'), url(https://fonts.gstatic.com/s/roboto/v20/KFOlCnqEu92Fr1MmSU5vAw.ttf) format('truetype');
        }

        @font-face {
            font-family: 'Roboto';
            font-style: normal;
            font-weight: 400;
            src: local('Roboto'), local('Roboto-Regular'), url(https://fonts.gstatic.com/s/roboto/v20/KFOmCnqEu92Fr1Me5Q.ttf) format('truetype');
        }

        @font-face {
            font-family: 'Roboto';
            font-style: normal;
            font-weight: 700;
            src: local('Roboto Bold'), local('Roboto-Bold'), url(https://fonts.gstatic.com/s/roboto/v20/KFOlCnqEu92Fr1MmWUlvAw.ttf) format('truetype');
        }

        /* Añado la declaración de font-family, para usar la fuente de Google Fonts en este PDF */

        body {
            font-family: 'Roboto', serif;
        }

        * {
            font-family: 'Roboto', serif;
            line-height: 2px !important;
        }

        h1,
        h3,
        h4 {
            font-family: 'Roboto', serif;
        }

        td,th {
            padding-top: 20px !important;
            white-space: normal;
    	}
        span{
            color: #000000 !important;
        }
    </style>
    @yield('css')
</head>

<body>
    @section('portada')
        <div style="padding: 2rem;">
            <div
                style="border-bottom: 3px solid #0152bd; display:flex;justify-content:space-between;margin-bottom:20px !important;padding-bottom:.8rem;">
                <div style="display: flex; justify-content:space-around; align-items:center;margin-top: -30px">
                    <div style="max-width: 150px">
                        <img src="{{ public_path('icon-medify.png') }}" alt="LOGO" style="max-width: 80px;">
                    </div>
                    <div style="margin-left:105px;color:#0179bd;margin-top: -50px">
                        <p style="font-size:33px;text-align:left;font-weight: 700;">Medify Labs</p>
                        <p style="font-size:20px;text-align:left">Laboratorio clinico</p>
                    </div>
                </div>
                <div style="color:#0179bd;margin-top: -200px">
                    <p style="font-size:13px;text-align:right">12 Calle 7-38 Zona 9, Guatemala</p>
                    <p style="font-size:13px;text-align:right">Telefono: 5459-3913</p>
                    <p style="font-size:13px;text-align:right">WhatsApp: 5467-2190</p>
                    <p style="font-size:13px;text-align:right">consultas@medify.com.gt</p>
                </div>
            </div>
        @show
        <div>
            @yield('contenido')
        </div>
</body>

</html>
