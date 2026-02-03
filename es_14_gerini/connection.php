<?php
$servernameDB="localhost";
$username="root";
$passwordDB="";
$dbnameDB="classicmodels";

mysqli_report(MYSQLI_REPORT_OFF);

$conn=new mysqli($servernameDB, $username,$passwordDB, $dbnameDB);

if($conn->connect_error){
    header("location: errore.html");
}
?>