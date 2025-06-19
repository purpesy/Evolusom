<?php

class ServicosController extends Controller{
    public function index(){
        $dados = array();

        $this->carregarViews('servicos', $dados);
    }
}