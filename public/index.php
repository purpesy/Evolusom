<?php

// carregando as configurações iniciais
require_once('../config/config.php');

// cria a variavel caminho que pega a classe
$caminho = new Routes();
//executa o metodo do classe
$caminho->executar();

// model - Responsável pelos dados e regras de negócio, view - Responsável pela interface do usuário. controller - Responsável pela lógica da aplicação.