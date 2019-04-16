<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>Page des joueurs</title>
    </head>
    <body>

    <h1>Ajouter des joueurs</h1>

    <?php if(isset($errors) && !emtpy($errors)) : ?>
        <?php foreach($errors as $error) : ?>
            <p><?php echo $error; ?></p>
        <?php endforeach; ?>
    <?php endif; ?>

    <form method="POST">
        <input type="text" name="lastname" placeholder="Nom">
        <input type="text" name="firstname" placeholder="Prénom">
        <select class="form-control form-control-sm"></select>
    </form>
    </body>
</html>