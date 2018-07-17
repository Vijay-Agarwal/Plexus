<?php
class Follow extends User{
	protected $pdo;
	function __construct($pdo)
	{
		$this->pdo=$pdo;
	}
	public function addFriend($friendId)
	{
		$stmt=$this->pdo->prepare("INSERT into friend(user_id,friend_id) values(:userid,:friendid)");
		$stmt->bindParam(":userid",$_SESSION['user_id'],PDO::PARAM_STR);
		$stmt->bindParam(":friendid",$friendId,PDO::PARAM_STR);	
		$stmt->execute();
		$stmt=$this->pdo->prepare("INSERT into notification(user_id,friend_id,message) values(:userid,:friendid,:message)");
		$message="Started Following You.";
		$stmt->bindParam(":userid",$friendId,PDO::PARAM_STR);
		$stmt->bindParam(":friendid",$_SESSION['user_id'],PDO::PARAM_STR);
		$stmt->bindParam(":message",$message,PDO::PARAM_STR);
		$stmt->execute();
		header('Location: profile.php?id='.$friendId);
	}
	public function removeFriend($friendId)
	{
		$stmt=$this->pdo->prepare("DELETE from friend where user_id=:userid and friend_id=:friendid");
		$stmt->bindParam(":userid",$_SESSION['user_id'],PDO::PARAM_STR);
		$stmt->bindParam(":friendid",$friendId,PDO::PARAM_STR);	
		$stmt->execute();
		#delete my follow unfollow notifications in friend's table
		$stmt=$this->pdo->prepare("DELETE from notification where user_id=:userid and friend_id=:friendid and type=:type");
		$stmt->bindParam(":userid",$friendId,PDO::PARAM_STR);
		$stmt->bindParam(":friendid",$_SESSION['user_id'],PDO::PARAM_STR);
		$type=0;
		$stmt->bindParam(":type",$type,PDO::PARAM_STR);

		$stmt->execute();
		#delete friend's notifications in my table
		$stmt=$this->pdo->prepare("DELETE from notification where user_id=:userid and friend_id=:friendid and type=:type");
		$stmt->bindParam(":userid",$_SESSION['user_id'],PDO::PARAM_STR);
		$stmt->bindParam(":friendid",$friendId,PDO::PARAM_STR);
		$type=1;
		$stmt->bindParam(":type",$type,PDO::PARAM_STR);

		$stmt->execute();
		$stmt=$this->pdo->prepare("DELETE from notification where user_id=:userid and friend_id=:friendid and type=:type");
		$stmt->bindParam(":userid",$_SESSION['user_id'],PDO::PARAM_STR);
		$stmt->bindParam(":friendid",$friendId,PDO::PARAM_STR);
		$type=4;
		$stmt->bindParam(":type",$type,PDO::PARAM_STR);

		$stmt->execute();
		
		header('Location: profile.php?id='.$friendId);	
		
	}
	public function getFollowing($id)
	{
		$stmt=$this->pdo->prepare("SELECT * FROM friend where user_id=:userid ");
		$stmt->bindParam(":userid",$id,PDO::PARAM_STR);		
		$stmt->execute();
		$user=$stmt->fetchAll(PDO::FETCH_OBJ);
		return $user;
	}
	public function getFollowers($id)
	{
		$stmt=$this->pdo->prepare("SELECT * FROM friend where friend_id=:friendid ");
		$stmt->bindParam(":friendid",$id,PDO::PARAM_STR);		
		$stmt->execute();
		$user=$stmt->fetchAll(PDO::FETCH_OBJ);
		return $user;
	}
}
?>