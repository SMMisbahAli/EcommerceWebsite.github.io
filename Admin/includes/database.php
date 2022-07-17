<?php

    $dbhost="sql208.epizy.com";
    $dbUser="epiz_32165324";
    $dbPass="s1kebdvAdhQ";
    $dbName="epiz_32165324_ecommercebasic";

    $conn=mysqli_connect($dbhost,$dbUser,$dbPass,$dbName);
    
    // define('SERVER_PATH',$_SERVER['DOCUMENT_ROOT'].'/PHP/Admin/');
    // //define('SITE_PATH','');

    // define('PRODUCT_IMAGE_SERVER_PATH',SERVER_PATH.'image/');
    // define('PRODUCT_IMAGE_SERVER_PATH',SITE_PATH.'image/');



    if(!$conn)
    {
        die("Data Base connection Failed") ;
    }
    

?>