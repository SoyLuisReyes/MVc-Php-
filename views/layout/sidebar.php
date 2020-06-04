            <!-- Barra lateral -->
            <aside id="lateral">

            <div id="carrito" class="block_aside">
                <h3>Mi carrito</h3>
                <ul>
                    <?php ob_start(); $stats = Utils::statsCarrito(); ?>                
                    <li><a href="<?=base_url?>carrito/index">Productos (<?=$stats['count']?>)</a></li>
                    <li><a href="<?=base_url?>carrito/index">Total: $<?=$stats['total']?> </a></li>
                    <li><a href="<?=base_url?>carrito/index">Ver el carrito</a></li>
                </ul>
            </div>

                <div id="login" class="block_aside">

                    <?php if (!isset($_SESSION['identity'])) :?>
                        <h3>Entrar a la web</h3>
                        <form action="<?=base_url?>usuario/login" method="post">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="">
                            <label for="password">Contraseña</label>
                            <input type="password" name="password" id="">
                            <input type="submit" value="Enviar">
                        </form>
                        
                    <?php else:?>
                        <h3><?=$_SESSION['identity']->nombre?> <?=$_SESSION['identity']->apellidos?></h3>
                     <?php endif;?>
                    <ul>
                        
                        <!-- Aca se hace una condicion en la que solo se mostran 
                        los enlaces si es usuario administrador -->
                        <?php if(isset($_SESSION['admin'])):?> 
                            <li><a href="<?=base_url?>categoria/index">Gestionar Categorias</a></li>
                            <li><a href="<?=base_url?>producto/gestion">Gestionar Productos</a></li>
                            <li><a href="<?=base_url?>pedido/gestion">Gestionar Pedidos</a></li>
                        <?php endif;?>

                        <!-- Aca se muestra "mis pedidos" si hay
                        alguien identificado en la bbdd -->
                        <?php if(isset($_SESSION['identity'])):?> 
                            <li><a href="<?=base_url?>pedido/mis_pedidos">Mis pedidos</a></li>
                            <li><a href="<?=base_url?>usuario/logout">Cerrar Sesión</a></li>
                        <?php else:?>
                            <li><a href="<?=base_url?>usuario/registro">Registrate aqui</a></li>
                        <?php endif;?>
                    </ul>

                </div>
            </aside>

            <!-- contenido central -->
            <div id="central">