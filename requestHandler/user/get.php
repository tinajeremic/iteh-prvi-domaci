<?php

require "../../dbBroker.php";
require "../../model/User.php";

if(isset($_POST['username'])){

    $obj = User::getUser($_POST['username'],$konekcija);

    echo json_encode($obj);

}

?>