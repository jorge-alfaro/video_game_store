<?php if (isset($_SESSION['pedido']) && $_SESSION['pedido'] == 'Complete') : ?>
    <h1 class="formcrear">Tu pedido se ha confirmado.</h1>
    <p id="h1cat"> tu pedido ha sido guardado con exito.</p>
    <br>

    <?php if (isset($pedido)) : ?>
        <h3 class="formcrear">Datos del pedido</h3>
        <p class="formcrear">
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
    
<?php elseif (isset($_SESSION['pedido']) && $_SESSION['pedido'] != 'Complete') : ?>
    <p>Tu pedido no ha podido procesarse</p>
<?php endif; ?>