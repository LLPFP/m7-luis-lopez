<?php 
include_once("./config/config.php");


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $age = $_POST['age'];
    $job = $_POST['job'];
    $date_register = date('Y-m-d H:i:s');
    $rol = 'User';
    
    // Handle file upload
    $avatar = '';
    if(isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'uploads/avatars/';
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
        
        $fileExtension = strtolower(pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION));
        $allowedExtensions = array('jpg', 'jpeg', 'png', 'gif');
        
        if(in_array($fileExtension, $allowedExtensions)) {
            $fileName = uniqid() . '.' . $fileExtension;
            $uploadFile = $uploadDir . $fileName;
            
            if(move_uploaded_file($_FILES['avatar']['tmp_name'], $uploadFile)) {
                $avatar = $uploadFile;
            }
        }
    }
        // Use mysqli prepared statements instead of PDO
    $sql = "INSERT INTO USERS (name, surname, email, password, avatar, age, job, date_register, rol) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    
    if ($stmt) {
        $stmt->bind_param("sssssssss", $name, $surname, $email, $password, $avatar, $age, $job, $date_register, $rol);
        $stmt->execute();
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }
}


?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>TechX - Registro</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="theme-name" content="agen" />
    <link rel="stylesheet" href="plugins/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="plugins/slick/slick.css">
    <link rel="stylesheet" href="plugins/themify-icons/themify-icons.css">
    <link rel="stylesheet" href="plugins/venobox/venobox.css">
    <link rel="stylesheet" href="plugins/card-slider/css/style.css">
    <link href="css/style.css" rel="stylesheet">
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">
    
</head>

<?php include("./componentes/header.php") ?>

<body>

<!-- banner -->
<section class="banner bg-cover position-relative d-flex justify-content-center align-items-center"
  data-background="images/banner/bannerTechX.jpg">
  <div class="container">
    <div class="row">
      <div class="col-12 text-center">
        <h1 class="display-1 text-white font-weight-bold font-primary">TechX</h1>
      </div>
    </div>
  </div>
</section>
<!-- /banner -->
    <div class="container mt-4 mb-4">
        <section class="section mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="card shadow-lg border-0 rounded-lg hover-lift">
                    <div class="card-header bg-gradient-primary text-white py-4">
                        <h3 class="text-center m-0 font-weight-bold"><i class="ti-user mr-2"></i>Registro de Usuario</h3>
                    </div>
                    <div class="card-body p-5 mt-3">
                        <form method="POST" action="" class="needs-validation" novalidate enctype="multipart/form-data">
                            <div class="mb-4 floating-label">
                                <label for="name" class="form-label text-primary fw-bold"><i class="ti-user mr-2"></i>Nombre</label>
                                <input type="text" class="form-control form-control-lg rounded-pill border-2" id="name" name="name" placeholder="Ingresa tu nombre" required>
                            </div>
                            
                            <div class="mb-4 floating-label">
                                <label for="surname" class="form-label text-primary fw-bold"><i class="ti-id-badge mr-2"></i>Apellido</label>
                                <input type="text" class="form-control form-control-lg rounded-pill border-2" id="surname" name="surname" placeholder="Ingresa tu apellido" required>
                            </div>
                            
                            <div class="mb-4 floating-label">
                                <label for="email" class="form-label text-primary fw-bold"><i class="ti-email mr-2"></i>Correo Electrónico</label>
                                <input type="email" class="form-control form-control-lg rounded-pill border-2" id="email" name="email" placeholder="ejemplo@email.com" required>
                            </div>
                            
                            <div class="mb-4">
                                <label for="avatar" class="form-label text-primary fw-bold"><i class="ti-image mr-2"></i>Imagen de Perfil</label>
                                <div class="input-group">
                                    <input type="file" class="form-control form-control-lg rounded-pill border-2 custom-file-input" id="avatar" name="avatar" accept="image/*" style="display: none;">
                                    <label for="avatar" class="btn btn-primary btn-lg rounded-pill shadow-sm hover-effect w-100 text-center">
                                        <i class="ti-upload mr-2"></i>Seleccionar imagen
                                    </label>
                                </div>
                                <small class="text-muted mt-1 d-block">Selecciona una imagen para tu perfil</small>
                            </div>                            
                            <div class="mb-4 floating-label">
                                <label for="password" class="form-label text-primary fw-bold"><i class="ti-lock mr-2"></i>Contraseña</label>
                                <input type="password" class="form-control form-control-lg rounded-pill border-2" id="password" name="password" placeholder="********" required>
                            </div>
                            
                            <div class="mb-4 floating-label">
                                <label for="age" class="form-label text-primary fw-bold"><i class="ti-calendar mr-2"></i>Edad</label>
                                <input type="number" class="form-control form-control-lg rounded-pill border-2" id="age" name="age" min="18" max="100" placeholder="Ingresa tu edad" required>
                            </div>
                            
                            <div class="mb-4 floating-label">
                                <label for="job" class="form-label text-primary fw-bold"><i class="ti-briefcase mr-2"></i>Trabajo</label>
                                <input type="text" class="form-control form-control-lg rounded-pill border-2" id="job" name="job" placeholder="Ingresa tu profesión" required>
                            </div>
                            
                            <div class="d-grid gap-2 mt-5">
                                <button type="submit" class="btn btn-primary btn-lg rounded-pill shadow-lg hover-effect py-3">
                                    <i class="ti-check mr-2"></i>Crear Cuenta
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>    </div>
</body>

<?php include("./componentes/footer.php") ?>

<!-- jQuery -->
<script src="plugins/jQuery/jquery.min.js"></script>
<!-- Bootstrap JS -->
<script src="plugins/bootstrap/bootstrap.min.js"></script>
<!-- slick slider -->
<script src="plugins/slick/slick.min.js"></script>
<!-- venobox -->
<script src="plugins/venobox/venobox.min.js"></script>
<!-- shuffle -->
<script src="plugins/shuffle/shuffle.min.js"></script>
<!-- apear js -->
<script src="plugins/counto/apear.js"></script>
<!-- counter -->
<script src="plugins/counto/counTo.js"></script>
<!-- card slider -->
<script src="plugins/card-slider/js/card-slider-min.js"></script>
<!-- google map -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCcABaamniA6OL5YvYSpB3pFMNrXwXnLwU&libraries=places"></script>
<script src="plugins/google-map/gmap.js"></script>
<!-- Main Script -->
<script src="js/script.js"></script>

<script>
// Validación del formulario
(function () {
    'use strict'
    var forms = document.querySelectorAll('.needs-validation')
    Array.prototype.slice.call(forms)
        .forEach(function (form) {
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }
                form.classList.add('was-validated')
            }, false)
        })
})()
</script>
</html>
