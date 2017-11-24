<?php
class session
{
  private $id,$name;
  public function register($name,$passw)
  {
    global $bdd;
		$reponse = $bdd->prepare('INSERT INTO `user`(`name`, `mdp`) VALUES (:name, :mdp)');
		$reponse->bindValue(':name',$name,PDO::PARAM_STR);
		$options = ['cost' => 12,];
		$reponse->bindValue(':mdp',password_hash($passw, PASSWORD_BCRYPT, $options),PDO::PARAM_STR);
		$reponse->execute();
		$reponse->closeCursor();
		$_SESSION['id'] = $bdd->lastInsertId();
		$_SESSION['name'] = $name;
    $_SESSION['msg'] = $_SESSION['formname'] = '';
    header('Location: /');
  }
  public function login($name,$passw)
  {
    global $bdd;
		$reponse = $bdd->prepare('SELECT * FROM `user` WHERE `name`=:name');
		$reponse->bindValue(':name',$name,PDO::PARAM_STR);
		$reponse->execute();
    if($donnees = $reponse->fetch())
		{
			if(password_verify($passw, $donnees['mdp']))
			{
				$_SESSION['id'] = $donnees['uid'];
				$_SESSION['name'] = $name;
				header('Location: /');
				$_SESSION['msg'] = $_SESSION['formname'] = '';
			}
			else
      {
      $_SESSION['msg'] = 'bad pass';
      $_SESSION['formname'] =  htmlentities($name);
      header('Location: /session.php');
      }
		}
		else
    {
      $_SESSION['msg'] = 'user not fund';
      $_SESSION['formname'] =  htmlentities($name);
      header('Location: /session.php');
    }
		$reponse->closeCursor();
  }
  public function logout()
  {session_destroy();header('Location: /');}
}
