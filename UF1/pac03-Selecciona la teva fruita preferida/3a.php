<?php 

function idolos(){
  $idols = [
    [
      'imatge' => 'https://wallsdesk.com/wp-content/uploads/2016/11/Muhammad-Ali-Images.jpg',
      'nom_i_cognoms' => 'Muhammad Ali',
      'descripcio' => 'Muhammad Ali va ser un llegendari boxejador i activista social. Conegut per la seva habilitat excepcional al ring i el seu carisma fora d\'ell, Ali va guanyar múltiples campionats mundials de pes pesant. La seva negativa a ser reclutat per la guerra del Vietnam i la seva lluita pels drets civils el van convertir en una icona cultural i un símbol de resistència.'
    ],
    [
      'imatge' => 'https://images.hellomagazine.com/horizon/landscape/821036cf20cd-keanu-reeves.jpg',
      'nom_i_cognoms' => 'Keanu Reeves',
      'descripcio' => 'Keanu Reeves és un actor admirable que, malgrat haver enfrontat nombroses dificultats personals, les ha superat amb humilitat i realisme. La seva actitud positiva i generositat el converteixen en un exemple inspirador de resiliència i autenticitat en la indústria del cinema.'
    ],
    [
      'imatge' => 'https://dragonballsuper-france.fr/wp-content/uploads/2015/08/11229409_10152904136805670_7010797766698638424_n-660x330.jpg',
      'nom_i_cognoms' => 'Akira Toriyama',
      'descripcio' => 'Akira Toriyama és un dels meus ídols per ser el creador de Dragon Ball, l\'anime que va marcar la meva infància. La seva creativitat i capacitat per crear un món fantàstic amb personatges inoblidables l\'han convertit en una llegenda de l\'animació japonesa.'
    ]
  ];


  foreach ($idols as $idol) {
    echo '<div class="col">
      <div class="card shadow-sm">
        <img src="' . $idol['imatge'] . '" class="bd-placeholder-img card-img-top" width="100%" height="225" alt="' . $idol['nom_i_cognoms'] . '">
        <div class="card-body">
          <h5 class="card-title">' . $idol['nom_i_cognoms'] . '</h5>
          <p class="card-text">' . $idol['descripcio'] . '</p>
        </div>
      </div>
    </div>';
  }  
}

?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Hugo 0.72.0">
  <title>Els meus ídols</title>

  <link rel="canonical" href="https://v5.getbootstrap.com/docs/5.0/examples/album/">

  <!-- Bootstrap core CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

  <style>
    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
      user-select: none;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }
  </style>

</head>

<body>

  <header>
    <div class="navbar navbar-dark bg-dark shadow-sm">
      <div class="container">
        <a href="#" class="navbar-brand d-flex align-items-center">
          <strong>Els meus ídols</strong>
        </a>
      </div>
    </div>
  </header>

  <main>

    <section class="py-5 text-center container">
      <div class="row py-lg-5">
        <div class="col-lg-6 col-md-8 mx-auto">
          <h1 class="font-weight-light">Els meus ídols</h1>
          <p class="lead text-muted">Aquí trobaràs una llista dels meus ídols personals i per què els admiro.</p>
        </div>
      </div>
    </section>

    <div class="album py-5 bg-light">
      <div class="container">

        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
          <?php
            idolos();
          ?>
        </div>
      </div>
    </div>

  </main>

  <footer class="text-muted py-5">
    <div class="container">
      <p class="float-right mb-1">
        <a href="#">Tornar a dalt</a>
      </p>
      <p class="mb-1">Aquest és un exemple d'àlbum d'ídols personals.</p>
    </div>
  </footer>

</body>

</html>