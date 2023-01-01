<?php

require "../../dbBroker.php";
require "../../model/predstava.php";

if(isset($_POST['id'])){

    $obj = Predstava::getPredstava($_POST['id'],$konekcija);

    echo json_encode($obj);

}

?>