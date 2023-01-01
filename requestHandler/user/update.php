<?php

require "../../dbBroker.php";
require "../../model/User.php";

if( isset($_POST['id']) &&
    isset($_POST['ime']) &&
    isset($_POST['prezime']) &&
    isset($_POST['datumRodj']) &&
    isset($_POST['pol']) &&
    isset($_POST['username']) &&
    isset($_POST['password'])){

    $user = new User($_POST['id'],$_POST['ime'],$_POST['prezime'],
                             $_POST['datumRodj'],$_POST['pol'],
                             $_POST['username'],$_POST['password']);

    $status = $user->update($konekcija);

    if($status){
        echo"Izmenjeno";
    }else{
        echo $status;
        echo "Greska!";
    }

}

?>