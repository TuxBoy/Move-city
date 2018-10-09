<?= $renderer->render('admin.header') ?>

<div class="container">
  <h1>Toutes les catégories</h1>

  <a href="/category/add" class="btn btn-primary">Ajouter une catégorie</a>
  <table class="table">
    <thead>
    <tr>
      <th>ID</th>
      <th>Name</th>
      <th>URL</th>
      <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach($categories as $category): ?>
      <tr>
        <td><?= $category->id ?></td>
        <td><a href="/category/edit?id=<?= $category->id ?>"><?= $category->name ?></a></td>
        <td><?= $category->slug ?></td>
        <td>
          <a href="/category/edit?id=<?= $category->id ?>" class="btn btn-success"><i class="far fa-edit"> Editer</a>
          <form action="/category/delete?id=<?= $category->id ?>" method="post" class="form-delete" style="display: inline-block;">
            <button class="btn btn-danger">Supprimer</button>
          </form>
        </td>
      </tr>
    <?php endforeach; ?>
    </tbody>
  </table>
</div>

<?= $renderer->render('admin.footer') ?>
