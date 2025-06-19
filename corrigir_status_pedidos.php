<?php
// Script para corrigir status dos pedidos
require_once 'config/conexao.php';

echo "<h2>Correção de Status dos Pedidos</h2>";

try {
    // Primeiro, verificar os status atuais
    echo "<h3>Status atuais na tabela:</h3>";
    $sql = "SELECT id_pedido, pedido_status, COUNT(*) as total FROM tbl_pedido GROUP BY pedido_status";
    $stmt = $db->query($sql);
    $statusAtuais = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    if (!empty($statusAtuais)) {
        echo "<table border='1'>";
        echo "<tr><th>Status</th><th>Quantidade</th></tr>";
        foreach ($statusAtuais as $status) {
            echo "<tr><td>" . $status['pedido_status'] . "</td><td>" . $status['total'] . "</td></tr>";
        }
        echo "</table>";
    }
    
    // Corrigir status numéricos para texto
    echo "<h3>Corrigindo status numéricos...</h3>";
    
    $correcoes = [
        '0' => 'Pendente',
        '1' => 'Aprovado', 
        '2' => 'Entregue',
        '3' => 'Cancelado',
        '4' => 'Inativo'
    ];
    
    $totalCorrecoes = 0;
    
    foreach ($correcoes as $statusNumerico => $statusTexto) {
        $sql = "UPDATE tbl_pedido SET pedido_status = :status_texto WHERE pedido_status = :status_numerico";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':status_texto', $statusTexto);
        $stmt->bindValue(':status_numerico', $statusNumerico);
        $stmt->execute();
        
        $linhasAfetadas = $stmt->rowCount();
        if ($linhasAfetadas > 0) {
            echo "<p>✅ Corrigidos $linhasAfetadas pedidos de status '$statusNumerico' para '$statusTexto'</p>";
            $totalCorrecoes += $linhasAfetadas;
        }
    }
    
    if ($totalCorrecoes == 0) {
        echo "<p>ℹ️ Nenhuma correção necessária - todos os status já estão corretos.</p>";
    } else {
        echo "<p><strong>Total de correções: $totalCorrecoes pedidos</strong></p>";
    }
    
    // Verificar resultado após correção
    echo "<h3>Status após correção:</h3>";
    $sql = "SELECT pedido_status, COUNT(*) as total FROM tbl_pedido GROUP BY pedido_status";
    $stmt = $db->query($sql);
    $statusCorrigidos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    if (!empty($statusCorrigidos)) {
        echo "<table border='1'>";
        echo "<tr><th>Status</th><th>Quantidade</th></tr>";
        foreach ($statusCorrigidos as $status) {
            echo "<tr><td>" . $status['pedido_status'] . "</td><td>" . $status['total'] . "</td></tr>";
        }
        echo "</table>";
    }
    
    echo "<h3>Últimos pedidos corrigidos:</h3>";
    $sql = "SELECT id_pedido, pedido_data, pedido_status, pedido_valor_total FROM tbl_pedido ORDER BY id_pedido DESC LIMIT 5";
    $stmt = $db->query($sql);
    $pedidos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    if (!empty($pedidos)) {
        echo "<table border='1'>";
        echo "<tr><th>ID</th><th>Data</th><th>Status</th><th>Valor</th></tr>";
        foreach ($pedidos as $pedido) {
            echo "<tr>";
            echo "<td>" . $pedido['id_pedido'] . "</td>";
            echo "<td>" . date('d/m/Y', strtotime($pedido['pedido_data'])) . "</td>";
            echo "<td><strong>" . $pedido['pedido_status'] . "</strong></td>";
            echo "<td>R$ " . number_format($pedido['pedido_valor_total'], 2, ',', '.') . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    }
    
    echo "<hr>";
    echo "<p><strong>✅ Correção concluída! Agora você pode:</strong></p>";
    echo "<ul>";
    echo "<li>Acessar a <a href='" . (isset($_SERVER['HTTP_HOST']) ? "http://".$_SERVER['HTTP_HOST']."/evolusom" : "") . "/pedido/listar' target='_blank'>Lista de Pedidos</a></li>";
    echo "<li>Criar um <a href='" . (isset($_SERVER['HTTP_HOST']) ? "http://".$_SERVER['HTTP_HOST']."/evolusom" : "") . "/pedido/novo' target='_blank'>Novo Pedido</a></li>";
    echo "</ul>";
    
} catch (Exception $e) {
    echo "<p style='color: red;'>Erro: " . $e->getMessage() . "</p>";
}
?>

<style>
table { border-collapse: collapse; margin: 10px 0; }
th, td { padding: 8px; text-align: left; border: 1px solid #ddd; }
th { background-color: #f2f2f2; }
body { font-family: Arial, sans-serif; margin: 20px; }
h2, h3 { color: #333; }
</style> 