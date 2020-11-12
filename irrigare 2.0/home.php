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

//var_dump($_SESSION['temp_idealCult']);
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
            <li data-target="#demo" data-slide-to="3"></li>
        </ul>

        <div class="carousel-inner">

            <div class="carousel-item active">
                <img src="CSS/imagens/estufa1.jpg" width="1100" height="500">
                <div class="carousel-caption">
                    <h1 style="color:rgb(230,255,235) ;text-shadow: #000 1px -1px, #000 -1px 1px, #000 1px 1px, #000 -1px -1px;">Bem vindo <?php echo  $_SESSION['nomeUsuario']?> !</h1>
                    <h4 style="color:rgb(230,255,235) ;text-shadow: #000 1px -1px, #000 -1px 1px, #000 1px 1px, #000 -1px -1px;">Confira as informações de sua plantação de <?php echo $_SESSION['nomeCult']?>!</h4>
                </div>
            </div>

            <div class="carousel-item">
                <img src="CSS/imagens/folhaDesfocada.jpg" width="1100" height="500">
                <div class="carousel-caption">
                    <h2 style="color:rgb(230,255,235) ;text-shadow: #000 1px -1px, #000 -1px 1px, #000 1px 1px, #000 -1px -1px;">Umidade do solo <?php echo $_SESSION['umiCont']?>%</h2>
                    <h4 style="color:rgb(230,255,235) ;text-shadow: #000 1px -1px, #000 -1px 1px, #000 1px 1px, #000 -1px -1px;">Utilizamos sensores capacitivos para realizar um calculo preciso do  nível de umidades do solo de sua estufa,<br> além de o regularmos conforme for melhor para suas hotaliças!</h4>
                </div>
            </div>

            <div class="carousel-item">
                <img src="CSS/imagens/frieza.jpg" width="1100" height="500">
                <div class="carousel-caption">
                    <h2  style="color:rgb(230,235,255) ;text-shadow: #000 1px -1px, #000 -1px 1px, #000 1px 1px, #000 -1px -1px;">Temperatura ambiente <?php echo $_SESSION['tempCont']?>°C</h2>
                    <h4  style="color:rgb(230,235,255) ;text-shadow: #000 1px -1px, #000 -1px 1px, #000 1px 1px, #000 -1px -1px;">Sua estufa possui um ótimo controle termico, obtido por meio de nossos sensores DHT11, apartir dos dados por <br>ele captados  podemos alterar a temperatura de sua estufa para favorecer suas plantas!</h4>
                </div>
            </div>

            <div class="carousel-item">
                <img src="CSS/imagens/chuva.jpg" width="1100" height="500">
                <div class="carousel-caption">
                    <h2 style="color:rgb(230,235,255) ;text-shadow: #000 1px -1px, #000 -1px 1px, #000 1px 1px, #000 -1px -1px;">Umidade do ar <?php echo $_SESSION['umiArCont']?>%</h2>
                    <h4 style="color:rgb(230,235,255) ;text-shadow: #000 1px -1px, #000 -1px 1px, #000 1px 1px, #000 -1px -1px;">Com o uso do nosso sensor DHT11 também é possivel obter a umidade relativa  do ar de sua estufa, com uma pequena margem de erro de 5%!</h4>
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
    <!--    <div class="container">
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
    </div>-->
    <div class="container-fluid">
        <div class="col-sm-12 col-md-4" align="center" style=" font-size: 20pt; margin-top: 20px; border-right:solid 1px rgba(50,100,50,0.6);">
            <h2>Umidade do solo (%)</h2>

            <figure class="highcharts-figure">

                <div id="container-speed" class="chart-container"></div>


            </figure>
            <script>
                var azul = <?php echo $_SESSION['umiCont']; ?>;
                var corUmi = <?php echo($_SESSION['umi_idealCult']) ?>;
                corUmi = corUmi/100;
                var amarelo1 = corUmi - 0.01;
                var amarelo2 = corUmi + 0.1;
                var red1 = corUmi - 0.25;
                var red2 = corUmi + 0.25;

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
                            [red1, '#DF5353'], //red
                            [amarelo1, '#DDDF0D'], // yellow                            
                            [corUmi, '#55BF3B'], // green
                            [amarelo2, '#DDDF0D'], // yellow
                            [red2, '#DF5353'] // red
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

        <div class="col-sm-12 col-md-4" align="center" style="font-size: 20pt; margin-top: 20px; border-right:solid 1px rgba(50,100,50,0.6);">
            <h2>Temperatura do ambiente (°C)</h2>

            <figure class="highcharts-figure">

                <div id="container-rpm" class="chart-container"></div>

            </figure>
            <script>
                var dado = <?php echo $_SESSION['tempCont']; ?>;
                var corTemp = <?php echo($_SESSION['temp_idealCult']) ?>;
                corTemp = corTemp/100;
                var amarelo3 = corTemp - 0.05;
                var amarelo4 = corTemp + 0.05;
                var red3 = corTemp - 0.1;
                var red4 = corTemp + 0.1;

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
                            [red3, '#DF5353'], // red
                            [amarelo3, '#DDDF0D'], // yellow
                            [corTemp, '#55BF3B'], // green
                            [amarelo4, '#DDDF0D'], // yellow
                            [red2, '#DF5353'] // red
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
            <h2>Umidade do ar (%)</h2>

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
                            [0.1, ''], // green
                            //[0.5, '#DDDF0D'], // yellow
                           // [0.9, '#DF5353'] // red
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
        <div class="col-sm-12" align="center" style="margin-top: 20px; font-size:11,5pt;">
            <p id="textoBotaoGraf">Confira abaixo os dados de umidade do solo, temperatura e umidade relativa do ar
                da estufa nos ultimos 15 dias,<br> podendo fazer download se assim preferir:</p>

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


    <script src="botoesGraficos.js"></script>
</body>

</html>