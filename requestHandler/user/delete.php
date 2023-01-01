<?php

require "../../dbBroker.php";
require "../../model/User.php";

if(isset($_POST['id'])){

    $user=new User($_POST['id']);

    $status=$user->delete($konekcija);

    if($status){
        echo"Obrisano";
    }else{
        echo $status;
        echo "Greska!";
    }

}

?>