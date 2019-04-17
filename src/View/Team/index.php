<?php

require_once './components/header.php';

?>
    
    <div class=' text-center container-fluid'>
        <h2> Liste des équipes </h2>
        <br>
        <div class='container'>
            <?php foreach ($teams as $team) { ?>
            <h2> <?php echo $team->getName(); ?> </h2>
            <button class='btn btn-success'> <a style='text-decoration:none; color:white' href=<?php echo '/team/update?team_id=' . $team->getId(); ?>> Modifier</a> </button>
            <button class='btn btn-danger'> <a style='text-decoration:none; color:white' href=<?php echo '/team/delete?team_id=' . $team->getId(); ?>> Supprimer</a> </button>
            <br>
            <br>
            <?php } ?>
        </div>
        <div class='container pt-5'>
        <button class='btn btn-primary'> <a style='text-decoration:none; color:white' href='/team/create'> Créer une nouvelle équipe </a> </button> 
        <br>
        <br>
        </div>
    </div>
</body>

</html>