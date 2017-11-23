<?php 
session_start();
include("asset/bdd.php");
include("asset/class.php");
?>
<!doctype html>
<html lang="fr">
	<?php include("./asset/head.php"); ?>
	<body>
		<?php include("./asset/header.php"); ?>
		<main>
			<?php
			$l = new msglist();
			$l->ech();
			?>
		</main>
		<?php include("./asset/footer.php"); ?>
	</body>
</html>
