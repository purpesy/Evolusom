<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

class ContatoController extends Controller
{
    public function index()
    {
        $dados = array();
        $this->carregarViews('contato', $dados);
    }

    public function enviarEmail()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $fone = filter_input(INPUT_POST, 'fone', FILTER_SANITIZE_SPECIAL_CHARS);
            $assunto = filter_input(INPUT_POST, 'assunto', FILTER_SANITIZE_SPECIAL_CHARS);
            $msg = filter_input(INPUT_POST, 'msg', FILTER_SANITIZE_SPECIAL_CHARS);

            $status = 'Pendente';

            date_default_timezone_set('America/Sao_Paulo');
            $dataHora = date('Y-m-d H:i:s');

            // Validação básica
            if (empty($nome) || empty($email) || empty($msg)) {
                $dados = array(
                    'mensagem' => 'Por favor, preencha todos os campos obrigatórios.',
                    'status'   => 'erro',
                    'nome'     => $nome,
                    'email'    => $email,
                    'fone'     => $fone,
                    'assunto'  => $assunto,
                    'msg'      => $msg
                );
                $this->carregarViews('contato', $dados);
                return;
            }

            // Validação de email
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $dados = array(
                    'mensagem' => 'Por favor, insira um email válido.',
                    'status'   => 'erro',
                    'nome'     => $nome,
                    'email'    => $email,
                    'fone'     => $fone,
                    'assunto'  => $assunto,
                    'msg'      => $msg
                );
                $this->carregarViews('contato', $dados);
                return;
            }

            try {
                $contatoModel = new Contato();
                $salvar = $contatoModel->salvarEmail($nome, $email, $fone, $assunto, $msg, $status, $dataHora);

                if ($salvar) {
                    // Carregamento correto dos arquivos PHPMailer
                    require_once '../public/vendors/email/Exception.php';
                    require_once '../public/vendors/email/PHPMailer.php';
                    require_once '../public/vendors/email/SMTP.php';

                    // Importações necessárias

                    // Criar instância do PHPMailer
                    $mail = new PHPMailer(true);

                    try {
                        // Configurações do servidor
                        $mail->SMTPDebug  = 0;
                        $mail->isSMTP();
                        $mail->Host       = EMAIL_HOST;
                        $mail->SMTPAuth   = true;
                        $mail->Username   = EMAIL_USER;
                        $mail->Password   = EMAIL_PASS;
                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                        $mail->Port       = EMAIL_PORT;

                        // Remetente e destinatário
                        $mail->setFrom(EMAIL_USER, 'Evolusom - Sistema de Contato');
                        $mail->addAddress('gui112491@gmail.com', 'Guilherme');
                        $mail->addReplyTo($email, $nome);

                        // Configurar charset
                        $mail->CharSet = 'UTF-8';

                        // Conteúdo do email
                        $mail->isHTML(true);
                        $mail->Subject = $assunto ? $assunto : 'Novo contato do site';
                        
                        $corpo = "
                        <h3>Novo contato recebido</h3>
                        <p><strong>Nome:</strong> " . htmlspecialchars($nome) . "</p>
                        <p><strong>Email:</strong> " . htmlspecialchars($email) . "</p>
                        <p><strong>Telefone:</strong> " . htmlspecialchars($fone) . "</p>
                        <p><strong>Assunto:</strong> " . htmlspecialchars($assunto) . "</p>
                        <p><strong>Mensagem:</strong></p>
                        <p>" . nl2br(htmlspecialchars($msg)) . "</p>
                        <hr>
                        <p><small>Enviado em: " . $dataHora . "</small></p>
                        ";
                        
                        $mail->msgHTML($corpo);
                        
                        $mail->AltBody = "Nome: $nome\nEmail: $email\nTelefone: $fone\nAssunto: $assunto\nMensagem: $msg\n\nEnviado em: $dataHora";

                        $mail->send();

                        $dados = array(
                            'mensagem' => 'Obrigado pelo seu contato! Em breve retornaremos.',
                            'status'   => 'sucesso'
                        );

                    } catch (Exception $e) {
                        error_log('Erro ao enviar email: ' . $mail->ErrorInfo);
                        
                        $dados = array(
                            'mensagem' => 'Não foi possível enviar sua mensagem. Tente novamente mais tarde.',
                            'status'   => 'erro',
                            'nome'     => $nome,
                            'email'    => $email,
                            'fone'     => $fone,
                            'assunto'  => $assunto,
                            'msg'      => $msg
                        );
                    }

                } else {
                    $dados = array(
                        'mensagem' => 'Erro ao salvar mensagem. Tente novamente.',
                        'status'   => 'erro',
                        'nome'     => $nome,
                        'email'    => $email,
                        'fone'     => $fone,
                        'assunto'  => $assunto,
                        'msg'      => $msg
                    );
                }

            } catch (Exception $e) {
                error_log('Erro geral no contato: ' . $e->getMessage());
                
                $dados = array(
                    'mensagem' => 'Erro interno. Tente novamente mais tarde.',
                    'status'   => 'erro'
                );
            }

            $this->carregarViews('contato', $dados);

        } else {
            $dados = array();
            $this->carregarViews('contato', $dados);
        }
    }
}