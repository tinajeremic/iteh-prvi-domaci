<?php

require "../../dbBroker.php";
require "../../model/predstava.php";

if(isset($_POST['naziv']) &&
    isset($_POST['reditelj']) &&
    isset($_POST['komentar'])){

    $predstava = new Predstava(null,$_POST['naziv'],$_POST['reditelj'],
        $_POST['komentar']);

    $status = $predstava->add($konekcija);

    if($status){
        echo"Uspesno";
    }else{
        echo "Neuspesno";
    }

}

?>