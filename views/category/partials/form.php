
<?php
$action = ($category && $category->id) ? '/category/edit?id=' . $category->id : '/category/add';
?>
<form action="<?= $action ?>" method="post">
  <div class="panel panel-default">
    <div class="panel-heading">
      Informations :
    </div>
    <div class="panel-body">
      <div class="form-group">
        <label for="name">Nom :</label>
        <input type="text" name="name" class="form-control" value="<?= $category->name ?>">
      </div>
      <div class="form-group">
        <label for="name">URL :</label>
        <input type="text" name="slug" class="form-control" value="<?= $category->slug ?>">
      </div>
    <div class="panel-footer">
      <button class="btn btn-primary" type="submit">Enregistrer</button>
    </div>
  </div>
</form>
