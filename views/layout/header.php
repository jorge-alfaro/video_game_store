<!DOCTYPE html>

<html lang="en">

<head>
  <meta charset="UTF-8, iso-8859-1">
  <meta name="descripcion" content="Web fake de juegos">
  <meta name="keywords" content="Juegos, Shooter, Juegos baratos, pixelart">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Bienvenidos a SteamFake</title>
  <link href="<?= base_url ?>assets/css/style.css" rel="stylesheet">

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</head>

<body style="background-color: #171a21;">
  <!-- MENU -->
  <?php $categorias = Utils::showCategorias(); ?>

  <div class="menu">

    <a href="<?= base_url ?>" class="brand"><img src="<?= base_url ?>assets/images/logo/steamfakelogo.png"></a>

    <!-- <h1>SteamFake</h1> -->
    <nav>
      <ul>
        <?php if (isset($_SESSION['admin'])) : ?>
          <li><a href="<?= base_url ?>categoria/index">CATEGORIAS</a>
            <ul>

              <?php while ($cat = $categorias->fetch_object()) : ?>
                <li>
                  <a href="<?= base_url ?>categoria/ver&id=<?= $cat->id ?>"><?= $cat->nombre ?></a>
                </li>
              <?php endwhile; ?>
            </ul>
          </li>
          <li><a href="<?= base_url ?>juegos/gestion">JUEGOS</a></li>
        <?php endif; ?>

        <?php $stats = Utils::statsCarrito(); ?>
        <?php if (!isset($_SESSION['identity'])) : ?>
          <li><a href="<?= base_url ?>usuario/registro">LOGIN</a></li>
          <li><a href="<?= base_url ?>carrito/index">Carrito (<strong id="carritobjs"><?= $stats['count'] ?></strong>) $<?= $stats['total'] ?></a>
          </li>

        <?php else : ?>
          <li><a href=""><?= $_SESSION['identity']->nombre ?> <?= $_SESSION['identity']->apellidos ?></a>
            <ul>
              <li>
                <a href="<?=base_url?>pedido/mis_pedidos">Mis pedidos</a>
              </li>
              <li>
                <a href="<?=base_url?>pedido/gestion">Gestionar pedidos</a>
              </li>
            </ul>
          </li>
        <?php endif; ?>

        <?php if (isset($_SESSION['identity'])) : ?>
          <li><a href="<?= base_url ?>carrito/index">Carrito (<strong id="carritobjs"><?= $stats['count'] ?></strong>) $<?= $stats['total'] ?></a>
          </li>
        <?php endif; ?>
        <?php if (isset($_SESSION['identity'])) : ?>
          <li><a href="<?= base_url ?>usuario/logout">LOGOUT</a></li>
        <?php endif; ?>
      </ul>

    </nav>
  </div>
  <div class="espacio"></div>
  <!-- <div> -->