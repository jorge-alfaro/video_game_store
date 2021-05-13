<?php if (isset($gestion)): ?>
    <h1 class="formcrear">Gestionar pedidos</h1>
<?php else: ?>
    <h1 class="formcrear">Mis pedidos</h1>
<?php endif; ?>
<table>
    <tr>
        <th>N° Pedido</th>
        <th>Coste</th>
        <th>Fecha</th>
        <th>Status</th>
    </tr>
    <?php
    while ($ped = $pedido->fetch_object()) : ?>
        <tr>
            <td>
                <a href="<?= base_url ?>pedido/detalle&id=<?= $ped->id ?>"><?= $ped->id ?></a>
            </td>
            <td>
                $<?= $ped->coste ?>
            </td>
            <td>
                <?= $ped->fecha ?>
            </td>
            <td>
            <?=Utils::showStatus($ped->status)?>
            </td>
        </tr>

    <?php endwhile; ?>
</table>