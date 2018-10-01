<?= $renderer->render('header') ?>

<h1>Tous les commerces</h1>

<table class="table">
	<thead>
	<tr>
		<th>ID</th>
		<th>Name</th>
		<th>Address</th>
		<th>Actions</th>
	</tr>
	</thead>
	<tbody>
	<?php foreach($shops as $shop): ?>
	<tr>
		<td><?= $shop->id ?></td>
		<td><a href="/shop/edit?id=<?= $shop->id ?>"><?= $shop->name ?></a></td>
		<td><?= $shop ?></td>
		<td>
			<a href="/shop/edit?id=<?= $shop->id ?>" class="btn btn-success">Editer</a>
			<form action="/shop/delete?id=<?= $shop->id ?>" method="post" class="form-delete">
				<button class="btn btn-danger">Supprimer</button>
			</form>
		</td>
	</tr>
	<?php endforeach; ?>
	</tbody>
</table>

<?= $renderer->render('footer') ?>
