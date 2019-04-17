<?php

require_once './components/header.php';

?>
    <h1>Ajouter des joueurs</h1>

    <form method="POST">
        <div class='form-group'>
            <input class='form-control' type="text" name="lastname" placeholder="Nom">
        </div>
        <div class='form-group'>
            <input class='form-control' type="text" name="firstname" placeholder="Prénom">
        </div>
        <div class="input-group mb-3">
            <select class="custom-select">
                <option selected>Choose...</option>
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
            </select>
        </div>
        <button class='btn btn-success' type='submit'> Inscrire le joueur </button>
    </form>
    </body>
</html>