<!-- Exercício 2
Crie um array com 10 números inteiros. Use um laço de repetição para calcular a
soma de todos os elementos do array e exiba o resultado. -->

<?php
    function soma($n) {
        $soma = 0;

        foreach ($n as $numero) {
            $soma += $numero;
        }

        return $soma;
    }

    $num = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];

    echo "A soma dos 10 números é " . soma($num);

?>