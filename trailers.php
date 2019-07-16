<body>

<?php
require('header.php');
$trailers = getTrailers();
?>

<table>
	<tr class="description"><td>Remorques</td>
		<td><a href="create-trailers.php">Créer une remorque</a></td>
	</tr>
	<tr class="description"><td>ID</td>
		<td>Marque</td>
		<td>Modèle</td>
		<td>Plaque</td>
		<td>Année</td>
		<td>Modifier</td>
		<td>Supprimer</td>
	</tr>
<?php while ($data = $trailers->fetch()){?>
	<tr><td><a href="update-trailers.php?id=<?php echo $data['id'];?>"><?php echo $data['id'];?></a></td>
		<td><?php echo $data['marque'];?></td>
		<td><?php echo $data['modele'];?></td>
		<td><?php echo $data['plaque'];?></td>
		<td><?php echo $data['annee'];?></td>
		<td><a href="update-trailers.php?id=<?php echo $data['id'];?>">▲</a></td>
		<td><a href="delete-trailers.php?id=<?php echo $data['id'];?>">E</a></td>
	</tr>
<?php
}
?>
</table>
</body>
</html>