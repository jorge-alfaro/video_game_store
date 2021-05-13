<?php
require_once 'models/juegos.php';
class juegosController{

    public function index(){
        //renderizar vista
        require_once 'views/layout/header.php';
        require_once 'views/layout/carrousel.php';


        $juego = new Juego();
        $juegos =$juego->getRandom(6);
       
        require_once 'views/games/juegosdestacados.php';
        //require_once 'views/games/ofertas1.php';
    }
    public function ver(){
        if(isset($_GET['id'])){
            $id= $_GET['id'];
           
            $juego = new Juego();
            $juego->setId($id);

           $game= $juego->getOne();

      
        }
        require_once 'views/games/ver.php';
    }

    public function gestion(){
        Utils::isAdmin();

        $juego = new Juego();
        $juegos = $juego->getAll();

        require_once 'views/games/juegos.php';
    }

    public function crear(){
        Utils::isAdmin();
        require_once 'views/games/crear.php';
    }

    public function save(){
        Utils::isAdmin();
        if(isset($_POST)){
            
            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
            $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : false;
            $precio = isset($_POST['precio']) ? $_POST['precio'] : false;
            $categoria = isset($_POST['categoria']) ? $_POST['categoria'] : false;
          //  $imagen = isset($_POST['imagen']) ? $_POST['imagen'] : false;

          if($nombre && $descripcion && $precio && $categoria){
              $juego =new Juego();
              $juego->setNombre($nombre);
              $juego->setDescripcion($descripcion);
              $juego->setPrecio($precio);
              $juego->setCategoria_id($categoria);


              //Guardar la imagen

              if(isset($_FILES['imagen'])){
                $file = $_FILES['imagen'];
                $filename =$file['name'];
                $mimetype =$file['type'];

                if($mimetype == "image/jpg" || $mimetype =='image/jpeg' || $mimetype == 'image/pgn' || $mimetype == 'image/gif'){

                    if(!is_dir('uploads/images')){
                        mkdir('uploads/images',0777,true);
                    }
                
                    move_uploaded_file($file['tmp_name'], 'uploads/images/'.$filename);
                    $juego->setImagen($filename);

                }
              }

              if(isset($_GET['id'])){
                $id = $_GET['id'];
                $juego->setId($id);

                $save =$juego->edit();
              }else{
                $save =$juego->save();
              }

              if($save){
                  $_SESSION['juego'] = "Complete";

              }else{
                  $_SESSION['juego'] = "Failed";
              }
          }else{
              $_SESSION['juego'] = "Failed";
          }
        }else{
            $_SESSION['juego'] = "Failed";
        }
        header('Location:'.base_url.'juegos/gestion');
    }

    public function editar(){
        Utils::isAdmin();
        if(isset($_GET['id'])){
            $id= $_GET['id'];
            $edit =true;

            $juego = new Juego();
            $juego->setId($id);

           $gam= $juego->getOne();

       require_once 'views/games/crear.php';
        }else{
            header('Location:'.base_url.'juegos/gestion');
        }
    }

    public function eliminar(){
       Utils::isAdmin();
       if(isset($_GET['id'])){
           $id =$_GET['id'];
           $juego = new Juego();
           $juego->setId($id);

          $delete = $juego->delete();
            if($delete){
                $_SESSION['delete'] = 'Complete';
            }else{
                $_SESSION['delete'] = 'Failed';
            }
       }else{
        $_SESSION['delete'] = 'Failed';
       }

       header('Location:'.base_url.'juegos/gestion');
    }
}