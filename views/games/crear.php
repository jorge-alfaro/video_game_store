<?php if(isset($edit) && isset($gam) && is_object($gam)): ?>
    <h1 id="h1cat">EDITAR JUEGO <?=$gam->nombre?></h1>
    <?php $url_action = base_url."juegos/save&id=".$gam->id; ?> 
<?php else: ?>
    <h1 id="h1cat">AGREGAR NUEVOS JUEGOS</h1>
    <?php $url_action = base_url."juegos/save"; ?> 
    
<?php endif; ?>

<div id="h1cat">
   
    <form action="<?=$url_action?>" method="POST" enctype="multipart/form-data">
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" value="<?=isset($gam) && is_object($gam) ? $gam->nombre : ''; ?>"/><br>

        <label for="descripcion">descripcion</label>
        <textarea type="text" name="descripcion"> <?=isset($gam) && is_object($gam) ? $gam->descripcion : ''; ?></textarea><br>

        <label for="precio">Precio</label>
        <input type="number" name="precio" value="<?=isset($gam) && is_object($gam) ? $gam->precio : ''; ?>" /><br>

        <label for="categoria">Categoria</label>
        <?php $categorias = Utils::showCategorias(); ?>
        <select name="categoria">
            <?php while ($cat = $categorias->fetch_object()) : ?>
                <option value="<?= $cat->id ?>" <?=isset($gam) && is_object($gam) && $cat->id == $gam->categoria_id ?  'selected' : ''; ?>>
                    <?= $cat->nombre ?>
                </option>
            <?php endwhile; ?>
        </select>
<br>
        <label for="imagen">Imagen</label>
        <?php if (isset($gam) && is_object($gam) && !empty($gam->imagen)): ?>
            <img src="<?=base_url?>uploads/images/<?=$gam->imagen?>" class="minima" width="150px"><br>
        <?php endif; ?>    
        <input type="file" name="imagen" /><br>

                <input type="submit" value="Guardar"/>

    </form>
</div>

