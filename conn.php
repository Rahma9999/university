<?php
$lh = "localhost";
$n = "root";
$dbn = "university";
$pass = "";
try{
    $conn = new PDO("mysql:host=$lh; dbname=$dbn", $n, $pass);
    //echo 'successfully!';
}
catch(PDOEexecption $e){
    echo 'Faild connection' . $e->getMessage();
}