<?= $renderer->render('header') ?>

	<div class="container">
		<h1><?= $shop->name ?></h1>
        <p><strong>Catégorie : </strong> <?= $shop->getListCategoryName() ?></p>
		<p><?= nl2br(htmlentities($shop->description)) ?></p>
		<address>
			<?= $shop->name ?> <br>
			<?= $shop->street ?> <br>
			<?= $shop->city ?> , <?= $shop->postal_code ?> <br>
		</address>
	</div>

<?= $renderer->render('footer') ?>
