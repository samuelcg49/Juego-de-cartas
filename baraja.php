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
            <h3>Seleccione el nº de cartas y el nº de filas</h3>
<?php
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
            <input type="submit" name='Enviar' value='Enviar'>

         </form>
            <table>
                <?php
                var_dump($nc, $cf);
                if ( empty($_POST['Enviar']) ){

                   printf("");

                }else {
                    if ($cf > $nc) {
                        printf("<h2>El nº de cartas por fila debe ser menor o igual que el nº de cartas elegido</h2>");
                    } else {
                        $cf = $_POST["cf"];
                        $nc = $_POST["nc"];

                        $contador = 0;
                        $contador2 = 0;

                        do{
                            printf("<tr>");
                                        for($i = 0; $i < $cf ; $i++){
                                            if($contador2 >= $nc){
                                                printf("");
                                            }else {
                                                $contador2++;
                                                printf("<td>Carta %s</td>", $contador2);
                                            }
                                        }
                            printf("</tr>", $contador+1);
                            $contador++;

                        }while(round($nc / $cf)+1 != $contador);
                    }
                }
                ?>
            </table>
        </aside>
    </section>
</body>
</html>