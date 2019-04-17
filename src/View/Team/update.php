<?php

require_once './components/header.php';

?>

    <div class='container-fluid'>
        <div class='container'>
            <h1> Editer l'équipe' </h1>

            <form method=post>
            <div class='form-group'>
                <label> Nouveau nom </label>
                <input class='form-control' name='team_name' value='<?php echo $team->getName(); ?>'>
            </div>
                <button class='btn btn-primary'> Valider </button>
            </form>