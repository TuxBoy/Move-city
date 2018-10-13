<?= $renderer->render('admin.header') ?>

<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
	<h1>Tous les commerces</h1>

	<a href="/shop/create" class="btn btn-primary">Ajouter un commerce</a>
	<table class="table">
		<thead>
		<tr>
			<th>ID</th>
			<th>Name</th>
			<th>Address</th>
			<th>Activé ?</th>
			<th>Actions</th>
		</tr>
		</thead>
		<tbody>
		<?php foreach($shops as $shop): ?>
			<tr>
				<td><?= $shop->id ?></td>
				<td><a href="/shop/edit?id=<?= $shop->id ?>"><?= $shop->name ?></a></td>
				<td><?= $shop ?></td>
				<td><?= $shop->enable ? '<span class="label label-success">oui</span>' : '<span class="label label-danger">non</span>' ?></td>
				<td>
					<a href="/shop/edit?id=<?= $shop->id ?>" class="btn btn-success">Editer</a>
					<form action="/shop/delete?id=<?= $shop->id ?>" method="post" class="form-delete" style="display: inline-block;">
						<button class="btn btn-danger">Supprimer</button>
					</form>
				</td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
</div>

<?= $renderer->render('admin.footer') ?>
