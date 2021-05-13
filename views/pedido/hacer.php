<?php if (isset($_SESSION['identity'])) : ?>
    <h1 class="formcrear">Hacer pedido</h1>
    <a href="<?= base_url ?>carrito/index">ver los productos y el precio del pedido.</a>
    <h3 class="formcrear">INFORMACIÓN DE FACTURACIÓN</h3>
    <form id="h1cat"action="<?=base_url?>pedido/add" method="POST">
        <label for="pais">Pais</label>
        <input type="text" name="pais" required/><br>

        <label for="estado">Estado</label>
        <input type="text" name="estado" required/><br>

        <input type="submit" value="Confirmar pedido">
    </form>



<?php else : ?>
    <h1 class="formcrear">Necesitas estar identificado</h1>
    <p class="formcrear">Necesitas estar logueado en la web para poder realizar tu compra.</p>
<?php endif; ?>