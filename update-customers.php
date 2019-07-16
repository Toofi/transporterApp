<body>

<?php
require('header.php');

$customer = getCustomer($_GET['id']);

?>

<?php
if (isset($_POST['send'])){
	updateCustomers($_GET['id'], $_POST['nom'], $_POST['adresse'], $_POST['telephone'], $_POST['email']);
?>La base de données a été modifiée !<a href="customers.php">Retour</a>
<?php }

else { ?>
<form method="post" action="update-customers.php?id=<?php echo $_GET['id'];?>">
	<table>
		<tr><td>Clients</td></tr>
		<tr><td>Numéro de client</td>
			<td><?php echo $customer['id'];?></td>
		</tr>
		<tr><td>Nom du client</td>
			<td><input type="text" value="<?php echo $customer['nom_client'];?>" name="nom"></td>
		</tr>
		<tr><td>Adresse</td>
			<td><input type="text" value="<?php echo $customer['adresse'];?>" name="adresse"></td>
		</tr>
		<tr><td>Téléphone</td>
			<td><input type="text" value="<?php echo $customer['telephone'];?>" name="telephone"></td>
		</tr>
		<tr><td>E-mail</td>
			<td><input type="email" value="<?php echo $customer['email'];?>" name="email"></td>
		</tr>
		<tr><td></td>
			<td><input type="submit" value="Modifier" name="send"></td>
		</tr>
	</table>
</form>
<a href="customers.php">Retour à la liste des clients</a>
<?php } ?>
</body>
</html>