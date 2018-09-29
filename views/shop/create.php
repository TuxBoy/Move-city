<?= $renderer->render('header') ?>

	<div class="container">
		<h1>Ajouter un commerce</h1>
		<?= $renderer->render('shop.partials.form', ['shop' => $shop]) ?>
	</div>

<?= $renderer->render('footer') ?>
