<?php

// Iniciando a sessão apenas se não estiver ativa
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// definindo uma constante, sempre que eu usar urlbase vai ser esse url
define('URL_BASE', 'http://localhost/Evolusom/public/');

// config database
define('DB_HOST', 'url');
define('DB_NAME', 'dbname');
define('DB_USER', 'dbuser');
define('DB_PASS', 'dbpass');

// Configurações de charset para evitar problemas de encoding
define('DB_CHARSET', 'utf8');

//config email
define('EMAIL_HOST', 'url');
define('EMAIL_PORT', '465');
define('EMAIL_USER', 'email');
define('EMAIL_PASS', 'senha');

// Configurações de timezone
date_default_timezone_set('America/Sao_Paulo');

// Configurações de erro (desabilitar em produção)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// sistema carregamento automático de class
spl_autoload_register(function($class){
    $paths = [
        '../app/controllers/',
        '../app/models/',
        '../routes/'
    ];
    
    foreach($paths as $path) {
        $file = $path . $class . '.php';
        if(file_exists($file)){
            require_once $file;
            return;
        }
    }
});
