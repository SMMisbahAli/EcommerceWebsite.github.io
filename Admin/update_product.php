<?php
   include('security.php');

   ?>

   <?php

$msg='';
if(isset($_GET['id']) && $_GET['id']!='')
    {
       
        $id=$_GET['id'];
        $query=mysqli_query($conn,"select * from product where id=$id");
        $check=mysqli_num_rows($query);
        if($check>0)
        {
            $row=mysqli_fetch_assoc($query);

            $categories_id=$row['categories_id'];
            
            $name= $row['name'];       
        
            $mrp=$row['mrp'];
            $qty=$row['qty'];
            $image=$row['image'];
            $price=$row['price'];
            $s_disc=$row['short_disc'];
            $disc=$row['discription'];
            $meta_title=$row['meta_title'];
            $meta_disc=$row['meta_disc'];
            $meta_key=$row['meta_keyword'];
          
        }
        
     
       
        if(isset($_POST['update_btn']))
        {

           $cat_id=$_POST['categories_id'];
            $name= $_POST['name'];       
        
            $mrp=get_safe_value($conn,$_POST['mrp']);
            $qty=$_POST['qty'];
            
            $price=$_POST['price'];
            $s_disc=$conn->real_escape_string($_POST['short_desc']);
            $disc=$conn->real_escape_string($_POST['description']);
            
            
            $meta_title=$_POST['meta_title'];
            $meta_disc=$_POST['meta_desc'];
            $meta_key=$_POST['meta_key'];

     
           
            if($_FILES['img']['type']!='image/jpeg' && $_FILES['img']['type']!='image/jpg'  &&  $_FILES['img']['type']!= 'image/png' && $_FILES['img']['name']!='')
            {
                $msg="Please select only jpeg , png or jpg images";
            }
            else{
           
               if($_FILES['img']['name']!=NULL)
               {
                    $image=rand(111111111,999999999).'_'.$_FILES['img']['name'];
                    move_uploaded_file($_FILES['img']['tmp_name'],'image/'.$image);
               
                    
                 $result=mysqli_query($conn,"update product
                 set categories_id='$cat_id',name='$name',mrp='$mrp',price='$price',qty='$qty',image='$image',short_disc='$s_disc',discription='$disc',meta_title='$meta_title',meta_disc='$meta_disc',meta_keyword='$meta_key' where id=$id");

                 if($result)
                {
                    header('Location:products.php?Updated');
                    exit();
                }
                 }  
                 else{
                    $result=mysqli_query($conn,"update product
                    set categories_id='$cat_id',name='$name',mrp='$mrp',price='$price',qty='$qty',short_disc='$s_disc',discription='$disc',meta_title='$meta_title',meta_disc='$meta_disc',meta_keyword='$meta_key' where id=$id");
   
                if($result)
                {
                    header('Location:products.php?Updated');
                    exit();
                }
               else{
                   $msg="Query Error";
               }
                 }

                 
                 
            }
           }
           
        //    else{
        //        echo "here2";
        //      $result=mysqli_query($conn,"update product
        //      set categories_id='$cat_id',name='$name',mrp='$mrp',price='$price',qty='$qty',short_disc='$s_disc',discription='$disc',meta_title='$meta_title',meta_disc='$meta_disc',meta_keyword='$meta_key' where id=$id");

        // if($result)
        // {
        //     // header('Location:products.php?Updated');
        //     // exit();
        // }           
    

    }
//    include('includes/header.php');
//    include('includes/navbar.php');
//    include('includes/topbar.php');
?>

<link href="css/sb-admin-2.min.css" rel="stylesheet">

<form  method="post" enctype="multipart/form-data">
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
                                    <div class="card-header">

                                    <h1 class="h4 text-Black-900 mb-4">Update Product</h1>
                                    </div>
                                   <label for=""></label>
                                        <div class="form-group">
                                        
                                            <label> Category </label>
                                            <select class="form-control form-control-user" name="categories_id" required >
                                                <option>Select Category</option>
                                                <?php
                                                echo "sffs";
                                                $result=mysqli_query($conn,"select id,categories from categories order by categories asc");
                                                while($row=mysqli_fetch_assoc($result))
                                                {
                                                
                                                if($row['id']==$categories_id)
                                                {
                                                
                                                    echo "<option selected  value=".$row['id'].">".$row['categories']."</option>";
                                               
                                                }
                                                else{
                                                    echo "sddf";
                                                    echo "<option  value=".$row['id'].">".$row['categories']."</option>";
                                               
                                                }

                                            
                                                     }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label> Product Name </label>
                                            <input type="input" class="form-control form-control-user"
                                                name="name" value="<?php echo $name ?>" required>
                                            </div>
                                            <div class="form-group">
                                            <label> MRP </label>
                                            <input type="input" class="form-control form-control-user"
                                                name="mrp" value="<?php echo $mrp; ?>" required>
                                            </div>
                                            <div class="form-group">
                                            <label> Price </label>
                                            <input type="input" class="form-control form-control-user"
                                                name="price" value="<?php echo $price ?>" required>
                                            </div>
                                            <div class="form-group">
                                            <label> Quantity </label>
                                            <input type="input" class="form-control form-control-user"
                                                name="qty" value="<?php echo $qty ?>" required>
                                            </div>
                                            <div class="form-group">
                                            <label> Image </label>
                                            <input type="file" class="form-control form-control-user"
                                                name="img"  >
                                            </div>
                                            <div class="form-group">
                                            <label>Meta Title </label>
                                            <textarea name="meta_title" cols="30" rows="2"  class="form-control" required><?php echo $meta_title ?></textarea>
                                            </div>
                                            
                                            <div class="form-group">
                                            <label>Meta Description </label>
                                            <textarea name="meta_desc" cols="30" rows="2"  class="form-control" required><?php echo $meta_disc ?></textarea>
                                            </div>
                                            <div class="form-group">
                                            <label>Meta Keyword </label>
                                            <textarea name="meta_key" cols="30" rows="2"  class="form-control" required><?php echo $meta_key ?></textarea>
                                            </div>
                                            <div class="form-group">
                                            <label>Short Description </label>
                                            <textarea name="short_desc" cols="30" rows="2"  class="form-control" required><?php echo $s_disc ?></textarea>
                                            </div>
                                            <div class="form-group">
                                            <label>Description </label>
                                            <textarea name="description" cols="30" rows="5"  class="form-control" required><?php echo $disc  ?></textarea>
                                            </div>
                                        
                                        <button type="submit" class="btn btn-primary  btn-user btn-block" name="update_btn">Update</button> 
                                            <div class="feild_error"><?php echo "$msg"; ?></div>
                                        
                                       
                                </div>
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
.form-group{
    color:black;
}

</style>




                    

<?php
include('includes/scripts.php');
include('includes/footer.php');
?>