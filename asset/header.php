<header>
	<nav>
		<ul>
			<li><a href="/">accueil</a></li>
		</ul>
		<?php
		if(!isset($_SESSION['id']))
		{
			echo'<li>
					<form method="post" action="/session.php">
						<input type="text" name="uname">
						<input type="password" name="passw">
						<input type="hidden" name="a" value="l">
						<input type="submit" value="Submit">
					</form>
				</li>
				<li><a href="/session.php">register</a></li>';
		}
		else
		{
			echo '<li><a>'.$_SESSION['name'].'</a></li>
			<li><a href="/session.php">logout</a></li>';
		}
		?>
	</nav>
</header>
