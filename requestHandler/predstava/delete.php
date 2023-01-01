<?php

require "../../dbBroker.php";
require "../../model/predstava.php";

if(isset($_POST['id'])){

    $predstava = new Predstava($_POST['id']);

    $status = $predstava->delete($konekcija);

    if($status){
        echo"Uspesno";
    }else{
        echo $status;
        echo "Neuspesno";
    }

}

?>