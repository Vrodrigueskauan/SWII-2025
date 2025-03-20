<!-- Exercício 4
Crie um array com 15 números inteiros. Use um laço de repetição para contar
quantos números são pares e quantos são ímpares. Exiba os resultados. -->

<?php
    $n = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15];

    $quantidapar = 0;
    $quantidaimpar = 0;

    for($i = $n[0]; $i < 16; $i ++){
        if($i % 2 == 0){
            $quantidapar += 1;
        }
        else {
            $quantidaimpar += 1;
        }
    }

    echo "A quantidade de números pares é de " . $quantidapar;
    echo "<br>";
    echo "A quantidade de números impares é de " . $quantidaimpar;

?>