<?= $renderer->render('header') ?>

	<div class="container">
		<h1>Ajouter un commerce</h1>
		<form action="/shop/create" method="post">
			<div class="panel panel-default">
				<div class="panel-heading">
					Informations :
				</div>
				<div class="panel-body">
						<div class="form-group">
							<label for="name">Nom :</label>
							<input type="text" name="name" class="form-control">
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="country">Pays :</label>
									<input type="text" name="country" class="form-control">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="street">Rue :</label>
									<input type="text" name="street" class="form-control">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="postal_code">Code postal :</label>
									<input type="text" name="postal_code" class="form-control">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="city">Ville :</label>
									<input type="text" name="city" class="form-control">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="latitude">Latitude :</label>
									<input type="text" name="latitude" class="form-control">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="longitude">Longitude :</label>
									<input type="text" name="longitude" class="form-control">
								</div>
							</div>
						</div>
						<div class="checkbox">
							<label>
								<input type="checkbox"> Activer ?
							</label>
						</div>
				</div>
				<div class="panel-footer">
					<button class="btn btn-primary" type="submit">Enregistrer</button>
				</div>
			</div>
		</form>
	</div>

<?= $renderer->render('footer') ?>
