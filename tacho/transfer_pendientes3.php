<html>

<head>

        <title>Ejemplo sencillo de AJAX</title>

        <script src="../js/jquery-3.3.1.min.js" crossorigin="anonymous"></script>

        <script>
                function realizaProceso(valorCaja1, valorCaja2){
                        var parametros = {
                                "valorCaja1" : valorCaja1,
                                "valorCaja2" : valorCaja2
                        };
                        $.ajax({
                                data:  parametros,
                                url:   'ejemplo_ajax_proceso.php',
                                type:  'post',
                                beforeSend: function () {
                                        $("#resultado").html("Procesando, espere por favor...");
                                },
                                success:  function (response) {
                                        $("#resultado").html(response);
                                }
                        });
                }
        </script>

</head>

<body>

        Introduce valor 1

        <input type="text" name="caja_texto" id="valor1" value="0"/> 


        Introduce valor 2

        <input type="text" name="caja_texto" id="valor2" value="0"/>

        Realiza suma
<!--
        <input type="button" href="javascript:;" onclick="realizaProceso($('#valor1').val(), $('#valor2').val());return false;" value="Calcula"/>
-->
<a href="#" class="btn btn-warning btn-lg btn-block" onclick="realizaProceso($('#valor1').val(), $('#valor2').val());return false;">
        <b class="h6"><strong>Guias Pend:</strong>
        </b>
</a>

<br/>

Resultado: <span id="resultado">0</span>

        <script src="../bootstrap/js/bootstrap.js"></script>
</body>

</html>