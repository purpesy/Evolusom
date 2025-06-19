<?php

class SobreController extends Controller{
    public function index(){
        $dados = array();

        $this->carregarViews('sobre', $dados);
    }
}