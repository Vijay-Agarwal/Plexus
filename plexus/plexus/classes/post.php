<?php
class Post extends User{
	protected $pdo;
	function __construct($pdo)
	{
		$this->pdo=$pdo;
	}
	public function allPost($id)
	{
		$stmt=$this->pdo->prepare("SELECT * FROM post where user_id in (SELECT friend_id from friend where user_id=:userid) order by post_id desc");
		$stmt->bindParam(":userid",$id,PDO::PARAM_STR);		
		$stmt->execute();
		$user=$stmt->fetchAll(PDO::FETCH_OBJ);
		return $user;
	}
	public function userPost($id)
	{
		$stmt=$this->pdo->prepare("SELECT * FROM post where user_id =:userid order by post_id desc");
		$stmt->bindParam(":userid",$id,PDO::PARAM_STR);		
		$stmt->execute();
		$user=$stmt->fetchAll(PDO::FETCH_OBJ);
		return $user;
	}
	public function newpost($status)
	{
		$stmt=$this->pdo->prepare("INSERT INTO post(user_id,message) values(:userid,:message) ");
		$stmt->bindParam(":userid",$_SESSION['user_id'],PDO::PARAM_STR);
		$stmt->bindParam(":message",$status,PDO::PARAM_STR);
		$stmt->execute();
		$postid=$this->pdo->lastInsertId();

		$stmt=$this->pdo->prepare("SELECT * FROM friend where friend_id=:friendid ");
		$stmt->bindParam(":friendid",$_SESSION['user_id'],PDO::PARAM_STR);		
		$stmt->execute();
		$result=$stmt->fetchAll(PDO::FETCH_OBJ);

		foreach($result as $user){
		$stmt=$this->pdo->prepare("INSERT into notification(user_id,friend_id,message,type,post_id) values(:userid,:friendid,:message,:type,:postid)");
		$message="Added a new post";
		$type=1;
		$stmt->bindParam(":userid",$user->user_id,PDO::PARAM_STR);
		$stmt->bindParam(":friendid",$_SESSION['user_id'],PDO::PARAM_STR);
		$stmt->bindParam(":message",$message,PDO::PARAM_STR);
		$stmt->bindParam(":type",$type,PDO::PARAM_STR);
		$stmt->bindParam(":postid",$postid,PDO::PARAM_STR);

		$stmt->execute();
		}
		return $postid;
	}
	public function deletePost($postid)
	{
		$stmt=$this->pdo->prepare("SELECT * FROM friend where friend_id=:friendid ");
		$stmt->bindParam(":friendid",$_SESSION['user_id'],PDO::PARAM_STR);		
		$stmt->execute();
		$result=$stmt->fetchAll(PDO::FETCH_OBJ);

		foreach($result as $user){
		$stmt=$this->pdo->prepare("DELETE from notification where user_id=:userid and friend_id=:friendid and type=:type and post_id=:postid");
		$type=1;
		$stmt->bindParam(":userid",$user->user_id,PDO::PARAM_STR);
		$stmt->bindParam(":friendid",$_SESSION['user_id'],PDO::PARAM_STR);
		$stmt->bindParam(":type",$type,PDO::PARAM_STR);
		$stmt->bindParam(":postid",$postid,PDO::PARAM_STR);
		$stmt->execute();

		}


		$stmt=$this->pdo->prepare("DELETE from notification where user_id=:userid and post_id=:postid");
		$stmt->bindParam(":userid",$_SESSION['user_id'],PDO::PARAM_STR);
		$stmt->bindParam(":postid",$postid,PDO::PARAM_STR);
		$stmt->execute();

		$stmt=$this->pdo->prepare("DELETE FROM post_like where post_id=:postid ");
		$stmt->bindParam(":postid",$postid,PDO::PARAM_STR);		
		$stmt->execute();

		$stmt=$this->pdo->prepare("DELETE FROM post_comment where post_id=:postid ");
		$stmt->bindParam(":postid",$postid,PDO::PARAM_STR);		
		$stmt->execute();

		$stmt=$this->pdo->prepare("DELETE FROM post_pic where post_id=:postid ");
		$stmt->bindParam(":postid",$postid,PDO::PARAM_STR);		
		$stmt->execute();

		$stmt=$this->pdo->prepare("DELETE from post where post_id=:postid");
		$stmt->bindParam(":postid",$postid,PDO::PARAM_STR);
		$stmt->execute();
		header('Location: profile.php?id='.$friendId);
	}
	public function viewPost($postid)
	{
		$stmt=$this->pdo->prepare("SELECT * FROM post where post_id =:postid ");
		$stmt->bindParam(":postid",$postid,PDO::PARAM_STR);		
		$stmt->execute();
		$user=$stmt->fetch(PDO::FETCH_OBJ);
		return $user;
	}
	public function postLike($postid)
	{
		$stmt=$this->pdo->prepare("INSERT into post_like values (:postid,:userid) ");
		$stmt->bindParam(":postid",$postid,PDO::PARAM_STR);		
		$stmt->bindParam(":userid",$_SESSION['user_id'],PDO::PARAM_STR);		
		$stmt->execute();
	}
	public function postLikeNotification($userid,$postid)
	{
		if($_SESSION['user_id']!=$userid){
			$stmt=$this->pdo->prepare("INSERT into notification(user_id,friend_id,message,type,post_id) values(:userid,:friendid,:message,:type,:postid)");
		$message="Liked your post";
		$type=2;
		$stmt->bindParam(":userid",$userid,PDO::PARAM_STR);
		$stmt->bindParam(":friendid",$_SESSION['user_id'],PDO::PARAM_STR);
		$stmt->bindParam(":message",$message,PDO::PARAM_STR);
		$stmt->bindParam(":type",$type,PDO::PARAM_STR);
		$stmt->bindParam(":postid",$postid,PDO::PARAM_STR);
		$stmt->execute();
		}
		
	}
	public function postUnlike($postid)
	{
		$stmt=$this->pdo->prepare("DELETE from post_like where post_id=:postid and user_id=:userid ");
		$stmt->bindParam(":postid",$postid,PDO::PARAM_STR);		
		$stmt->bindParam(":userid",$_SESSION['user_id'],PDO::PARAM_STR);		
		$stmt->execute();
	}
	public function postUnlikeNotification($userid,$postid)
	{
		if($_SESSION['user_id']!=$userid){
		$stmt=$this->pdo->prepare("DELETE from notification where user_id=:userid and friend_id=:friendid and type=:type and post_id=:postid");
		$type=2;
		$stmt->bindParam(":userid",$userid,PDO::PARAM_STR);		
		$stmt->bindParam(":postid",$postid,PDO::PARAM_STR);	
		$stmt->bindParam(":type",$type,PDO::PARAM_STR);	
		$stmt->bindParam(":friendid",$_SESSION['user_id'],PDO::PARAM_STR);		
		$stmt->execute();
		}
	}

	public function likeButton($postid)
	{
		$stmt=$this->pdo->prepare("SELECT * FROM post_like where post_id=:postid and user_id=:userid");
		$stmt->bindParam(":postid",$postid,PDO::PARAM_STR);
		$stmt->bindParam(":userid",$_SESSION['user_id'],PDO::PARAM_STR);				
		$stmt->execute();
		$count=$stmt->rowCount();
		return $count;
	}
	public function likeCount($postid)
	{
		$stmt=$this->pdo->prepare("SELECT * FROM post_like where post_id=:postid");
		$stmt->bindParam(":postid",$postid,PDO::PARAM_STR);		
		$stmt->execute();
		$count=$stmt->rowCount();
		return $count;
	}
	public function allLikes($postid)
	{
		$stmt=$this->pdo->prepare("SELECT * FROM post_like where post_id=:postid");
		$stmt->bindParam(":postid",$postid,PDO::PARAM_STR);		
		$stmt->execute();
		$user=$stmt->fetchAll(PDO::FETCH_OBJ);
		return $user;
	}
	public function commentCount($postid)
	{
		$stmt=$this->pdo->prepare("SELECT * FROM post_comment where post_id=:postid");
		$stmt->bindParam(":postid",$postid,PDO::PARAM_STR);		
		$stmt->execute();
		$count=$stmt->rowCount();
		return $count;
	}
	public function allComments($postid)
	{
		$stmt=$this->pdo->prepare("SELECT * FROM post_comment where post_id=:postid");
		$stmt->bindParam(":postid",$postid,PDO::PARAM_STR);		
		$stmt->execute();
		$user=$stmt->fetchAll(PDO::FETCH_OBJ);
		return $user;
	}
	public function postComment($postid,$comment)
	{
		$stmt=$this->pdo->prepare("INSERT into post_comment values (:postid,:userid,:message) ");
		$stmt->bindParam(":postid",$postid,PDO::PARAM_STR);		
		$stmt->bindParam(":userid",$_SESSION['user_id'],PDO::PARAM_STR);	
		$stmt->bindParam(":message",$comment,PDO::PARAM_STR);			
		$stmt->execute();
	}
	public function postCommentNotification($userid,$postid)
	{
		if($_SESSION['user_id']!=$userid){
			$stmt=$this->pdo->prepare("INSERT into notification(user_id,friend_id,message,type,post_id) values(:userid,:friendid,:message,:type,:postid)");
		$message="Commented your post";
		$type=3;
		$stmt->bindParam(":userid",$userid,PDO::PARAM_STR);
		$stmt->bindParam(":friendid",$_SESSION['user_id'],PDO::PARAM_STR);
		$stmt->bindParam(":message",$message,PDO::PARAM_STR);
		$stmt->bindParam(":type",$type,PDO::PARAM_STR);
		$stmt->bindParam(":postid",$postid,PDO::PARAM_STR);
		$stmt->execute();
		}	
	}
	public function newNotes($subject,$notes,$dep,$sem)
	{
		$stmt=$this->pdo->prepare("INSERT INTO post(user_id,message,type,dep,sem,notes_link) values(:userid,:subject,:type,:dep,:sem,:noteslink) ");
		$type=1;
		$stmt->bindParam(":userid",$_SESSION['user_id'],PDO::PARAM_STR);
		$stmt->bindParam(":subject",$subject,PDO::PARAM_STR);
		$stmt->bindParam(":type",$type,PDO::PARAM_STR);
		$stmt->bindParam(":dep",$dep,PDO::PARAM_STR);
		$stmt->bindParam(":sem",$sem,PDO::PARAM_STR);
		$stmt->bindParam(":noteslink",$notes,PDO::PARAM_STR);
		$stmt->execute();
		$postid=$this->pdo->lastInsertId();

		$stmt=$this->pdo->prepare("SELECT * FROM friend where friend_id=:friendid ");
		$stmt->bindParam(":friendid",$_SESSION['user_id'],PDO::PARAM_STR);		
		$stmt->execute();
		$result=$stmt->fetchAll(PDO::FETCH_OBJ);

		foreach($result as $user){
		$stmt=$this->pdo->prepare("INSERT into notification(user_id,friend_id,message,type,post_id) values(:userid,:friendid,:message,:type,:postid)");
		$message="Added new notes";
		$type=4;
		$stmt->bindParam(":userid",$user->user_id,PDO::PARAM_STR);
		$stmt->bindParam(":friendid",$_SESSION['user_id'],PDO::PARAM_STR);
		$stmt->bindParam(":message",$message,PDO::PARAM_STR);
		$stmt->bindParam(":type",$type,PDO::PARAM_STR);
		$stmt->bindParam(":postid",$postid,PDO::PARAM_STR);
		$stmt->execute();
		}
	}
	public function allNotes($dep,$sem)
	{
		$stmt=$this->pdo->prepare("SELECT * FROM post where type=:type and dep=:dep and sem=:sem order by post_id desc");
		$type=1;
		$stmt->bindParam(":type",$type,PDO::PARAM_STR);
		$stmt->bindParam(":dep",$dep,PDO::PARAM_STR);		
		$stmt->bindParam(":sem",$sem,PDO::PARAM_STR);				
		$stmt->execute();
		$user=$stmt->fetchAll(PDO::FETCH_OBJ);
		return $user;
	}
	public function getImage($postid)
	{
		$stmt=$this->pdo->prepare("SELECT * FROM post_pic where post_id=:postid");
		$stmt->bindParam(":postid",$postid,PDO::PARAM_STR);
		$stmt->execute();
		$count=$stmt->rowCount();
		$user=$stmt->fetch(PDO::FETCH_OBJ);
		if($count!=0)
		{
			return $user->postImage;
		}
	}
	public function uploadPostImage($file)
	{
		$filename=basename($file['name']);
		$fileTmp=$file['tmp_name'];
		$fileSize=$file['size'];
		$error=$file['error'];

		$ext=explode('.',$filename);
		$ext=strtolower(end($ext));
		$allowed_ext=array('jpg','png','jpeg');
		if(in_array($ext,$allowed_ext)===true){
			if($error===0){
				if($fileSize<=209272152){
					$fileRoot='images/'.$filename;
					move_uploaded_file($fileTmp,$fileRoot);
					return $fileRoot;
				}else{
					$GLOBALS['imageError']='The file size is too large';
				}
			}
		}else{
			$GLOBALS['imageError']='The extension is not allowed';
		}
	}
	public function insertImage($postid,$fileroot)
	{
		$stmt=$this->pdo->prepare("INSERT into post_pic(post_id,postImage) values (:postid,:fileroot)");
		$stmt->bindParam(":postid",$postid,PDO::PARAM_STR);
		$stmt->bindParam(":fileroot",$fileroot,PDO::PARAM_STR);
		$stmt->execute();
		
	}

}
?>