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
 * Incluir librerias 
 */
require_once ($config['models']."/usuarios.php");

/**
 * Settings iniciales 
 */
$usuarioM = new UsuariosModel();
$datos= $usuarioM -> initUserData();

/*aqui no es crea objecte ja que no necesitem la resta d'opcions del objecte (cridada estatica)
//es la forma més ràpida de convertir la programació estructurada a P Orientada Objectes(en quant a escriptura),aquesta actua de llibreria
peró aquesta no utilitza totes les possibilitats de la POO*/
$datos= UsuariosModel::initUserData();

/**
 * Inicializacion de variables 
 */
$usuario='';
$content='';
$route=route('usuarios', 'select');     

/**
 * Parametrizar 
 */

/**
 * Procesar 
 */
$db = new dbConnect($config);
$model = new UsuariosModel();

switch($route['action'])
{
    case 'delete':
        if (isset($_POST['usuario']))
        {
            // Procesar formulario de insert            
            if ($_POST['delete']=='Si')
                //$usuarioM -> procesarDelete($config['usersUploadDirectory']."/images", $config);
            	$usuarioM=UsuariosModel::procesarDelete($config['usersUploadDirectory']."/images", $config,$db);
            //header("Location: index.php?controller=usuarios&action=select"); 
            break;
        }
        else
        {
            //$usuarios= $usuarioM -> readUserById($link, $_GET['usuario']);
            
        	$usuarios= $model ->readUsersById($db, $_GET['usuario']);
            $viewVar=array('usuarios'=>$usuarios,'helper'=>$config['helpers']);     
        }
    break;    
    case 'update':       
        if (isset($_POST['usuario']))
        {
            // Procesar formulario de insert            
            //$usuarioM -> procesarUpdate($config['usersUploadDirectory']."/images", $config);
        	$usuarioM=UsuariosModel::procesarUpdate($config['usersUploadDirectory']."/images", $config,$db);
            header("Location: ?controller=usuarios&action=select"); 
            break;
        }
        else
        {
            //$datos=$usuarioM -> readUserData($link, $config['usersUploadDirectory']."/images");
            $datos=UsuariosModel::readUserData($config['usersUploadDirectory']."/images", $db);
        }        
    case 'insert':
        // Si POST          
        if (isset($_POST['usuario']))
        {
            // Procesar formulario de insert
            //$usuarioM -> procesar($config['usersUploadDirectory']."/images", $config);
        	$usuarioM=UsuariosModel::procesar($config['usersUploadDirectory']."/images", $config,$db);
            header("Location: ?controller=usuarios&action=select");            
        }
        else
        {
            //Mostrar formulario
            $viewVar=array('usuario'=>'','datos'=>$datos,'link'=>$db,'helper'=>$config['helpers']);           
        }                             
    break;
    case 'select':
    default:   
        //$usuarios=$usuarioM -> readUsers($link);
       

    	$usuarios=UsuariosModel::readUsers($db);
        $viewVar=array('usuarios'=>$usuarios,'helper'=>$config['helpers']);
    break;
}
/**
 * Mostrar 
 */
$content=view($viewVar, $config['views'].'/'.$route['controller'].'/'.$route['action'].'.phtml');
$db -> disconnectDBServer();
?>