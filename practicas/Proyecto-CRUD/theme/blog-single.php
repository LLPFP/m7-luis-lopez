<?php 
include_once("./config/config.php");
session_start();

// Verificar si se ha proporcionado un ID en la URL
if(isset($_GET['id']) && is_numeric($_GET['id'])) {
  $id = $_GET['id'];
  
  // Consulta para obtener la noticia específica por ID
  $noticiaObject = $conn->query("SELECT * FROM NEWS WHERE id = $id");
  
  // Verificar si la noticia existe
  if($noticiaObject->num_rows > 0) {
      $noticia = $noticiaObject->fetch_assoc();
  } else {
      // Redirigir a la página de blog si la noticia no existe
      header("Location: blog.php");
      exit();
  }
} else {
  // Redirigir a la página de blog si no se proporciona un ID válido
  header("Location: blog.php");
  exit();
}
//paso 2. hacer la query con el ->que devolverá on objeto
$noticiasObject = $conn->query("SELECT * FROM NEWS ORDER BY new_data DESC");
$noticiasArray = $noticiasObject->fetch_all(MYSQLI_ASSOC);


// Obtener los comentarios para esta noticia
$commentsObject = $conn->query("SELECT * FROM COMMENTS WHERE new_id = $id ORDER BY date DESC");
$commentsArray = $commentsObject->fetch_all(MYSQLI_ASSOC);




?>

<!DOCTYPE html>

<!--
 // WEBSITE: https://themefisher.com
 // TWITTER: https://twitter.com/themefisher
 // FACEBOOK: https://www.facebook.com/themefisher
 // GITHUB: https://github.com/themefisher/
-->

<html lang="zxx">

<head>
  <meta charset="utf-8">
  <title>TechX</title>

  <!-- mobile responsive meta -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  
  <!-- ** Plugins Needed for the Project ** -->
  <!-- Bootstrap -->
  <link rel="stylesheet" href="plugins/bootstrap/bootstrap.min.css">
  <!-- slick slider -->
  <link rel="stylesheet" href="plugins/slick/slick.css">
  <!-- themefy-icon -->
  <link rel="stylesheet" href="plugins/themify-icons/themify-icons.css">
  <!-- venobox css -->
  <link rel="stylesheet" href="plugins/venobox/venobox.css">
  <!-- card slider -->
  <link rel="stylesheet" href="plugins/card-slider/css/style.css">

  <!-- Main Stylesheet -->
  <link href="css/style.css" rel="stylesheet">
  
  <!--Favicon-->
  <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
  <link rel="icon" href="images/favicon.ico" type="image/x-icon">

</head>

<body>
  
<?php 

  include("./componentes/header.php")
?>

<!-- page-title -->
<section class="page-title bg-cover" data-background="images/banner/bannerTechX.jpg">
  <div class="container">
    <div class="row">
      <div class="col-12 text-center">
        <h1 class="display-1 text-white font-weight-bold font-primary">Noticias</h1>
      </div>
    </div>
  </div>
</section>
<!-- /page-title -->

<section class="section">
  <div class="container">
    <div class="row">
      <div class="col-lg-10 mx-auto">
        <h3 class="font-tertiary mb-5"><?php echo $noticia['title']; ?></h3>
        <img src="<?php echo $noticia['thumbnail']; ?>" alt="<?php echo $noticia['title']; ?>" class="img-fluid w-100 mb-3">
        <p class="float-left mr-4">Post by <?php echo $noticia['author'] ?? 'Admin'; ?></p>
        <p><?php echo date('F j, Y', strtotime($noticia['new_data'])); ?></p>
        <div class="content">
          <?php echo $noticia['description']; ?>
        </div>
      </div>
    </div>
  </div>
</section>

<section>
  <div class="container">
    <div class="row">
      <div class="col-lg-10 mx-auto">
        <div class="p-5 mb-4">
          <?php if(count($commentsArray) > 0): ?>
            <?php foreach($commentsArray as $comment): ?>
              <?php 
                // Get the user who wrote this specific comment
                $userObject = $conn->query("SELECT name, surname, avatar FROM USERS WHERE id = " . $comment['user_id']);
                $userData = ($userObject && $userObject->num_rows > 0) ? $userObject->fetch_assoc() : null;
                $userName = $userData ? $userData['name'] : 'Anonymous';
                $userSurname = $userData ? $userData['surname'] : '';
                $userAvatar = $userData && $userData['avatar'] ? $userData['avatar'] : 'images/user-1.jpg';
              ?>
              <div class="media border-bottom py-4">
                <img src="<?php echo htmlspecialchars($userAvatar); ?>" class="img-fluid align-self-center mr-3" alt="<?php echo htmlspecialchars($userName); ?>" style="width: 64px; height: 64px; object-fit: cover; border-radius: 50%;">
                <div class="media-body">
                  <h5 class="mb-0 text-secondary"><?php echo htmlspecialchars($userName . ' ' . $userSurname); ?></h5>
                  <span class="mr-3"><?php echo date('d F Y \A\t h:i a', strtotime($comment['date'])); ?></span>                  <a href="#" class="btn btn-transparent py-1 px-2 "><i class="ti-share-alt"></i> Reply</a>
                  <p><?php echo htmlspecialchars($comment['description']); ?></p>
                </div>
              </div>
            <?php endforeach; ?>
          <?php else: ?>
            <p>No hay comentarios todavía. ¡Sé el primero en comentar!</p>
          <?php endif; ?>
        </div>
        <?php if(isset($_SESSION['user_id'])): ?>
        <h4 class="mb-3 pb-3 text-secondary">Dejar un Comentario</h4>
        <form action="add-comment.php" method="post" class="row">
          <input type="hidden" name="new_id" value="<?php echo $id; ?>">
          <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">
          <div class="col-12">
            <textarea name="description" id="comment" placeholder="Mensaje" class="form-control mb-4 border" required></textarea>
          </div>
          <div class="col-12">
            <button type="submit" class="btn btn-secondary">Enviar Comentario</button>
          </div>
        </form>
        <?php else: ?>
        <div class="alert alert-info">
          <p>Debes <a href="inicioSesion.php">iniciar sesión</a> para poder comentar.</p>
        </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>

<!-- blog -->
<section class="section">
  <div class="container">
    <div class="row">
      <?php 
      $count = 0;
      foreach($noticiasArray as $noticia): 
      if($count < 3):
      ?>
      <div class="col-lg-4 col-md-6 mb-4">
        <article class="card">
          <img src="<?php echo $noticia['thumbnail']; ?>" alt="<?php echo $noticia['title']; ?>" class="card-img-top mb-2">
          <div class="card-body p-0">
            <time><?php echo date('F j, Y', strtotime($noticia['new_data'])); ?></time>
            <a href="blog-single.php?id=<?php echo $noticia['id']; ?>" class="h4 card-title d-block my-3 text-dark hover-text-underline"><?php echo $noticia['title']; ?></a>
            <a href="blog-single.php?id=<?php echo $noticia['id']; ?>" class="btn btn-transparent">Read more</a>
          </div>
        </article>
      </div>
      <?php
      $count++;
      endif;
      endforeach; 
      ?>
     </div>
  </div>
</section>
<!-- /blog -->

<?php 

include("./componentes/footer.php")

?>

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

</body>
</html>