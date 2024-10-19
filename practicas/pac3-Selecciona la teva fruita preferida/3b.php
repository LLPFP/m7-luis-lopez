<?php


    $frutas=[
        [
            'nombre' => 'Manzana',
            'imagen' => 'https://www.elespectador.com/resizer/5Y60x35Y60x35Y60x35Y60x35Y60x35Y60x35Y60x35Y60x35Y60x35Y60x35Y60x35Y60x35Y60x35Y60x35Y60x35Y60x35Y60x35Y60x35Y60x35Y60x35Y60x35Y60x35Y60x35Y60x35Y60x35Y60x35Y60x35Y60x35Y60x35Y60x35Y60x35Y60x35Y60x35Y60x35Y60x35Y60x35Y60x35Y60x35,
            /uploads/2020/08/manzana-1.jpg',
            'descripcion' => 'La manzana es una fruta de forma redonda y de color rojo brillante. Es una fruta muy popular y se consume en muchas recetas de cocina y postres. Es una fruta rica en vitaminas y minerales, como la vitamina C y el potasio.'
        ],
        [
            'nombre' => 'Plátano',
            'imagen' => 'https://www.elespectador.com/resizer/5Y60x35Y60x35Y60x35Y60x35Y60x35Y60x35Y60x35Y60x35Y60x35Y60x35Y60x35Y60x35Y60x35Y60x35Y60x35Y60x35Y60x35Y60x35Y60x35Y60x35Y60x35Y60x35Y60x35Y60x35Y60x35Y60x35Y60x35Y60x35Y60x35Y60x35Y60x35Y60x35Y60x35Y60x35Y60x35Y60x35Y60x35Y60
            x35Y60x35Y60x35Y60x35Y60x35Y60x35Y60x35Y60x35Y60x35Y60x35Y60x35Y60x35Y60x35Y60x35Y60x35Y60x35Y60x35Y60x35Y60x35Y60x35Y60x35Y60x35Y60x35Y60x35Y60x35Y60x35Y60x35Y60x35Y60x35Y60x35Y60x35Y60x35Y60x35Y60x35Y60x35Y60x35Y60x35Y60x35Y60x35Y60x35Y60x35Y60x35Y60x35Y
            /uploads/2020/08/platano-1.jpg',
            'descripcion' => 'El plátano es una fruta de forma alargada y de color amarillo brillante. Es una fruta muy popular y se consume en muchas recetas de cocina y postres. Es una fruta rica en vitaminas y minerales, como la vitamina C y el potasio.'
            ],
        [

        ]

    ]

    


?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Frutas favoritas</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Selecciona tu fruta favorita</h1>

        <table class="table table-bordered mt-4">
            <thead class="thead-dark">
                <tr>
                    <th>Fruta</th>
                    <th>Estado</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                <tr class="table-danger">
                    <td>Manzana</td>
                    <td>✖ No seleccionada</td>
                    <td><a class="btn btn-primary" href="">Seleccionar</a></td>
                </tr>
                <tr class="table-danger">
                    <td>Plátano</td>
                    <td>✖ No seleccionada</td>
                    <td><a class="btn btn-primary" href="">Seleccionar</a></td>
                </tr>
                <tr class="table-danger">
                    <td>Naranja</td>
                    <td>✖ No seleccionada</td>
                    <td><a class="btn btn-primary" href="">Seleccionar</a></td>
                </tr>
                <tr class="table-danger">
                    <td>Fresa</td>
                    <td>✖ No seleccionada</td>
                    <td><a class="btn btn-primary" href="">Seleccionar</a></td>
                </tr>
                <tr class="table-danger">
                    <td>Kiwi</td>
                    <td>✖ No seleccionada</td>
                    <td><a class="btn btn-primary" href="">Seleccionar</a></td>
                </tr>
            </tbody>
        </table>

        <!-- Mostrar tarjeta de la fruta seleccionada (actualmente estatica, siempre hay una manzana) -->
        <div class="card mt-4 w-25 shadow-lg">
            <img src="https://static.vecteezy.com/system/resources/previews/023/858/853/non_2x/ai-genrative-green-apple-free-png.png" class="card-img-top img-fluid" alt="Manzana">
            <div class="card-body bg-warning">
                <h5 class="card-title">Manzana</h5>
                <p class="card-text">¡Esta es tu fruta favorita!</p>
            </div>
        </div>

    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>


<!-- aqui tienes el emoji de SELECCIONADA ✔️ para copiarlo y usarlo en la práctica -->