<?php

class Controller{
    public function carregarViews($views, $dados = array()){
        // Se estiver carregando o dashboard, garante que as categorias estejam disponíveis
        if($views == 'admin/dash') {
            $modelCategoria = new Categoria();
            if(!isset($dados['categoria'])) {
                $dados['categoria'] = $modelCategoria->getCategorias();
            }
        }
        
        extract($dados);
        require_once '../app/views/'.$views.'.php';
        //../app/views/home.php

    }
}