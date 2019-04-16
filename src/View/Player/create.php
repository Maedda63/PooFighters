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
        <div class="input-group mb-3">
        <select class="custom-select">
            <option selected>Choose...</option>
            <option value="1">One</option>
            <option value="2">Two</option>
            <option value="3">Three</option>
        </select>
    </form>
    </body>
</html>