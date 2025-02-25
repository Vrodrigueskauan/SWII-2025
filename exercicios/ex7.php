<?php
    $nomes = ["Kauan", "Sarah", "Heitor", "Apollo"];
    
    echo "Usando o foreach: <br>";

    foreach ($nomes as $nome) {
        echo $nome . "<br>";
    }

    $quant = count($nomes);
    echo $quant . "<br>";

    // echo "usando o for: <br>";
    // for ($i = 0; $i < 3; $i++){
    //     echo $nomes[$i]. "<br";
    // }

?>