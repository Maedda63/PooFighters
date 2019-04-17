<?php

require_once './components/header.php';

?>

<h1>Liste des utilisateurs</h1>
<ul>
    <?php
    /** @var \App\Model\Player[] $players */
    foreach ($players as $player) : ?>
        <li> <?php echo $player->getFirstName() . ' ' . $player->getLastName(); ?></li>
    <?php endforeach; ?>
</ul>
<a href="/player/create">Ajouter</a>
</body>
</html>