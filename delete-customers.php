<body>
<?php
require('header.php');

?>
<?php
if(isset($_POST['send'])){
	if($_POST['YN']=="Y"){
		deleteCustomers($_GET['id']);
		echo 'Le tracteur a été supprimé!';
	}
	elseif($_POST['YN']=="N"){
		?><a href="customers.php">Retour</a><?php
	}
	else{
		echo 'Ce n\'est pas une bonne réponse ! Répondez par Y ou N !';
	}
}


else { ?>
Etes-vous sûr de vouloir supprimer ? (Y/N)
<form method="POST" action="delete-customers.php?id=<?php echo $_GET['id'];?>">
	<input type="text" value="" name="YN">
	<input type="submit" value="Valider" name="send">
</form>
<?php } ?>

</body>
</html>