<?php

session_start();
//include myfunctions.php here
include ("Folder/accounts.php");

$db = mysqli_connect ($hostname, $username, $password, $project);
    if (mysqli_connect_errno())
    {
        echo "Failed to connect to MySQL: ".myseli_connecterror();
        exit ();
    }
    print "Successfully connected to MYSQL.<br>";
    mysqli_select_db($db, $project);

    function authenticate ($ucid, $pass) {
        global $db; 
            
        $s = "select * from users where ucid = '$ucid' and pass = '$pass' " ;
        echo "<br><br>SQL select is $s" ;
        ($t = mysqli_query ($db, $s) ) or die( mysqli_error($db));
        $num = mysqli_num_rows ($t);

        if ( ! authenticate ($ucid, $pass ) ) 
    { echo "<br>not auth. Being redirected to form " ;
        header ( "refresh: 2; url= run.html ") ; //(change the name)
        exit();
     }
        else 
    { echo "<br>yes auth. Being redirected to form " ;
    header ( "refresh: 2; url=xnext.php " ) ; // (change the name )
    exit();
    }


























?>