<?php

$conn = new PDO("mysql:host=localhost;dbname=shop_db","root");

if($conn){
    echo "connected";
}

function unique_id(){
    $chars ='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWYZ';
    $charLength =strlen($chars);
    $randomString = '';
    for($i=0; $i<20; $i++){
         $randomString.=$chars[mt_rand(0, $charLength -1)];  
    }
    return $randomString;
}
