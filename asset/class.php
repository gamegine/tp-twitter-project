class msg
{
  private $id,$author,$msg;
  public function __construct($id,$author,$msg)
  {
    $this->id = $id;
    $this->author = $author;
    $this->msg = htmlentities($msg);
  }
  public function ech()
  { echo "<div>".$this->author."<p>".htmlentities($this->msg)."</p></div>"; }
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
