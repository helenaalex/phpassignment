<?php
    session_start();
    require_once __DIR__.'/bootstrap.php';

    $name = $_GET['dish'];
    $xml=simplexml_load_file("menu.xml") or die("Error: Cannot create object");

    foreach($xml->children() as $menu) {
        foreach($menu->children() as $dish){
            if ($name == $dish->title){
                $descr = $dish;
            }
        }
    }

    echo $twig->render('descr.html', ['dish' => $descr] );

