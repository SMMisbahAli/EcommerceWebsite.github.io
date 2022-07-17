<?php



function prx($arr)
{
    echo '<pre>';
    print_r($arr);
    die();
}

function get_safe_value($conn,$str)
{
    if($str!='')
    {
        return mysqli_real_escape_string($conn,$str);
    }
}

function getproduct($conn,$limit='',$cat_id='',$product_id=''){
    $sql="select product.*,categories.categories from categories,product where product.status='1' ";
    if($cat_id!='')
    {
        $sql.=" and product.categories_id = '$cat_id' ";
    }
    if($product_id!='')
    {
        $sql.=" and product.id='$product_id'";
    }
    $sql.=" and product.categories_id=categories.id "; 
   $sql.="order by product.id desc";
    if($limit!='')
    {
        $sql.=" limit $limit";
    }
    $result=mysqli_query($conn,$sql);
    $data=array();
    while($row=mysqli_fetch_assoc($result))
    {
        $data[]=$row;
    }
    return $data;

}
?>