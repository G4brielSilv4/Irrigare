<?php
session_start();

if ($_SESSION['usuarioIdntf'] == false) {
    echo "<script>alert('Você deve efetuar login')</script>";
    echo "<script>window.location.href='index.php'</script>";
}

require_once('php_bdConection.php');

//Resgatando valores do banco de dados

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
    $_SESSION['tempCont'] = $dadosCont['temp_atual'];
    $_SESSION['tempoCont'] = $dadosCont['tempo'];
    $_SESSION['umiArCont'] = $dadosCont['umiAr_atual'];
}


//Destruindo os placeholders da tabela de cadatro

unset($_SESSION['placeName']);
unset($_SESSION['placeDesc']);
unset($_SESSION['placeTemp']);
unset($_SESSION['placeUmi']);

include('controleDiario30.php');
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
    



    <div id="demo" class="carousel slide" data-ride="carousel">
        <ul class="carousel-indicators">
            <li data-target="#demo" data-slide-to="0" class="active"></li>
            <li data-target="#demo" data-slide-to="1"></li>
            <li data-target="#demo" data-slide-to="2"></li>
        </ul>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="CSS/imagens/brancojumbo.jpg" alt="Los Angeles" width="1100" height="500">
                <div class="carousel-caption">
                    <h3>Los Angeles</h3>
                    <p>We had such a great time in LA!</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="CSS/imagens/GERALDO.png" alt="Chicago" width="1100" height="500">
                <div class="carousel-caption">
                    <h3>Chicago</h3>
                    <p>Thank you, Chicago!</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="CSS/imagens/GERALDO.png" alt="New York" width="1100" height="500">
                <div class="carousel-caption">
                    <h3>New York</h3>
                    <p>We love the Big Apple!</p>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#demo" data-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </a>
        <a class="carousel-control-next" href="#demo" data-slide="next">
            <span class="carousel-control-next-icon"></span>
        </a>
    </div>



    <br><br><br>
    <!--<br><br><br>

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
                    <th style="text-align:center;">Última consulta</th>
                </tr>
                <tr>
                    <td style="text-align:center;"> <?php echo $_SESSION['tempoCont'] ?></td>
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
-->
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
                            text: ''
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
            <p class="textoGraficosGauge" style="margin-bottom: 68px;">A estufa contém sensores DHT11 para medir a temperatura do seu interior. Esses sensores permitem fazer medições
                de 0°C a 50°C, com uma mínima margem de erro de 2°C.<br>Abaixo confira a temperatura atual da estufa:</p>

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
                            text: ''
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
            <p class="textoGraficosGauge">O mesmo sensor DHT11 que fornece as medições de temperatura também oferece a medição da
                umidade relativa do ar. O sensor pode determinar a umidade do ar da estufa entre 20% e 90%, com uma mínima margem de erro de 5%.
                <br>Abaixo confira a porcentagem atual de umidade do ar ar da estufa:</p>

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
                            text: ''
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
            <p id="textoBotaoGraf">Clicando no botão abaixo você terá acesso a um gráfico que contém os dados de umidade do solo,<br> temperatura e umidade relativa do ar
                da estufa nos ultimos 15 dias, podendo fazer download se assim preferir:</p>

            <!-- Grafico de linha -->
            <!--
            <span class="botaoGraf">Dados dos ultimos 7 dias</span>
            <div class='grafico7dias'>
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
                            categories: ['7', '6', '5', '4', '3', '2', '1']
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
                            data: [<?php echo ($umidade6); ?>, <?php echo ($umidade5); ?>, <?php echo ($umidade4); ?>, <?php echo ($umidade3); ?>, <?php echo ($umidade2); ?>, <?php echo ($umidade1); ?>, <?php echo ($umidadeDiario1); ?>]
                        }, {
                            name: 'Temperatura (°C)',
                            data: [<?php echo ($temperatura6); ?>, <?php echo ($temperatura5); ?>, <?php echo ($temperatura4); ?>, <?php echo ($temperatura3); ?>, <?php echo ($temperatura2); ?>, <?php echo ($temperatura1); ?>, <?php echo ($temperaturaDiario1); ?>]
                        }, {
                            name: 'Umidade ar (%)',
                            data: [<?php echo ($umidadeAr6); ?>, <?php echo ($umidadeAr5); ?>, <?php echo ($umidadeAr4); ?>, <?php echo ($umidadeAr3); ?>, <?php echo ($umidadeAr2); ?>, <?php echo ($umidadeAr1); ?>, <?php echo ($umidadeArDiario1); ?>]
                        }]
                    });
                </script>
            </div>
         -->
            <span class="botaoGrafi">Dados dos ultimos 15 dias</span>
            <div class='graficoUmid'>

                <figure class="highcharts-figure">
                    <div id="container"></div>
                </figure>

                <script>
                    Highcharts.chart('container', {
                        chart: {
                            type: 'line'
                        },
                        title: {
                            text: 'Umidade e temperatura nos ultimos 15 dias'
                        },
                        xAxis: {
                            categories: ['15', '14', '13', '12', '11', '10', '9', '8', '7', '6', '5', '4', '3', '2', '1']
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
                            data: [<?php echo ($umidade14); ?>, <?php echo ($umidade13); ?>, <?php echo ($umidade12); ?>, <?php echo ($umidade11); ?>, <?php echo ($umidade10); ?>, <?php echo ($umidade9); ?>, <?php echo ($umidade8); ?>, <?php echo ($umidade7); ?>, <?php echo ($umidade6); ?>, <?php echo ($umidade5); ?>, <?php echo ($umidade4); ?>, <?php echo ($umidade3); ?>, <?php echo ($umidade2); ?>, <?php echo ($umidade1); ?>, <?php echo ($umidadeDiario1); ?>]
                        }, {
                            name: 'Temperatura (°C)',
                            data: [<?php echo ($temperatura14); ?>, <?php echo ($temperatura13); ?>, <?php echo ($temperatura12); ?>, <?php echo ($temperatura11); ?>, <?php echo ($temperatura10); ?>, <?php echo ($temperatura9); ?>, <?php echo ($temperatura8); ?>, <?php echo ($temperatura7); ?>, <?php echo ($temperatura6); ?>, <?php echo ($temperatura5); ?>, <?php echo ($temperatura4); ?>, <?php echo ($temperatura3); ?>, <?php echo ($temperatura2); ?>, <?php echo ($temperatura1); ?>, <?php echo ($temperaturaDiario1); ?>]
                        }, {
                            name: 'Umidade ar (%)',
                            data: [<?php echo ($umidadeAr14); ?>, <?php echo ($umidadeAr13); ?>, <?php echo ($umidadeAr12); ?>, <?php echo ($umidadeAr11); ?>, <?php echo ($umidadeAr10); ?>, <?php echo ($umidadeAr9); ?>, <?php echo ($umidadeAr8); ?>, <?php echo ($umidadeAr7); ?>, <?php echo ($umidadeAr6); ?>, <?php echo ($umidadeAr5); ?>, <?php echo ($umidadeAr4); ?>, <?php echo ($umidadeAr3); ?>, <?php echo ($umidadeAr2); ?>, <?php echo ($umidadeAr1); ?>, <?php echo ($umidadeArDiario1); ?>]
                        }]
                    });
                </script>

            </div>

            <!--
            <span class="botaoGraf30">Dados dos ultimos 30 dias</span>
            <div class='graficoUmi30'>

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
                            categories: ['30', '29', '28', '27', '26', '25', '24', '23', '22', '21', '20', '19', '18', '17','16', '15', '14', '13', '12', '11', '10', '9', '8', '7','6', '5', '4', '3', '2', '1']
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
                            data: [<?php echo ($umidade29); ?>, <?php echo ($umidade28); ?>, <?php echo ($umidade27); ?>, <?php echo ($umidade26); ?>, <?php echo ($umidade25); ?>, <?php echo ($umidade24); ?>, <?php echo ($umidade23); ?>, <?php echo ($umidade22); ?>, <?php echo ($umidade21); ?>, <?php echo ($umidade20); ?>, <?php echo ($umidade19); ?>, <?php echo ($umidade18); ?>, <?php echo ($umidade17); ?>, <?php echo ($umidade16); ?>, <?php echo ($umidade15); ?>, <?php echo ($umidade14); ?>, <?php echo ($umidade13); ?>, <?php echo ($umidade12); ?>, <?php echo ($umidade11); ?>, <?php echo ($umidade10); ?>, <?php echo ($umidade9); ?>, <?php echo ($umidade8); ?>, <?php echo ($umidade7); ?>, <?php echo ($umidade6); ?>, <?php echo ($umidade5); ?>, <?php echo ($umidade4); ?>, <?php echo ($umidade3); ?>, <?php echo ($umidade2); ?>, <?php echo ($umidade1); ?>, <?php echo ($umidadeDiario1); ?>]
                        }, {
                            name: 'Temperatura (°C)',
                            data: [<?php echo ($temperatura29); ?>, <?php echo ($temperatura28); ?>, <?php echo ($temperatura27); ?>, <?php echo ($temperatura26); ?>, <?php echo ($temperatura25); ?>, <?php echo ($temperatura24); ?>, <?php echo ($temperatura23); ?>, <?php echo ($temperatura22); ?>, <?php echo ($temperatura21); ?>, <?php echo ($temperatura20); ?>, <?php echo ($temperatura19); ?>, <?php echo ($temperatura18); ?>, <?php echo ($temperatura17); ?>, <?php echo ($temperatura16); ?>, <?php echo ($temperatura15); ?>, <?php echo ($temperatura14); ?>, <?php echo ($temperatura13); ?>, <?php echo ($temperatura12); ?>, <?php echo ($temperatura11); ?>, <?php echo ($temperatura10); ?>, <?php echo ($temperatura9); ?>, <?php echo ($temperatura8); ?>, <?php echo ($temperatura7); ?>, <?php echo ($temperatura6); ?>, <?php echo ($temperatura5); ?>, <?php echo ($temperatura4); ?>, <?php echo ($temperatura3); ?>, <?php echo ($temperatura2); ?>, <?php echo ($temperatura1); ?>, <?php echo ($temperaturaDiario1); ?>]
                        }, {
                            name: 'Umidade ar (%)',
                            data: [<?php echo ($umidadeAr29); ?>, <?php echo ($umidadeAr28); ?>, <?php echo ($umidadeAr27); ?>, <?php echo ($umidadeAr26); ?>, <?php echo ($umidadeAr25); ?>, <?php echo ($umidadeAr24); ?>, <?php echo ($umidadeAr23); ?>, <?php echo ($umidadeAr22); ?>, <?php echo ($umidadeAr21); ?>, <?php echo ($umidadeAr20); ?>, <?php echo ($umidadeAr19); ?>, <?php echo ($umidadeAr18); ?>, <?php echo ($umidadeAr17); ?>, <?php echo ($umidadeAr16); ?>, <?php echo ($umidadeAr15); ?>, <?php echo ($umidadeAr14); ?>, <?php echo ($umidadeAr13); ?>, <?php echo ($umidadeAr12); ?>, <?php echo ($umidadeAr11); ?>, <?php echo ($umidadeAr10); ?>, <?php echo ($umidadeAr9); ?>, <?php echo ($umidadeAr8); ?>, <?php echo ($umidadeAr7); ?>, <?php echo ($umidadeAr6); ?>, <?php echo ($umidadeAr5); ?>, <?php echo ($umidadeAr4); ?>, <?php echo ($umidadeAr3); ?>, <?php echo ($umidadeAr2); ?>, <?php echo ($umidadeAr1); ?>, <?php echo ($umidadeArDiario1); ?>]
                        }]
                    });
                </script>

            </div>
                -->
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