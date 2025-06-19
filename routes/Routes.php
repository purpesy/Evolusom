<?php

class Routes {
    public function executar() {
        $url = '/';
        if (isset($_GET['url'])) {
            $url .= $_GET['url'];
        }

        $parametro = [];

        if (!empty($url) && $url != '/') {
            $url = explode('/', $url);
            array_shift($url);

            $controladorAtual = ucfirst($url[0]) . 'Controller';
            array_shift($url);

            $acaoAtual = isset($url[0]) && !empty($url[0]) ? ucfirst($url[0]) : 'index';
            if (isset($url[0])) array_shift($url);

            $parametro = $url;
        } else {
            $controladorAtual = 'HomeController';
            $acaoAtual = 'index';
        }

        if (!file_exists('../app/controllers/' . $controladorAtual . '.php')) {
            $controladorAtual = 'ErroController';
            $acaoAtual = 'index';
        }

        require_once '../app/controllers/' . $controladorAtual . '.php';

        if (!class_exists($controladorAtual) || !method_exists($controladorAtual, $acaoAtual)) {
            $controladorAtual = 'ErroController';
            $acaoAtual = 'index';
        }

        $controller = new $controladorAtual();
        $method = $_SERVER['REQUEST_METHOD'];

        // Lê o corpo da requisição
        $dados = $_POST;
        if (in_array($method, ['PUT', 'PATCH']) && empty($dados)) {
            parse_str(file_get_contents("php://input"), $dados);
        }

        // Aqui está a correção
        if (in_array($method, ['POST', 'PUT', 'PATCH'])) {
            if (count($parametro) === 1) {
                call_user_func_array([$controller, $acaoAtual], [$parametro[0], $dados]);
            } else {
                call_user_func_array([$controller, $acaoAtual], [$dados]);
            }
        } else {
            call_user_func_array([$controller, $acaoAtual], $parametro);
        }
    }
}
