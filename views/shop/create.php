<?= $renderer->render('admin.header') ?>

	<div class="container">
		<h1>Ajouter un commerce</h1>
		<?= $renderer->render('shop.partials.form', ['shop' => $shop, 'categories' => $categories]) ?>
	</div>

<?= $renderer->render('admin.footer') ?>
