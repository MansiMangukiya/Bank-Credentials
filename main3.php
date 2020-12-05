
<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
ini_set('display_errors', 1);
include ( "accounts.php" );

$db = mysqli_connect ($hostname, $username, $password, $project);

if (mysqli_connect_errno())
    {
        echo "Failed to connect to MySQL: ".mysqli_connect_error();
        exit();
    }
print "Successfully connected to MySQL.<br><br><br>";

mysqli_select_db ($db, $project ); 

$ucid        = $_GET ["ucid"];      print "<br>The ucid is $ucid";
$account     = $_GET ["account"];   print "<br>The account is $account";
$amount      = $_GET ["amount"];    print "<br>The amount is $amount";
$mail        = $_GET ["mail"];      print "<br>The mail is $mail";

$s = "insert into transactions values ( '$ucid', '$account', '$amount', NOW(), '$mail')";
print "<br>SQL insert statement is $s";
$t= (mysqli_query($db,$s)) or die(mysqli_error($db));

$q = "update accounts set balance = balance+'$amount', recent = NOW() where ucid='$ucid' and account= '$account'";
print "<br>SQL update statement is $q";
$t= (mysqli_query($db,$q)) or die (mysqli_error($db));

print "<br><br>bye";
?>






