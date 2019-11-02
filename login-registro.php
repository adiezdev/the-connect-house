<?php
require_once(__DIR__."/includes/header.php");
require_once(__DIR__."/includes/constantes.php");
$a = array(
    "widgets" => "widgets",
    "login" => "estilos-login" 
);
$objects = json_decode(json_encode($a), FALSE);
cabecera(TITULO_LOGIN,$objects,false);
?>

<body>
    <div class="contenedor-izquierdo">
        <div class="into-contenedor">

            <form action="" method="get">
                <?php echo '<div id="marca">'.file_get_contents("img/marca/banner.svg").'</div>'; ?>
                <label for="email">Correo electrónico</label><br>
                <input type="email" name="email" id="credential" placeholder="Correo electronico"><br>
                <label for="pass">Contraseña</label><br>
                <input type="password" name="pass" id="credential" placeholder="Contraseña"><br><br>
                <div id="acciones">
                    <input type="submit" value="Entrar" class="button">
                    <a>Resgistrarse</a>
                </div>
            </form>
        </div>
    </div>
    <div class="contenedor-derecho"></div>
</body>

</html>