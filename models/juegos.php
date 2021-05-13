<?php
class Juego{
    private $id;
    private $categoria_id;
    private $nombre;
    private $descripcion;
    private $precio;
    private $oferta;
    private $fecha;
    private $imagen;

    private $db;

    public function __construct(){
        $this->db = Database::connect();
    }
    
    function getId(){
        return $this->id;
    }

    function getCategoria_id(){
        return $this->categoria_id;
    }
    function getNombre(){
        return $this->nombre;
    }    
    function getDescripcion(){
        return $this->descripcion;
    }
    function getPrecio(){
        return $this->precio;
    }
    function getOferta(){
        return $this->oferta;
    }
    function getFecha(){
        return $this->fecha;
    }
    function getImagen(){
        return $this->imagen;
    }

    function setId($id){
        $this->id =$id;
    }
    function setCategoria_id($categoria_id){
        $this->categoria_id=$categoria_id;
    }
    function setNombre($nombre){
        $this->nombre=$this->db->real_escape_string($nombre);
    }
    function setDescripcion($descripcion){
        $this->descripcion=$this->db->real_escape_string($descripcion);
    }
    function setPrecio($precio){
        $this->precio=$this->db->real_escape_string($precio);
    }
    function setOferta($oferta){
        $this->oferta=$this->db->real_escape_string($oferta);
    }
    function setFecha($fecha){
        $this->fecha=$fecha;
    }
    function setImagen($imagen){
        $this->imagen=$imagen;
    }

    public function getAll(){
        $juegos = $this->db->query("SELECT * FROM juegos ORDER BY id DESC");
        return $juegos;
    }
    public function getAllCategory(){
        $sql ="SELECT j.*, c.nombre AS 'catnombre' FROM juegos j "
        . "INNER JOIN categorias c ON c.id = j.categoria_id "
        . "WHERE j.categoria_id = {$this->getCategoria_id()} "
        . "ORDER BY id DESC";
        $juegos = $this->db->query($sql);
        return $juegos;
    }

    public function getRandom($limit){
        $juegos = $this->db->query("SELECT * FROM juegos ORDER BY RAND() LIMIT $limit");
        return $juegos;
    }
    public function getOne(){
        $juego = $this->db->query("SELECT * FROM juegos WHERE id = {$this->getId()};");
        return $juego->fetch_object();
    }
    
    public function save(){
    
        $sql = "INSERT INTO juegos VALUES (NULL,'{$this->getCategoria_id()}','{$this->getNombre()}','{$this->getDescripcion()}',{$this->getPrecio()},'{$this->getOferta()}',CURDATE(),'{$this->getImagen()}');";
        $save = $this->db->query($sql);
    
        $result =false;
        if($save){
            $result =true;
        }
        return $result;
    }

    public function edit(){
    
    $sql = "UPDATE juegos SET nombre='{$this->getNombre()}',descripcion='{$this->getDescripcion()}',precio={$this->getPrecio()}, categoria_id={$this->getCategoria_id()}";

        if($this->getImagen() != null){
        $sql.=",imagen='{$this->getImagen()}'";
        }
        $sql.=" WHERE id={$this->id};";


        $save = $this->db->query($sql);
    
        $result =false;
        if($save){
            $result =true;
        }
        return $result;
    }

    public function delete(){
        $sql ="DELETE FROM juegos WHERE id={$this->id} ";
        $delete = $this->db->query($sql);
        
        $result =false;
        if($delete){
            $result =true;
        }
        return $result;
    }
}