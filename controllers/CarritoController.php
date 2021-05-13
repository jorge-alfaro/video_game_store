<?php
require_once 'models/juegos.php';

class carritoController{

    public function index(){
         if (isset($_SESSION['carrito']) && count($_SESSION['carrito']) >= 1){
            $carrito = $_SESSION['carrito'];
         }else{
             $carrito=array();
         }
       require_once 'views/carrito/index.php';
    }

    public function add(){
        if(isset($_GET['id'])){
            $juego_id =$_GET['id'];
        }else{
            header('Location:'.base_url);
        }

        if(isset($_SESSION['carrito'])){
            $counter = 0;
            foreach($_SESSION['carrito'] as $indice => $elemento){
                if($elemento['id_juego'] == $juego_id){
                    $_SESSION['carrito'][$indice]['unidades']++;
                    $counter++;
                }
            }

        }

        if(!isset($counter) || $counter == 0){
            //conseguir juego
            $juego = new Juego();
            $juego->setId($juego_id);
            $juego = $juego->getOne();
            

            //Añadir al carrito
            if(is_object($juego)){
                $_SESSION['carrito'][] = array("id_juego" => $juego->id,
                    "precio" => $juego->precio,
                    "unidades" => 1,
                    "juego" => $juego
                );
                
            }
        }
        header('Location:'.base_url."carrito/index");
    }

    public function delete(){
        if(isset($_GET['index'])){
        $index = $_GET['index'];
        unset($_SESSION['carrito'][$index]);
        }
        header('Location:'.base_url."carrito/index");
    }
    public function up(){
        if(isset($_GET['index'])){
        $index = $_GET['index'];
        $_SESSION['carrito'][$index]['unidades']++;
        }
        header('Location:'.base_url."carrito/index");
    }
    public function down(){
        if(isset($_GET['index'])){
            $index = $_GET['index'];
            $_SESSION['carrito'][$index]['unidades']--;
            
            if($_SESSION['carrito'][$index]['unidades']==0){  
                unset($_SESSION['carrito'][$index]);
            }
        }
        header('Location:'.base_url."carrito/index");
    }

    public function delete_all(){
        unset($_SESSION['carrito']);
        header('Location:'.base_url."carrito/index");
    }
}