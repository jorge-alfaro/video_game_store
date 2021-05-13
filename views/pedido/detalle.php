
<h1 class="formcrear">Detalle del pedido</h1>
<?php if (isset($pedido)) : ?>
    <?php if(isset($_SESSION['admin'])): ?>
    <h3 class="formcrear">Cambiar estado del pedido</h3>
    <form action="<?=base_url?>pedido/status" method="POST">
    <input type="hidden" value="<?=$pedido->id?>" name="pedido_id">
        <select name="status">
            <option value="confirm" <?=$pedido->status =="confirm" ? 'selected' : '';?>>Pendiente</option>
            <option value="adquirido" <?=$pedido->status =="adquirido" ? 'selected' : '';?>>Adquirido</option>
        </select>
        <input type="submit" value="Cambiar">
    </form>
    <br>
    <?php endif; ?>
        <h3 class="formcrear">Datos del Usuario</h3>
      <p class="formcrear">
        Pais: <?=$pedido->pais ?><br>
        Estado: <?=$pedido->estado?><br>

        </p>
        <h3 class="formcrear">Datos del pedido</h3>
        <p class="formcrear">
        Estatus: <?=Utils::showStatus($pedido->status)?>
         <br>
        Numero de pedido: <?= $pedido->id ?><br>
        Total a pagar: $<?= $pedido->coste ?><br>
        Juegos:</p>
        <table>
        <tr>
        <th>Imagen</th>
        <th>Nombre</th>
        <th>Precio</th>
        <th>Unidades</th>
    </tr>
            <?php while($juego = $juegos->fetch_object()) : ?>
                <tr>
                    <td>
                        <?php if ($juego->imagen != null) : ?>
                            <img src="<?= base_url ?>uploads/images/<?= $juego->imagen ?>" class="img_carrito" />
                        <?php else : ?>
                            <img src="<?= base_url ?>assets/images/games/noimage.png" class="img_carrito" />
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="<?= base_url ?>juegos/ver&id=<?= $juego->id ?>"><?= $juego->nombre ?></a>
                    </td>
                    <td>
                        <?= $juego->precio ?>
                    </td>
                    <td>
                        <?= $juego->unidades?>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
        
    <?php endif; ?>