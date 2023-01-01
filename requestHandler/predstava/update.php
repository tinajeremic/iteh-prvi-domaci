<?php

require "../../dbBroker.php";
require "../../model/predstava.php";

if( isset($_POST['id']) &&
    isset($_POST['naziv']) &&
    isset($_POST['reditelj']) &&
    isset($_POST['komentar'])){
    $predstava = new Predstava($_POST['id'],$_POST['naziv'],$_POST['reditelj'],
        $_POST['komentar']);

    $status = $predstava->update($konekcija);

    if($status){
        echo"Uspesno";
    }else{
        echo $status;
        echo "Neuspesno";
    }

}

?>