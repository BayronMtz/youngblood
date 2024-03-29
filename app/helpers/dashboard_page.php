<?php
/*
*	Clase para definir las plantillas de las páginas web del sitio privado.
*/
class Dashboard_Page
{
    /*
    *   Método para imprimir la plantilla del encabezado.
    *
    *   Parámetros: $title (título de la página web y del contenido principal).
    *
    *   Retorno: ninguno.
    */
    public static function headerTemplate($title)
    {
        // Se crea una sesión o se reanuda la actual para poder utilizar variables de sesión en las páginas web.
        session_start();
        // Se imprime el código HTML de la cabecera del documento.
        print('
            <!DOCTYPE html>
            <html lang="es">
                <head>
                    <meta charset="utf-8">
                    <title>Dashboard - ' . $title . '</title>
                    <link type="image/png" rel="icon" href="../../resources/img/logo.png"/>
                    <link type="text/css" rel="stylesheet" href="../../resources/css/materialize.min.css"/>
                    <link type="text/css" rel="stylesheet" href="../../resources/css/material_icons.css"/>
                    <link type="text/css" rel="stylesheet" href="../../resources/css/dashboard.css"/>
                    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
                </head>
                <body>
        ');
        // Se obtiene el nombre del archivo de la página web actual.
        $filename = basename($_SERVER['PHP_SELF']);
        // Se comprueba si existe una sesión de administrador para mostrar el menú de opciones, de lo contrario se muestra un menú vacío.
        if (isset($_SESSION['id_usuario'])) {
            // Se verifica si la página web actual es diferente a index.php (Iniciar sesión) y a register.php (Crear primer usuario) para no iniciar sesión otra vez, de lo contrario se direcciona a main.php
            if ($filename != 'index.php' && $filename != 'register.php' && $filename != 'cambiar_contra.php') {
                // Se llama al método que contiene el código de las cajas de dialogo (modals).
                self::modals();
                // Se imprime el código HTML para el encabezado del documento con el menú de opciones.
                print('
                    <header>
                        <div class="navbar-fixed">
                            <nav class="indigo darken-4">
                                <div class="nav-wrapper">
                                    <a href="main.php" class="brand-logo"><img src="../../resources/img/logo.png" height="60"></a>
                                    <a href="#" data-target="mobile" class="sidenav-trigger"><i class="material-icons">menu</i></a>
                                    <ul class="right hide-on-med-and-down">
                                        <li><a href="productos.php"><i class="material-icons left">shop</i>Productos</a></li>
                                        <li><a href="categorias.php"><i class="material-icons left">shop_two</i>Categorías</a></li>
                                        <li><a href="pedidos.php"><i class="material-icons left">local_shipping</i>Pedidos</a></li>
                                        <li><a href="clientes.php"><i class="material-icons left">contacts</i>Clientes</a></li>
                                        <li><a href="valoraciones.php"><i class="material-icons left">star</i>Valoraciones</a></li>
                                        <li><a href="usuarios.php"><i class="material-icons left">group</i>Usuarios</a></li>
                                        <li><a href="#" class="dropdown-trigger" data-target="dropdown"><i class="material-icons left">verified_user</i>Cuenta: <b>' . $_SESSION['alias_usuario'] . '</b></a></li>
                                    </ul>
                                    <ul id="dropdown" class="dropdown-content">
                                        <li><a href="#" onclick="openProfileDialog()"><i class="material-icons">face</i>Editar perfil</a></li>
                                        <li><a href="#" onclick="openPasswordDialog()"><i class="material-icons">lock</i>Cambiar clave</a></li>
                                        <li><a href="#" onclick="openDevicesDialog()"><i class="material-icons">devices</i>Dispositivos</a></li>
                                        <li><a href="#" onclick="openSecurityDialog()"><i class="material-icons">security</i>Seguridad</a></li>
                                        <li><a href="#" onclick="logOut()"><i class="material-icons">clear</i>Salir</a></li>
                                    </ul>
                                </div>
                            </nav>
                        </div>
                        <ul class="sidenav" id="mobile">
                            <li><a href="productos.php"><i class="material-icons left">shop</i>Productos</a></li>
                            <li><a href="categorias.php"><i class="material-icons left">shop_two</i>Categorías</a></li>
                            <li><a href="pedidos.php"><i class="material-icons left">local_shipping</i>Pedidos</a></li>
                            <li><a href="clientes.php"><i class="material-icons left">contacts</i>Clientes</a></li>
                            <li><a href="valoraciones.php"><i class="material-icons left">star</i>Valoraciones</a></li>
                            <li><a href="usuarios.php"><i class="material-icons left">group</i>Usuarios</a></li>
                            <li><a class="dropdown-trigger" href="#" data-target="dropdown-mobile"><i class="material-icons">verified_user</i>Cuenta: <b>' . $_SESSION['alias_usuario'] . '</b></a></li>
                        </ul>
                        <ul id="dropdown-mobile" class="dropdown-content">
                            <li><a href="#" onclick="openProfileDialog()">Editar perfil</a></li>
                            <li><a href="#" onclick="openPasswordDialog()">Cambiar clave</a></li>
                            <li><a href="#" onclick="openDevicesDialog()">Dispositivos</a></li>
                            <li><a href="#" onclick="openSecurityDialog()">Seguridad</a></li>
                            <li><a href="#" onclick="logOut()">Salir</a></li>
                        </ul>
                    </header>
                    <main class="container">
                        <h3 class="center-align">' . $title . '</h3>
                ');
            } else {
                header('location: main.php');
            }
        } else {
            // Se verifica si la página web actual es diferente a index.php (Iniciar sesión) y a register.php (Crear primer usuario) para direccionar a index.php, de lo contrario se muestra un menú vacío.
            if ($filename != 'index.php' && $filename != 'register.php' 
                    && $filename != 'cambiar_contra.php' && $filename != 'verificar_email.php'
                    && $filename != 'verificar_codigo.php' && $filename != 'recuperar_contra.php'
                    && $filename != 'autenticacion.php') {
                header('location: index.php');
            } else {
                // Se imprime el código HTML para el encabezado del documento con un menú vacío cuando sea iniciar sesión o registrar el primer usuario.
                print('
                    <header>
                        <div class="navbar-fixed">
                            <nav class="indigo darken-4">
                                <div class="nav-wrapper">
                                    <a href="index.php" class="brand-logo"><i class="material-icons">dashboard</i></a>
                                </div>
                            </nav>
                        </div>
                    </header>
                    <main class="container">
                        <h3 class="center-align">' . $title . '</h3>
                ');
            }
        }
    }

    /*
    *   Método para imprimir la plantilla del pie.
    *
    *   Parámetros: $controller (nombre del archivo que sirve como controlador de la página web).
    *
    *   Retorno: ninguno.
    */
    public static function footerTemplate($controller)
    {
        // Se comprueba si existe una sesión de administrador para imprimir el pie respectivo del documento.
        if (isset($_SESSION['id_usuario'])) {
            $scripts = '
                <script type="text/javascript" src="../../resources/js/materialize.min.js"></script>
                <script type="text/javascript" src="../../resources/js/sweetalert.min.js"></script>
                <script type="text/javascript" src="../../app/helpers/components.js"></script>
                <script type="text/javascript" src="../../app/controllers/dashboard/initialization.js"></script>
                <script type="text/javascript" src="../../app/controllers/dashboard/inactividad.js"></script>
                <script type="text/javascript" src="../../app/controllers/dashboard/account.js"></script>
                <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js" integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI=" crossorigin="anonymous"></script>
                <script type="text/javascript" src="../../app/controllers/dashboard/' . $controller . '"></script>
            ';
        } else {
            $scripts = '
                <script type="text/javascript" src="../../resources/js/materialize.min.js"></script>
                <script type="text/javascript" src="../../resources/js/sweetalert.min.js"></script>
                <script type="text/javascript" src="../../app/helpers/components.js"></script>
                <script type="text/javascript" src="../../app/controllers/dashboard/' . $controller . '"></script>
            ';
        }
        print('
                    </main>
                    <footer class="page-footer indigo darken-4">
                        <div class="container">
                            <div class="row">
                                <div class="col s12 m6 l6">
                                    <h5 class="white-text">Dashboard</h5>
                                    <a class="white-text" href="mailto:dacasoft@outlook.com"><i class="material-icons left">email</i>Ayuda</a>
                                </div>
                                <div class="col s12 m6 l6">
                                    <h5 class="white-text">Enlaces</h5>
                                    <a class="white-text" href="http://localhost/youngblood/views/public/" target="_blank"><i class="material-icons left">store</i>Sitio público</a>
                                </div>
                            </div>
                        </div>
                        <div class="footer-copyright">
                            <div class="container">
                                <span>© YOUNGBLOOD, todos los derechos reservados.</span>
                                <span class="white-text right">Diseñado con <a class="red-text text-accent-1" href="http://materializecss.com/" target="_blank"><b>Materialize</b></a></span>
                            </div>
                        </div>
                    </footer>
                    ' . $scripts . '
                </body>
            </html>
        ');
    }

    /*
    *   Método para imprimir las cajas de dialogo (modals) de editar pefil y cambiar contraseña.
    */
    private static function modals()
    {
        // Se imprime el código HTML de las cajas de dialogo (modals).
        print('
            <!-- Componente Modal para mostrar el formulario de editar perfil -->
            <div id="profile-modal" class="modal">
                <div class="modal-content">
                    <h4 class="center-align">Editar perfil</h4>
                    <form method="post" id="profile-form">
                        <div class="row">
                            <div class="input-field col s12 m6">
                                <i class="material-icons prefix">person</i>
                                <input id="nombres_perfil" type="text" name="nombres_perfil" class="validate" required/>
                                <label for="nombres_perfil">Nombres</label>
                            </div>
                            <div class="input-field col s12 m6">
                                <i class="material-icons prefix">person</i>
                                <input id="apellidos_perfil" type="text" name="apellidos_perfil" class="validate" required/>
                                <label for="apellidos_perfil">Apellidos</label>
                            </div>
                            <div class="input-field col s12 m6">
                                <i class="material-icons prefix">email</i>
                                <input id="correo_perfil" type="email" name="correo_perfil" class="validate" required/>
                                <label for="correo_perfil">Correo</label>
                            </div>
                            <div class="input-field col s12 m6">
                                <i class="material-icons prefix">person_pin</i>
                                <input id="alias_perfil" type="text" name="alias_perfil" class="validate" required/>
                                <label for="alias_perfil">Alias</label>
                            </div>
                        </div>
                        <div class="row center-align">
                            <a href="#" class="btn waves-effect grey tooltipped modal-close" data-tooltip="Cancelar"><i class="material-icons">cancel</i></a>
                            <button type="submit" class="btn waves-effect blue tooltipped" data-tooltip="Guardar"><i class="material-icons">save</i></button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Componente Modal para mostrar el formulario de cambiar contraseña -->
            <div id="password-modal" class="modal">
                <div class="modal-content">
                    <h4 class="center-align">Cambiar contraseña</h4>
                    <label>Su contraseña debe como mínimo ocho caracteres entre
                        alfanuméricos y especiales (al menos uno de cada uno) y que sea diferente al nombre de usuario</label>
                    
                    <form method="post" id="password-form">
                        <div class="row">
                            <div class="input-field col s12 m6 offset-m3">
                                <i class="material-icons prefix">security</i>
                                <input id="clave_actual" type="password" name="clave_actual" class="validate" required/>
                                <label for="clave_actual">Clave actual</label>
                            </div>
                        </div>
                        <div class="row center-align">
                            <label>CLAVE NUEVA</label>
                        </div>
                        <div class="row">
                            <div class="input-field col s12 m6">
                                <i class="material-icons prefix">security</i>
                                <input id="clave_nueva_1" type="password" name="clave_nueva_1" class="validate" required/>
                                <label for="clave_nueva_1">Clave</label>
                            </div>
                            <div class="input-field col s12 m6">
                                <i class="material-icons prefix">security</i>
                                <input id="clave_nueva_2" type="password" name="clave_nueva_2" class="validate" required/>
                                <label for="clave_nueva_2">Confirmar clave</label>
                            </div>
                        </div>
                        <div class="row center-align">
                            <p>
                                <label>
                                <input type="checkbox" onchange="showHidePassword(\'checkboxContraseña\', \'clave_actual\',\'clave_nueva_1\',\'clave_nueva_2\')" id="checkboxContraseña" />
                                <span>Mostrar Contraseña</span>
                                </label>
                            </p>
                        </div>
                        <div class="row center-align">
                            <a href="#" class="btn waves-effect grey tooltipped modal-close" data-tooltip="Cancelar"><i class="material-icons">cancel</i></a>
                            <button type="submit" class="btn waves-effect blue tooltipped" data-tooltip="Guardar"><i class="material-icons">save</i></button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Componente Modal para mostrar el formulario de dispositivos -->
            <div id="devices-modal" class="modal">
                <div class="modal-content">
                    <h4 class="center-align">Dispositivos</h4>
                    <form method="post" id="device-form">
                        <div class="row">
                            <!-- Tabla para mostrar los registros existentes -->
                            <table class="highlight" id="data-table">
                                <!-- Cabeza de la tabla para mostrar los títulos de las columnas -->
                                <thead>
                                    <tr>
                                        <th>DISPOSITIVO</th>
                                        <th>FECHA</th>
                                        <th>HORA</th>
                                    </tr>
                                </thead>
                                <!-- Cuerpo de la tabla para mostrar un registro por fila -->
                                <tbody id="tbody-devices">
                                </tbody>
                            </table>
                        </div>
                        <div class="row center-align">
                            <a href="#" class="btn waves-effect grey tooltipped modal-close" data-tooltip="Cancelar"><i class="material-icons">cancel</i></a>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Componente Modal para mostrar el formulario de seguridad -->
            <div id="security-modal" class="modal">
                <div class="modal-content">
                    <h4 class="center-align">Panel de Seguridad</h4>
                    <form method="post" id="security-form">
                        <div class="row">
                            <div class="col s12 m6">
                                <blockquote>
                                Intentos fallidos de sesión: <b id="lblIntentos">14</b>
                                </blockquote>
                            </div>
                            <div class="col s12 m6">
                                <p>
                                    <label>
                                    <input id="checkbox_autenticacion" type="checkbox" />
                                    <span>Inicio de sesión en dos pasos</span>
                                    </label>
                                </p>
                                <input type="hidden" value="no" id="checkboxValue" name="checkboxValue"/>
                            </div>
                        </div>
                        <div class="row">
                            <!-- Tabla para mostrar los registros existentes -->
                            <table class="highlight" id="data-table">
                                <!-- Cabeza de la tabla para mostrar los títulos de las columnas -->
                                <thead>
                                    <tr>
                                        <th>FECHA</th>
                                        <th>HORA</th>
                                        <th>OBSERVACIÓN</th>
                                    </tr>
                                </thead>
                                <!-- Cuerpo de la tabla para mostrar un registro por fila -->
                                <tbody id="tbody-security">
                                </tbody>
                            </table>
                        </div>
                        <div class="row center-align">
                            <button type="submit" class="btn waves-effect blue tooltipped" data-tooltip="Guardar Cambios"><i class="material-icons">save</i></button>
                            <a href="#" class="btn waves-effect grey tooltipped modal-close" data-tooltip="Cancelar"><i class="material-icons">cancel</i></a>
                        </div>
                    </form>
                </div>
            </div>
        ');
    }
}
