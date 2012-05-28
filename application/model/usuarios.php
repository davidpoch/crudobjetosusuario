<?php
/*
 * input: $array es un array que voy a dibujar
 * output: $salida es un string con la tabla html
 */

class UsuariosModel
{
	
	public function procesarUpdate($proyecto, $config,$db)
	{
	   // $link=$db -> link;
	    //Actualizar imagen
	    
	    //Actualizar tabla de usuarios_has_likes
	    
	    //Actualizar tabla de usuarios
	    
	     /* ------------------------------------ */
	 
	    //Si imagen en el update
	    if($_FILES['photo']['name']!='')
	    {
	        // Borrar imagen anterior
	                    $sql="SELECT photo FROM usuarios 
	                        WHERE idusuarios=".$_POST['usuario'];
	
	                    $result=  $db -> query($sql);
	                    $arrPhoto=$db -> arrayAssoc($result);
	
	                    $imagen_anterior=$arrPhoto['photo'];
	                    
	                    unlink($_SERVER['DOCUMENT_ROOT'].
	                           $proyecto."/".
	                           $imagen_anterior);
	        // Subir imagen nueva
	                    $origen=$_FILES['photo']['tmp_name'];
	                    $nombre=$_FILES['photo']['name'];
	
	                    $out=array();
	
	                    // Destino es la localizacion fisica en el disco duro
	                    $destino=$_SERVER['DOCUMENT_ROOT'].$proyecto."/".$nombre;
	                    
	                    $count=0;
	                    $partes_ruta=pathinfo($destino);
	                    while(file_exists($destino))
	                    {
	                        $count++;    
	                        $destino=$_SERVER['DOCUMENT_ROOT'].$proyecto."/".
	                        $partes_ruta['filename']."-".
	                        $count.".".$partes_ruta['extension'];
	                    }
	                    if($count==0)
	                    {
	                        // Esta es la ruta en la URL
	                        $imagen=$partes_ruta['filename'].".".$partes_ruta['extension'];
	                    }
	                    else
	                        $imagen=$partes_ruta['filename']."-".$count.".".$partes_ruta['extension'];
	                   
	                    move_uploaded_file($origen,$destino);
	                    $out['photo']=$imagen;        
	   }
	   
	   // Crear array out
	
	                    foreach($_POST as $key => $value)
	                    {
	                        if(is_array($value))
	                            $out[$key]=implode(',',$value);
	                        else
	                            $out[$key]=$value;
	                    }
	                    
	   // Actualizar tabla de usuarios       
	        
	                    $sql="UPDATE users SET
	                            email = '".$out['email']."',            
	                            name = '".$out['name']."',
	                            surname = '".$out['surname']."',
	                            birthday = '".$out['birthday']."',";
	                     if(isset($out['photo']))
	                            $sql.="photo = '".$out['photo']."',"; 
	                     $sql.="description = '".$out['description']."',
	                            cities_idcities = ".$out['city'].",
	                            genders_idgenders = ".$out['gender'].",
	                            transports =  '".$out['transports']."' 
	                        WHERE idusers =".$out['usuario']."";
	                     
	                    $result=$db -> query($sql);
	    
	    // Actualizar tabla de usuarios_has_likes
	    
	    
	                    // Borrar todos los datos del usuario                    
	                    $sql="DELETE FROM usuarios_has_likes 
	                          WHERE usuarios_idusuarios = ".$out['usuario'];
	                    $db -> query($sql);
	                    // Insertar todos los datos del usuario
	                    $likes=explode(',', $out['likes']);
	                    foreach ($likes as $key => $value)
	                    {
	                        $sql="INSERT INTO usuarios_has_likes SET
	                                usuarios_idusuarios = ".$out['usuario'].",
	                                likes_idlikes = ".$value;
	                        $db -> query($sql);
	                    }
	                    
	    return $out['usuario'];
	}
	public function procesar($proyecto,$config,$db)
	{
	    
	    if($_FILES['photo']['name']!='')
	        {
	                //Procesar insert
	
	                /* ------------------------------------ */
	                $origen=$_FILES['photo']['tmp_name'];
	                $nombre=$_FILES['photo']['name'];
	
	                $out=array();
	
	                // Destino es la localizacion fisica en el disco duro
	                $destino=$_SERVER['DOCUMENT_ROOT']."/".$proyecto."/".$nombre;
	
	                $count=0;
	                $partes_ruta=pathinfo($destino);
	                while(file_exists($destino))
	                {
	                    $count++;    
	                    $destino=$_SERVER['DOCUMENT_ROOT']."/".$proyecto."/".
	                    $partes_ruta['filename']."-".
	                    $count.".".$partes_ruta['extension'];
	                }
	                if($count==0)
	                {
	                    // Esta es la ruta en la URL
	                    $imagen=$partes_ruta['filename'].".".$partes_ruta['extension'];
	                }
	                else
	                    $imagen=$partes_ruta['filename']."-".$count.".".$partes_ruta['extension'];
	
	                move_uploaded_file($origen,$destino);
	                $out['photo']=$imagen;                
	        }
	        
	        foreach($_POST as $key => $value)
	        {
	            if(is_array($value))
	                $out[$key]=implode(',',$value);
	            else
	                $out[$key]=$value;
	        }
	        
	        // Hacer el insert
	        $link= $db -> connectDBServer($config);
	        $sql="INSERT INTO users SET
	            email = '".$out['email']."',
	            password = '".$out['password']."',
	            name = '".$out['name']."',
	            surname = '".$out['surname']."',
	            birthday = '".$out['birthday']."',
	            photo = '".$out['photo']."', 
	            description = '".$out['description']."',
	            cities_idcities = ".$out['city'].",
	            genders_idgenders = ".$out['gender'].",
	            transports =  '".$out['transports']."'"; 
	
	        $result=$db -> queryInsert($sql);
	     
	        $likes=explode(',', $out['name']);
	        foreach ($likes as $key => $value)
	        {
	            $sql="INSERT INTO users_has_likes SET
	                    usuarios_idusers = ".$result.",
	                    likes_idlikes = ".$value;
	            $db -> query($sql);
	        }
	
	        return $result;
	        
	  
	
	}
	
	public function procesarDelete($imgDir,$proyecto, $db)
	{
	    // Crear array out
	                    $out=array();
	                    foreach($_POST as $key => $value)
	                    {
	                        if(is_array($value))
	                            $out[$key]=implode(',',$value);
	                        else
	                            $out[$key]=$value;
	                    }       
	
	    // Borrar imagen 
	                    $sql="SELECT photo FROM users 
	                        WHERE idusers=".$out['usuario'];
	
	                    $result=  $db -> query($sql);
	                    $arrPhoto=$db -> arrayAssoc($result);
	
	                    $imagen_anterior=$arrPhoto['photo'];
	                    
	                    unlink($_SERVER['DOCUMENT_ROOT'].
	                           $proyecto."/".
	                           $imagen_anterior);
	     // Borrar todos datos en usuarios_has_likes                   
	                    $sql="DELETE FROM users_has_likes 
	                          WHERE users_idusers = ".$out['usuario'];
	                    $db -> query($sql);
	    // Borrar todos los datos del usuario                    
	                    $sql="DELETE FROM users 
	                          WHERE idusers = ".$out['usuario'];
	                    $db -> query($sql);
	             echo $sql;       
	    return $out['usuario'];
	}
	/*-------------------------------------------------------------------------*/
	
	public function readUsers($db)
	{
	    $sql="SELECT * FROM users";
	    $result =  $db -> query($sql);
	    $usuarios= $db -> resultToArray($result);
	    return $usuarios;
	}

	public function readUsersById($db,$id)
	{
	    $sql="SELECT * FROM users 
	                  WHERE idusers=".$id;
	            $result  = $db -> query($sql);
	            $usuarios= $db -> resultToArray($result);
	    return $usuarios;
	}
	
	public function initUserData()
	{
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
	    return $datos;
	}
	
	public function readUserData($proyecto,$db)
	{
	    $usuario=$_GET['usuario'];        
	            // Leer datos de usuario de la db segun seleccion
	            $sql="SELECT users.*, countries.* 
	                FROM users, countries, cities
	                WHERE idusers=".$usuario." AND
	                users.cities_idcities = cities.idcities AND
	                cities.countries_idcountries = countries.idcountries";      
	
	            $result = $db -> query($sql);  
	            $arr=     $db -> arrayAssoc($result);
				
	            // Procesar gustos
	            $sql="SELECT users_idusers, likes_idlikes, likes.name 
	                FROM users_has_likes, likes 
	                WHERE users_idusers=".$usuario." AND 
	                    users_has_likes.likes_idlikes=likes.idlikes"
	                    ;        
	    //        echo $sql;
	    //        die;
	            $result = $db -> query($sql); 
	            $likes=array();
	            $arrLikes=$db -> resultToArray($result);
		            foreach($arrLikes as $key => $values)
		            {
		                $likes[]=$values['likes_idlikes'];
		            }

	            $likes=implode(',',$likes);
	
	            $datos=array('name'=>$arr['name'],
	                    'password'=>$arr['password'],
	                    'surname'=>$arr['surname'],
	                    'email'=>$arr['email'],
	                    'description'=>$arr['description'],
	                    'id'=>$arr['idusers'],
	                    'birthday'=>$arr['birthday'],
	                    'gender'=>$arr['genders_idgenders'],
	                    'likes'=>$likes,
	                    'transports'=>$arr['transports'],                
	                    'city'=>$arr['cities_idcities'],
	                    'country'=>$arr['idcountries'],
	                    'photo'=>$proyecto."/".$arr['photo'],
	            );
	            return $datos;
	}
}
?>

