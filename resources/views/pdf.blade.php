<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>CODElABS</title>
    <style>
        /* Estilos CSS para personalizar el aspecto del PDF */
        body {
            font-family: Arial, sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 10px;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #333;
            color: white;
        }
    </style>
</head>

<body>
    <img src="https://medify-labs-frontend-gbvaldez.vercel.app/assets/img/header-2.jpg" alt="" width="300px">
    <h1>Cod<span style="color: red;">e</span>Labs</h1>

    <p>Estimado cliente</p>
    <p>Este informe presenta un resumen de los resultados de su muestra médica individual. A continuación, se detallan los aspectos clave de su muestra, lo que le proporcionará una visión precisa de su situación médica.</p>
    @if (!empty($data))
    <table style="max-width: 80%; width: 100%;">
        <tr>
            @foreach(array_keys(reset($data)) as $column)
            <th>{{ $column }}</th>
            @endforeach
        </tr>
        @foreach($data as $item)
        <tr>
            @foreach($item as $value)
            <td>{{ $value }}</td>
            @endforeach
        </tr>
        @endforeach
    </table>
    @else
    <p>No hay datos disponibles.</p>
    @endif
    <br>
    <p>
        Este resumen se centra en una única muestra médica, lo que facilita la comprensión de los datos relacionados con su salud. Si tiene alguna pregunta o necesita aclaraciones adicionales, no dude en ponerse en contacto con nuestro equipo médico.

    </p>
    <p>Atentamente</p>
    <p>CodeLabs.S.A.</p>
</body>

</html>