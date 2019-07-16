<body>

<?php
require('header.php');
$customers = getCustomers();
?>


<table>
	<tr class="description"><td>Clients</td>
		<td><a href="create-customers.php">Créer un client</a></td>
	</tr>
	<tr class="description"><td>ID</td>
		<td>Nom</td>
		<td>Adresse</td>
		<td>Téléphone</td>
		<td>Adresse e-mail</td>
		<td>Modifier</td>
		<td>Supprimer</td>
	</tr>
<?php while ($data = $customers->fetch()){?>
	<tr><td><a href="update-customers.php?id=<?php echo $data['id'];?>"><?php echo $data['id'];?></td>
		<td><?php echo $data['nom_client'];?></td>
		<td><?php echo $data['adresse'];?></td>
		<td><?php echo $data['telephone'];?></td>
		<td><?php echo $data['email'];?></td>
		<td><a href="update-customers.php?id=<?php echo $data['id'];?>">▲</a></td>
		<td><a href="delete-customers.php?id=<?php echo $data['id'];?>">▲</a></td>
	</tr>
<?php
}
?>
</table>
</body>
</html>