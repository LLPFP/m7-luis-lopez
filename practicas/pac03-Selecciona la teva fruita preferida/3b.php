<?php
    // Pas 2: Crear l'array de fruites
    $frutas = [
        [
            'nombre' => 'Manzana',
            'imagen' => 'https://static.vecteezy.com/system/resources/previews/023/858/853/non_2x/ai-genrative-green-apple-free-png.png',
            'descripcion' => 'La manzana es una fruta de forma redonda y de color rojo brillante. Es una fruta muy popular y se consume en muchas recetas de cocina y postres. Es una fruta rica en vitaminas y minerales, como la vitamina C y el potasio.'
        ],
        [
            'nombre' => 'Plátano',
            'imagen' => 'https://img.freepik.com/foto-gratis/platano-unico-aislado-sobre-fondo-blanco_839833-17794.jpg',
            'descripcion' => 'El plátano es una fruta de forma alargada y de color amarillo brillante. Es una fruta muy popular y se consume en muchas recetas de cocina y postres. Es una fruta rica en vitaminas y minerales, como la vitamina C y el potasio.'
        ],
        [
            'nombre' => 'Naranja',
            'imagen' => 'https://media.istockphoto.com/id/672613170/es/foto/rodajas-de-naranja-aislado-sobre-blanco.jpg?s=612x612&w=0&k=20&c=GBaH5pQzLm0ugkBU1SrL3o9a0ED_tcFdVk8BbQmS7AQ=',
            'descripcion' => 'La naranja es una fruta cítrica de color naranja brillante. Es conocida por su alto contenido en vitamina C y su sabor refrescante.'
        ],
        [
            'nombre' => 'Fresa',
            'imagen' => 'https://media.istockphoto.com/id/1157946861/es/foto/fresa-de-baya-roja-aislada.jpg?s=612x612&w=0&k=20&c=lSELqZMZv9TmXjdTLczmiSzl3Z-jI81rRa_WloV8gcQ=',
            'descripcion' => 'La fresa es una fruta pequeña y roja, conocida por su dulzura y aroma. Es rica en antioxidantes y vitamina C.'
        ],
        [
            'nombre' => 'Kiwi',
            'imagen' => 'https://upload.wikimedia.org/wikipedia/commons/d/d3/Kiwi_aka.jpg',
            'descripcion' => 'El kiwi es una fruta pequeña y ovalada con piel marrón y pulpa verde. Es rico en vitamina C y fibra.'
        ]
    ];

    // Pas 3: Gestió de la selecció
    $seleccionada = isset($_GET['seleccionada']) ? intval($_GET['seleccionada']) : -1;

    // Pas 4: Funció per mostrar les fruites
    function mostraFruites($fruites, $seleccionada) {
        foreach ($fruites as $index => $fruta) {
            $estado = ($index == $seleccionada) ? '✔️ Seleccionada' : '✖ No seleccionada';
            $clase = ($index == $seleccionada) ? 'table-success' : 'table-danger';
            $accion = ($index == $seleccionada) ? 'Deseleccionar' : 'Seleccionar';
            $href = ($index == $seleccionada) ? '?' : "?seleccionada=$index";
            echo "<tr class='$clase'>
                    <td>{$fruta['nombre']}</td>
                    <td>$estado</td>
                    <td><a class='btn btn-primary' href='$href'>$accion</a></td>
                  </tr>";
        }
    }

    // Gestión del cambio de color
    $backgroundColor = isset($_GET['color']) ? $_GET['color'] : '#ffffff';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Frutas favoritas</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: <?php echo $backgroundColor; ?>;
        }
        .color-palette {
            position: fixed;
            top: 10px;
            right: 10px;
            display: flex;
            gap: 5px;
        }
        .color-option {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="color-palette">
        <a href="?color=%23ff0000<?php echo isset($_GET['seleccionada']) ? '&seleccionada=' . $_GET['seleccionada'] : ''; ?>"><div class="color-option" style="background-color: #ff0000;"></div></a>
        <a href="?color=%230000ff<?php echo isset($_GET['seleccionada']) ? '&seleccionada=' . $_GET['seleccionada'] : ''; ?>"><div class="color-option" style="background-color: #0000ff;"></div></a>
        <a href="?color=%2300ff00<?php echo isset($_GET['seleccionada']) ? '&seleccionada=' . $_GET['seleccionada'] : ''; ?>"><div class="color-option" style="background-color: #00ff00;"></div></a>
        <a href="?color=%23ffff00<?php echo isset($_GET['seleccionada']) ? '&seleccionada=' . $_GET['seleccionada'] : ''; ?>"><div class="color-option" style="background-color: #ffff00;"></div></a>
        <a href="?color=%23ffa500<?php echo isset($_GET['seleccionada']) ? '&seleccionada=' . $_GET['seleccionada'] : ''; ?>"><div class="color-option" style="background-color: #ffa500;"></div></a>
        <a href="?color=%23ffc0cb<?php echo isset($_GET['seleccionada']) ? '&seleccionada=' . $_GET['seleccionada'] : ''; ?>"><div class="color-option" style="background-color: #ffc0cb;"></div></a>
    </div>

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
                <?php mostraFruites($frutas, $seleccionada); ?>
            </tbody>
        </table>

        <?php
        // Pas 5: Mostrar la fruita seleccionada
            $fruta_seleccionada = $frutas[$seleccionada];
            echo "<div class='card mt-4 w-25 shadow-lg'>
                    <img src='{$fruta_seleccionada['imagen']}' class='card-img-top img-fluid' alt='{$fruta_seleccionada['nombre']}'>
                    <div class='card-body bg-warning'>
                        <h5 class='card-title'>{$fruta_seleccionada['nombre']}</h5>
                        <p class='card-text'>{$fruta_seleccionada['descripcion']}</p>
                    </div>
                  </div>";
        
        ?>

    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>