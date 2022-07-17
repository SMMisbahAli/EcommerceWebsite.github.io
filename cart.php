<?php
require('includes/header.php');
require('includes/topbar.php');
    //prx($_SESSION['cart']);
    //unset($_SESSION['cart']);
///echo $_SESSION['cart']['18']['qty'];  // trying to access the $_SESSION-cart-array_id=18-qty=
?>

<div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url(images/bg/banner) no-repeat scroll center center / cover ;">
            <div class="ht__bradcaump__wrap">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="bradcaump__inner">
                                <nav class="bradcaump-inner">
                                  <a class="breadcrumb-item" href="index.php">Home</a>
                                  <span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
                                  <span class="breadcrumb-item active">Cart</span>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      
<div class="cart-main-area ptb--100 bg__white">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <form action="#">               
                            <div class="table-content table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th class="product-thumbnail">products</th>
                                            <th class="product-name">name of products</th>
                                            <th class="product-price">Price</th>
                                            <th class="product-quantity">Quantity</th>
                                            <th class="product-subtotal">Total</th>
                                            <th class="product-remove">Remove</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                          
                                                            
                               <?php
                               $var=0;
                                    if(isset($_SESSION['cart']))
                                    {
                                        foreach($_SESSION['cart'] as $key=>$val){
                                   
                                            $productArr=getproduct($conn,'','',$key);
                                                $pname=$productArr[0]['name'];
                                                $mrp=$productArr[0]['mrp'];
                                                $price=$productArr[0]['price'];
                                                $image=$productArr[0]['image'];
                                                $qty=$val['qty'];
                                                
                                    
                                
                                ?>

                                    <tr>
                                            <td class="product-thumbnail"><a href="product_details.php"><img src="Admin/image/<?php echo $image ?>"/></a></td>
                                            <td class="product-name"><a href="#"><?php echo $pname; ?></a>
                                                <ul  class="pro__prize">
                                                    <li class="old__prize"><?php  echo $mrp ?></li>
                                                    <li><?php echo $price ?></li>
                                                </ul>
                                                <?php 
                                                 $var=1;
                                                 ?>
                                            </td>
                                            <td class="product-price"><span class="amount"><?php echo $price ?></span></td>
                                            <td class="product-quantity"><input type="quantity" id="<?php echo $key ?>qty" value="<?php echo $qty ?>" /> 
                                            <br>   <a href="javascript:void(0)"  onclick="manage_cart('<?php echo $key ?>','update')">update</a></br>
                                             </td>
                                            <td class="product-subtotal"><?php echo $price*$qty ?></td>
                                            <td class="product-remove"><a href="javascript:void(0)"  onclick="manage_cart('<?php echo $key ?>','remove')"><i class="icon-trash icons"></i></a></td>
                                        </tr>

                            <?php
                                           }   }
                            ?>
                                    </tbody>
                                </table>
                            </div>
                            <?php 
                            if($var==1){

                            
                            ?>
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="buttons-cart--inner">
                                        <div class="buttons-cart">
                                            <a href="index.php">Continue Shopping</a>
                                        </div>
                                        <div class="buttons-cart checkout--btn">
                                            
                                            <a href="checkout.php">checkout</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <?php
                        }
                        else{
                            echo "Your cart is currently empty";
                                
                            ?>
                           
                            <br>
                            <br>
                             <div class="buttons-cart">
                                            <a href="index.php">Continue Shopping</a>
                                        </div>
                                  
                            <?php
                          
                        }
                        ?> 
                    </div>
                </div>
            </div>
        </div>

        <script>
            function manage_cart(pid,type){
         if(type=='update')
         {
            var qty=jQuery("#"+pid+"qty").val();
             
         }else{
             var qty=jQuery("#qty").val(); 
         }
        jQuery.ajax({
        url:'manage_cart.php',
		type:'post',
		data:'pid='+pid+'&qty='+qty+'&type='+type,
		success:function(result){
			if(type=='update' || type=='remove'){
				window.location.href='cart.php';
			}
			jQuery('.htc__qua').html(result);
        }    
                    
                });
    }

       </script>



            <?php

            include('includes/footer.php');
            ?>