<!-- Exercício 3
Crie um array com 8 números inteiros. Use um laço de repetição para encontrar o
maior e o menor valor no array e exiba ambos. -->

<?php
    $numeros = [1, 4, 2, 10, 5, 3, 9, 7];
    sort($numeros);

    echo "O maior número é o " . $numeros[count($numeros) - 1];
    echo "<br>";
    echo "O menor número é o " . $numeros[0];
    
?>