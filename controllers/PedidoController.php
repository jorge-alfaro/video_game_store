<?php
require_once 'models/pedido.php';
class pedidoController{

    public function hacer(){
        require_once 'views/pedido/hacer.php';
    }

    public function add(){
        if(isset($_SESSION['identity'])){
            $usuario_id = $_SESSION['identity']->id;
            
            $pais = isset($_POST['pais']) ? $_POST['pais'] : false;
            $estado = isset($_POST['estado']) ? $_POST['estado'] : false;

            $stats =Utils::statsCarrito();
            $coste =$stats['total'];

            if($pais && $estado){
                //save datos en DB
                $pedido =new Pedido();
                $pedido->setUsuario_id($usuario_id);
                $pedido->setCoste($coste);
                $pedido->setPais($pais);
                $pedido->setEstado($estado);

                $save = $pedido->save();

                //Linea Pedido
               $save_linea = $pedido->save_linea();

                if($save && $save_linea){
                    $_SESSION['pedido'] = "Complete";
                }else{
                    $_SESSION['pedido'] = "failed";
                }
            }else{
                $_SESSION['pedido'] = "failed";
            }

            header("Location:".base_url.'pedido/confirmado');
        }else{
            //redirigir al index
            header("Location".base_url);
        }
       
    }

    public function confirmado(){
        if(isset($_SESSION['identity'])){
            $identity =$_SESSION['identity'];
            $pedido = new Pedido();
            $pedido->setUsuario_id($identity->id);

            $pedido = $pedido->getOneByUser();

            $pedido_juegos = new Pedido();
            $juegos = $pedido_juegos->getJuegosByPedido($pedido->id);
        }
        require_once 'views/pedido/confirmado.php';
    }

    public function mis_pedidos(){
        Utils::isIdentity();

    $usuario_id =$_SESSION['identity']->id;
    $pedido = new Pedido();

    //traer los pedidos del usuario
    $pedido->setUsuario_id($usuario_id); 
    $pedido = $pedido->getAllByUser();

        require_once 'views/pedido/mis_pedidos.php';
    }

    public function detalle(){
        Utils::isIdentity();

        if(isset($_GET['id'])){
            $id = $_GET['id'];

            //sacar el pedido
            $pedido = new Pedido();
            $pedido->setId($id);
            $pedido = $pedido->getOne();

            //Sacar los Juegos
            $pedido_juegos = new Pedido();
            $juegos = $pedido_juegos->getJuegosByPedido($id);


            require_once 'views/pedido/detalle.php';
        }else{
            header('Location:'.base_url.'pedido/mis_pedidos');
        }
    }

    public function gestion(){
        Utils::isAdmin();
        $gestion = true;

        $pedido = new Pedido();
        $pedido = $pedido->getAll();
        require_once 'views/pedido/mis_pedidos.php';
    }

    public function status(){
        Utils::isAdmin();
        if(isset($_POST['pedido_id']) && isset($_POST['status'])){
           //recoger datos del form
            $id = $_POST['pedido_id'];
            $status =$_POST['status'];
            //update del pedido
            $pedido= new Pedido();
            $pedido->setId($id);
            $pedido->setStatus($status);
            $pedido->edit();

            header("location:".base_url.'pedido/detalle&id='.$id);

        }else{
            header("Location:".base_url);
        }
    }
}