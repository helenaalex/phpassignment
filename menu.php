<?php
$xml=simplexml_load_file("menu.xml") or die("Error: Cannot create object");
foreach($xml->children() as $menu) {
    echo $menu['category'] . "<br>";
    foreach($menu->children() as $dish){
        echo '<table>';
            echo '<tr>';
                echo '<td rowspan="5">';
                echo'<img src="Images/'.$dish->image.'" alt="Cassoulet" width="150" height="120">';
                echo '</td>';
                echo '<td>';
                echo $dish->title . "<br> ";
                echo '</td>';
            echo '</tr>';
            echo '<tr>';
                echo '<td>';
                echo $dish->ingredients . "<br>";
                echo '</td>';
            echo '</tr>';
            echo '<tr>';
                echo '<td>';
                echo $dish->comments . "<br>";
                echo '</td>';
            echo '</tr>';
            echo '<tr>';
                echo '<td>';
                echo $dish->price . "<br>";
                echo '</td>';
            echo '</tr>';
            echo '<tr>';
                echo '<td>';
                echo '<a href="descr.php?dish='.$dish->title.'">View description</a>';
                echo '</td>';
            echo '</tr>';
        echo '</table>';
        echo'<br><br>';
    }
    
}
?>
