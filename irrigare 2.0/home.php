<?php
session_start();

if ($_SESSION['usuarioIdntf'] == false) {
    echo "<script>alert('Você deve efetuar login')</script>";
    echo "<script>window.location.href='index.php'</script>";
}

require_once('php_bdConection.php');

$email = $_SESSION['emailUsuario'];

$consulta =  "SELECT * FROM usuario where login = '{$email}'";
$con = $mysqli->query($consulta) or die($mysqli->error);


while ($dados = $con->fetch_array()) {

    $_SESSION['codUsuario'] = $dados['cod'];
    $_SESSION['nomeUsuario'] = $dados['nome'];
    $_SESSION['emailUsuario'] = $dados['login'];
    $_SESSION['senhaUsuario'] = $dados['senha'];
}

$codUsu = $_SESSION['codUsuario'];

$cultura = "SELECT * FROM cultura WHERE usuario = '{$codUsu}'";
$conn = $mysqli->query($cultura) or die($mysqli->error);

while ($dadosCult = $conn->fetch_array()) {
    $_SESSION['codCult'] = $dadosCult['cod'];
    $_SESSION['nomeCult'] = $dadosCult['nome'];
    $_SESSION['usuarioCult'] = $dadosCult['usuario'];
    $_SESSION['descricaoCult'] = $dadosCult['descricao'];
    $_SESSION['temp_idealCult'] = $dadosCult['temp_ideal'];
    $_SESSION['umi_idealCult'] = $dadosCult['umi_ideal'];
}

$codCult = $_SESSION['codCult'];


$controle = "SELECT * FROM controle WHERE codCult = '{$codCult}'";
$connn = $mysqli->query($controle) or die($mysqli->error);

while ($dadosCont = $connn->fetch_array()) {
    $_SESSION['codCont'] = $dadosCont['cod'];
    $_SESSION['umiCont'] = $dadosCont['umi_atual'];
    $_SESSION['dataCont'] = $dadosCont['data'];
    $_SESSION['tempCont'] = $dadosCont['temp_atual'];
    $_SESSION['horaCont'] = $dadosCont['hora'];
    $_SESSION['umiArCont'] = $dadosCont['umiAr_atual'];
}


?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/highcharts-more.js"></script>
    <script src="https://code.highcharts.com/modules/solid-gauge.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <link rel="stylesheet" type="text/css" href="CSS/graficos.css" />
    <link rel="stylesheet" type="text/css" href="CSS/home.css">

    <?php include("head.html"); ?>

</head>

<body>

    <?php include("navbar.html"); ?>


    <div class="container-fluid">
        <div class="col-sm-12">
            <h4 style="font-size: 20pt;">Olá <?php echo $_SESSION['nomeUsuario']; ?>! Confira aqui as informações de sua estufa:</h4>

            <br><br><br><br>

        </div>
    </div>



    <div class="container">
        <div class="col-sm-12 col-md-6" align="center" id="imgEstufa">
            <img src="CSS/imagens/estufa.png" alt="A imagem não pode ser carregada">

        </div>

        <div class="col-sm-12 col-md-6" align="center">
            <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">


                <tr>
                    <th style="text-align:center;" class="align-middle">Cultura em uso</th>
                </tr>
                <tr>
                    <td style="text-align:center;"><?php echo $_SESSION['nomeCult'] ?></td>
                </tr>

                <tr>
                    <th style="text-align:center;">Última irrigacao efetuada</th>
                </tr>
                <tr>
                    <td style="text-align:center;"> 10:34 - 11/11/11</td>
                </tr>

                <tr>
                    <th style="text-align:center;">Última ventilação efetuada</th>
                </tr>
                <tr>
                    <td style="text-align:center;"> 10:34 - 11/11/11</td>
                </tr>

                <tr>
                    <th style="text-align:center;">Último aquecimento realizado</th>
                </tr>
                <tr>
                    <td style="text-align:center;"> 10:34 - 11/11/11</td>
                </tr>

                <tr>
                    <th style="text-align:center;">Acão em execução</th>
                </tr>
                <tr>
                    <td style="text-align:center;"> Irrigação</td>
                </tr>

            </table>
        </div>
    </div>

    <div class="container-fluid">
        <div class="col-sm-12 col-md-4" align="center" style=" font-size: 20pt; margin-top: 20px;">
            <h3>Umidade do solo (%)<br></h3>
            <p class="textoGraficosGauge">O solo da sua estufa passa por constantes medições para que suas plantas sempre estejam seguras e bem
                umidecidas. Nosos sensores capacitivos são resistentes a corrosão e oferecem uma medição baseada na corrente eletrica do solo para
                entregar uma avaliação mais precisa.<br>Abaixo confira a porcentagem atual de umidade do seu solo:</p>


            <figure class="highcharts-figure">

                <div id="container-speed" class="chart-container"></div>


            </figure>
            <script>
                var gaugeOptions = {
                    chart: {
                        type: 'solidgauge'
                    },

                    title: null,

                    pane: {
                        center: ['50%', '85%'],
                        size: '140%',
                        startAngle: -90,
                        endAngle: 90,
                        background: {
                            backgroundColor: Highcharts.defaultOptions.legend.backgroundColor || '#EEE',
                            innerRadius: '60%',
                            outerRadius: '100%',
                            shape: 'arc'
                        }
                    },

                    exporting: {
                        enabled: false
                    },

                    tooltip: {
                        enabled: false
                    },

                    // the value axis
                    yAxis: {
                        stops: [
                            [0.1, '#55BF3B'], // green
                            [0.5, '#DDDF0D'], // yellow
                            [0.9, '#DF5353'] // red
                        ],
                        lineWidth: 0,
                        tickWidth: 0,
                        minorTickInterval: null,
                        tickAmount: 3,
                        title: {
                            y: -70
                        },
                        labels: {
                            y: 16
                        }
                    },

                    plotOptions: {
                        solidgauge: {
                            dataLabels: {
                                y: 5,
                                borderWidth: 0,
                                useHTML: true
                            }
                        }
                    }
                };
                var azul = <?php echo $_SESSION['umiCont']; ?>;

                // The speed gauge
                var graficoUmidade = Highcharts.chart('container-speed', Highcharts.merge(gaugeOptions, {
                    yAxis: {
                        min: 0,
                        max: 100,
                        title: {
                            text: 'Umidade do solo'
                        }
                    },

                    credits: {
                        enabled: false
                    },

                    series: [{
                        name: 'Umidade',
                        data: [azul],
                        dataLabels: {
                            format: '<div style="text-align:center">' +
                                '<span style="font-size:25px">{y}</span>' +
                                '<span style="font-size:25px;"> %</span>' +
                                '</div>'
                        },
                        tooltip: {
                            valueSuffix: '%'
                        }
                    }]

                }));
            </script>




            <h1><span id="valorUmidadeSolo"></span></h1>

        </div>

        <div class="col-sm-12 col-md-4" align="center" style="font-size: 20pt; margin-top: 20px;">
            <h3>Temperatura do ambiente (°C)</h3>
            <p class="textoGraficosGauge">A sua estufa contém sensores DHT11 para medir a temperatura do seu interior. Esses sensores permitem fazer medições
                de 0°C a 50°C, com uma minima margem de erro de 2°C.<br>Abaixo confira a temperatura atual da sua estufa:</p>

            <figure class="highcharts-figure">

                <div id="container-rpm" class="chart-container"></div>

            </figure>
            <script>
                var gaugeOptions = {
                    chart: {
                        type: 'solidgauge'
                    },

                    title: null,

                    pane: {
                        center: ['50%', '85%'],
                        size: '140%',
                        startAngle: -90,
                        endAngle: 90,
                        background: {
                            backgroundColor: Highcharts.defaultOptions.legend.backgroundColor || '#EEE',
                            innerRadius: '60%',
                            outerRadius: '100%',
                            shape: 'arc'
                        }
                    },

                    exporting: {
                        enabled: false
                    },

                    tooltip: {
                        enabled: false
                    },

                    // the value axis
                    yAxis: {
                        stops: [
                            [0.1, '#55BF3B'], // green
                            [0.5, '#DDDF0D'], // yellow
                            [0.9, '#DF5353'] // red
                        ],
                        lineWidth: 0,
                        tickWidth: 0,
                        minorTickInterval: null,
                        tickAmount: 3,
                        title: {
                            y: -70
                        },
                        labels: {
                            y: 16
                        }
                    },

                    plotOptions: {
                        solidgauge: {
                            dataLabels: {
                                y: 5,
                                borderWidth: 0,
                                useHTML: true
                            }
                        }
                    }
                };
                var dado = <?php echo $_SESSION['tempCont']; ?>;
                // The speed gauge
                var graficoUmidade = Highcharts.chart('container-rpm', Highcharts.merge(gaugeOptions, {
                    yAxis: {
                        min: 0,
                        max: 100,
                        title: {
                            text: 'Temperatura'
                        }
                    },

                    credits: {
                        enabled: false
                    },

                    series: [{
                        name: 'temperatura',
                        data: [dado],
                        dataLabels: {
                            format: '<div style="text-align:center">' +
                                '<span style="font-size:25px">{y}</span>' +
                                '<span style="font-size:25px;"> °C</span>' +
                                '</div>'
                        },
                        tooltip: {
                            valueSuffix: '%'
                        }
                    }]

                }));
            </script>


            <h1><span id="valorTemperaturaAr"></span></h1>
        </div>

        <div class="col-sm-12 col-md-4" align="center" style="font-size: 20pt; margin-top: 20px;">
            <h3>Umidade do ar (%)</h3>
            <p class="textoGraficosGauge">O mesmo sensor DHT11 que fornece as medições de temperatura da sua estufa também oferece a medição da
                umidade relativa do ar. O sensor pode determinar a umidade do ar da sua estufa entre 20% e 90%, com uma minima margem de erro de 5%.
                <br>Abaixo confira a porcentagem atual de umidade do ar ar de sua estufa:</p>

            <figure class="highcharts-figure">

                <div id="container-umiAr" class="chart-container"></div>

            </figure>
            <script>
                var gaugeOptions = {
                    chart: {
                        type: 'solidgauge'
                    },

                    title: null,

                    pane: {
                        center: ['50%', '85%'],
                        size: '140%',
                        startAngle: -90,
                        endAngle: 90,
                        background: {
                            backgroundColor: Highcharts.defaultOptions.legend.backgroundColor || '#EEE',
                            innerRadius: '60%',
                            outerRadius: '100%',
                            shape: 'arc'
                        }
                    },

                    exporting: {
                        enabled: false
                    },

                    tooltip: {
                        enabled: false
                    },

                    // the value axis
                    yAxis: {
                        stops: [
                            [0.1, '#55BF3B'], // green
                            [0.5, '#DDDF0D'], // yellow
                            [0.9, '#DF5353'] // red
                        ],
                        lineWidth: 0,
                        tickWidth: 0,
                        minorTickInterval: null,
                        tickAmount: 3,
                        title: {
                            y: -70
                        },
                        labels: {
                            y: 16
                        }
                    },

                    plotOptions: {
                        solidgauge: {
                            dataLabels: {
                                y: 5,
                                borderWidth: 0,
                                useHTML: true
                            }
                        }
                    }
                };
                var dado = <?php echo $_SESSION['umiArCont']; ?>;;
                // The speed gauge
                var graficoUmidade = Highcharts.chart('container-umiAr', Highcharts.merge(gaugeOptions, {
                    yAxis: {
                        min: 0,
                        max: 100,
                        title: {
                            text: 'Umidade do ar'
                        }
                    },

                    credits: {
                        enabled: false
                    },

                    series: [{
                        name: 'UmidadeAr',
                        data: [dado],
                        dataLabels: {
                            format: '<div style="text-align:center">' +
                                '<span style="font-size:25px">{y}</span>' +
                                '<span style="font-size:25px;"> %</span>' +
                                '</div>'
                        },
                        tooltip: {
                            valueSuffix: '%'
                        }
                    }]

                }));
            </script>


            <h1><span id="valorUmidadeAr"></span></h1>
        </div>

    </div>

    <div class="container-fluid">
        <div class="col-sm-12" align="center">
            <p id="textoBotaoGraf">Clicando no botão abaixo você terá acesso a um grafico que contem os dados de umidade do solo,<br> temperatura e umidade relativa do ar
                de sua estufa nos ultimos 15 dias, podendo fazer download do mesmo se assim preferir:</p>
            <span class="botaoGraf">Dados dos ultimos 15 dias</span>
            <div class='graficoUmi'>

                <!-- Grafico de linha -->

                <figure class="highcharts-figure">
                    <div id="container"></div>
                </figure>

                <script>
                    Highcharts.chart('container', {
                        chart: {
                            type: 'line'
                        },
                        title: {
                            text: 'Umidade e temperatura nos ultimos 30 dias'
                        },
                        xAxis: {
                            categories: ['7', '6', '5', '4', '3', '2', '1', 'hoje']
                        },
                        yAxis: {
                            title: {
                                text: 'Indice (%)/(°C)'
                            }
                        },
                        plotOptions: {
                            line: {
                                dataLabels: {
                                    enabled: true
                                },
                                enableMouseTracking: false
                            }
                        },
                        series: [{
                            name: 'Umidade solo (%)',
                            data: [7.0, 6.9, 9.5, 14.5, 18.4, 21.5, 80.2, 26.5]
                        }, {
                            name: 'Temperatura (°C)',
                            data: [3.9, 4.2, 5.7, 8.5, 11.9, 15.2, 17.0, 16.6]
                        }, {
                            name: 'Umidade ar (%)',
                            data: [4.9, 9.2, 2.7, 11.5, 22.9, 10.2, 13.0, 14.6]
                        }]
                    });
                </script>



            </div>
        </div>
    </div>
    <div>
        <br><br><br><br><br>
    </div>

    <footer>
        <?php include("footer.html"); ?>
    </footer>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


    <!--------------//--------------//--------------//------- Scripts JavaScript do Firebase -------//---------------//---------------//--------------

    <script src="https://www.gstatic.com/firebasejs/7.12.0/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/7.12.0/firebase-database.js"></script>
    <script src="firebase.js"></script>-->

    <script src="botoesGraficos.js"></script>
</body>

</html>