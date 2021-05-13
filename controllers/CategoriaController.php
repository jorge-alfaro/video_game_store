<?php
require_once 'models/categoria.php';
require_once 'models/juegos.php';
class categoriaController{

    public function index(){
        Utils::isAdmin();
        $categoria = new Categoria();
        $categorias = $categoria->getAll();


        require_once 'views/categoria/index.php';
    }

    public function ver(){

        if(isset($_GET['id'])){
            $id=$_GET['id'];
            //Conseguir la categoria
            $categoria = new Categoria();
            $categoria->setId($id);
            $categoria = $categoria->getOne();
            //Conseguir los juegos
            $juego = new Juego();
            $juego->setCategoria_id($id);
            $juegos =$juego->getAllCategory();
          
        }
        require_once 'views/categoria/ver.php';
    }
    public function crear(){
        Utils::isAdmin();
        require_once 'views/categoria/crear.php';
    }

    public function save(){
        Utils::isAdmin();
        if(isset($_POST) && isset($_POST['nombre'])){

        
        //guardar la categoria en la base de datos
        $categoria = new Categoria();
        $categoria->setNombre($_POST['nombre']);
        $save = $categoria->save();
        }
        header("Location:".base_url."categoria/index");

    }

}