<?php

class ProdutosController extends Controller{
    public function index(){
        $dados = array();

        $this->carregarViews('produtos', $dados);
    }
}