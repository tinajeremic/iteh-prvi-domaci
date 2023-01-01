<?php

require "../../dbBroker.php";
require "../../model/uloga.php";

if(isset($_POST['id'])){

    $obj = Uloga::getUloga($_POST['id'],$konekcija);

    echo json_encode($obj);

}

?>