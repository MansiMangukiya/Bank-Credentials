<?php
// gatekeeper
session_start();


if ($_GET["mpm58"] != "secret") 
{ 
        exit ("not allowed");
}

if (!isset($_SESSION["logged"]) )
        {
                echo "<br> Please Login." ;
                header ( "refresh: 5 ; url=run.html");
                exit();

        ;}

echo "<h3>You have been fadmitted to next block. </h3>";
$pin = mt_rand (10000, 999999 );
echo = " <br>pin is: $pin<br>";

$to = "mpm58@g.njit.edu";
$subj = "pin";
$msg = $pin;


mail ($to, $subj, $msg) ;

        
?>

<form action= "xnextverify.php" >
<input type = text name = "pin" > Enter mailed pin <br>
<input type = submit >
        
</form>