<?php
require_once __DIR__.'/bootstrap.php';
$xml=simplexml_load_file("menu.xml") or die("Error: Cannot create object");
foreach($xml->children() as $menu) {
    echo $twig->render('menu.html', ['dishes' => $menu->children(),'category'=> $menu['category']] );
    
}
?>
