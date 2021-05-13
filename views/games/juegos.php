
<link rel="stylesheet" href="<?=base_url?>assets/css/stylegestiongames.css">
<h1 id="h1cat">GESTION DE JUEGOS</h1>

<a class="button" href="<?=base_url?>juegos/crear" >
Insertar Juego
</a>

<?php if(isset($_SESSION['juego']) && $_SESSION['juego'] == 'Complete'): ?>
    <strong class="alert_green">El juego se agrego correctamente</strong>
    <?php elseif(isset($_SESSION['juego']) && $_SESSION['juego'] != 'Complete'): ?>
    <strong class="alert_red">El juego NO se agrego correctamente</strong>
    <?php endif; ?>
    <?php Utils::deleteSession('juego'); ?>

    <?php if(isset($_SESSION['delete']) && $_SESSION['delete'] == 'Complete'): ?>
    <strong class="alert_green">El juego se ha borrado correctamente!</strong>
    <?php elseif(isset($_SESSION['delete']) && $_SESSION['delete'] != 'Complete'): ?>
    <strong class="alert_red">El juego NO se borro correctamente! :(</strong>
    <?php endif; ?>
    <?php Utils::deleteSession('delete'); ?>

<table>
    <tr>
        <th>ID</th>
        <th>NOMBRE</th>
        <th>PRECIO</th>
        <th>ACCIONES</th>
        <!-- <th>ACCIONES</th> -->
    </tr>
<?php while($gam = $juegos->fetch_object()): ?>
    <tr>
        <td><?=$gam->id;?></td> 
        <td><?=$gam->nombre;?></td>
        <td><?=$gam->precio;?></td>
        <!-- <td><?=$gam->oferta;?></td> -->
        <td>
            <a href="<?=base_url?>juegos/editar&id=<?=$gam->id?>" class="button button-gestion">Editar</a>
            <a href="<?=base_url?>juegos/eliminar&id=<?=$gam->id?>" class="button button-gestion button-red">Eliminar</a>

        </td>
    </tr>
<?php endwhile; ?>
</table>
