<?php if (isset($edit) && isset($pro) && is_object($pro)):?> 
<!-- // verifica si existe la variable "edit=true" que está en la accion editar -->
    <h1>Editar productos <?=$pro->nombre?></h1>
    <?php $url_action = base_url."producto/save&id=".$pro->id; ?> 
    <!-- // le pasamos el id del producto  eliminar -->

<?php else: ?>
    <h1>Crear nuevos productos</h1>
    <?php $url_action = base_url."producto/save";?>
<?php endif; ?>

<div class="form_container">

    <form action="<?=$url_action?>" method="post" enctype="multipart/form-data">

        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" id="" value="<?=isset($pro) && is_object($pro)? $pro->nombre: "";?>"/>

        <label for="descripcion">Descripcion</label>
        <textarea name="descripcion"><?=isset($pro) && is_object($pro)? $pro->descripcion: "";?> </textarea>

        <label for="precio">Precio</label>
        <input type="text" name="precio" id="" value="<?=isset($pro) && is_object($pro)? $pro->precio: "";?>">

        <label for="stock">Stock</label>
        <input type="number" name="stock" id="" value="<?=isset($pro) && is_object($pro)? $pro->stock: "";?>">

        <label for="categoria">Categorias</label>
        <?php $categorias = Utils::showCategorias(); ?>
        <select name="categoria" id="">
            <?php while ($cat = $categorias->fetch_object()) : ?>
                <option value="<?= $cat->id ?>" <?=isset($pro) && is_object($pro) && $cat->id == $pro->categoria_id ? 'selected': "";?>>
                    <?= $cat->nombre ?>
                </option>
            <?php endwhile; ?>
        </select>

        <label for="imagen">Imagen</label>
        <?php if(isset($pro) && is_object($pro) && !empty($pro->imagen)) :?>
            <img src="<?=base_url?>uploads/images/<?=$pro->imagen?>" class="thumb" />
        <?php endif;?>
        <input type="file" name="imagen" id="">

        <input type="submit" value="Guardar">
    </form>
</div>