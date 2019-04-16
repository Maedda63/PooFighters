<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Page utilisateur</title>
</head>
<body>

<h1>Liste des utilisateurs</h1>
<ul>
    <?php
    /** @var \App\Model\Player[] $players */
    foreach ($players as $player) : ?>
        <li> <?php echo $player->getLastName() . ' ' . $user->getFirstName(); ?></li>
    <?php endforeach; ?>
</ul>
<a href="/player/create">Ajouter</a>
</body>
</html>