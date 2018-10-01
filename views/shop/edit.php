<?= $renderer->render('header') ?>

<div class="container">
	<h1>Editer un commerce</h1>
	<p><a href="/shop" class="btn btn-warning">< Retour</a></p>
   <?= $renderer->render('shop.partials.form', ['shop' => $shop]) ?>
</div>

<?= $renderer->render('footer') ?>
