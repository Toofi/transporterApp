<body>
<?php
require('header.php');

if(isset($_POST['send'])){
	insertTrailers($_POST['marque'], $_POST['modele'], $_POST['plaque'], $_POST['annee']);
	echo 'La remorque '.$_POST['plaque'].' a été ajoutée ! '; ?><a href="trailers.php">Retour</a><?php
}
else{ ?>
<form method="post" action="create-trailers.php">
	<table>
		<tr><td>Créer une remorque</td></tr>
		<tr><td>Marque</td>
			<td><input type="text" value="" name="marque">
			</td>
		</tr>
		<tr><td>Modèle</td>
			<td><select value="modele" name="modele">
				<option>Porte 5</option>
				<option>Porte 8</option>
				<option>Plateau</option>
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
		<tr><td></td>
			<td><input type="submit" value="Ajouter" name="send">
			</td>
		</tr>
	</table>
</form>
<?php } ?>

</body>
</html>