<?= $renderer->render('admin.header') ?>

    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
		<h1>Ajouter un commerce</h1>
		<?= $renderer->render('shop.partials.form', ['shop' => $shop, 'categories' => $categories]) ?>
	</div>

<?= $renderer->render('admin.footer') ?>
