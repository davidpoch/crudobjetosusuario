<?php
/*
 * input: $array es un array que voy a dibujar
 * output: $salida es un string con la tabla html
 */

function dibujaTabla($array)
{
    $salida='';
    
    $salida.="<table border=1>";
    $m=0;
    foreach($array as $keyfila => $fila)
    {
        if($m==0)
        {
            $salida.="<tr>";
            foreach ($fila as $keycolumna => $columna)
            {
                $salida.="<th>".$keycolumna."</th>";
            }
            $salida.="<th>Opciones</th>";
            $salida.="</tr>";            
            $m++;
        }        
        $id='';
        $salida.="<tr>";
        foreach ($fila as $keycolumna => $columna)
        {
            $salida.="<td>".$columna."</td>";
            if($keycolumna=='idusers')
                 $id=$columna;
        }
   
        $salida.="<td>
                     <a href=\"?controller=usuarios&action=update&usuario=".$id."\">Update</a>&nbsp;
                     <a href=\"?controller=usuarios&action=delete&usuario=".$fila['idusers']."\">Delete</a>
                  </td>";
        $salida.="</tr>";
        
    }
    $salida.="</table>";
    
    return $salida;
}


function dibujaTablaNum($array)
{
//    echo "<pre>";
//    print_r($array);
//    echo "<pre>";
    $salida="";
    $columnas=sizeof($array[0]);
    $filas=sizeof($array);
    
    
    // 2. Dibujar tabla
    
    $salida.="<table border=1>";
    for($m=0;$m<$filas;$m++)
    {    
        $salida.="<tr>";
        for($i=0;$i<$columnas;$i++)
        {
            $salida.="<td>";
            $salida.=$array[$m][$i];
            $salida.="</td>";
        }
        if($m==0)
            $salida.="<td>opciones</td>";
        else
            $salida.="<td>
                       <a href=\"?action=update&usuario=".$m."\">Update</a>&nbsp;
                       <a href=\"?action=delete&usuario=".$m."\">Delete</a>
                       </td>";    
        $salida.="</tr>";    
    }    
    $salida.="</table>";
    
    return $salida;
}

?>

