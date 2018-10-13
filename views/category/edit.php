<?= $renderer->render('admin.header') ?>

<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
  <h1>Editer une catégorie</h1>
  <?= $renderer->render('category.partials.form', ['category' => $category]) ?>
</div>

<?= $renderer->render('admin.footer') ?>
