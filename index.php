<?php
require "dbBroker.php";
require "model/Prijava.php";  

$greska=""; 
session_start();

if (isset($_SESSION['current_user'])) {
    header('Location: pocetna.php');
    exit();
}

if(isset($_POST['username']) && isset($_POST['password'])){
    $username=$_POST['username'];
    $password=$_POST['password'];

    $odg=Prijava::prijaviSe($konekcija,$username,$password);
    if($odg!=null && $odg->num_rows==1){
        $red=$odg->fetch_assoc();
        $_SESSION['current_user']=$red['username'];
        header('Location: pocetna.php');
        exit();
    }else{
        $greska="Pogresili ste username ili lozinku!!!";
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Napravi svoju predstavu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="css/style.css" rel="stylesheet">
    <link rel = "shortcut icon" type = "image/x-icon" href = "logo2.png"/>
</head>
<body>

<div class="header">
    <div class="naslov">  
    <img src ="logo2.png"></img>      
        <h1>Napravi svoju predstavu</h1>
    </div>

</div>

<div class="forma" style="margin-top: 50px;border-radius:25px">
    <form method="post">
        <div class="input-group mb-3 container">
            <input class="form-control" type="text" name="username" placeholder="Username" value="">
        </div>
        <div class="input-group mb-3 container">
            <input class="form-control" type="password" name="password" placeholder="Password" value="">
        </div>
        <div class="d-grid gap-2 d-md-block">
            <button type="submit" id="login" class="btn btn-success" style="background-color: rgb(255, 122, 127, .8); border: none">Log in</button>
            <button type="button" id="register" onclick="document.location.href='registracija.php'" class="btn btn-primary" style="background-color: rgb(255, 122, 127, .8); border: none">Napravi nalog</button>
        </div>

    </form>
    <br>
    <div style="display: block;">
        <p style="color: black; background-color: white;"><?=$greska?></p>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>
</html>