<body>

<?php
require('header.php');


if (isset($_GET['tri'])){
	$trucks = getTrucksByOrder($_GET['tri']);
}
else{
	$trucks = getTrucks();
}
?>

<table>
	<tr class="description"><td>Camions</td>
		<td><a href="create-trucks.php">Ajouter un tracteur</a></td>
	</tr>
	<tr class="description"><td><a href="trucks.php?tri=id">ID</a></td>
		<td><a href="trucks.php?tri=marque">Marque</a></td>
		<td><a href="trucks.php?tri=modele">Modèle</a></td>
		<td><a href="trucks.php?tri=plaque">Plaque</a></td>
		<td><a href="trucks.php?tri=annee">Année</a></td>
		<td>Modifier</td>
		<td>Supprimer</td>
	</tr>
<?php while ($data = $trucks->fetch()){?>
	<tr><td><a href="update-trucks.php?id=<?php echo $data['id'];?>"><?php echo $data['id'];?></a></td>
		<td><?php echo $data['marque'];?></td>
		<td><?php echo $data['modele'];?></td>
		<td><?php echo $data['plaque'];?></td>
		<td><?php echo $data['annee'];?></td>
		<td><a href="update-trucks.php?id=<?php echo $data['id'];?>">¶</a></td>
		<td><a href="delete-trucks.php?id=<?php echo $data['id'];?>">¶</a></td>
	</tr>






<?php
}
?>