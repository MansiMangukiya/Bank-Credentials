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
    $ucid = $_GET ["ucid"] ; print "<br>ucid is:  $ucid";
    $accounts = $_GET ["account"] ; print "<br>accounts is:  $accounts";
    $amount = $_GET ["amount"] ; print"<br>amount is: $amount";
    $mail = $_GET ["mail"] ; print"<br>Mail: $mail";
    $transmethod ="insert into transactions values('$ucid','$accounts','$amount',NOW(),'$mail')";
    print "<br>SQL statement is: $transmethod.<br>";
    ($t = mysqli_query ($db, $transmethod)) or die( mysqli_error($db));
    $transmethod ="update accounts set balance= balance + '$amount', recent = NOW() where ucid='$ucid' and account='$accounts'";
    print "<br>SQL statement is: $transmethod.<br>";
    ($t = mysqli_query ($db, $transmethod)) or die( mysqli_error($db));

    
?>