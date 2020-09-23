<?php

require_once('php_bdConection.php');

$controleDiario1 = "SELECT * FROM controleDiario ORDER BY cod ASC";
$connn1 = $mysqli->query($controleDiario1);

while ($dadosDiario1 = $connn1->fetch_array()) {
    $umidadeDiario1 = $dadosDiario1['umidade'];
    $temperaturaDiario1 = $dadosDiario1['temperatura'];
    $umidadeArDiario1 = $dadosDiario1['umidadeAr'];
    $codDiario1 = $dadosDiario1['cod'];
}

$controleDiario = "controleDiario";
$dadosDiario = "dadosDiario";
$umidadeDiario = 'umidade';
$temperaturaDiario = 'temperatura';
$umidadeArDiario = 'umidadeAr';
$codDiario = $codDiario1;

for ($x = 1; $x < 30; $x++) {
    $codDiario--;
    ${$controleDiario . $x} = "SELECT * FROM controleDiario WHERE cod = {$codDiario}";
    $connn1 = $mysqli->query(${$controleDiario . $x});

    while (${$dadosDiario . $x} = $connn1->fetch_array()) {
        ${$umidadeDiario . $x} = ${$dadosDiario . $x}['umidade'];
        ${$temperaturaDiario . $x} = ${$dadosDiario . $x}['temperatura'];
        ${$umidadeArDiario . $x} = ${$dadosDiario . $x}['umidadeAr'];
        ${$codDiario . $x} = ${$dadosDiario . $x}['cod'];
    }
    /*echo (${$codDiario . $x});
    echo (" ");
    echo (${$umidadeDiario . $x});
    echo (" ");
    echo (${$temperaturaDiario . $x});
    echo (" ");
    echo (${$umidadeArDiario . $x});
    echo (" ");
    echo (" ");
    echo (" ");*/
}
?>