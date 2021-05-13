<?php
class Pedido{
    private $id;
    private $usuario_id;
    private $coste;
    private $pais;
    private $estado;
    private $status;
    private $fecha;
    private $hora;

    private $db;

    public function __construct(){
        $this->db = Database::connect();
    }
    
    function getId(){
        return $this->id;
    }

    function getUsuario_id(){
        return $this->usuario_id;
    }
    function getCoste(){
        return $this->coste;
    }    
    function getPais(){
        return $this->pais;
    }
    function getEstado(){
        return $this->estado;
    }
    function getStatus(){
        return $this->status;
    }
    function getFecha(){
        return $this->fecha;
    }
    function getHora(){
        return $this->hora;
    }

    function setId($id){
        $this->id =$id;
    }
    function setUsuario_id($usuario_id){
        $this->usuario_id=$usuario_id;
    }
    function setCoste($coste){
        $this->coste=$coste;
    }
    function setPais($pais){
        $this->pais=$this->db->real_escape_string($pais);
    }
    function setEstado($estado){
        $this->estado=$this->db->real_escape_string($estado);
    }
    function setStatus($status){
        $this->status=$this->db->real_escape_string($status);
    }
    function setFecha($fecha){
        $this->fecha=$fecha;
    }
    function setHora($hora){
        $this->hora=$hora;
    }

    public function getAll(){
        $juegos = $this->db->query("SELECT * FROM pedidos ORDER BY id DESC");
        return $juegos;
    }
  
    public function getOne(){
        $juego = $this->db->query("SELECT * FROM pedidos WHERE id = {$this->getId()};");
        return $juego->fetch_object();
    }

    public function getOneByUser(){
       $sql = "SELECT p.id, p.coste FROM pedidos p "
     //  . "INNER JOIN lineas_pedidos lp ON lp.pedido_id = p.id "
       . "WHERE p.usuario_id = {$this->getUsuario_id()} ORDER BY id DESC LIMIT 1";
        $pedido = $this->db->query($sql);
        return $pedido->fetch_object();
    }

    public function getAllByUser(){
        $sql = "SELECT p.* FROM pedidos p "
        . "WHERE p.usuario_id = {$this->getUsuario_id()} ORDER BY id DESC";
         $pedido = $this->db->query($sql);
         return $pedido;
     }
    
    public function getJuegosByPedido($id){
        // $sql = "SELECT * FROM juegos WHERE id IN "
        // . "(SELECT juegos_id FROM lineas_pedidos WHERE pedido_id={$id})";

        $sql = "SELECT ju.*, lp.unidades FROM juegos ju "
        . "INNER JOIN lineas_pedidos lp ON ju.id =lp.juegos_id "
        . "WHERE lp.pedido_id={$id}"; 
        $juegos = $this->db->query($sql);
        return $juegos;
    }
    public function save(){
    
        $sql = "INSERT INTO pedidos VALUES (NULL,{$this->getUsuario_id()},{$this->getCoste()},'{$this->getPais()}','{$this->getEstado()}','confirm',CURDATE(),CURTIME());";
        $save = $this->db->query($sql);
    
        $result =false;
        if($save){
            $result =true;
        }
        return $result;
    }
    public function save_linea(){
        $sql = "SELECT LAST_INSERT_ID() as 'pedido';";
        $query = $this->db->query($sql);
        $pedido_id =$query->fetch_object()->pedido;

        foreach ($_SESSION['carrito'] as $indice => $elemento){
            $juego = $elemento['juego'];

            $insert = "INSERT INTO lineas_pedidos VALUES(NULL,{$pedido_id},{$juego->id},{$elemento['unidades']})";
            $save = $this->db->query($insert);
        }
    
        $result =false;
        if($save){
            $result =true;
        }
        return $result;

    }
    public function edit(){
    
        $sql = "UPDATE pedidos SET status='{$this->getStatus()}' ";
            $sql.=" WHERE id={$this->getId()};";
    
    
            $save = $this->db->query($sql);
        
            $result =false;
            if($save){
                $result =true;
            }
            return $result;
        }
}