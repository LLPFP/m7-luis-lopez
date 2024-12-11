<!DOCTYPE html>
<html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido a Mercadona </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
 <body>

<div class="container-fluid">
    <div class="container text-center my-5">
        <h1>Bienvenido a Mercadona</h1>
        <p>Por favor, completa el siguiente formulario para continuar tu compra.</p>
    </div>

        <div class="container">
            <!-- AQUÍ PUEDES USAR UN FORM DE BOOTSTRAP 5 SENCILLO PARA PEDIR LOS
            DATOS:
            - NOMBRE
            - APELLIDOS
            - NÚMERO DE TELÉFONO
            - DNI
            - CÓDIGO DE SOCIO
            - CORREO ELECTRÓNICO
            -->
            <div class="row justify-content-center">
            <div class="col-md-6">  

            <form class="needs-validation" action="index.php" method="post" >
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="nombre" class="form-label">Nombre:</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                    </div>
                    <div class="col-md-6">
                        <label for="apellidos" class="form-label">Apellidos:</label>
                        <input type="text" class="form-control" id="apellidos" name="apellidos" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="foto" class="form-label">Foto:</label>
                    <input type="text" class="form-control" id="foto" name="foto" required>
                </div>
                <div class="mb-3">
                    <label for="telefono" class="form-label">Número de teléfono:</label>
                    <input type="tel" class="form-control" id="telefono" name="telefono" pattern="[0-9]{9}" required>
                </div>

                <div class="mb-3">
                    <label for="dni" class="form-label">DNI:</label>
                    <input type="text" class="form-control" id="dni" name="dni" pattern="[0-9]{8}[A-Za-z]{1}" required>
                </div>

                <div class="mb-3">
                    <label for="codigo_socio" class="form-label">Código de socio:</label>
                    <input type="text" class="form-control" id="codigo_socio" name="codigo_socio" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Correo electrónico:</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Enviar</button>
                </div>
            </form>

            </div>
        </div>

        </div>
</div>

 <script src="https: /cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"> </script>
 </body>
 </html>