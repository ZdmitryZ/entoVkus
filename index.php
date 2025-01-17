<?php
 session_start();

 

?>

<!doctype html>
<html lang="en" class="h-100">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Hugo 0.104.2">
  <title>Sofia Abbasi</title>

  <link rel="canonical" href="https://getbootstrap.com/docs/5.2/examples/cover/">
  <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      user-select: none;

    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }

    .b-example-divider {
      height: 3rem;
      background-color: rgba(0, 0, 0, .1);
      border: solid rgba(0, 0, 0, .15);
      border-width: 1px 0;
      box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
    }

    .b-example-vr {
      flex-shrink: 0;
      width: 1.5rem;
      height: 100vh;
    }

    .bi {
      vertical-align: -.125em;
      fill: currentColor;
    }

    .nav-scroller {
      position: relative;
      z-index: 2;
      height: 2.75rem;
      overflow-y: hidden;
    }

    .nav-scroller .nav {
      display: flex;
      flex-wrap: nowrap;
      padding-bottom: 1rem;
      margin-top: -1px;
      overflow-x: auto;
      text-align: center;
      white-space: nowrap;
      -webkit-overflow-scrolling: touch;
    }
    body {
  text-shadow: 0 .05rem .1rem rgba(0, 0, 0, .5);
  box-shadow: inset 0 0 5rem rgba(0, 0, 0, .5);
  background:linear-gradient(rgba(0, 0, 0,0.5), rgba(0, 0, 0,0.4 )), url("/assets/img/cover.png");
  background-size: cover;
    background-position: center;
}
  </style>


  <!-- Custom styles for this template -->
  <link href="assets/css/cover.css" rel="stylesheet">
</head>

<body class="d-flex h-100 text-center text-bg-dark">
    <div class="wrapper cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
      
    <?php include "header.php" ?>

      <main class="px-3">
        <h1>Поппробовал жизнь на вкус..</h1>
        <p class="lead">Сдесь представлены национальные рецепты разных стран.. Попробуйте приготовьте, если сможете. </p>
        <p class="lead">
          <a href="recipe.php" class="btn btn-lg btn-secondary fw-bold border-white bg-white">К рецептам</a>
        </p>
      </main>

      <footer class="mt-auto text-white-50">
        <p>Create by  <a href="https://getbootstrap.com/" class="text-white">Sofia Abbasi</a> <a
            href="https://twitter.com/mdo" class="text-white">sonyamay74@gmail.com</a>. <br> <a style="font-size: 70%;" class="text-white text-decoration-none" href="admin/">admin</a></p>
      </footer>

  </div> 


</body>

</html>