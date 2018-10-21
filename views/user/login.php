<?= $renderer->render('header') ?>

    <div class="container">
        <h1>Se connecter</h1>

        <form action="#" method="post">
            <div class="form-group">
                <input type="text" class="form-control" name="username" placeholder="Nom d'utilisateur">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password" placeholder="Votre mot de passe">
            </div>
            <button class="btn btn-primary" type="submit">Se connecter</button>
        </form>
    </div>

<?= $renderer->render('footer') ?>