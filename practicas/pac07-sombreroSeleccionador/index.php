<!DOCTYPE html>
<html lang="ca">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Sombrero Seleccionador de Hogwarts</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    /* .rojo{
        background-color: rgb(138, 14, 30);
    }
    .textoRojo{
        color: rgb(138, 14, 30);
    } */



</style>

</head>
<body class="text-warning" style="background-color: rgb(242, 242, 242);">
<div class="container mt-5">
<h1 class="text-center mb-4">Benvinguts a Hogwarts</h1>
<!-- AQUI VA EL FORMULARI-->
<div class="container mt-5 rounded bg-dark">

            <div class="row justify-content-center">
            <div class="col-md-6">  

            <form class="needs-validation" action="bienvenida.php" method="post" >
                <div class="row mb-3">
                    <h2 class="text-center mt-5">Ingresa tu nombre</h2>
                    <div class="col-md-6 mt-5">
                        <label for="nombre" class="form-label"><strong>Nombre:</strong></label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                    </div>
                    <div class="col-md-6 mt-5">
                        <label for="apellidos" class="form-label"><strong>Apellidos:</strong></label>
                        <input type="text" class="form-control" id="apellidos" name="apellidos" required>
                    </div>

                    <div class="text-center mt-5">
                    <button type="submit" class="btn btn-secondary">Enviar</button>
                    </div>
                </div>
            </form>
            </div>
            </div>
</div>
</div>

</body>
</html>