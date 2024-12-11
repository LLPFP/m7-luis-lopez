<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Mercadona productos</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<style>
    /* CSS para usar Flexbox y hacer que el footer esté pegado en la parte inferior */
    body, html {
        height: 100%;
        margin: 0;
        display: flex;
        flex-direction: column;
    }
    .content {
        flex: 1;
    }
</style>
</head>
<body>

<?php
// Incluimos los componentes
include("./tienda/includes/header.php");
include("./tienda/data/productos.php");
include("./tienda/includes/funciones.php");
?>

<!-- Contenido principal de la página -->   
<div class="container content">
    <h2>Productos disponibles</h2>
    <!-- Aquí va la tabla de productos -->
    <?php 
        generarTablaProductos($productos);
    ?>
    <!-- Botón y modal de contacto -->
    <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Mi perfil 🖐</button>
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Información de contacto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Información de contacto -->
                     <?php 
                        muestraInfoContacto($nombre,$telefono,$foto);
                     ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal con la lista de productos -->
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <!-- Aquí va la lista de productos -->
    </div>
</div>

<!-- Footer fuera del contenedor para que ocupe todo el ancho -->
<?php include("./tienda/includes/footer.php"); ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>
</html>
