<?php

    error_reporting (E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
    ini_set ('display_errors', 1);

    include ("accounts.php");
    //include("main.html");
    $db = mysqli_connect ($hostname, $username, $password, $project);
    if (mysqli_connect_errno())
    {
        echo "Failed to connect to MySQL: ".myseli_connecterror();
        exit ();
    }
    print "Successfully connected to MYSQL.<br>";
    mysqli_select_db($db, $project);

/*
    $s = "select * from transactions where ucid = '$ucid' and account = 'account' " ;
    echo "<br><br>SQL select for retrieval is $s" ;
    ($t = mysqli_query ($db, $s) ) or die( mysqli_error($db));
    $num = mysqli_num_rows ($t);

//march thru $t a row at a time & display

while ( $r= mysqli_fetch_array($t, MYSQL_ASSOC)) {
        $amounts =   $r["amounts" ];
        $timestamp = $r["timestamp" ];
    
        echo "<br><br> amounts is $amounts and time is $timestamp" ;
    
}
*/
    //auth ucid & pass  users
function authenticate ($ucid, $pass) {
    global $db; 
        
    $s = "select * from users where ucid = '$ucid' and pass = '$pass' " ;
    echo "<br><br>SQL select is $s" ;
    ($t = mysqli_query ($db, $s) ) or die( mysqli_error($db));
    $num = mysqli_num_rows ($t);
    
    if ($num == 0) 
    {  
        return false ;
    
    } 
    else          
    { 
        $_SESSION [ "logged"] = true;
        $_SESSION [ "ucid"] =   $ucid;

        
        return true ;
    
    }
}

//replace $_GET ["ucid"] with safe ("ucid")
function safe ( $name )
{
    global $db;

    $v =  $_GET [$name];  
    $v =  trim($v);

    if ($v != " " ) { $v = mysqli_real_escape_string($db, $v); }
    print "<br>$name:    $v"; 
    return $v;



}

//Get inputs - ucid pass account
//$ucid = $_GET ["ucid"];         print "<br>ucid     $ucid"; 
//$ucid = mysqli_real_escape_string($db, $ucid);
$ucid = safe ("ucid");

//$account = $_GET ["account"];   print "<br>account  $account";
//$account = mysqli_real_escape_string($db, $account);
$account = safe ("account");

//$pass = $_GET ["pass"];   print "<br>pass  $pass";
//$pass = mysqli_real_escape_string($db, $pass);
$pass = safe ("pass");

if ( ! authenticate ($ucid, $pass ) ) 
    { echo "<br>not auth. Being redirected to form " ;
        header ( "refresh: 5; url= run.html ") ;
        exit();
     }
else 
    { echo "<br>yes auth. Being redirected to form " ;
    header ( "refresh: 5; url=xnext.php " ) ;
    exit();
    }
   

    /*
    $accounts = $_GET ["account"] ; print "<br>accounts is:  $accounts";
    $amount = $_GET ["amount"] ; print"<br>amount is: $amount";
    $mail = $_GET ["mail"] ; print"<br>Mail: $mail";
    $transmethod ="insert into transactions values('$ucid','$accounts','$amount',NOW(),'$mail')";
    print "<br>SQL statement is: $transmethod.<br>";
    ($t = mysqli_query ($db, $transmethod)) or die( mysqli_error($db));
    $transmethod ="update accounts set balance= balance + '$amount', recent = NOW() where ucid='$ucid' and account='$accounts'";
    print "<br>SQL statement is: $transmethod.<br>";
    ($t = mysqli_query ($db, $transmethod)) or die( mysqli_error($db));
    
    print "<br>Bye";
    /*

    
?>
