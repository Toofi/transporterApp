<body>
<?php
require('header.php');
$truck = getTruck($_GET['id']);
?>

<?php
if (isset($_POST['send'])){
	updateTrucks($_GET['id'], $_POST['marque'], $_POST['modele'], $_POST['plaque'], $_POST['annee']);
?>La base de données a été modifiée ! <a href="trucks.php">Retour</a>
<?php }
else { ?>
<form method="post" action="update-trucks.php?id=<?php echo $truck['id'];?>">
	<table>
		<tr><td>Camions</td></tr>
		<tr><td>Numéro du camion</td>
			<td>C<?php echo $truck['id'];?></td>
		</tr>
		<tr><td>Marque</td>
			<td><input type="text" value="<?php echo $truck['marque'];?>" name="marque"></td>
		</tr>
		<tr><td>Modèle</td>
			<td><input type="text" value="<?php echo $truck['modele'];?>" name="modele"></td>
		</tr>
		<tr><td>Plaque d'immatriculation</td>
			<td><input type="text" value="<?php echo $truck['plaque'];?>" name="plaque"></td>
		</tr>
		<tr><td>Année d'achat</td>
			<td><input type="text" value="<?php echo $truck['annee'];?>" name="annee"></td>
		</tr>
		<tr><td></td>
			<td><input type="submit" value="Modifier" name="send"></td>
		</tr>
	</table>
</form>

<a href="trucks.php">Annuler</a>

<?php } ?>
</body>
</html>