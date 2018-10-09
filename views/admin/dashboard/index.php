<?= $renderer->render('admin.header') ?>


<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
	<h1 class="page-header">Dashboard</h1>

	<div class="row placeholders">
		<div class="col-xs-6 col-sm-3 placeholder">
			<img src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" width="200" height="200" class="img-responsive" alt="Generic placeholder thumbnail">
			<h4>Commerces</h4>
			<span class="text-muted">Gestion des commerces</span>
		</div>
		<div class="col-xs-6 col-sm-3 placeholder">
			<img src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" width="200" height="200" class="img-responsive" alt="Generic placeholder thumbnail">
			<h4>Catégories</h4>
			<span class="text-muted">Gestion des catégories</span>
		</div>
		<div class="col-xs-6 col-sm-3 placeholder">
			<img src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" width="200" height="200" class="img-responsive" alt="Generic placeholder thumbnail">
			<h4>Label</h4>
			<span class="text-muted">Something else</span>
		</div>
		<div class="col-xs-6 col-sm-3 placeholder">
			<img src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" width="200" height="200" class="img-responsive" alt="Generic placeholder thumbnail">
			<h4>Label</h4>
			<span class="text-muted">Something else</span>
		</div>
	</div>

	<div class="row">
		<div class="col-md-6">
			<h2 class="sub-header">Les derniers commerces ajoutés</h2>
			<div class="table-responsive">
				<table class="table table-striped">
					<thead>
					<tr>
						<th>#</th>
						<th>Name</th>
						<th>Address</th>
						<th>Activé ?</th>
						<th>Actions</th>
					</tr>
					</thead>
					<tbody>
					<?php foreach ($shops as $shop): ?>
						<tr>
							<td><?= $shop->id ?></td>
							<td><?= $shop->name ?></td>
							<td><?= $shop ?></td>
							<td><?= $shop->enable ?></td>
							<td>
								<a href="/shop/edit?id=<?= $shop->id ?>" class="btn btn-success"><i class="far fa-edit"></i></a>
								<form action="/shop/delete?id=<?= $shop->id ?>" method="post" class="form-delete" style="display: inline-block;">
									<button class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
								</form>
							</td>
						</tr>
					<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
		<div class="col-md-6">
			<h2 class="sub-header">Les dernières catégories ajoutées</h2>
			<div class="table-responsive">
				<table class="table table-striped">
					<thead>
					<tr>
						<th>#</th>
						<th>Name</th>
						<th>URL</th>
						<th>Actions</th>
					</tr>
					</thead>
					<tbody>
					<?php foreach ($categories as $category): ?>
						<tr>
							<td><?= $category->id ?></td>
							<td><?= $category->name ?></td>
							<td><?= $category->slug ?></td>
							<td>
								<a href="/category/edit?id=<?= $category->id ?>" class="btn btn-success"><i class="far fa-edit"></i></a>
								<form action="/category/delete?id=<?= $category->id ?>" method="post" class="form-delete" style="display: inline-block;">
									<button class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
								</form>
							</td>
						</tr>
					<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<?= $renderer->render('admin.footer') ?>
