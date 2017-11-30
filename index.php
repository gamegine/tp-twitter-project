<?php 
session_start();
include("asset/bdd.php");
include("asset/class.php");
if(isset($_POST))
{
	$post=new msgf();
	if(isset($_POST['post']))
	{$post->post(htmlentities($_POST['post']));}
	elseif(isset($_POST['likeid'])){$post->like($_POST['likeid']);}
}
if(isset($_GET['uid'])){$l = new msglist(htmlentities($_GET['uid']));}
else{$l = new msglist();}
?>
<!doctype html>
<html lang="fr">
	<?php include("./asset/head.php"); ?>
	<body>
		<?php include("./asset/header.php"); ?>
		<main>
			<?php $l->ech(); ?>
			<form method="post">
				<fieldset>
					<legend>post</legend>
					<textarea name="post" maxlength="255" rows="4" cols="50" autofocus></textarea>
					<input type="submit" value="Submit">
				</fieldset>
			</form>
		</main>
		<?php include("./asset/footer.php"); ?>
	</body>
</html>
