<?php
/**
 * Index controller
 *
 * Controller for all applications.
 * 
 * @uses       none
 * @package    Index
 * @subpackage Controller
 */
//TODO
//esto es algo que tendré que hacer
//FIXME esto peta que te cagas
/**
 * Settings iniciales 
 */
require_once ("../application/configs/settings.php");

/**
 * Debugs 
 */
echo "<pre>GET: ";
print_r($_GET);
echo "</pre>";

echo "<pre>POST: ";
print_r($_POST);
echo "</pre>";

echo "<pre>Files: ";
print_r($_FILES);
echo "</pre>";

/**
 * Incluir librerias 
 */
require_once ("../libs/functions_db.php");
require_once ("../libs/functions_views.php");
require_once ("../libs/functions_mvc.php");
/**
 * Inicializacion de variables 
 */
$content='vacio';
$renderview = '';
/**
 * Parametrizar 
 */

/**
 * Procesar 
 */

if(isset($_GET['controller']) && 
   file_exists($config['controllers']."/".$_GET['controller'].'.php'))
    $renderview='file';
elseif(isset($_GET['controller']) && 
   !file_exists($config['controllers']."/".$_GET['controller'].'.php'))
    $renderview='error';
else
    $renderview = 'default';


switch ($renderview)
{
    case 'file':
        echo "<pre>";
        print_r("Esto es file");
        echo "</pre>";
        include_once($config['controllers'].'/'.$_GET['controller'].'.php');
    break;
    case 'error':
        header("Status: 404 Not Found");
        echo "<pre>";
        print_r("Esto es error");
        echo "</pre>";        
    break;
    default:
        echo "<pre>";
        print_r("Esto es default");
        echo "</pre>";
        $content="<ul><li><a href=\"?controller=usuarios\">usuarios</a></li></ul>";
    break;
}

/**
 * Mostrar 
 */
echo render($content, $config['layout']);
        
?>


