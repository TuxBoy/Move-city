<?= $renderer->render('admin.header') ?>

<div class="container">
  <h1>Editer une catégorie</h1>
  <?= $renderer->render('category.partials.form', ['category' => $category]) ?>
</div>

<?= $renderer->render('admin.footer') ?>
