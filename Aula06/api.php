<?php
// Define o tipo de conteúdo como JSON e o charset como UTF-8
header("Content-Type: application/json; charset=UTF-8");

$metodo = $_SERVER['REQUEST_METHOD'];
$arquivo = "usuarios.json";

// Se o arquivo não existir, cria um vazio
if (!file_exists($arquivo)) {
    file_put_contents($arquivo, json_encode([], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
}

$usuarios = json_decode(file_get_contents($arquivo), true);

switch ($metodo) {
    case 'GET':
        if (isset($_GET["id"])) {
            $id = intval($_GET["id"]);
            $usuario_encontrado = null;

            foreach ($usuarios as $usuario) {
                if ($usuario['id'] == $id) {
                    $usuario_encontrado = $usuario;
                    break;
                }
            }

            if ($usuario_encontrado) {
                echo json_encode($usuario_encontrado, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            } else {
                http_response_code(400);
                echo json_encode(["erro" => "Usuário não encontrado"], JSON_UNESCAPED_UNICODE);
            }
        } else {
            echo json_encode($usuarios, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        }
        break;

    case 'POST':
        $dados = json_decode(file_get_contents('php://input'), true);

        if (!isset($dados["nome"]) || !isset($dados["email"])) {
            http_response_code(400);
            echo json_encode(["erro" => "Dados incompletos."], JSON_UNESCAPED_UNICODE);
            exit;
        }

        $novo_id = 1;
        if (!empty($usuarios)) {
            $ids = array_column($usuarios, "id");
            $novo_id = max($ids) + 1;
        }

        $novoUsuario = [
            "id" => $novo_id,
            "nome" => $dados["nome"],
            "email" => $dados["email"]
        ];

        $usuarios[] = $novoUsuario;

        file_put_contents($arquivo, json_encode($usuarios, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

        echo json_encode(["mensagem" => "Usuário inserido com sucesso!", "usuarios" => $usuarios], JSON_UNESCAPED_UNICODE);
        break;

    case 'PUT':
        if (!isset($_GET["id"])) {
            http_response_code(400);
            echo json_encode(["erro" => "ID não informado para atualização."], JSON_UNESCAPED_UNICODE);
            exit;
        }

        $id = intval($_GET["id"]);
        $dados = json_decode(file_get_contents('php://input'), true);
        $atualizado = false;

        foreach ($usuarios as &$usuario) {
            if ($usuario['id'] == $id) {
                if (isset($dados["nome"])) $usuario["nome"] = $dados["nome"];
                if (isset($dados["email"])) $usuario["email"] = $dados["email"];
                $atualizado = true;
                break;
            }
        }

        if ($atualizado) {
            file_put_contents($arquivo, json_encode($usuarios, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
            echo json_encode(["mensagem" => "Usuário atualizado com sucesso!", "usuarios" => $usuarios], JSON_UNESCAPED_UNICODE);
        } else {
            http_response_code(400);
            echo json_encode(["erro" => "Usuário não encontrado para atualização."], JSON_UNESCAPED_UNICODE);
        }
        break;

    case 'DELETE':
        if (!isset($_GET["id"])) {
            http_response_code(400);
            echo json_encode(["erro" => "ID não informado para exclusão."], JSON_UNESCAPED_UNICODE);
            exit;
        }

        $id = intval($_GET["id"]);
        $encontrado = false;

        foreach ($usuarios as $index => $usuario) {
            if ($usuario['id'] == $id) {
                unset($usuarios[$index]);
                $usuarios = array_values($usuarios); // Reindexar o array
                $encontrado = true;
                break;
            }
        }

        if ($encontrado) {
            file_put_contents($arquivo, json_encode($usuarios, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
            echo json_encode(["mensagem" => "Usuário removido com sucesso!", "usuarios" => $usuarios], JSON_UNESCAPED_UNICODE);
        } else {
            http_response_code(400);
            echo json_encode(["erro" => "Usuário não encontrado para exclusão."], JSON_UNESCAPED_UNICODE);
        }
        break;

    default:
        http_response_code(405);
        echo json_encode(["erro" => "Método não permitido."], JSON_UNESCAPED_UNICODE);
        break;
}
?>
