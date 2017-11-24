<?php
class user
{
  private $id,$name;
  public function __construct($id)
  {
    $this->msg = array();
    global $bdd;
    $reponse = $bdd->prepare('SELECT `uid`,`name` FROM `user` where uid = :uid');
	$reponse->bindValue(':uid',intval($id),PDO::PARAM_INT);
    $reponse->execute();
    $donnees = $reponse->fetch();
    $this->id=$donnees['uid'];
    $this->name=htmlentities($donnees['name']);
    $reponse->closeCursor();
  }
  public function ech()
  { echo '<a>'.htmlentities($this->name).'</a>'; }
}
class msg
{
  private $id,$author,$msg;
  public function __construct($id,$authorid,$msg)
  {
    $this->id = $id;
    $this->author = new user($authorid);
    $this->msg = htmlentities($msg);
  }
  public function ech()
  { echo "<div>";$this->author->ech();echo"<p>".htmlentities($this->msg)."</p></div>"; }
}
class msglist
{
  private $msg;
  public function __construct()
  {
    global $bdd;
    $this->msg = array();
    global $bdd;
    $reponse = $bdd->prepare('SELECT * FROM `tw`');
    $reponse->execute();
    while ($donnees = $reponse->fetch())
    { array_push( $this->msg, new msg( $donnees['id'] , new user($donnees['uid']) , $donnees['txt'] ) ); }
    $reponse->closeCursor();
  }
  public function ech()
  { foreach ($this->msg as &$m) {$m->ech();} }
}
class msgf
{
  public function post($msg)
  {
	if(isset($_SESSION['id']))
	{
		global $bdd;
		$reponse = $bdd->prepare('INSERT INTO `tw`(`uid`, `txt`) VALUES (:uid, :txt)');
		$reponse->bindValue(':uid',$_SESSION['id'],PDO::PARAM_STR);
		$reponse->bindValue(':txt',htmlentities($msg),PDO::PARAM_STR);
		$reponse->execute();
		$reponse->closeCursor();
		$_SESSION['postmsg']='';
		header( "refresh:0;url=/" );
	}
	else
	{
		header('Location: /session.php');
		$_SESSION['postmsg']=htmlentities($msg);
	}
  }
}
