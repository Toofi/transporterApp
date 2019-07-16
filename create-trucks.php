<body>
<?php
require('header.php');
?>

<?php
if(isset($_POST['send'])){
	insertTrucks($_POST['marque'], $_POST['modele'], $_POST['plaque'], $_POST['annee']);
	echo 'Le tracteur '.$_POST['plaque'].' a été ajouté ! '; ?><a href="trucks.php">Retour</a><?php
}
else{ ?>
<form method="post" action="create-trucks.php">
	<table>
		<tr><td>Créer un tracteur</td></tr>
		<tr><td>Marque</td>
			<td><input type="text" value="" name="marque">
			</td>
		</tr>
		<tr><td>Modèle</td>
			<td><input type="text" value="" name="modele">
			</td>
		</tr>
		<tr><td>Plaque</td>
			<td><input type="text" valule="" name="plaque">
			</td>
		</tr>
		<tr><td>Année d'achat</td>
			<td><input type="text" value="" name="annee">
			</td>
		</tr>
		<tr><td><a href="trucks.php">Annuler</a></td>
			<td><input type="submit" value="Ajouter" name="send">
			</td>
		</tr>
	</table>
</form>
<?php } ?>

</body>
</html>