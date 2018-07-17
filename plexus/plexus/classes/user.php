<?php
class User{
	protected $pdo;
	function __construct($pdo)
	{
		$this->pdo=$pdo;
	}
	public function checkInput($var)
	{
		$var=htmlspecialchars($var);
		$var=trim($var);
		$var=stripcslashes($var);
		return $var;
	} 
	public function login($email,$password)
	{
		$stmt=$this->pdo->prepare("SELECT user_id FROM users WHERE email = :email AND password = :password ");
		$stmt->bindParam(":email",$email,PDO::PARAM_STR);
		$stmt->bindParam(":password",$password,PDO::PARAM_STR);
		$stmt->execute();
		$user=$stmt->fetch(PDO::FETCH_OBJ );
		$count=$stmt->rowCount(); 
		if($count>0)
		{
			$_SESSION['user_id'] = $user->user_id;
			$stmt=$this->pdo->prepare("UPDATE  users SET active = '1' WHERE email = :email ");
			$stmt->bindParam(":email",$email,PDO::PARAM_STR);
			$stmt->execute();
			header('Location: home.php');


		}else{
			return false;
		}

	}
	public function update($table,$user_id,$fields=array()){
		
		$columns='';
		$i=1;
		foreach($fields as $name=>$value){
			$columns.="{$name}=:{$name}";
			if($i<count($fields)){
				$columns.=', ';
			}
			$i++;
		}
		$sql="UPDATE {$table} SET {$columns} WHERE user_id={$user_id}";
		if($stmt=$this->pdo->prepare($sql)){
			foreach($fields as $key=>$value){
				$stmt->bindValue(':'.$key,$value);

			}
			$stmt->execute();
		}
	}


	public function userData($user_id)
	{
		$stmt=$this->pdo->prepare("SELECT * FROM users WHERE user_id = :user_id ");
		$stmt->bindParam(":user_id",$user_id,PDO::PARAM_STR);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_OBJ);

	}
	public function logout(){
		$stmt=$this->pdo->prepare("UPDATE  users SET active = '0' WHERE user_id = {$_SESSION['user_id']} ");
			$stmt->execute();
		$_SESSION=array();
		session_destroy();
		header('Location: index.php');

	}
	public function checkEmail($email)
	{
		$stmt=$this->pdo->prepare("SELECT email FROM users WHERE email = :email ");
		$stmt->bindParam(":email",$email,PDO::PARAM_STR);
		$stmt->execute();
		$count=$stmt->rowCount();
		if($count>0){
			return true;
		}
		else{
			return false;
		}
	}
	public function loggedIn(){

		return (isset($_SESSION['user_id']))? true:false;

	}	

	public function register($name,$email,$password,$mobile,$dob){
		$stmt=$this->pdo->prepare("INSERT INTO users(name,email,password,dob,mobile,profileImage) VALUES (:name,:email,:password,:dob,:mobile,:profileImage)");
		$profileImage='images/alphabet/'.strtolower($name[0]).'.jpeg';
		$stmt->bindParam(":email",$email,PDO::PARAM_STR);
		$stmt->bindParam(":name",$name,PDO::PARAM_STR);
		$stmt->bindParam(":password",$password,PDO::PARAM_STR);
		$stmt->bindParam(":mobile",$mobile,PDO::PARAM_STR);
		$stmt->bindParam(":profileImage",$profileImage,PDO::PARAM_STR);
		$stmt->bindParam(":dob",$dob,PDO::PARAM_STR);
		$stmt->execute();
		$user_id=$this->pdo->lastInsertId();
		$_SESSION['user_id']=$user_id;
		$stmt=$this->pdo->prepare("UPDATE  users SET active = '1' WHERE user_id = :userid ");
		$stmt->bindParam(":userid",$user_id,PDO::PARAM_STR);
		$stmt->execute();
	}
	public function userIdByUserName($username){
		$stmt=$this->pdo->prepare("SELECT user_id FROM users WHERE name = :username ");
		$stmt->bindParam(":username",$username,PDO::PARAM_STR);
		$stmt->execute();
		$user=$stmt->fetch(PDO::FETCH_OBJ);
		return $user->user_id;
	}
	public function uploadImage($file)
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
	public function search($search)
	{
		$stmt=$this->pdo->prepare("SELECT * FROM users WHERE name LIKE '{$search}' ");
		// $stmt->bindParam(":str",$search,PDO::PARAM_STR);
		$stmt->execute();
		$user=$stmt->fetchAll(PDO::FETCH_OBJ);
		return $user;
	}
	public function friend($id)
	{
		$stmt=$this->pdo->prepare("SELECT * FROM friend where user_id=:userid and friend_id=:id");
		$stmt->bindParam(":userid",$_SESSION['user_id'],PDO::PARAM_STR);
		$stmt->bindParam(":id",$id,PDO::PARAM_STR);
		$stmt->execute();
		$count=$stmt->rowCount();
		if($count>0)
			return true;
		else 
			return false;
	}
	public function following($userid)
	{
		$stmt=$this->pdo->prepare("SELECT * FROM friend where user_id=:userid");
		$stmt->bindParam(":userid",$userid,PDO::PARAM_STR);		
		$stmt->execute();
		$count=$stmt->rowCount();
		return $count;
	}
	public function followers($userid)
	{
		$stmt=$this->pdo->prepare("SELECT * FROM friend where friend_id=:userid");
		$stmt->bindParam(":userid",$userid,PDO::PARAM_STR);		
		$stmt->execute();
		$count=$stmt->rowCount();
		return $count;
	}
	public function notification()
	{
		$stmt=$this->pdo->prepare("SELECT * FROM notification where user_id=:userid");
		$stmt->bindParam(":userid",$_SESSION['user_id'],PDO::PARAM_STR);		
		$stmt->execute();
		$count=$stmt->rowCount();
		if($count>0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	public function getNotifications()
	{
		$stmt=$this->pdo->prepare("SELECT * FROM notification where user_id=:userid order by notif_id desc");
		$stmt->bindParam(":userid",$_SESSION['user_id'],PDO::PARAM_STR);		
		$stmt->execute();
		$user=$stmt->fetchAll(PDO::FETCH_OBJ);
		return $user;
	}
	public function deleteNotification($userid)
	{
		$stmt=$this->pdo->prepare("DELETE from notification where user_id=:userid");
		$stmt->bindParam(":userid",$userid,PDO::PARAM_STR);
		$stmt->execute();
		header('Location: home.php');
	}
	public function getPassword()
	{
		$stmt=$this->pdo->prepare("SELECT password FROM users WHERE user_id = :userid ");
		$stmt->bindParam(":userid",$_SESSION['user_id'],PDO::PARAM_STR);
		$stmt->execute();
		$user=$stmt->fetch(PDO::FETCH_OBJ);
		return $user->password;
	}
	public function changePassword($new)
	{
		$stmt=$this->pdo->prepare("UPDATE users set password=:new WHERE user_id = :userid ");
		$stmt->bindParam(":userid",$_SESSION['user_id'],PDO::PARAM_STR);
		$stmt->bindParam(":new",$new,PDO::PARAM_STR);
		$stmt->execute();
	}
}
?>