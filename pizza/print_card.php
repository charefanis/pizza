<?php
session_start();
foreach($_SESSION['cart'] as $item)
{
    echo "<h3>".$item['num_art'].$item['nom_art'].$item['prix_art'].$item['qte']."</h3>";
}

?>