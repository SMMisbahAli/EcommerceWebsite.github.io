<?php
include('includes/header.php');
include('includes/topbar.php');

$order_id=$_GET['id'];
?>
<div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url(images/bg/banner) no-repeat scroll center center / cover ;">
            <div class="ht__bradcaump__wrap">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="bradcaump__inner">
                                <nav class="bradcaump-inner">
                                  <a class="breadcrumb-item" href="index.php">Home</a>
                                  <span class="brd-separetor"><i class="zmdi zmdi-chevron-right"> <a href="thankyou.php">Thank You</a> </i></span>
                                  <span class="breadcrumb-item active"></span>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
     

<div class="wishlist-area ptb--100 bg__white">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="wishlist-content">
                            <form action="#">
                                <div class="wishlist-table table-responsive">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th class="product-thumbnail">Product Name</th>
                                                <th class="product-thumbnail">Product Image</th>
                                                
                                                <th class="product-name"><span class="nobr">Qty</span></th>
                                                <th class="product-price"><span class="nobr"> Price </span></th>
                                                <th class="product-price"><span class="nobr"> Total Price </span></th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $total_price=0;
                                               $user_id=$_SESSION['USER_ID'];
                                                $query=mysqli_query($conn,"select distinct(order_details.id),order_details.*,product.name,product.image from order_details,product,`order` where order_details.order_id='$order_id' and `order`.user_id='$user_id' and order_details.product_id=product.id");
                                                while($row=mysqli_fetch_assoc($query)){

                                                    $total_price=$total_price+($row['price']*$row['qty']);
                                            ?>
                                            <tr>
                                                <td class="product-name"><?php echo $row['name'] ?></td>
                                                <td class="product-name"><?php echo $row['image'] ?></td>
                                                <td class="product-name"><?php echo $row['qty'] ?></td>
                                                <td class="product-name"><?php echo $row['price'] ?></td>
                                                <td class="product-name"><?php echo $row['qty']*$row['price'] ?></td>
                                                
                                            </tr>
                                            <tr>
                                                <td colspan="3"></td>
                                                <td class="product-name">Total Price</td>
                                                <td class="product-name"><?php echo $total_price ?></td>
                                                
                                            </tr>
                                          <?php
                                          }  
                                          ?>
                                        </tbody>
                                       
                                    </table>
                                </div>  
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        include('includes/footer.php');
?>













