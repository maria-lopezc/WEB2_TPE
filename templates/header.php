<?php if (session_status() === PHP_SESSION_NONE) session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

<base href="<?php echo BASE_URL ?>">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" href="templates/css/styleHeader.css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
</head>
<body>
<nav class="navbar navbar-light bg-light">
<a class="navbar-brand" href="home"> 
    <!-- arreglar imagen para libro/:id
    Preguntar link (no funciona en otras pc)
    Cambiiar link del header para probar-->
    <img src="<?php echo BASE_URL ?>/icons/icon.png" width="30" height="30" alt="">
  </a>
  <a href="autores">
    Autores
  </a>
  <?php if (isset($_SESSION['ID_USER'])): ?>
    <a href="<?php echo BASE_URL ?>logout">Cerrar sesión</a>
  <?php else: ?>
    <a href="<?php echo BASE_URL ?>login">Iniciar sesión</a>
  <?php endif; ?>
</nav>