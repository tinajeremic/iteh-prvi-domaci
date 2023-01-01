<?php

require "../../dbBroker.php";
require "../../model/uloga.php";

if( isset($_POST['id']) &&
    isset($_POST['glumac']) &&
    isset($_POST['predstava_id']) &&
    isset($_POST['user_id']) &&
    isset($_POST['naziv'])){

    $uloga = new Uloga($_POST['id'],$_POST['glumac'],$_POST['predstava_id'],
        $_POST['user_id'],$_POST['naziv']);

    $status = $uloga->update($konekcija);

    if($status){
        echo"Uspesno";
    }else{
        echo $status;
        echo "Greska!";
    }

}

?>