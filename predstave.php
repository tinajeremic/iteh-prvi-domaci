<?php
session_start();

if (!isset($_SESSION['current_user'])) {
    header('Location: index.php');
    exit();
}

require "dbBroker.php";
require "model/User.php";
require "model/predstava.php";

$user = User::getUserUsername($_SESSION['current_user'],$konekcija)[0];
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
    <link rel = "shortcut icon" type = "image/x-icon" href = "logo.png"/>
</head>
<body>

<div class="header">
    <div class="naslov">
    <img src ="logo2.png"></img>
        <h1>Napravi svoju predstavu</h1>
    </div>

    <div class="navigacija d-flex justify-content-between">
        <ul class="nav" id="navigacija-lista" >
            <li class="nav-item">
                <a class="nav-link" aria-current="page" href="pocetna.php">Naslovna</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="predstave.php">Predstave</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="uloga.php">Uloge</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="profil.php">Profil</a>
            </li>            
        </ul>
        <div>
            <a class="btn btn-danger" href="odjava.php">Log out</a>
        </div>
    </div>
</div>

<div class="content">
    <div class="naslov">
        <h2>Predstava</h2>
    </div>

    <div class="forma" style = "border-radius:25px">
        <form method="post" id="formaPredstava">
            <input type="hidden" name="id" value="">

            <div class="input-group mb-3 container">
                <input class="form-control" type="text" name="naziv" placeholder="Naziv" value="">
            </div>
            <div class="input-group mb-3 container">
                <input class="form-control" type="text" name="reditelj" placeholder="Reditelj" value="">
            </div>

            <div class="input-group mb-3 container">
            <input class="form-control" type="text" name="komentar" placeholder="Komentar" value="">
            </div>

            <div class="d-grid gap-2 d-md-block">
                <button type="submit"  class="btn btn-success" style="background-color: rgb(255, 122, 127, .8); border: none">Sačuvaj predstavu</button>
                <button type="reset" id="resetPredstavu" class="btn btn-primary"style="background-color: rgb(255, 122, 127, .8); border: none">Resetuj formu za unos</button>
                <button type="button" id="obrisiPredstavu" class="btn btn-danger" style="background-color: rgb(255, 122, 127, .8); border: none" >Izbrisi predstavu</button>
            </div>

        </form>
    </div>

    <div class="prikazPodataka" style = "padding: 20px;border-radius:25px; background: transparent;">
        <div class="d-flex p-1 justify-content-center align-items-center">
            <div>
                <h3>Predstave</h3>
            </div>
            <div class="w-50 p-3">
                <input class="form-control" type="text" placeholder="pretraga" id="pretraga">
            </div>
            <div>
                <input class="form-control" type="button" id="sortBtn" value="sortiraj">
            </div>
        </div>

       <div class="row row-cols-1 row-cols-sm-2 g-3">
           <?php
           $predstave=Predstava::getAll($konekcija);
           while (($predstava=$predstave->fetch_assoc())!=null){?>

           <div class="col">
               <div class="card" style="background: radial-gradient(circle, rgba(122,20,65,1) 0%, rgba(74,19,27,1) 100%);border-radius:25px">
                   <div class="card-body">
                       <h5 class="card-title"><?=$predstava['naziv']?></h5>
                       <p class="card-text"><?=$predstava['reditelj']?></p>
                       <p class="card-text"><?=$predstava['komentar']?></p>
                       <input type="radio" name="predstavaCheck" value="<?=$predstava['id']?>">
               </div>
           </div>
       </div>

        <?php }
        ?>
       </div>



    </div>
</div>

<br>
<br>
<br>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="js/predstava.js"></script>


</body>
</html>