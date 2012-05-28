<?php
/**
 * Usuarios controller
 *
 * Controller for application usuarios.
 * 
 * @uses       none
 * @package    Usuarios
 * @subpackage Controller
 */


/**
 * Settings iniciales 
 */

/**
 * Debugs 
 */
echo "<pre>Files: ";
print_r($_FILES);
echo "</pre>";

/**
 * Incluir librerias 
 */
require_once ($config['models']."/usuarios.php");

/**
 * Inicializacion de variables 
 */

$usuario='';
$content='';

// Controller
if(isset($_GET['controller']))
    $controller=$_GET['controller'];
else
    $controller='auth';

// Action
if(isset($_GET['action']))
    $action=$_GET['action'];
else
    $action='login';
       

/**
 * Parametrizar 
 */

/**
 * Procesar 
 */
$link=connectDBServer($config);

switch($action)
{
    case 'login':
        ob_start();
        include ("formulario_login.php"); 
        $content = ob_get_contents();
        ob_end_clean();
    break;
    case 'logout':
        echo "<pre>";
        print_r("esto es el logout");
        echo "<pre>";
    break;    
    default:           
    break;
}
$content=view($viewVar, $config['views'].'/'.$controller.'/'.$action.'.phtml');
disconnectDBServer($link);
/**
 * Mostrar 
 */
?>
