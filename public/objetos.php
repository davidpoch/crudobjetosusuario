<?php 

//crear classe

class miClase
{
	//propiedades
	public	$mipropiedad='esto es la propiedad';
	//metodos
	
	public function mimetodo()
	{
		echo "hola Mundo!";
    return null;
	}
}

class A
{
	function foo()
	{
		if (isset($this)) 
		{
			echo '$this is defined (';
			echo get_class($this);
			echo ")\n";
		}
		else 
		{
			echo "\$this is not defined.\n";
		}
	}
}

class SimpleClass
{
	// invalid member declarations:
	//public $var1 = 'hello '.'world';//en la definició de classe no es poden definir propietats de forma dinamica
	//public $var2 = <<<EOD

	//public $var3 = 1+2;
	//public $var4 = self::myStaticMethod();
	//public $var5 = $myVar;
	// valid member declarations:
	//define('myConstant','Mi constante'); no es pot definir constants d'aquesta manera

	public $pi   =3.1416;
	//public $var6 = myConstant;
	//public $var7 = self::pi;
	public $var8 = array(true, false);
		function displayVar2()
		{
			echo "<b>Simple class\n</b><br/>";
			return;
		}
}
$instance = new SimpleClass();

class ExtendClass extends SimpleClass
{
	// Redefine the parent method
	function displayVar()
	{
		echo "Extending class\n";
		parent::displayVar2();
		echo "<br/>";
	}
}
$extended = new ExtendClass();
$extended->displayVar();
echo "<br/>";
$extended->displayVar2();
echo "<br/>";

//instancia objecte
$miObjeto=new miClase();
$miObjeto -> mimetodo();
echo "<br/>";
echo $miObjeto -> mipropiedad;
$miObjeto -> mipropiedad ="valor modificado";
echo "<br/>";
echo $miObjeto -> mipropiedad;

$miObjeto2=new miClase();
echo "<br/>";
echo $miObjeto2 -> mipropiedad;
echo "<br/>";
echo "<br/>";
$objeto1=new A;
$objeto1 -> foo();
echo"------------------------------------------------------------------------------------";
echo"<br/>";
class MyDestructableClass {
	function __construct() {
		print "In constructor\n";
		$this->name = "MyDestructableClass";
	}
	function __destruct() {
		print "Destroying " . $this->name . "\n";
	}
}
$obj = new MyDestructableClass();
?>