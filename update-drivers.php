<body>

<?php
require('header.php');
$driver = getDriver($_GET['id']);
$plaquesTrucks = getTrucks();
$plaquesRemorques = getTrailers();
?>

<?php 
if (isset($_POST['send'])){
	updateDrivers($_GET['id'], $_POST['nom'], $_POST['prenom'], $_POST['ville'], $_POST['tracteur'], $_POST['remorque']);
?>La base de données a été modifiée ! <a href="drivers.php">Retour</a>
<?php }

else { ?>
<form method="post" action="update-drivers.php?id=<?php echo $_GET['id'];?>">
<table>
	<tr><td>Chauffeur</td>
	</tr>
	<tr><td>Nom</td>
		<td><input type="text" value="<?php echo $driver['nom_chauffeur'];?>" name="nom"></td>
	</tr>
	<tr><td>Prénom</td>
		<td><input type="text" value="<?php echo $driver['prenom_chauffeur'];?>" name="prenom"></td>
	</tr>
	<tr><td>Ville</td>
		<td><input type="text" value="<?php echo $driver['ville'];?>" name="ville"></td>
	</tr>
	<?php /* $_POST['remorque']=3; $_POST['tracteur']=3; echo $_POST['remorque']; echo $_POST['tracteur'];*/ ?>
	<tr><td>Tracteur</td>
		<td><select name="tracteur">
			<?php while ($dataTracteur = $plaquesTrucks->fetch()){
				?><option value="<?php echo $dataTracteur['id'];?>" <?php if ($dataTracteur['plaque']==$driver['plaque_tracteur']){ echo "selected='selected'";}?>><?php echo 'T'.$dataTracteur['id'].' - '.$dataTracteur['plaque'];?></option>
			<?php
			}?>
			</select></td>
	</tr>
	<tr><td>Remorques</td>
		<td><select name="remorque">
			<?php while ($dataRemorque = $plaquesRemorques->fetch()){
				?><option value="<?php echo $dataRemorque['id'];?>" <?php if ($dataRemorque['plaque']==$driver['plaque_remorque']){ echo "selected='selected'";}?>><?php echo 'R'.$dataRemorque['id'].' - '.$dataRemorque['plaque'];?></option>
			<?php
			}?>
			</select></td>
	</tr>
	<tr><td></td>
		<td><input type="submit" name="send" value="Modifier"></td>
	</tr>
</table>
</form>

<a href="drivers.php">Retour à la liste des chauffeurs</a>


<?php } ?>
</body>
</html>