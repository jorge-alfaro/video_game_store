<link rel="stylesheet" href="<?= base_url ?>assets/css/stylesdestacados.css" />

<!-- <h1>JUEGOS DESTACADOS</h1> -->
<?php while ($jueg = $juegos->fetch_object()) : ?>
  <div class="caja">
    <a href="<?= base_url ?>juegos/ver&id=<?= $jueg->id ?>">
      <?php if ($jueg->imagen != null) : ?>
        <img src="<?= base_url ?>uploads/images/<?= $jueg->imagen ?>" />
      <?php else : ?>
        <img src="<?= base_url ?>assets/images/games/noimage.png" />
      <?php endif; ?>
      <p><?= $jueg->nombre ?></p>
    </a>
    <p>$ <?= $jueg->precio ?></p>
    <a href="<?= base_url ?>carrito/add&id=<?= $jueg->id ?>" class="button">Comprar</a>
  </div>
<?php endwhile; ?>