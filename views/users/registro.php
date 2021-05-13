<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />

  <!-- FONT GOOGLE-->
  <link href="https://fonts.googleapis.com/css?family=Quicksand&display=swap" rel="stylesheet">
  <!-- ANIMATE CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
  <!-- CUSTOM CSS-->
  <link rel="stylesheet" href="../assets/css/style-registro.css">

  <title>Registro</title>
</head>

<body>
  <div class="boddy">
    <div class="content">
      <h1 class="logo">Registrarse</h1>
      
     <?php if (isset($_SESSION['register']) && $_SESSION['register'] == 'Complete') : ?>
      <strong class="alert_green">Registro Completado Correctamente</strong>
      <?php elseif (isset($_SESSION['register']) && $_SESSION['register'] != 'Complete') : ?>
      <strong class="alert_red">Registro Fallido, Introduce bien los datos</strong>
      <?php endif; ?>

      <?php Utils::deleteSession('register'); ?>

      <div class="contenedor-wrapper">
        <div class="registro-form">

          <form action="<?=base_url?>usuario/save" method="POST">
            <p>
              <label for="nombre">Nombre</label>
              <input type="text" name="nombre" required />
            </p>
            <p>
              <label for="apellidos">Apellido</label>
              <input type="text" name="apellidos" required />
            </p>
            <p>
              <label for="email">Email Address</label>
              <input type="email" name="email" required />
            </p>
            <p>
              <label for="password">Contraseña</label>
              <input type="password" name="password" required />
            </p>

            <p class="block">
              <button type="submit" value="Registrarse">Enviar</button>
            </p>
          </form>
        </div>
        <div class="login-info">
          <h3 class="h3-logo">Ingresar</h3>
          <?php if(!isset($_SESSION['identity'])): ?>
          <form action="<?=base_url?>usuario/login" method="POST">
            <p>
              <label>Email Address</label>
              <input type="email" name="email" />
            </p>
            <p>
              <label for="password">Contraseña</label>
              <input type="password" name="password" />
            </p>
            <p class="block">
              <button type="submit">Enviar</button>
            </p>
          </form>
          <?php else: ?>
            <h3><?=$_SESSION['identity']->nombre?></h3>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</body>

</html>