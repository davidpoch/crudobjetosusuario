<?php
/*
 * 
 */
function route($controllerO, $actionO)
{
    $route=array();
    if(isset($_GET['controller']))
        $controller=$_GET['controller'];
    else
        $controller=$controllerO;

    // Action
    if(isset($_GET['action']))
        $action=$_GET['action'];
    else
        $action=$actionO;
    
    $route=array('controller'=>$controller, 
                 'action'=>$action
                 );
    
    return $route;
}

?>

