<?php
    $user = 'root';
    $password = '';
    $server = 'localhost';
    $database = 'pozoriste';

    $konekcija = new mysqli($server, $user, $password, $database);

    if($konekcija->connect_errno){
        exit('Konekcija sa bazom neuspesna! '. $konekcija->connect_error);
    }
?>