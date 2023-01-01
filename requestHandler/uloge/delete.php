<?php

require "../../dbBroker.php";
require "../../model/uloga.php";

if(isset($_POST['id'])){

    $uloga = new Uloga($_POST['id']);

    $status = $uloga->delete($konekcija);

    if($status){
        echo"Uspesno";
    }else{
        echo $status;
        echo "Greska!";
    }

}

?>