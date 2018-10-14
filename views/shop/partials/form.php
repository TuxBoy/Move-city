
<?php
$action = ($shop && $shop->id) ? '/shop/edit?id=' . $shop->id : '/shop/create';
?>
<form action="<?= $action ?>" method="post">
	<div class="panel panel-default">
		<div class="panel-heading">
			Informations :
		</div>
        <div class="panel-body">
            <div class="form-group">
                <label for="name">Nom :</label>
                <input type="text" name="name" class="form-control" value="<?= $shop->name ?>">
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="country">Pays :</label>
                        <input type="text" name="country" class="form-control" value="<?= $shop->country ?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="street">Rue :</label>
                        <input type="text" name="street" class="form-control" value="<?= $shop->street ?>">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="postal_code">Code postal :</label>
                        <input type="text" name="postal_code" class="form-control" value="<?= $shop->postal_code ?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="city">Ville :</label>
                        <input type="text" name="city" class="form-control" value="<?= $shop->city ?>">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="latitude">Latitude :</label>
                        <input type="text" name="latitude" disabled class="form-control" value="<?= $shop->latitude ?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="longitude">Longitude :</label>
                        <input type="text" name="longitude" disabled class="form-control" value="<?= $shop->longitude ?>">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="description">Description :</label>
                <textarea name="description" id="description" class="form-control"><?= $shop->description ?></textarea>
            </div>
            <div class="form-group">
                <label for="categories">Catégorie</label>
                <select name="categories[]" id="categories" class="form-control" multiple>
                  <?php foreach ($categories as $category): ?>
                      <option value="<?= $category->id ?>" <?= $shop->categoryIsSelected($category) ?>><?= $category->name ?></option>
                  <?php endforeach; ?>
                </select>
            </div>
            <div class="checkbox">
                <label>
                    <input type="hidden" name="enable" value="0">
                    <input type="checkbox" name="enable" <?= $shop->enable ? 'checked' : '' ?> value="1"> Activer ?
                </label>
            </div>
            <div class="panel-footer">
                <button class="btn btn-primary" type="submit">Enregistrer</button>
            </div>
        </div>
    </div>
</form>
