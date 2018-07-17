<?php
include 'init.php';
if(isset($_POST['search']) && !empty($_POST['search'])){
	$search=$getFromU->checkInput($_POST['search']);
	$result=$getFromU->search($search.'%');
	echo '<div class="nav-right-down-wrap"><ul>';
	foreach($result as $user){
		if($user->user_id==$_SESSION['user_id']){
			continue;
		}else{
		echo '<li>
  		<div class="nav-right-down-inner">
			<div class="nav-right-down-left">
				<a href="'.BASE_URL.'profile.php?id='.$user->user_id.'"><img src="'.$user->profileImage.'"></a>
			</div>
			<div class="nav-right-down-right">
				<div class="nav-right-down-right-headline">
					<a href="'.BASE_URL.'profile.php?id='.$user->user_id.'">'.$user->name.'</a>';
					if($user->active==1)
						echo '<i class="material-icons ">star</i>';
				echo '</div>
				<div class="nav-right-down-right-body">
				 
			    </div>
			</div>
		</div> 
	 </li> ';

		}
	}
	echo '</ul></div>';
}


?>