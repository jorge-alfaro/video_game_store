<h1 class="formcrear">Carrito de compra</h1>

<?php if (isset($_SESSION['carrito']) && count($_SESSION['carrito']) >= 1) : ?>

    <table>
        <tr>
            <th>Imagen</th>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Unidades</th>
            <th>Eliminar</th>
        </tr>
        <?php
        foreach ($carrito as $indice => $elemento) :
            $juego = $elemento['juego'];
        ?>
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
                    <a href="<?=base_url?>carrito/down&index=<?=$indice?>" class="button-menos ">-</a>
                    <?= $elemento['unidades'] ?>
                    <a href="<?=base_url?>carrito/up&index=<?=$indice?>" class="button">+</a>
                </td>
                <td>
                <a href="<?= base_url ?>carrito/delete&index=<?=$indice?>" class="button button-pedido button-quitar">Quitar juego</a> 
                </td>
            </tr>

        <?php endforeach; ?>
    </table>
            <div class="total-carrito">
                <div class="der">
                <a href="<?= base_url ?>carrito/delete_all" class=" button button-pedido button-red ">Vaciar Carrito</a>
            </div>
                <?php $stats = Utils::statsCarrito(); ?>
                <h3>Precio total: $<?= $stats['total'] ?></h3>
                <div class="izq">
                <a href="<?= base_url ?>pedido/hacer" class=" button button-pedido">Hacer pedido</a>
        </div>
    </div>
<?php else : ?>
    <p class="formcrear">El carrito esta vacio.</p>
<?php endif; ?>