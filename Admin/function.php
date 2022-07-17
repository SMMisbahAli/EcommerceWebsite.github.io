<?php

    function get_safe_value($conn,$var)
    {
       if($var!='')
       {
           return mysqli_real_escape_string($conn,$var);       }
    }

?>