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

/**
 * Incluir librerias 
 */
require_once ("../libs/functions.php");

/**
 * Inicializacion de variables 
 */

$usuario='';
$content='';

// Controller
if(isset($_GET['controller']))
    $controller=$_GET['controller'];
else
    $controller='';

// Action
if(isset($_GET['action']))
    $action=$_GET['action'];
else
    $action='';


        
$datos=array('name'=>'',
             'lastname'=>'',
             'email'=>'',
             'description'=>'Escriba aqui sus datos por favor',
             'id'=>'',
             'birthday'=>'',
             'gender'=>'',
             'likes'=>'',
             'transports'=>'',
             'country'=>'',
             'city'=>''              
    );

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

    case 'delete':
         $content="
                <form method=\"POST\">
                    <input type=\"submit\" name=\"delete\" value=\"Si\"/>                
                    <input type=\"submit\" name=\"delete\" value=\"No\"/>
                    <input type=\"hidden\" name=\"usuario\" value=\"".$_GET['usuario']."\" />
                </form>"; 
    break;
    
    case 'update':
        

    case 'insert':
        $viewVar=array('datos'=>$datos,
                       'link'=>$link,
                       'helper'=>$config['helpers']);
        
    break;
    case 'select':
    default:        
        $content="<a href=?controller=usuarios&action=insert>insert</a>&nbsp;
            <a href=?action=update>update</a>&nbsp;
            <a href=?action=delete>delete</a>&nbsp;
            <a href=?action=login>login</a>";
        
        
        $sql="SELECT * FROM usuarios";
        echo $sql;       
        $result = query($link, $sql);
        echo "<pre>";
        print_r($result);
        echo "</pre>";
        
        $html="<table border=1>";
        while ($row = arrayAssoc($result))
        {
            $html.="<tr>";
                $html.="<td>".$row."</td>";
            $html.="</tr>";
        }
        $html.="</table>";
        
        echo $html;
        
        mysql_data_seek($result,0);
        $usuarios=array();
        while ($row = arrayAssoc($result))
        {
            $usuarios[]=$row;
        }
//        assert('is_array($usuarios) /*No es array*/');
        
        echo "<pre>Usuarios: ";
        print_r($usuarios);
        echo "</pre>";
        
        
        $viewVar=array('usuarios'=>$usuarios,
                       'link'=>$link,
                       'helper'=>$config['helpers']);
        
               
        
    break;
}
$content=view($viewVar, $config['views'].'/'.$controller.'/'.$action.'.phtml');
disconnectDBServer($link);
/**
 * Mostrar 
 */
?>
