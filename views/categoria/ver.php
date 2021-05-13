<link rel="stylesheet" href="<?= base_url ?>assets/css/stylesdestacados.css" />
<div class="cajacat">
    <?php if (isset($categoria)) : ?>
        <h1><?= $categoria->nombre ?></h1>
        <?php if ($juegos->num_rows == 0) : ?>
            <p>No hay Juegos para mostrar</p>
        <?php else : ?>
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
                    <p><?= $jueg->precio ?></p>
                    <a href="<?=base_url?>carrito/add&id=<?=$jueg->id?>" class="button">Comprar</a>
                </div>
            <?php endwhile; ?>
        <?php endif; ?>
    <?php else : ?>
        <h1>La Categoria no Existe</h1>
    <?php endif; ?>

</div>