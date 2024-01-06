<?php
session_start();
include_once '../include/camisetasDB.php';

class Producto {
  private $id_producto;
  private $nombre;
  private $precio;
  private $imagen;
  
  function __construct($id_producto,$nombre, $precio, $imagen ) {
    $this->id_producto = $id_producto;
    $this->nombre = $nombre;
    $this->precio= $precio;
    $this->imagen= $imagen;
 
  }

    public function getIdproducto() {
        return $this->id_producto;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getPrecio() {
        return $this->precio;
    }

    public function getImagen() {
        return $this->imagen;
    }

/*Devuelve un array asociativo que contiene todos los productos*/

    public static function select() {
        $conexion = camisetasDB::connectDB();
        $sql = "SELECT * FROM productos";

        try {
            $stmt = $conexion->prepare($sql);
            $stmt->execute();
            $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $productos = array();
            foreach ($resultados as $producto) {
                $productos[] = new Producto(
                    $producto['id_producto'],
                    $producto['nombre'],
                    $producto['precio'],
                    $producto['imagen']
                );
            }
            return $productos;
        } catch (PDOException $e) {
            echo "Error de conexión: " . $e->getMessage();
            return false; // Devuelve falso en caso de error
        }
    }

    
}