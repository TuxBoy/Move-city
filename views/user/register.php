<?= $renderer->render('header') ?>

    <div class="container">
        <h1>Créer un compte</h1>

        <form action="#" method="POST">
            <div class="form-group">
                <input type="text" name="username" placeholder="Nom d'utilisateur" class="form-control">
            </div>
            <div class="form-group">
                <input type="email" name="email" class="form-control" placeholder="Email">
            </div>
            <div class="form-group">
                <input type="password" name="password" class="form-control" placeholder="Mot de passe">
            </div>
            <div class="form-group">
                <input type="password" name="confirm_password" class="form-control" placeholder="Confirmer votre mot de passe">
            </div>
            <button type="submit" class="btn btn-primary">Enregister</button>
        </form>
    </div>

<?= $renderer->render('footer') ?>