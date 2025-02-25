<?php

$nota1 = 8;
$nota2 = 7;
$nota3 = 9;

echo "Bem Vindo a calculadora de média!";
echo "<br>";
echo "<br>";
echo "Nota 1: " . $nota1 . "<br>";
echo "<br>";
echo "Nota 2: " . $nota2 . "<br>";
echo "<br>";
echo "Nota 3: " . $nota3 . "<br>";
echo "<br>";
echo "<br>";

$media = ($nota1 + $nota2 + $nota3) / 3;

if ($media > 6){
    echo "Média - " . $media . " - Aprovado!";
}
else{
    echo "Média - " . $media . " - Reprovado!";
}
?>