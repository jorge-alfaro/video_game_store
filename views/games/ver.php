<link rel="stylesheet" href="<?= base_url ?>assets/css/stylesdestacados.css" />

<?php if (isset($game)) : ?>
  <h1><?= $game->nombre ?></h1>
  <div class="cajacat">
    <div class="image">
      <?php if ($game->imagen != null) : ?>
        <img src="<?= base_url ?>uploads/images/<?= $game->imagen ?>" />
      <?php else : ?>
        <img src="<?= base_url ?>assets/images/games/noimage.png" />
      <?php endif; ?>
    </div>
    <div class="data">
      <p class="description"><?= $game->descripcion ?></p>
      </a>
      <p class="price">$<?= $game->precio ?></p>
      <a href="<?=base_url?>carrito/add&id=<?=$game->id?>" class="button">Comprar</a>
    </div>
  </div>

<?php else : ?>
  <h1>El Juego no Existe</h1>
<?php endif; ?>

</div>