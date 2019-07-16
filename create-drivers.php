<body>
<?php
require('header.php');
$plaquesTrucks = getTrucks();
$plaquesRemorques = getTrailers();

if(isset($_POST['send'])){
	insertDrivers($_POST['nom'], $_POST['prenom'], $_POST['ville'], $_POST['tracteur'], $_POST['remorque']);
	echo 'Le chauffeur '.$_POST['prenom'].' '.$_POST['nom'].' a été ajouté ! '; ?><a href="drivers.php">Retour</a><?php
}
else{ ?>
<form method="post" action="create-drivers.php">
	<table>
		<tr><td>Ajouter un chauffeur</td></tr>
		<tr><td>Nom</td>
			<td><input type="text" value="" name="nom">
			</td>
		</tr>
		<tr><td>Prénom</td>
			<td><input type="text" value="" name="prenom">
			</td>
		</tr>
		<tr><td>Ville</td>
			<td><input type="text" value="" name="ville">
			</td>
		</tr>
		<tr><td>Tracteur</td>
			<td><select name="tracteur">
				<?php while ($dataTracteur = $plaquesTrucks->fetch()){
					?><option value="<?php echo $dataTracteur['id'];?>"><?php echo 'T'.$dataTracteur['id'].' - '.$dataTracteur['plaque'];?></option>
				<?php
				}?>
				</select></td>
		</tr>
		<tr><td>Remorque</td>
			<td><select name="remorque">
				<?php while ($dataRemorque = $plaquesRemorques->fetch()){
					?><option value="<?php echo $dataRemorque['id'];?>"><?php echo 'R'.$dataRemorque['id'].' - '.$dataRemorque['id'].' - '.$dataRemorque['plaque'];?></option>
				<?php
				}?>
				</select></td>
		</tr>
		<tr><td><a href="drivers.php">Annuler</a>
			<td><input type="submit" name="send" value="Ajouter"></td>
		</tr>
	</table>
</form>


<?php } ?>
</body>
</html>
