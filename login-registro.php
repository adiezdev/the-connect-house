<?php
require_once(__DIR__."/includes/header.php");
require_once(__DIR__."/includes/constantes.php");
//
$a = array(
    "widgets" => ESTILOS_WIDGETS,
    "login" => ESTILOS_LOGIN
);
//
$objects = json_decode(json_encode($a), FALSE);
//
cabecera(TITULO_LOGIN,$objects,false);
?>

    <body>
        <div class="contenedor-izquierdo">
            <div class="into-contenedor">
                <?php echo '<div id="marca">'.file_get_contents("img/marca/banner.svg").'</div>'; ?>
                <!--Login-->
                <form  method="post" id="login">
                    <label for="email">Correo electrónico</label><br>
                    <input type="email" id="email" name="email" class="credential" placeholder="Correo electronico"><br>
                    <label for="pass">Contraseña</label><br>
                    <input type="password" id="pass" name="pass" class="credential" placeholder="Contraseña"><br><br>
                    <div id="acciones">
                        <input type="button" id="bnLogin" value="Entrar" class="button">
                        <span id="registrarse">Resgistrarse</span>
                    </div>
                </form>
                <!--Registro-->
                <form action="" method="post" id="registro">
                    <label for="nombre">Nombre <span class="spanred">*</span></label><br>
                    <input type="text" name="nombre" id="nombre" class="credential" placeholder="Nombre"><br>
                    <label for="apellidos">Apellidos <span class="spanred">*</span></label>
                    <input type="text" name="apellidos" id="apellidos" class="credential" placeholder="Apellidos"><br>
                    <label for="email">Correo electrónico <span class="spanred">*</span></label><br>
                    <input type="email" name="email" id="email" class="credential" placeholder="Correo electronico"><br>
                    <label for="sexo">Sexo <span class="spanred">*</span></label>
                    <select name="sexo" id="selector">
                            <option value="null">Seleccionar <span class="spanred">*</span></option>
                            <option value="m">Mujer</option>
                            <option value="h">Hombre</option>
                    </select>
                    <label for="pass">Contraseña  <span class="spanred">*</span></label><br>
                    <input type="password" name="password" id="password" class="credential" placeholder="Contraseña"><br>
                    <label for="pass">Repetir contraseña <span class="spanred">*</span></label><br>
                    <input type="password" name="password2" id="password2" class="credential" placeholder="Contraseña"><br><br>
                    <div id="acciones">
                        <span id="atras">Atrás</span>
                        <input type="button" id="bnRegistro" value="Registrarse" class="button">
                    </div>
                </form>
            </div>
        </div>
        <div class="contenedor-centro">
            <img src="img/img-modelo.jpg" alt="Habitacion" srcset="">
        </div>
        <script src="js/validaciones/login-registro.js"></script>
    </body>
    <script>
    </html>