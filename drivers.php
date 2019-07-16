<body>

<?php
require('header.php');
$drivers = getDrivers();

?>

<table>
	<tr class="description"><td>Chauffeurs</td>
		<td><a href="create-drivers.php">Ajouter un chauffeur</a></td>
	</tr>
	<tr class="description"><td>ID</td>
		<td>Nom</td>
		<td>Prénom</td>
		<td>Ville</td>
		<td>Tracteur</td>
		<td>Remorque</td>
		<td>Modifier</td>
		<td>Supprimer</td>
	</tr>
<?php while ($data = $drivers->fetch()){?>
	<tr><td><a href="update-drivers.php?id=<?php echo $data['id_chauffeur'];?>"><?php echo $data['id_chauffeur'];?></a></td>
		<td><?php echo $data['nom_chauffeur'];?></td>
		<td><?php echo $data['prenom_chauffeur'];?></td>
		<td><?php echo $data['ville'];?></td>
		<td><?php echo $data['plaque_tracteur'];?></td>
		<td><?php echo $data['plaque_remorque'];?></td>
		<td><a href="update-drivers.php?id=<?php echo $data['id_chauffeur'];?>">▲</a></td>
		<td><a href="delete-drivers.php?id=<?php echo $data['id_chauffeur'];?>">▲</a></td>
	</tr>


<?php
}
?>
</table>
</body>
</html>