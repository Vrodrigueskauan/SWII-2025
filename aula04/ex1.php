<!-- Exercício 1
a) Crie um array associativo chamado $pessoa com as seguintes chaves: nome,
idade, cidade.
b) Adicione uma nova chave chamada profissao ao array.
c) Crie um array indexado chamado $amigos com os nomes de três amigos.
d) Combine os arrays $pessoa e $amigos em um novo array chamado $dados.
e) Exiba o conteúdo do array $dados usando print_r. -->

<?php
    $pessoa = array("nome" => "kauan", "idade" => "17", "cidade" => "Rio Grande da Serra");

    $pessoa["profissao"] = "Estudando";

    $amigos = ["Bruno", "Daniel", "Bryan"];

    $dados = array_merge($pessoa, $amigos);
    print_r($dados);
?>