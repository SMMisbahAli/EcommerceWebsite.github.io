
  <?php
require('includes/header.php');
require('includes/topbar.php');
//prx($_SESSION['cart']);
$totalPrice=0;
foreach($_SESSION['cart'] as $key=>$val){
                                    
    $productArr=getproduct($conn,'','',$key);
                                            
        $price=$productArr[0]['price'];
        $qty=$val['qty'];
        $totalPrice=$totalPrice+($price*$qty);
}

if(isset($_POST['submit']))
{

 
    $address=$_POST['address'];
    $city=$_POST['city'];
    $code=$_POST['code'];

    $payment_type=$_POST['payment_type'];
    $user_id=$_SESSION['USER_ID'];
    $cart_total=$totalPrice;
    $payment_status='1';
    if($payment_type=='COD'){
        $Patment_status='success';
    }
    $order_status='pending';
    $added_on=date('Y-m-d h:i:s');
    if($conn) 
    
    $query=mysqli_query($conn,"insert into `order`(user_id,address,city,pincode,payment_type,payment_status,order_status,added_on,total_price) values('$user_id','$address','$city','$code','$payment_type','$order_status','$payment_status','$added_on','$cart_total')");

    

    $order_id=mysqli_insert_id($conn);

    foreach($_SESSION['cart'] as $key=>$val){
                                    
            $productArr=getproduct($conn,'','',$key);                                               
            $price=$productArr[0]['price'];
            $qty=$val['qty'];
            $query1=mysqli_query($conn,"insert into `order_details`(order_id,product_id,qty,price) values($order_id,$key,$qty,$price)");   
        }
        if($query1){
            unset($_SESSION['cart']);
        ?>
        <script>
            window.location.href='thankyou.php';
        </script>   
<?php
        }
        
 }

?>

<div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url(images/bg/banner) no-repeat scroll center center / cover ;">
            <div class="ht__bradcaump__wrap">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="bradcaump__inner">
                                <nav class="bradcaump-inner">
                                  <a class="breadcrumb-item" href="index.html">Home</a>
                                  <span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
                                  <span class="breadcrumb-item active">checkout</span>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="checkout-wrap ptb--100">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <div class="checkout__inner">
                            <div class="accordion-list">
                                <div class="accordion">
                                    <div class="accordion__title">
                                        Checkout Method
                                    </div>
                                    <div class="accordion__body">
                                        <div class="accordion__body__form">
                                            <div class="row">
                                            <?php if(isset($_SESSION['USER_LOGIN'])){
                                               ?>
                                                    <span class="login_error" id="login_error"></span>
                                               <div class='alert alert-success'><strong>You have successfully already loggedIn, you can Proceed</strong></div>
                                               <?php

                                        
                                        }
                                            else{
                                                ?>
                                                    <div class="col-md-6">
                                                    <div class="checkout-method__login">
                                                    <form id="login-form" >
									<div class="single-contact-form">
										<div class="contact-box name">
											<input type="text" name="login_email" id="login_email" placeholder="Your Email*" style="width:100%">
										</div>
										<span class="feild_error" id="login_email_error"></span>
										
									</div>
									<div class="single-contact-form">
										<div class="contact-box name">
											<input type="password" name="login_password" id="login_password" placeholder="Your Password*" style="width:100%">
										</div>
										<span class="feild_error" id="login_password_error"></span>
										
									</div>
									<span class="login_error" id="login_error"></span>
									<div class="contact-btn">
										<button type="button" onclick="user_login()" class="fv-btn">Login</button>
										
										
									</div>
								</form>
                                                    </div>
                                                </div>

                                            <?php
                                            }
                                            ?>    
                                            
                                                <!-- <div class="col-md-6">
                                                    <div class="checkout-method__login">
                                                        <form action="#">
                                                            <h5 class="checkout-method__title">Register</h5>
                                                            <div class="single-input">
                                                                <label for="user-email">Name</label>
                                                                <input type="email" id="user-email">
                                                            </div>
															<div class="single-input">
                                                                <label for="user-email">Email Address</label>
                                                                <input type="email" id="user-email">
                                                            </div>
															
                                                            <div class="single-input">
                                                                <label for="user-pass">Password</label>
                                                                <input type="password" id="user-pass">
                                                            </div>
                                                            <div class="dark-btn">
                                                                <a href="#">Register</a>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div> -->
                                            </div>
                                        </div>
                                    </div>
                                    <?php 
                                    if(isset($_SESSION['USER_LOGIN'])){
                                        ?>
                                                <div class="accordion__title">
                                                Address Informations
                                                </div>
                                                <form method="post">     
                                    <div class="accordion__body">
                                        <div class="bilinfo">
                                           
                                                <div class="row">
                                                   
                                                  
                                                    <div class="col-md-12">
                                                        <div class="single-input">
                                                            <input type="text" name="address" placeholder="Street Address" required>
                                                        </div>
                                                    </div>
                                                
                                                    <div class="col-md-6">
                                                        <div class="single-input">
                                                            <input type="text" name="city" placeholder="City/State"required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="single-input">
                                                            <input type="text" name="code" placeholder="Post code/ zip"required>
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                            
                                        </div>
                                    </div>
                                    <div class="accordion__title">
                                        payment information
                                    </div>
                                    <div class="accordion__body">
                                        <div class="paymentinfo">
                                            <div class="single-method">
                                                       * COD <input type="radio" name="payment_type" value="COD" required/>
                                            </div>
                                            <div class="single-method">
                                                      * PayU <input type="radio" name="payment_type" value="payu" required/>
                                            </div>
                                            <br>
                                            
                                        </div>
                                    </div>
                                    <div class="single-method">
                                                  <input type="submit" name="submit" />
                                            </div>
                                </form>
                               
                                    
                                        <?php
                                    }

                                    else{
                                    
                                    }
                                    ?>
                               
                                    
                                
                                    
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="order-details">
                            <h5 class="order-details__title">Your Order</h5>
                            <div class="order-details__item">
                            
                    <?php
                    
                    
                                    if(isset($_SESSION['cart']))
                                    {
                                        foreach($_SESSION['cart'] as $key=>$val){
                                    
                                            $productArr=getproduct($conn,'','',$key);
                                                $pname=$productArr[0]['name'];
                                                $mrp=$productArr[0]['mrp'];
                                                $price=$productArr[0]['price'];
                                                $image=$productArr[0]['image'];
                                                $qty=$val['qty'];
                                                $totalPrice=$totalPrice+($price*$qty);
                                                
                                ?>
                                
                                <div class="single-item">
                                    <div class="single-item__thumb">
                                        <img src="Admin/image/<?php echo $image; ?>" alt="ordered item">
                                    </div>
                                    <div class="single-item__content">
                                        <a href="#"><?php echo $pname; ?></a>
                                        <span class="price"><?php echo $price; ?></span>
                                    </div>
                                    <div class="single-item__remove">
                                    <a href="javascript:void(0)"  onclick="manage_cart('<?php echo $key ?>','remove')"><i class="zmdi zmdi-delete"></i></a>
                                    </div>
                                </div>
                          
        <?php
                    }        }
                    

        ?>
         </div>         
                            <div class="ordre-details__total">
                                <h5>Order total</h5>
                                <span class="price"><?php echo $totalPrice ?></span>
                            </div>
                        </div>
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
				window.location.href='checkout.php';
			}
			jQuery('.htc__qua').html(result);
        }    
                    
                });
    }
       </script>


    <style>

.accordion .accordion__hide {
  background: #f4f4f4;
  height: 65px;
  line-height: 65px;
  display: flex;
  align-items: center;
  padding: 0 30px;
  position: relative;
  font-size: 16px;
  font-weight: 600;
  letter-spacing: 1px;
  text-transform: uppercase;
  margin-bottom: 10px;
  font-family: "Poppins";
  cursor: pointer;
}
    </style>
    <script>
function user_login(){

jQuery('.field_error').html('');
var email=jQuery("#login_email").val();
var password=jQuery("#login_password").val();
var is_error='';
if(email==""){
    jQuery('#login_email_error').html('Please enter email');
    is_error='yes';
}if(password==""){
    jQuery('#login_password_error').html('Please enter password');
    is_error='yes';
}
if(is_error==''){
    jQuery.ajax({
        url:'login_submit.php',
        type:'post',
        data:'email='+email+'&password='+password,
        success:function(result){
            result=$.trim(result); 
            if(result=='wrong'){
                $('#login-form').trigger('reset');
                $('#login_error').html("<div class='alert alert-danger'><strong>Please enter valid login details</strong></div>");

            }
            if(result=='valid'){	                              		
              
                $('#login-form').trigger('reset');		
                $('#login_error').html("<div class='alert alert-success'><strong>You have successfully logged in now you can Proceed</strong></div>");
                window.location.href='checkout.php'; 
            }
        }	
    });
}	
}

    </script>

    <style>
        .feild_error{
            color: red;
        }
        .feild_success{
            color: green;
            margin: 55px;
            font-size: 20px;
        }
        .login_error{
            color: red;
            margin: 20px;
            font-size: 15px;
        }

    </style>




        <?php
    include('includes/footer.php');
        ?>