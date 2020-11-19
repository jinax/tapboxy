<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>TapBoxy - Tu caja de sonidos personalizada</title>
  <script src="assets/js/popper.min.js"></script>
  <script src="assets/js/jquery-3.4.1.min.js"></script>
  <script src="assets/js/bootstrap.js"></script>
  <script src="assets/js/script.js"></script>
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/font-awesome.min.css">
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand brand" href="index.php">TapBoxy</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarColor01">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
        <li class="nav-item">
          <a class="nav-link" href="index.php">inicio</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="lorem.php">docs</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="lorem.php">blog</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="lorem.php">faq</a>
        </li>
        <a class="nav-link" href="verCajas.php">Cajas</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="cuenta.php"><?php echo $_SESSION['nick'] ?></a>
        </li>

      </ul>
      <form class="form-inline my-2 my-lg-0" action="busqueda.php" method="post">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <input class="form-control mr-sm-2" type="text" name="campobuscar" placeholder="Buscar por cajas públicas">
            <button class="btn btn-secondary my-2 my-sm-0" type="submit" name="botonbuscar">Buscar</button>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="logout.php">Salir</a>
          </li>

        </ul>
      </form>
    </div>
  </nav>