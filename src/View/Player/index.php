<?php

require_once './components/header.php';

?>

<h2>Liste des utilisateurs</h2>
<br>
<ul>
    <?php
    /** @var \App\Model\Player[] $players */
    foreach ($players as $player) : ?>
        <li> <?php echo $player->getFirstName() . ' ' . $player->getLastName(); ?></li>
    <?php endforeach; ?>
</ul>
<br>
<button class='btn btn-primary'> <a style='text-decoration:none; color:white' href='/player/create'> Ajouter un joueur </a> </button> 
</body>
</html>