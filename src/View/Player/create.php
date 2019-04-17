<?php

require_once './components/header.php';

?>
    <h1>Ajouter des joueurs</h1>
    <br>
        <div class="col-6 offset-3">
            <form method="POST">
                <div class='form-group'>
                    <input class='form-control' type="text" name="firstname" placeholder="Prénom">
                </div>
                <div class='form-group'>
                    <input class='form-control' type="text" name="lastname" placeholder="Nom">
                </div>
                <div class="input-group mb-3">
                    <select name='team' class="custom-select">
                        <option selected>Choose...</option>
                        <option name='team' value="1">One</option>
                        <option name='team' value="2">Two</option>
                        <option name='team' value="3">Three</option>
                    </select>
                </div>
                <br>
                <button class='btn btn-success' type='submit'> Inscrire le joueur </button>
            </form>
            <br>
            <p>(Si votre équipe n'existe pas, veuillez la <a href="../team/create">créer en premier ici</a>)</p>
        </div>
    </body>
</html>