<?php if (isset($_SESSION['pedido']) && $_SESSION['pedido'] == 'complete') : ?>;
    <h1>Tu pedido se ha confirmado</h1>
    <p>
        Tu pedido ha sido guardado con exito,
        una vez que la transferencia se haya realizado a la cuenta ASDE33w2F54
        se le enviara el pedido
    </p>
    <br>
    <?php if (isset($pedido)) : ?>;
        <h3>Datos del pedido</h3>

        Numero del pedido: <?= $pedido->id ?> <br>
        Total a pagar:$ <?= $pedido->coste ?><br>
        Productos: <br>

        <table>
            <tr>
                <th>Imagen</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Unidades</th>
            </tr>
            <?php while ($producto = $productos->fetch_object()) : ?>
                <tr>
                    <td>
                        <?php if ($producto->imagen != null) : ?>
                            <img src="<?= base_url ?>uploads/images/<?= $producto->imagen ?>" alt="Imagen de camiseta no cargada" class="img_carrito">
                        <?php else : ?>
                            <img src="<?= base_url ?>assets/img/camiseta.png" class="img_carrito">
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="<?= base_url ?>producto/ver&id=<?= $producto->id ?>"><?= $producto->nombre ?></a>
                    </td>
                    <td>
                        <?= $producto->precio ?>
                    </td>
                    <td>
                        <?= $producto->unidades ?>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>

    <?php endif; ?>
<?php elseif (isset($_SESSION['pedido']) && $_SESSION['pedido'] !== 'complete') : ?>;
    <h1>Tu pedido NO ha sido confirmado</h1>
    <p>
        NINGUN PEDIDO
    </p>
<?php endif; ?>