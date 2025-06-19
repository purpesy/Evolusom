<?php

// Iniciando a sessão apenas se não estiver ativa
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// definindo uma constante, sempre que eu usar urlbase vai ser esse url
define('URL_BASE', 'http://localhost/Evolusom/public/');

// config database
define('DB_HOST', 'smpsistema.com.br');
define('DB_NAME', 'u283879542_evollusom');
define('DB_USER', 'u283879542_evollusom');
define('DB_PASS', '_Tipi@03');

// Configurações de charset para evitar problemas de encoding
define('DB_CHARSET', 'utf8');

//config email
define('EMAIL_HOST', 'smpsistema.com.br');
define('EMAIL_PORT', '465');
define('EMAIL_USER', 'tipi03@smpsistema.com.br');
define('EMAIL_PASS', 'Senac@tipi03');

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
