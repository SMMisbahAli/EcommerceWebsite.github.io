<?php
   include('security.php');

   $msg='';
    
   ?>

   <?php


    if(isset($_POST['add_btn']))
    {
        
        $cat=$_POST['categories'];
       

        if(empty($cat))
        {
         header('Location:add_Categories.php?EmptyFeilds') ;
         exit(); 
        }
        $sql="SELECT * FROM `categories` WHERE categories='$cat'";
        $result=mysqli_query($conn,$sql);
        if(mysqli_num_rows($result)>0)
        {
            $msg="Categoriy Already Exist";
            header("Location:add_categories.php?CategoryAlreadyexist");
            exit();
        }
        else{
                
        $sql="insert into categories(categories,status) values('$cat','1')";
        mysqli_query($conn,$sql);
        header('Location:categories.php?CategoriesEntered');
        die();
        }


    }


    include('includes/header.php');
    include('includes/navbar.php');
    include('includes/topbar.php');
   ?>
   


  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

<form action="add_categories.php" method="post">
<body class="bg-gradient">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center" >

            <div class="col-xl-6 col-lg-12 col-md-8">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">


                            
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">

                                    

                                    <h1 class="h4 text-gray-900 mb-4">Add Categories</h1>
                                    </div>
                                    <form class="user">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user"
                                                name="categories" 
                                                placeholder=<?php '$cat' ?> >
                                        </div>
                                        
                                      
                                        
                                        <button type="submit" class="btn btn-primary btn-user btn-block" name="add_btn">ADD</button> 
                                            <div class="feild_error"><?php echo $msg; ?></div>
                                        
                                       
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
    </form>
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>

<style>
.feild_error{
    color: red;
}

</style>



   <?php
include('includes/scripts.php');
include('includes/footer.php');
?>