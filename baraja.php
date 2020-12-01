<!Doctype html>
<html lang="es-ES">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="author" content="Samuel Cies Gracia">
    <link rel="stylesheet" href="./css/style.css" type="text/css">
    <title>Juego de Cartas</title>
</head>
<body>

<h1>BENVENIDO AL JUEGO DE CARTAS </h1>
<section>
    <!-- Lateral bar with buttons to select charts -->
    <aside>
        <h3>Seleccione el nº de cartas y el nº de cartas por fila</h3>
        <?php
        require ("./comun.php");

        if(isset($_POST['nc'])){} else {
            $_POST['cf'] = "0";
            $_POST['nc'] = "0";
        }
        $cf = $_POST["cf"];
        $nc = $_POST["nc"];
        printf("<form action='%s' method='POST'>", $_SERVER["PHP_SELF"]);
        ?>
        <fieldset>
            <label for="nc">Nº de cartas</label>
            <select name="nc" id="nc">
                <?php
                for($i = 1; $i <= 12 ; $i++){
                    printf("<option value='%d'", $i); if($i == $nc) printf("selected");
                    printf("> %s </option>",$i);
                }
                ?>
            </select>
        </fieldset>
        <br>
        <fieldset>
            <label for="cf">Nº de cartas por fila</label>
            <select name="cf" id="cf">
                <?php
                for($i = 1; $i <= 10 ; $i++){
                    printf("<option value='%d'", $i); if($i == $cf) printf("selected");
                    printf("> %s </option>",$i);
                }
                ?>
            </select>
        </fieldset>
        <br>
        <input type="submit" name='Enviar' value='Extraer cartas'>

        </form>
        <br>

        <?php

        if ( empty($_POST['Enviar']) ){

            printf("");

        }else {
            reparteCartas($cf, $nc);

        }


        function reparteCartas($cf, $nc){
            global $cartas;
            global $controlCartas;

            if ($cf > $nc) {
                printf("<h2>El nº de cartas por fila debe ser menor o igual que el nº de cartas elegido. </h2>");
            } else {

                printf("<table>");

                $contador = 0;
                $contador2 = 0;


                do {
                    printf("<tr>");
                    for ($i = 0; $i < $cf; $i++) {

                        $aleat1 = rand(0, 9);
                        $aleat2 = rand(1, 4);
                        $control = $aleat1 . $aleat2;

                        if (in_array($control, $controlCartas)) {

                            do{
                                $aleat1 = rand(0, 9);
                                $aleat2 = rand(1, 4);
                                $control = $aleat1 . $aleat2;
                            }while(in_array($control, $controlCartas));

                            if ($contador2 >= $nc) {
                                printf("");
                            } else {

                                $nombreFichero = imagenDeCarta($aleat1, $aleat2);
                                $nombreCarta = cartaConLetra($aleat1, $aleat2);
                                $contador2++;

                                printf("<td>");
                                printf("<img src='$nombreFichero'>");
                                printf("<br>");
                                printf("<p>$nombreCarta</p>");
                                printf("</td>");

                                array_push($controlCartas, $control);
                            }

                        } else {
                            if ($contador2 >= $nc) {
                                printf("");
                            } else {

                                $nombreFichero = imagenDeCarta($aleat1, $aleat2);
                                $nombreCarta = cartaConLetra($aleat1, $aleat2);
                                $contador2++;

                                printf("<td>");
                                printf("<img src='$nombreFichero'>");
                                printf("<br>");
                                printf("<p>$nombreCarta</p>");
                                printf("</td>");

                                array_push($controlCartas, $control);
                            }
                        }
                    }
                        printf("</tr>");
                        $contador++;

                }while (ceil($nc / $cf) != $contador) ;

                    printf("</table");
                }
        }

        function imagenDeCarta($aleat1, $aleat2){
            $nombreFichero = "./images/carta$aleat2$aleat1.png";

            return $nombreFichero;
        }

        function cartaConLetra($aleat1, $aleat2){
            global $cartas;
            $nombreCarta = $cartas[0][$aleat1] ." de " . $cartas[1][$aleat2];

            return $nombreCarta;
        }

        ?>

    </aside>
</section>
</body>
</html>