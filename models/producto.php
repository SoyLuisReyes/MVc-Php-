<?php

class Producto
{
    private $id;
    private $categoria_id;
    private $nombre;
    private $descripcion;
    private $precio;
    private $stock;
    private $oferta;
    private $fecha;
    private $imagen;
    private $db;

    public function __construct()
    {
        $this->db = Database::Connect();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getCategoria_id()
    {
        return $this->categoria_id;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function getDescripcion()
    {
        return $this->descripcion;
    }

    public function getPrecio()
    {
        return $this->precio;
    }

    public function getStock()
    {
        return $this->stock;
    }

    public function getOferta()
    {
        return $this->oferta;
    }

    public function getFecha()
    {
        return $this->fecha;
    }

    public function getImagen()
    {
        return $this->imagen;
    }

    // SETTER
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function setCategoria_id($categoria_id)
    {
        $this->categoria_id = $categoria_id;

        return $this;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $this->db->real_escape_string($nombre);

        return $this;
    }

    public function setDescripcion($descripcion)
    {
        $this->descripcion = $this->db->real_escape_string($descripcion);

        return $this;
    }

    public function setPrecio($precio)
    {
        $this->precio = $this->db->real_escape_string($precio);

        return $this;
    }

    public function setStock($stock)
    {
        $this->stock = $this->db->real_escape_string($stock);

        return $this;
    }

    public function setOferta($oferta)
    {
        $this->oferta = $this->db->real_escape_string($oferta);

        return $this;
    }

    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    public function setImagen($imagen)
    {
        $this->imagen = $imagen;

        return $this;
    }

    public function getAll()
    {
        $productos = $this->db->query("SELECT * FROM productos ORDER BY id DESC");
        return $productos;
    }

    public function getAllcategory()
    {
        $sql = "SELECT p.*, c.nombre AS 'catnombre' FROM productos p "
              ." INNER JOIN categorias c ON c.id = p.categoria_id"
              ." WHERE p.categoria_id = {$this->getCategoria_id()} "
              ." ORDER BY id DESC";

        $productos = $this->db->query($sql);
        return $productos;
    }

    public function getRandom ($limit)
    {
        $productos = $this->db->query("SELECT * FROM productos ORDER BY RAND() LIMIT $limit");
        return $productos;
    }

    public function getOne()
    {
    $producto = $this->db->query("SELECT * FROM productos WHERE id = {$this->getId()}");
        return $producto->fetch_object();
    }

    public function save()
    {  // se tienen que insertar en el mismo orden que estan en la clase

        $sql = "INSERT INTO productos VALUES(NULL, {$this->getCategoria_id()}, '{$this->getNombre()}', '{$this->getDescripcion()}', {$this->getPrecio()}, {$this->getStock()}, NULL, CURDATE(), '{$this->getImagen()}')";
        // echo $sql; debugueando contenido
        // echo $this->db->error; otra forma de debuguear
        // echo $sql;
        // echo '<br>';
        // echo $this->db->error;
        // die();
        $save = $this->db->query($sql);

        $result = false;
        if ($save) {
            $result = true;
        }
        return $result;
    }

    public function edit()
    {  

        $sql = "UPDATE productos SET nombre ='{$this->getNombre()}', descripcion = '{$this->getDescripcion()}', precio = {$this->getPrecio()}, stock = {$this->getStock()}, categoria_id = {$this->getCategoria_id()} "; 
       
        if ($this->getImagen() != null ) {
             $sql .= ", imagen='{$this->getImagen()}'" ;
        } 
       
        $sql .= " WHERE id={$this->id};" ;

        $save = $this->db->query($sql);

        $result = false;
        if ($save) {
            $result = true;
        }
        return $result;
    } 

    public function delete()
    {
    $sql = "DELETE FROM productos WHERE id={$this->id}";
    $delete = $this->db->query($sql);

    $result = false;
    if ($delete) {
        $result = true;
    }
    return $result;
    }
}
