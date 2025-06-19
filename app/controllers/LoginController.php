<?php
 
class LoginController extends Controller
{
    public function index()
    {
        $dados = array();
        $this->carregarViews('login', $dados);
    }
 
    public function entrar()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $senha = filter_input(INPUT_POST, 'senha');
            $funcModel = new Funcionario();
            $usuario = $funcModel->buscarFunc($email, $senha);
 
            if ($usuario) {
                $tipo = 'funcionario';
                $tipo_id = $usuario['id_funcionario'];
                $tipo_nome = $usuario['funcionario_nome'];
                $tipo_email = $usuario['funcionario_email'];
 
            } else {
                $clienteModel = new Cliente();
                $usuario = $clienteModel->buscarCliente($email, $senha);
 
                if ($usuario) {
 
                    $tipo = 'cliente';
                    $tipo_id = $usuario['id_cliente'];
                    $tipo_nome = $usuario['cliente_nome'];
                    $tipo_email = $usuario['cliente_email'];
                } else {
                    $usuario = null;
                }
            }
 
 
            if ($usuario) {
 
                $_SESSION['tipo'] = $tipo;
                $_SESSION['tipo_id'] = $tipo_id;
                $_SESSION['tipo_nome'] = $tipo_nome;
                $_SESSION['tipo_email'] = $tipo_email;
                if($tipo == 'cliente') {
                    header('location:' . URL_BASE . 'home');
                } else {
                    header('location:' . URL_BASE . 'dash');
                }
                exit;
            }else{
                $_SESSION['erro-login'] = "Ops! Este login não existe ou a senha está incorreta. Verifique seus dados e tente novamente.";
                header('Location:' . URL_BASE . 'home');
                exit;
            }  
        }
    }

    public function logout()
    {
        // Iniciar sessão se não estiver ativa
        if(session_status() == PHP_SESSION_NONE){
            session_start();
        }
        
        // Destruir todas as variáveis de sessão
        $_SESSION = array();
        
        // Se desejar destruir a sessão completamente, apague também o cookie de sessão
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }
        
        // Finalmente, destruir a sessão
        session_destroy();
        
        // Redirecionar para a página inicial
        header('Location:' . URL_BASE . 'home');
        exit;
    }
}