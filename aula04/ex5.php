<!-- Exercício 5
Crie um array associativo onde cada chave é o nome de um aluno e o valor é a sua
nota.Use um laço de repetição para calcular a média das notas e exiba o resultado. 
Dicas para Resolução:
• Use for ou foreach para percorrer os arrays.
• Utilize funções como count() para determinar o tamanho do array.
• Para arrays associativos, lembre-se de acessar as chaves e valores corretamente-->

<?php
    $boletim = array("Kauan" => "7", "sarinha" => "10", "heitor" => "9", "Anderson" => "7");

    $soma = 0;

    foreach ($boletim as $key => $value) {
        $soma += $value;
    }

    $media = $soma / count($boletim);

    echo "A média é " . $media;
?>