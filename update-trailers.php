<body>

<?php
require('header.php');

$trailer = getTrailer($_GET['id']);
//créer une table modele remorques? Pour avoir un while dans le formulaire
?>
<?php
	if (isset($_POST['send'])){
		updateTrailers($_GET['id'], $_POST['marque'], $_POST['modele'], $_POST['plaque'], $_POST['annee']);
?>La base de données a bien été modifiée ! <a href="trailers.php">Retour</a>
<?php }
else { ?>
<form method="post" action="update-trailers.php?id=<?php echo $trailer['id'];?>">
	<table>
		<tr><td>Remorques</td></tr>
		<tr><td>Numéro de la remorque</td>
			<td>R<?php echo $trailer['id'];?></td>
		</tr>
		<tr><td>Marque</td>
			<td><input type="text" value="<?php echo $trailer['marque'];?>" name="marque"></td>
		</tr>
		<tr><td>Modèle</td>
			<td><select value="modele" name="modele">
				<option>Porte 5</option>
				<option>Porte 8</option>
				<option>Plateau</option>
			</td>
		</tr>
		<tr><td>Plaque d'immatriculation</td>
			<td><input type="text" value="<?php echo $trailer['plaque'];?>" name="plaque"></td>
		</tr>
		<tr><td>Année d'achat</td>
			<td><input type="text" value="<?php echo $trailer['annee'];?>" name="annee"></td>
		</tr>
		<tr><td></td>
			<td><input type="submit" value="Modifier" name="send"></td>
		</tr>
	</table>
</form>
<a href="trailers.php">Annuler</a>
<?php } ?>
</body>
</html>