<?php

class HomeController extends Controller{
    public function index(){
        $produtoModel = new Produto();
        $servicoModel = new Servico();
        
        $dados = array();
        $dados['titulo'] = '🔊 Evolusom - Sons e Acessórios Automotivos';
        $dados['subtitulo'] = 'home';
        $dados['produtos_destaque'] = $produtoModel->getProdutosDestaque(12); // Buscar mais produtos para o carrossel
        $dados['servicos_destaque'] = $servicoModel->getServicosLimitados(12); // Buscar mais serviços para o carrossel
        
        $this->carregarViews('home', $dados);
    }   
}