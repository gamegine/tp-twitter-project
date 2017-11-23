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
  {
  echo "<div>".$this->author."<p>".htmlentities($this->msg)."</p></div>";
  }
}
