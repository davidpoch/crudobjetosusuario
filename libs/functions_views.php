<?php
/*
 * string function render(string $content, filePath $layout)
 * 
 * Renderiza el contenido de content en layout 
 * y devuelve como html.
 */

function render($content, $layout)
{
    ob_start();
        include ($layout); 
        $html = ob_get_contents();
    ob_end_clean();
    return $html;
}

function view($viewVar, $view)
{
    ob_start();
        include ($view); 
        $html = ob_get_contents();
    ob_end_clean();
    return $html;
}

function debug($data, $label)
{
    echo "<pre>".$label.": ";
    print_r($data);
    echo "</pre>";   
}
?>

