<?php
session_start();
include('includes/database.php');

if(isset($_POST['login_btn']))
{
    $name=$_POST['name'];
    $passd=$_POST['password'];

      if(empty($passd) || empty($name))
      {
        $_SESSION['status']='Empty Feilds';
          header("Location:login.php");  
      }
      else{

            $email=mysqli_real_escape_string($conn,$name);
            $pad=mysqli_real_escape_string($conn,$passd);
            $sql="select * from admin_users where username = '$name'";
            $result=mysqli_query($conn,$sql);
            if(mysqli_num_rows($result) > 0 )
            {
                while($row=mysqli_fetch_array($result))
                {
                    //password_verify($pad,$row['password'])
                    //$hashedPassw=password_hash($pad,PASSWORD_DEFAULT);
                    //echo $hashedPassw;
                    if(password_verify($pad,$row['password']))
                    {
                       
                            $_SESSION['username']=$name;
                        header("Location:index.php?LogedIn");
                        exit();
                        
                    }
                    else{
                        $_SESSION['status']='Password is invalid';
                        header("Location:login.php?InvalidFeilds");
                    }
                }
            }
            else{
                $_SESSION['status']='Name';
                header("Location:login.php?InvalidFeilds");
            }
    }
}
?>