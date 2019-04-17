<?php

require_once './components/header.php';

?>

<div class='container-fluid'>
    <div class='container'>
        <h1> Editer l'équipe </h1>

        <form method="POST">
                <div class='form-group'>
                    <input class='form-control' type="text" name="lastname" value="<?php echo $player->getLastname(); ?>">
                </div>
                <div class='form-group'>
                    <input class='form-control' type="text" name="firstname" value="<?php echo $player->getFirstname(); ?>">
                </div>
                <div class="input-group mb-3">
                    <select name='team' class="custom-select">
                        <?php foreach ($teams as $team): ?>
                            <option value="<?php echo $team->getId();?>"> <?php echo $team->getName();?> </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <br>
                <button class='btn btn-success' type='submit'> Inscrire le joueur </button>
            </form>
    </div>
</div>