<?php

class DashController extends Controller
{

    public function index()
    {

        //tratamento para lidar com o usuario

        if(session_status() == PHP_SESSION_NONE){
            session_start();
        }

        if(!isset($_SESSION['tipo']) || !isset($_SESSION['tipo_id'])){
            header('Location:' . URL_BASE);
            exit;
        }

        $dados = array();
        $categoriaModel = new Categoria();
        $dados['categoria'] = $categoriaModel->getCategorias();
       
        
        $dados['titulo'] = 'DASHBOARD Sistema EvoluSom';
        $this->carregarViews('admin/dash', $dados); 
    }
    
}