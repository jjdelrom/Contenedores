<?php require("funcionesPHP.php"); ?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />  <!--   <meta charset="UTF-8" /> -->
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />  
        <meta name="keywords" content="Wellness" />
        <meta name="description" content="Wellness" />
        <title>Wellness Smart Cities</title>
        <link href="css/style.css" rel="stylesheet" type="text/css">
        <link rel="shortcut icon" href="img/logo.png">
        <script src="js/jquery.min.js"></script>
        <script src="js/funcionesJS.js"></script>       
    </head>
    <body>
        <?php
        $cont = file_get_contents("json/testContainers.json");
        $contenedores = json_decode($cont);

        $med = file_get_contents("json/testMeasures.json");
        $medidas = json_decode($med);
        ?>
        <script>
            var contenedores = <?php echo json_encode($contenedores); ?>;
            var medidas = <?php echo json_encode($medidas); ?>;
        </script>                         
        <div class="container">              
            <form id="formContenedores" name="formContenedores" method="post" action="ficheroExcel.php">    
                <div class="container"><br>
                    <div class="well show">
                        <h4 class="text-center">TRABAJO</h4>
                        <p>A partir de los datos de contenedores y medidas que se adjuntan en sendos ficheros JSON, obtener:<br>
                            1 - Un informe que muestre por cada contenedor seleccionado, el nivel de llenado de dicho contenedor a las 8:00, para cada día.<br>
                            2 - Además se mostrará la media mensual de llenado de dicho contenedor con los valores de la mañana de dichos contenedores.</p>
                        <h4 class="text-center">COMENTARIOS</h4>
                        <p> En el punto 1 entiendo que para cada elemento que seleccionemos (con un campo select por ejemplo) mostrará el nivel de llenado entre otro valores,
                            pero en el archivo json no existe ninguna medida a las 8:00 de la mañana con lo cual he echo otro desplegable con todas las horas en las que existen datos para que el usuario elija la hora</p>
                        <p> En el punto 2 para calcular la media entiendo como los valores de la mañana aquellos valores tomados a las <strong>10:00:04</strong> independientemente de la hora elegida.</p>
                    </div>                     
                    <br>
                    <div class="well show">
                        <h4 class="text-center">Seleccione un contenedor</h4>
                        <select id="contenedor" name="contenedor" class="form-control" required="" onchange="calculaMedia();" ><option  selected="" ></option>
                            <?php rellenaSelectContenedor($contenedores); ?>
                        </select><br>
                        <h4 id="texto"></h4>
                        <div id="media"></div><br>
                        <h4 class="text-center">Seleccione la hora</h4>
                        <select id="hora" name="hora" class="form-control" required="" ><option  selected="" ></option>
                            <?php rellenaSelectHora($medidas); ?>
                        </select>  
                    </div>
                    <div class="text-center" id="botonExcel">
                        <a href="#" class="btn btn-success btn-sm active botonExcel" role="button" ><img src="img/excel.png" class="botonExcel" /> EXPORTAR A EXCEL</a><br><br>
                        <br><br>
                    </div>               
                    <div class="panel panel-primary" style=" border-color: #003366;">
                        <div class="panel-heading">DATOS DE LOS CONTENEDORES A LA HORA ELEGIDA</div>
                        <table class="table table-bordered table-condensed" id="tablaContenedores">                                  
                            <thead>  
                                <tr>
                                    <th style="background-color: #FFEB99">MEDIDA</th>
                                    <th style="background-color: #FFEB99">% LLENADO </th>
                                    <th style="background-color: #FFEB99">TEMPERATURA</th>
                                    <th style="background-color: #FFEB99">BATERIA</th>
                                </tr>  
                            </thead>
                            <tbody></tbody>   
                        </table>         
                    </div> 
                </div>
            </form>

        </div>

        <form action="ficheroExcel.php" method="post" target="_blank" id="FormularioExportacion">
            <input type="hidden" id="datos_a_enviar" name="datos_a_enviar" />
            <input type="hidden" id="mediaHidden" name="mediaHidden" value="10" />
        </form>
    </body>
</html>