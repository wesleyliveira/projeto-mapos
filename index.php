<?php
// 1. CONEXÃO COM O BANCO
$host = "localhost";
$user = "root";
$pass = ""; 
$db   = "db_vendas";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

// 2. BUSCA DOS DADOS
$sql = "SELECT id, cliente, valor_total, desconto FROM vendas";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>QuickSales Lite | Correção de Descontos</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f4f7f6; padding: 40px; }
        .container { max-width: 900px; margin: auto; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        h2 { color: #333; border-bottom: 2px solid #007bff; pb: 10px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background-color: #007bff; color: white; }
        .valor-bruto { color: #777; text-decoration: line-through; font-size: 0.9em; }
        .valor-liquido { color: #28a745; font-weight: bold; font-size: 1.1em; }
        .badge-desconto { background: #ffc107; padding: 2px 6px; border-radius: 4px; font-size: 0.8em; }
    </style>
</head>
<body>

<div class="container">
    <h2>Relatório de Vendas (Simulação MapOS)</h2>
    <p>Demonstração técnica de correção de cálculo na View.</p>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Cliente</th>
                <th>Valor Base</th>
                <th>Desconto</th>
                <th>Total a Pagar (Líquido)</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result->num_rows > 0): ?>
                <?php while($row = $result->fetch_assoc()): ?>
                    <?php 
                        $valorLiquido = $row["valor_total"] - $row["desconto"]; 
                    ?>
                    <tr>
                        <td>#<?= $row["id"] ?></td>
                        <td><?= $row["cliente"] ?></td>
                        <td class="valor-bruto">R$ <?= number_format($row["valor_total"], 2, ',', '.') ?></td>
                        <td><span class="badge-desconto">- R$ <?= number_format($row["desconto"], 2, ',', '.') ?></span></td>
                        <td class="valor-liquido">R$ <?= number_format($valorLiquido, 2, ',', '.') ?></td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr><td colspan="5">Nenhuma venda encontrada.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

</body>
</html>