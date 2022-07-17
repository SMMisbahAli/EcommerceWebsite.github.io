<?php
   include('security.php');

   $msg="";
    
   ?>

   <?php


    if(isset($_POST['add_btn']))
    {
        
         $cat=$_POST['categories_id'];
         $name=$_POST['name'];
         $mrp=$_POST['mrp'];
         $price=$_POST['price'];
         $qty=$_POST['qty'];
         //$image=$_POST['img'];
          $meta_title=$_POST['meta_title'];
          $meta_desc=$_POST['meta_desc'];
          $meta_key=$_POST['meta_key'];
          $s_desc=$_POST['short_desc'];
          $l_desc=$_POST['description'];
        
      
         if($_FILES['img']['type']!='image/jpeg' && $_FILES['img']['type']!='image/jpg'  &&  $_FILES['img']['type']!= 'image/png')
         {
             $msg="Please select  jpeg , png or jpg images";
         }
         else{
            if($_FILES['img']['name']=='')
            {
                $msg="Please select  jpeg , png or jpg images";
            }else{
                $image=rand(111111111,999999999).'_'.$_FILES['img']['name'];
            //$file_tmp=$_FILES['img']['temp_name'];
             move_uploaded_file($_FILES['img']['tmp_name'],'image/'.$image);
        
                if( empty($name) || empty($mrp) || empty($price) || empty($qty) ||  empty($meta_title) || empty($meta_key) || empty($meta_desc) ||empty($s_desc) ||  empty($l_desc))
           {
            $msg="Please Enter all valid feilds";
            
           }
           else{
            $sql="SELECT * FROM `product` WHERE name='$name'";
            $result=mysqli_query($conn,$sql);
            if(mysqli_num_rows($result)>0)
            {
                $msg="Categoriy Already Exist";
                header("Location:add_product.php?CategoryAlreadyexist");
                exit();
            }
            else{
                 $sql="insert into product(categories_id,name,mrp,price,qty,image,short_disc,discription,meta_title,meta_disc,meta_keyword,status) values('$cat','$name','$mrp','$price','$qty','$image','$s_desc','$l_desc','$meta_title','$meta_desc','$meta_key','1')";
            $query=mysqli_query($conn,$sql);
                if($query){
                    header("Location:Products.php");
                    exit();
                }
            }
           }
           
            }
            
           
        }
         }


   ?>
   


  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

<form action="add_product.php" method="post" enctype="multipart/form-data">
<body class="bg-gradient">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center" >

            <div class="col-xl-8  ">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">


                            
                            <div class="col-lg-12">
                                <div class="p-5">
                                <div class="feild_error"><?php echo $msg ?></div>
                                    <div class="card-header">

                                    <h1 class="h4 text-Black-900 mb-4">Add Product</h1>
                                    </div>
                                   <label for=""></label>
                                        <div class="form-group">
                                            <label> Category</label>
                                            <select class="form-control form-control-user" name="categories_id">
                                                <?php
                                                $result=mysqli_query($conn,"select id,categories from categories order by categories asc");
                                                while($row=mysqli_fetch_assoc($result))
                                                {
                                                    echo "<option value=".$row['id'].">".$row['categories']."</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label> Product Name </label>
                                            <input type="input" class="form-control form-control-user"
                                                name="name" placeholder="Enter Product name">
                                            </div>
                                            <div class="form-group">
                                            <label> MRP </label>
                                            <input type="input" class="form-control form-control-user"
                                                name="mrp" placeholder="Enter Product MRP">
                                            </div>
                                            <div class="form-group">
                                            <label> Price </label>
                                            <input type="input" class="form-control form-control-user"
                                                name="price" placeholder="Enter Product Price">
                                            </div>
                                            <div class="form-group">
                                            <label> Quantity </label>
                                            <input type="input" class="form-control form-control-user"
                                                name="qty" placeholder="Enter Product Quantity">
                                            </div>
                                            <div class="form-group">
                                            <label> Image </label>
                                            <input type="file" class="form-control"
                                                name="img" placeholder="img">
                                            </div>
                                            
                                            <div class="form-group">
                                            <label>Meta Title </label>
                                            <textarea name="meta_title" cols="30" rows="2" placeholder="Enter Product Meta title" class="form-control" ></textarea>
                                            </div>
                                            <div class="form-group">
                                            <label>Meta Description </label>
                                            <textarea name="meta_desc" cols="30" rows="2" placeholder="Enter Product Meta Description" class="form-control" ></textarea>
                                            </div>
                                            <div class="form-group">
                                            <label>Meta Keyword </label>
                                            <textarea name="meta_key" cols="30" rows="2" placeholder="Enter Product Meta Key word" class="form-control" ></textarea>
                                            </div>
                                            <div class="form-group">
                                            <label>Short Description </label>
                                            <textarea name="short_desc" cols="30" rows="2" placeholder="Enter Product Short Description" class="form-control" ></textarea>
                                            </div>
                                            <div class="form-group">
                                            <label>Description </label>
                                            <textarea name="description" cols="30" rows="5" placeholder="Enter Product Description" class="form-control" ></textarea>
                                            </div>
                                        
                                        <button type="submit" class="btn btn-primary btn-user btn-block" name="add_btn">ADD</button> 
                                          
                                        
                                       
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
    align-content: center;
    color: red;
    
    padding: 9px;
}
.form-group{
    color:black;
}

</style>



   <?php
include('includes/scripts.php');
include('includes/footer.php');
?>