<?php

require "../../dbBroker.php";
require "../../model/User.php";

if(isset($_POST['ime']) &&
    isset($_POST['prezime']) &&
    isset($_POST['datumrodj']) &&
    isset($_POST['pol']) &&
    isset($_POST['username'])&&
    isset($_POST['password'])){

    $user = new User(null,$_POST['ime'],$_POST['prezime'],
        $_POST['datumrodj'],$_POST['pol'],
        $_POST['username'],$_POST['password']);

    $status = $user->add($konekcija);

    if($status){
        echo"Uspesno";
    }else{
        echo "Neuspesno";
    }

}


?>