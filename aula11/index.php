<?php

// Ativa a exibição de erros para depuração (em ambiente local apenas)
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Inicializa a variável que armazenará o resultado
$resultado = "";
$erro = "";

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["cep"])) {
    $cep = $_GET["cep"];

    // Expressão regular: só permite exatamente 8 números
    if (preg_match("/^[0-9]{8}$/", $cep)) {

        // Consulta à API ViaCEP usando o CEP fornecido
        $url = "https://viacep.com.br/ws/{$cep}/json/";

        // Tenta buscar os dados da API
        $json = file_get_contents($url);

        if ($json !== false) {
            $dados = json_decode($json, true);

            // Verifica se houve erro no retorno da API (CEP inexistente)
            if (!isset($dados["erro"])) {
                // Monta o card com os dados
                $resultado = "
                    <div class='card'>
                        <h3>Endereço encontrado:</h3>
                        <p><strong>Logradouro:</strong> " . ($dados["logradouro"] ?: "N/A") . "</p>
                        <p><strong>Bairro:</strong> " . ($dados["bairro"] ?: "N/A") . "</p>
                        <p><strong>Cidade:</strong> " . ($dados["localidade"] ?: "N/A") . "</p>
                        <p><strong>Estado (UF):</strong> " . ($dados["uf"] ?: "N/A") . "</p>
                        <p><strong>Região estimada:</strong> " . ($dados["localidade"] . " - " . $dados["uf"]) . "</p>
                    </div>
                ";
            } else {
                $erro = "❌ CEP não encontrado.";
            }
        } else {
            $erro = "⚠️ Erro ao conectar com a API.";
        }
    } else {
        $erro = "⚠️ CEP inválido. Digite exatamente 8 números (ex: 08492808).";
    }
}
?>






<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Buscar CEP</title>
  <link rel="stylesheet" href="css/style.css" />
</head>
<body>
  <h1>Buscar Endereço pelo CEP</h1>

    <!-- Formulário para digitar o CEP -->
    <form method="get">
        <input type="text" name="cep" placeholder="Digite o CEP (8 números)" maxlength="8" required>
        <button type="submit">Buscar</button>
    </form>

    <!-- Exibe erro, se houver -->
    <?php if ($erro): ?>
        <p class="erro"><?= $erro ?></p>
    <?php endif; ?>

    <!-- Exibe resultado, se houver -->
    <?= $resultado ?>

 
</body>
</html>
