<?php
function authenticate ($ucid, $pass) 
{
    global $db; 
      
    $s = "select * from users where ucid = '$ucid' and pass = '$pass' " ;
    ($t = mysqli_query ($db, $s) ) or die( mysqli_error($db));
    $num = mysqli_num_rows ($t);

    if ($num == 0){
        return false;
    }
    else{
        $_SESSION["logged"] = true;
        $_SESSION["ucid"] = $ucid;
        return true;
    }
}

function safe($name)
{
    global $db;
    $v= $_GET [$name];
    $v= trim ($v);

    if ($v != " ")
        {
            $v = mysqli_real_escape_string ($db, $v);

        }
    return $v;
}



?>