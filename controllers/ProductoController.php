<?php
require_once 'models/producto.php'; // mandamos a llamar al modelo para poder crear objetos

class productoController
{ // Esto es el controlador

    public function index()
    { // esta es la accion
        $producto = new Producto();
        $productos = $producto->getRandom(6); // Le pasamos como limite 6 que seria el parametro
       
        // Renderizar vista
        require_once 'views/producto/destacado.php';
    }

    public function ver ()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
    
            $producto = new Producto();
            $producto->setId($id);

            $product = $producto->getOne();

        } 
        require_once 'views/producto/ver.php';
    }

    // creamos una funcion para gestionar productos
    public function gestion()
    {
        Utils::isAdmin(); // verificamos si es administrador

        //creamos un nuevo objeto con los get y set del modelo producto
        $producto = new Producto();
        $productos = $producto->getAll(); // accedemos al metodo GetAll que 
        //contiene la query sql de la clase producto y luego se la pasamos a la vista

        require_once 'views/producto/gestion.php';
    }

    public function crear()
    {
        Utils::isAdmin();
        require_once 'views/producto/crear.php';
    }

    public function save()
    {
        Utils::isAdmin();
        if (isset($_POST)) {
            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
            $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : false;
            $precio = isset($_POST['precio']) ? $_POST['precio'] : false;
            $stock = isset($_POST['stock']) ? $_POST['stock'] : false;
            $categoria = isset($_POST['categoria']) ? $_POST['categoria'] : false;
            // $imagen = isset($_POST['imagen']) ? $_POST['imagen'] : false;

            if ($nombre && $descripcion && $precio && $stock && $categoria) {
                $producto = new Producto(); // se empieza a trabajar con los objetos y metodos del modelo (tener siempre el require del modelo)
                $producto->setNombre($nombre);
                $producto->setDescripcion($descripcion);
                $producto->setPrecio($precio);
                $producto->setStock($stock);
                $producto->setCategoria_id($categoria);


                // Guardar imagen en la base de datos
                if ($_FILES['imagen']) { 
                    
                    $file = $_FILES['imagen'];
                    $filename = $file['name'];
                    $mimetype = $file['type'];

                    if ($mimetype == 'image/jpg' || $mimetype == 'image/jpeg' || $mimetype == 'image/png' || $mimetype == 'image/gif') {
                        
                        if (!is_dir('uploads/images')) {
                            mkdir('uploads/images', 0777, true);
                        }

                        $producto->setImagen($filename);
                        move_uploaded_file($file['tmp_name'], 'uploads/images/' . $filename);
                    }
                }

                // Aca diferenciamos si es actualizar o agregar nuevo producto
                if (isset($_GET['id'])) {
                    $id = $_GET['id'];
                    $producto->setId($id);
                    $save = $producto->edit(); // los guardamos en la bbdd
                } else {
                    $save = $producto->save(); // los guardamos en la bbdd
                }

                
                if ($save) { // comprobamos si la varible da true
                    $_SESSION['producto'] = 'complete';
                } else {
                    $_SESSION['producto'] = 'failed';
                }
            } else { // compropando si una variable da false
                $_SESSION['producto'] = 'failed';
            }
        } else { // comprando si no llega nada por post
            $_SESSION['producto'] = 'failde';
        }
        // hacemos una redireccion donde estan la  lista de productos
        header("Location:" . base_url . "producto/gestion");
    }

    public function editar()
    {
        Utils::isAdmin();
       
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $edit = true;

            $producto = new Producto();
            $producto->setId($id);

            $pro = $producto->getOne();

            require_once 'views/producto/crear.php';

        } else {
            header('Location:' . base_url . 'producto/gestion');
        }
        
    }

    public function eliminar()
    {
        Utils::isAdmin();

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $producto = new Producto();
            $producto->setId($id);

            $delete = $producto->delete();
            if ($delete) {
                $_SESSION['delete'] = 'complete';
            } else {
                $_SESSION['delete'] = 'failed';
            }
        } else {
            $_SESSION['delete'] = 'failed';
        }
        header('Location:' . base_url . 'producto/gestion');
    }
}
