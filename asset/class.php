<?php
	class user
	{
		private $id,$name;
		public function __construct($id)
		{
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
		{ echo '<a href="/?uid='.$this->id.'">'.htmlentities($this->name).'</a>'; }
	}
	class msg
	{
		private $id,$author,$msg,$nl;
		public function __construct($id,$authorid,$msg,$nl)
		{
			$this->id = $id;
			$this->author = $authorid;
			$this->msg = htmlentities($msg);
			$this->nl = $nl;
		}
		public function ech()
		{ echo"<div>";$this->author->ech();echo"<p>".htmlentities($this->msg).'</p><p>'.$this->nl.' likes<form method="post"><input type="hidden" name="likeid"value="'.$this->id.'"><input type="submit" value="like"></form></p></div>'; }
	}
	class msglist
	{
		private $msg;
		public function __construct()
		{
			$this->msg = array();
			global $bdd;
			if (func_num_args())
			{
			$reponse = $bdd->prepare('SELECT * FROM `twitt` WHERE `uid`=:uid');
			$reponse->bindValue(':uid',intval(func_get_args()[0]),PDO::PARAM_INT);
			}
			else{$reponse = $bdd->prepare('SELECT * FROM `twitt`');}
			$reponse->execute();
			while ($donnees = $reponse->fetch())
			{
				$l= $bdd->prepare('SELECT COUNT(*) AS L FROM `like` WHERE `mid`=:mid');
				$l->bindValue(':mid',$donnees['id'],PDO::PARAM_INT);
				$l->execute();
				$nl=$l->fetch()[0];
				$l->closeCursor();
				array_push( $this->msg, new msg( $donnees['id'] , new user($donnees['uid']) , $donnees['txt'] ,$nl) );
			}
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
				$reponse = $bdd->prepare('INSERT INTO `twitt`(`uid`, `txt`) VALUES (:uid, :txt)');
				$reponse->bindValue(':uid',$_SESSION['id'],PDO::PARAM_INT);
				$reponse->bindValue(':txt',htmlentities($msg),PDO::PARAM_STR);
				$reponse->execute();
				$reponse->closeCursor();
				$_SESSION['postmsg']='';
				header( "refresh:0;url=/" );
			}
			else
			{
				header('Location: /session.php');
				$_SESSION['postmsg']='not_connected';
			}
		}
		public function like($mid)
		{
			if(isset($_SESSION['id']))
			{
				global $bdd;
				$reponse = $bdd->prepare('SELECT * FROM `like` where uid = :uid AND `mid` = :mid');
				$reponse->bindValue(':uid',$_SESSION['id'],PDO::PARAM_STR);
				$reponse->bindValue(':mid',htmlentities($mid),PDO::PARAM_STR);
				$reponse->execute();
				if($donnees = $reponse->fetch())
				{
					$reponse->closeCursor();
					$reponse = $bdd->prepare('DELETE FROM `like` WHERE `uid`=:uid AND `mid`=:mid');
					$reponse->bindValue(':uid',$_SESSION['id'],PDO::PARAM_STR);
					$reponse->bindValue(':mid',htmlentities($mid),PDO::PARAM_STR);
					$reponse->execute();
					$reponse->closeCursor();
				}
				else
				{
					$reponse->closeCursor();
					$reponse = $bdd->prepare('INSERT INTO `like`(`uid`, `mid`) VALUES (:uid, :mid)');
					$reponse->bindValue(':uid',$_SESSION['id'],PDO::PARAM_STR);
					$reponse->bindValue(':mid',htmlentities($mid),PDO::PARAM_STR);
					$reponse->execute();
					$reponse->closeCursor();
				}
				$_SESSION['postmsg']='';
				header( "refresh:0;url=/" );
			}
			else
			{
				header('Location: /session.php');
				$_SESSION['postmsg']='not_connected';
			}
		}
	}
