<body>
<?php
require('header.php');

if(isset($_POST['send'])){
	insertCustomers($_POST['nom'], $_POST['adresse'], $_POST['telephone'], $_POST['email']);
	echo 'Le client '.$_POST['nom'].' a été ajouté ! '; ?><a href="customers.php">Retour</a><?php
}
else{ ?>
<form method="post" action="create-customers.php">
	<table>
		<tr><td>Créer un client</td></tr>
		<tr><td>Nom</td>
			<td><input type="text" value="" name="nom">
			</td>
		</tr>
		<tr><td>Adresse</td>
			<td><input type="text" value="" name="adresse">
			</td>
		</tr>
		<tr><td>Téléphone</td>
			<td><input type="text" valule="" name="telephone">
			</td>
		</tr>
		<tr><td>Adresse e-mail</td>
			<td><input type="email" value="" name="email">
			</td>
		</tr>
		<tr><td><a href="customers.php">Annuler</a></td>
			<td><input type="submit" value="Ajouter" name="send">
			</td>
		</tr>
	</table>
</form>
<?php } ?>

</body>
</html>