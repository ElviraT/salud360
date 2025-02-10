<!doctype html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    <title>{{ 'Contactanos' }}</title>
    <style>
        body {
            font-family: "Segoe UI";
            font-size: 16px;
        }

        .rec {
            padding: 10px;
            justify-content: justify;
            align-content: justify;
            text-align: justify;
            letter-spacing: 0.7px;
            line-height: 24px;
            font-size: 14px;
        }
    </style>
</head>

<body>
    <div class="rec">
        <h3> {{ 'Estimado(a) GEMATECHNOLOGY,' }}</h3>

        <p> {{ 'Mi nombre es' }} <strong>{{ $data['name'] . ' ' . $data['lastname'] }}</strong>
        </p>

        <p> {{ $data['message'] }}
        </p>

        <p> {{ 'Quedo a la espera de su pronta respuesta.' }}</p>

        <p> {{ 'Atentamente,' }}</p>
        <strong>{{ $data['name'] . ' ' . $data['lastname'] }}</strong>

    </div>
</body>

</html>
