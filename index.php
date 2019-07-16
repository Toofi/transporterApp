<body>
<?php
require('header.php');
$commands = getOrders();
?>
<table>
	<tr class="description"><td>Commandes</td>
		<td><a href="create-orders.php">Ajouter une commande</a></td>
	</tr>
	<tr class="description"><td>ID</td>
		<td>Marque</td>
		<td>Modèle</td>
		<td>Plaque</td>
		<td>Client</td>
		<td>Adresse de chargement</td>
		<td>Adresse de livraison</td>
		<td>Date de chargement prévue</td>
		<td>Heure de chargement prévue</td>
		<td>Date de livraison prévue</td>
		<td>Heure de livraison prévue</td>
		<td>Date de chargement</td>
		<td>Heure de chargement</td>
		<td>Date de livraison</td>
		<td>Heure de livraison</td>
		<td>Chauffeur au chargement</td>
		<td>Chauffeur à la livraison</td>
		<td>Remarque</td>
		<td>Modifier</td>
		<td>Supprimer</td>
	</tr>
<?php while ($data = $commands->fetch()){?>
		<tr><td><a href="update-orders.php?id=<?php echo $data['id_commande'];?>"><?php echo $data['id_commande'];?></a></td>
			<td><?php echo $data['marque'];?></td>
			<td><?php echo $data['modele'];?></td>
			<td><?php echo $data['plaque'];?></td>
			<td><?php echo $data['nom_client'];?></td>
			<td><?php echo $data['adresse_chargement'];?></td>
			<td><?php echo $data['adresse_livraison'];?></td>
			<td><?php echo $data['date_chargement'];?></td>
			<td><?php echo $data['heure_chargement'];?></td>
			<td><?php echo $data['date_livraison'];?></td>
			<td><?php echo $data['heure_livraison'];?></td>
			<td><?php echo $data['date_chargee'];?></td>
			<td><?php echo $data['heure_chargee'];?></td>
			<td><?php echo $data['date_livree'];?></td>
			<td><?php echo $data['heure_livree'];?></td>
			<td><?php echo $data['chauffeur_chargement'];?></td>
			<td><?php echo $data['chauffeur_livraison'];?></td>
			<td><?php echo $data['remarque'];?></td>
			<td><a href="update-orders.php?id=<?php echo $data['id_commande'];?>"><center>▲</center></a></td>
			<td><a href="delete-orders.php?id=<?php echo $data['id_commande'];?>"><center>▲</center></a></td>
		</tr>
<?php } ?>
</body>
</html>