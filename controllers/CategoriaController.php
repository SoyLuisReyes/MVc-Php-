<?php
require_once 'models/categoria.php';
require_once 'models/producto.php';

class categoriaController
{ // Esto es el controlador

    public function index()
    { // esta es la accion
        Utils::isAdmin();
        $categoria = new Categoria();
        $categorias = $categoria->getCategoria_listar();

        require_once 'views/categoria/index.php';
    }

    public function crear()
    {
        Utils::isAdmin();
        require_once 'views/categoria/crear.php';
    }

    public function ver()
    {
        if (isset($_GET['id'])){

            // conseguir categoria
            $id = $_GET['id'];
            $categoria = new Categoria();
            $categoria->setId($id);

            $categoria = $categoria->getOne();

            // conseguir productos
            $producto = new Producto();
            $producto->setCategoria_id($id);
            $productos = $producto->getAllcategory();
        }
        require_once 'views/categoria/ver.php';
    }

    public function save()
    {
        Utils::isAdmin();

       if (isset($_POST) && isset($_POST['nombre']) ) {
            // Guardar la categorias en la base de datos
        $categoria = new Categoria();
        $categoria->setNombre($_POST['nombre']);
        $save = $categoria->save();
       } 
        header("Location:" . base_url . "categoria/index");
    }
}
