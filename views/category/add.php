<?= $renderer->render('header') ?>

<div class="container">
  <h1>Ajouter une catégorie</h1>
  <?= $renderer->render('category.partials.form', ['category' => $category]) ?>
</div>

<?= $renderer->render('footer') ?>
