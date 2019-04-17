<?php

require_once './components/header.php';

?>

        <div class='text-center container-fluid'>
            <h2>Liste des joueurs</h2>
            <br>
            <ul>
                <?php
                /** @var \App\Model\Player[] $players */
                foreach ($players as $player) : ?>
                    <h3> <?php echo $player->getFirstName() . ' ' . $player->getLastName(); ?></h3>
                    <button class='btn btn-success'> <a style='text-decoration:none; color:white' href=<?php echo '/player/update?player_id=' . $player->getId(); ?>> Modifier</a> </button>
                    <button class='btn btn-danger'> <a style='text-decoration:none; color:white' href=<?php echo '/player/delete?player_id=' . $player->getId(); ?>> Supprimer</a> </button>
                <br>
                <br>
                    <?php endforeach; ?>
            </ul>
            <br>
            <button class='btn btn-primary'> <a style='text-decoration:none; color:white' href='/player/create'> Ajouter un joueur </a> </button> 
        </div>
        <br>
        <br>
    </body>
</html>