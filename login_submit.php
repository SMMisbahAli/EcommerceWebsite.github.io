	<?php
include('includes/database.php');
include('functions.php');
$email=get_safe_value($conn,$_POST['email']);
$password=get_safe_value($conn,$_POST['password']);
$res=mysqli_query($conn,"select * from users where email='$email'");
$check_user=mysqli_num_rows($res);
if($check_user>0){
	while($row=mysqli_fetch_assoc($res)){
		if(password_verify($password,$row['password']))
		{
			$_SESSION['USER_LOGIN']='yes';
			$_SESSION['USER_ID']=$row['id'];
			$_SESSION['USER_NAME']=$row['name'];
			echo "valid";
		}else{
			echo "wrong";
		}

	}

}
else{
	echo "wrong";
}

?> 